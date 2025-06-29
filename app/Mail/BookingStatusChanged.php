<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Enums\BookingStatus;

/**
 * Mailable for notifying the user when a booking status has changed.
 */
class BookingStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Booking $reservation
     */
    public function __construct(public Booking $reservation)
    {
        //
    }

    /**
     * Get the envelope (subject line and other metadata) for the message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->generateSubject(),
        );
    }

    /**
     * Get the content (view and view data) of the message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_status_changed',
        );
    }

    /**
     * Get any attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Generate the dynamic subject line based on booking status.
     */
    private function generateSubject(): string
    {
        return match ($this->reservation->status) {
            BookingStatus::PENDING     => 'Booking Request Received',
            BookingStatus::CONFIRMED   => 'Your Booking is Confirmed!',
            BookingStatus::CHECKED_IN  => 'Welcome! You’ve Checked In',
            BookingStatus::CHECKED_OUT => 'Hope You Enjoyed Your Stay',
            BookingStatus::CANCELLED   => 'Your Booking was Cancelled',
            BookingStatus::NO_SHOW     => 'Marked as No Show',
            BookingStatus::RESCHEDULED => 'Your Booking Has Been Rescheduled',
            BookingStatus::ON_HOLD     => 'Your Booking is On Hold',
            BookingStatus::FAILED      => 'There Was an Issue With Your Booking',
            BookingStatus::REFUNDED    => 'Booking Refunded',
            default                    => 'Booking Status Updated',
        };
    }

    /**
     * Get a dynamic heading for the email body.
     */
    public function heading(): string
    {
        return match ($this->reservation->status) {
            BookingStatus::PENDING     => 'Booking Request Received',
            BookingStatus::CONFIRMED   => 'Booking Confirmed!',
            BookingStatus::CHECKED_IN  => 'You’ve Checked In',
            BookingStatus::CHECKED_OUT => 'You’ve Checked Out',
            BookingStatus::CANCELLED   => 'Booking Cancelled',
            BookingStatus::NO_SHOW     => 'Marked as No Show',
            BookingStatus::RESCHEDULED => 'Booking Rescheduled',
            BookingStatus::ON_HOLD     => 'Booking On Hold',
            BookingStatus::FAILED      => 'Booking Failed',
            BookingStatus::REFUNDED    => 'Refund Processed',
            default                    => 'Booking Status Updated',
        };
    }

    /**
     * Get a dynamic message/paragraph to include in the email body based on the current status.
     */
    public function messageText(): ?string
    {
        return match ($this->reservation->status) {
            BookingStatus::PENDING     => "We've received your booking request. It is currently under review, and we’ll notify you once it’s confirmed.",
            BookingStatus::CONFIRMED   => "Your booking has been confirmed. We can't wait to welcome you!",
            BookingStatus::CHECKED_IN  => "You're all checked in. Enjoy your stay!",
            BookingStatus::CHECKED_OUT => "Thanks for staying with us. We hope to see you again!",
            BookingStatus::CANCELLED   => "We're sorry your booking was cancelled. If this was a mistake, please contact us.",
            BookingStatus::NO_SHOW     => "Your reservation is marked as no-show. You may be subject to charges.",
            BookingStatus::RESCHEDULED => "Your booking has been successfully rescheduled.",
            BookingStatus::ON_HOLD     => "Your booking is currently on hold. We’ll notify you once it progresses.",
            BookingStatus::FAILED      => "There was an issue processing your booking. Please reach out to support if you need assistance.",
            BookingStatus::REFUNDED    => "A refund has been processed for your cancelled booking.",
            default                    => null,
        };
    }
}
