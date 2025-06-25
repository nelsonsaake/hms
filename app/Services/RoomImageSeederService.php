<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\RoomType;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as LaravelFile;
use Illuminate\Support\Str;

class RoomImageSeederService
{
    /**
     * Simulates uploading files from a resource path directory and stores them like uploaded files.
     *
     * @param string $roomTypeDir  The subdirectory under `resources/images` to load files from (e.g., "single", "double").
     * @return string[]  An array of publicly accessible URLs to the newly stored files.
     */
    public function simulateUploadRooomPhoto(string $roomTypeDir): array
    {
        $dir = resource_path("images/{$roomTypeDir}");

        if (!File::exists($dir)) {
            return []; // or throw an exception if preferred
        }

        $files = File::files($dir);
        $storedPaths = [];

        foreach ($files as $file) {
            $uploadedFile = new LaravelFile($file->getRealPath());
            $path = Storage::disk('public')->putFile("uploads/rooms/{$roomTypeDir}", $uploadedFile);
            $storedPaths[] = $path;
        }

        return $storedPaths;
    }

    /**
     * Deletes all files in the given uploads/rooms/{roomTypeDir} directory on the public disk.
     *
     * @param string $roomTypeDir The subdirectory under `uploads/rooms` to clear (e.g., "single", "double").
     * @return bool True if directory exists and files were deleted, false otherwise.
     */
    public function clearUploadedRoomFiles(string $roomTypeDir): bool
    {
        $disk = Storage::disk('public');
        $dir = "uploads/rooms/{$roomTypeDir}";

        if (!$disk->exists($dir)) {
            return false;
        }

        $files = $disk->files($dir);

        foreach ($files as $file) {
            $disk->delete($file);
        }

        return true;
    }

    /**
     * Clears all room images and re-seeds them by simulating uploads from resource directories.
     *
     * @return void
     */
    public function run(): void
    {
        // Clear all existing room images
        RoomImage::truncate();

        // Fetch all rooms once
        $rooms = Room::all();

        // Clear files from disk
        foreach(RoomType::values() as $roomType){
            $this->clearUploadedRoomFiles($roomType);
        }

        // we seed the system 
        foreach ($rooms as $room) {

            // Simulate uploads
            $paths = $this->simulateUploadRooomPhoto($room->type);

            // Prepare and insert new image records
            $images = array_map(fn($path) => [
                'id' => Str::uuid(),
                'path' => $path,
                'room_id' => $room->id,
                'created_at' => now(),
                'updated_at' => now(),
            ], $paths);

            RoomImage::insert($images);
        }
    }
}
