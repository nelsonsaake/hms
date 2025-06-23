<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\RoomImage;
use Illuminate\Support\Arr;

class RoomImageRepository
{

    protected string $disk = "local";

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
    * Store a file from the given data array under a specific key.
    *
    * @param array $data The input data array containing the file.
    * @param string $key The key in the array where the file is expected.
    * @return string|null The path to the stored file or null if no file was provided.
    */
    public function storeFile(array $data, string $key): string|null
    {
        $file = Arr::get($data, $key);
        if (!$file) {
            return null;
        }

        return $file->store('uploads/room_images', $this->disk);
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
        $data['path'] = $this->storeFile($data, 'path');

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

