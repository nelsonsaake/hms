<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Booking;

class BookingRepository
{

    /**
     * paginate: filter booking, and paginate
     * 
     * @param array $data { 
     *    @type string $status (optional)
     *    @type string $start_date (optional)
     *    @type string $end_date (optional)
     *    @type string $per_page (optional)
     * }
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $data)
    { 
        return Booking::query()
            ->when(get($data, 'status'), function ($query) use ($data) {
                $query->where('status', get($data, 'status'));
            }) 
            ->when(get($data, 'start_date'), function ($query) use ($data) {
                $query->whereDate('created_at', '>=', Carbon::parse(get($data, 'start_date')));
            })
            ->when(get($data, 'end_date'), function ($query) use ($data) {
                $query->whereDate('created_at', '<=', Carbon::parse(get($data, 'end_date')));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(get($data, 'per_page'));
    }

    /**
    * find: find booking
    *
    * @param string $bookingId
    * @return Booking|null
    */
    public function find(string $bookingId): Booking|null
    {
        return Booking::find($bookingId);
    }

    /**
     * create: create booking in db
     *
     * @param array $data {
     *    @type string $user_id
     *    @type string $room_id
     *    @type DateTime $check_in
     *    @type DateTime $check_out
     *    @type string $status
     *    @type string $guest_name
     *    @type string $guest_email
     *    @type string $guest_phone
     *    @type DateTime $from_date
     *    @type DateTime $to_date
     * }
     * @return Booking|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {

        return Booking::create($data);
    }

    /**
     * update: update $booking with data in db
     *
     * @param \App\Models\Booking $booking
     * @param array $data {
     *    @type string $user_id (optional)
     *    @type string $room_id (optional)
     *    @type DateTime $check_in (optional)
     *    @type DateTime $check_out (optional)
     *    @type string $status (optional)
     *    @type string $guest_name (optional)
     *    @type string $guest_email (optional)
     *    @type string $guest_phone (optional)
     *    @type DateTime $from_date (optional)
     *    @type DateTime $to_date (optional)
     * }
     * @return Booking
     */
    public function update(Booking $booking, array $data)
    {

        $booking->update($data);

        return $booking;
    }

    /**
     * destroy: soft delete $booking
     *
     * @param \App\Models\Booking $booking
     * @return void
     */
    public function destroy(Booking $booking)
    {

        $booking->delete();
    }
}

