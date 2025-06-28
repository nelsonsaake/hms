<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class BookingReportRepository
{
    /**
     * Get a filtered query builder for bookings report.
     *
     * Filters include:
     * - Search (guest name, email, phone, room number)
     * - Date range (applied to from_date, to_date, check_in, check_out, created_at)
     * - Status
     *
     * @param Request $request
     * @return Builder
     */
    public function filtered(Request $request): Builder
    {
        return Booking::query()
            ->with('room')
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $search = $request->search;
                $q->where(function ($q) use ($search) {
                    $q->where('guest_name', 'like', "%{$search}%")
                      ->orWhere('guest_email', 'like', "%{$search}%")
                      ->orWhere('guest_phone', 'like', "%{$search}%")
                      ->orWhereHas('room', fn($qr) => $qr->where('number', 'like', "%{$search}%"));
                });
            })
            ->when($request->filled('start_date'), function (Builder $q) use ($request) {
                $start = $request->start_date;
                $q->where(function (Builder $q) use ($start) {
                    $q->whereDate('from_date', '>=', $start)
                      ->orWhereDate('to_date', '>=', $start)
                      ->orWhereDate('check_in', '>=', $start)
                      ->orWhereDate('check_out', '>=', $start)
                      ->orWhereDate('created_at', '>=', $start);
                });
            })
            ->when($request->filled('end_date'), function (Builder $q) use ($request) {
                $end = $request->end_date;
                $q->where(function (Builder $q) use ($end) {
                    $q->whereDate('from_date', '<=', $end)
                      ->orWhereDate('to_date', '<=', $end)
                      ->orWhereDate('check_in', '<=', $end)
                      ->orWhereDate('check_out', '<=', $end)
                      ->orWhereDate('created_at', '<=', $end);
                });
            })
            ->when($request->filled('status'), fn(Builder $q) => $q->where('status', $request->status));
    }

    /**
     * Get a collection of bookings for export, applying the same filters as the report view.
     *
     * @param Request $request
     * @return Collection<int, Booking>
     */
    public function export(Request $request): Collection
    {
        return $this->filtered($request)->latest()->get();
    }
}
