<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Room;

class RoomRepository
{

    /**
     * paginate: filter room, and paginate
     * 
     * @param array $data { 
     *    @type string $status (optional)
     *    @type string $search (optional)
     *    @type string $start_date (optional)
     *    @type string $end_date (optional)
     *    @type string $per_page (optional)
     * }
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $data)
    { 
        $search = get($data, 'search');

        return Room::query()
            ->when($search, function ($query) use ($search) {
                return $query
                    ->where('description', 'like', "%$search%");
            })
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
    * find: find room
    *
    * @param string $roomId
    * @return Room|null
    */
    public function find(string $roomId): Room|null
    {
        return Room::find($roomId);
    }

    /**
     * create: create room in db
     *
     * @param array $data {
     *    @type string $type
     *    @type double $price
     *    @type int $beds
     *    @type string $description
     *    @type string $status
     *    @type int $floor
     *    @type int $number
     * }
     * @return Room|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {

        return Room::create($data);
    }

    /**
     * update: update $room with data in db
     *
     * @param \App\Models\Room $room
     * @param array $data {
     *    @type string $type (optional)
     *    @type double $price (optional)
     *    @type int $beds (optional)
     *    @type string $description (optional)
     *    @type string $status (optional)
     *    @type int $floor (optional)
     *    @type int $number (optional)
     * }
     * @return Room
     */
    public function update(Room $room, array $data)
    {

        $room->update($data);

        return $room;
    }

    /**
     * destroy: soft delete $room
     *
     * @param \App\Models\Room $room
     * @return void
     */
    public function destroy(Room $room)
    {

        $room->delete();
    }
}

