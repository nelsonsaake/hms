<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\RoomImage;

class RoomImageRepository
{
    /**
     * paginate: filter room image, and paginate
     * 
     * @param array $data {
     *    @type string $start_date (optional)
     *    @type string $end_date (optional)
     *    @type string $per_page (optional)
     * }
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $data)
    { 
        return RoomImage::query() 
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
    * find: find roomImage
    *
    * @param string $roomImageId
    * @return RoomImage|null
    */
    public function find(string $roomImageId): RoomImage|null
    {
        return RoomImage::find($roomImageId);
    }

    /**
     * create: create room image in db
     *
     * @param array $data {
     *    @type string $path
     *    @type string $room_id
     * }
     * @return RoomImage|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return RoomImage::create($data);
    }

    /**
     * update: update $roomImage with data in db
     *
     * @param \App\Models\RoomImage $roomImage
     * @param array $data {
     *    @type string $path (optional)
     *    @type string $room_id (optional)
     * }
     * @return RoomImage
     */
    public function update(RoomImage $roomImage, array $data)
    {
        $roomImage->update($data);

        return $roomImage;
    }

    /**
     * destroy: soft delete $roomImage
     *
     * @param \App\Models\RoomImage $roomImage
     * @return void
     */
    public function destroy(RoomImage $roomImage)
    {
        $roomImage->delete();
    }
}


