<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Booking;
use App\Enums\BookingStatus;
use App\Enums\RoomStatus;
use App\Enums\BookingStatusNextOptions;
use App\Mail\BookingStatusChanged;
use InvalidArgumentException;

class BookingStatusService
{
    public function update(Booking $booking, string|array $statusOrPayload): void
    {
        $status = $this->extractStatus($statusOrPayload);
        $this->validateStatus($status);
        $this->validateTransition($booking, $status);
        $this->handleRoomSideEffects($booking, $status);
        $booking->update(['status' => $status]);
        $this->sendStatusUpdateEmail($booking);
    }

    private function sendStatusUpdateEmail(Booking $booking)
    {
        $email = $booking->user->email ?? $booking->guest_email;
        safeMailSend($email, new BookingStatusChanged($booking));
    }

    private function extractStatus(string|array $input): ?string
    {
        return is_array($input) ? ($input['status'] ?? null) : $input;
    }

    private function validateStatus(?string $status): void
    {
        if (!in_array($status, BookingStatus::values(), true)) {
            throw new InvalidArgumentException("Invalid status provided.");
        }
    }

    private function validateTransition(Booking $booking, string $new): void
    {
        $valid = BookingStatusNextOptions::options($booking->status);
        if (!in_array($new, $valid, true)) {
            throw new InvalidArgumentException("Invalid status transition from {$booking->status} to $new.");
        }
    }

    private function handleRoomSideEffects(Booking $booking, string $status): void
    {
        $room = $booking->room;

        if ($status === BookingStatus::CHECKED_IN) {
            if ($booking->status !== BookingStatus::CONFIRMED) {
                throw new InvalidArgumentException("Booking status must be 'confirmed' before check-in.");
            }

            if ($room->status == RoomStatus::OUT_OF_SERVICE) {
                throw new InvalidArgumentException("Can't check in, this room is currently out of service.");
            }

            $room->update(['status' => RoomStatus::BOOKED]);
        }

        if ($status === BookingStatus::CHECKED_OUT) {
            if ($booking->status !== BookingStatus::CHECKED_IN) {
                throw new InvalidArgumentException("Booking status must be 'checked-in' before check-out.");
            }

            $room->update(['status' => RoomStatus::AVAILABLE]);
        }

        if ($status === BookingStatus::CONFIRMED) {
            if ($booking->status !== BookingStatus::PENDING) {
                throw new InvalidArgumentException("You can only confirm a pending reservation.");
            }

            $room->update(['status' => RoomStatus::BOOKED]);
        }
    }
}
