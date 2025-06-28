<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use App\Http\Requests\StoreRoomImageRequest;
use App\Http\Requests\UpdateRoomImageRequest;
use App\Http\Resources\RoomImageResource;
use App\Models\RoomImage;
use App\Models\Room;
use App\Repositories\RoomImageRepository; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class RoomImageController extends Controller
{
    public function __construct(
        protected RoomImageRepository $roomImageRepository, 
    ) {
    }

    /**
     * Display a listing of the room image.
     *
     * @return
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', RoomImage::class);

        try {  
            $roomImages = $this->roomImageRepository->paginate($request->all());
            return view('room_images.index', compact('roomImages'));
        } catch (\Exception $e) {
            Log::debug ("Error getting room image: " . $e->getMessage());
            $msg = 'Something went wrong getting room images, please try again later.';
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Create room image view.
     *
     * @param  Request  $request
     * @return
     */
    public function create(Request $request)
    {
        Gate::authorize('create', RoomImage::class);

        try { 
            $rooms = Room::all();

            return view(
                'room_images.create', 
                compact('rooms'),

            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create room image view, please try again later.';
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Store a newly created room image in storage.
     *
     * @param  StoreRoomImageRequest  $request
     * @return
     */
    public function store(StoreRoomImageRequest $request)
    {
        Gate::authorize('create', RoomImage::class);

        try { 
            $roomImage = $this->roomImageRepository->create($request->all()); 
            return redirect()
                ->route('room_images.index')
                ->with('success', 'Create room image successful');
        } catch (\Exception $e) {
            Log::debug ("Error creating room image: " . $e->getMessage());
            $msg = 'Something went wrong creating room image, please try again later.';
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Display the specified room image.
     *
     * @param  \App\Models\RoomImage  $roomImage
     * @return
     */
    public function show(RoomImage $roomImage)
    {
        Gate::authorize('view', $roomImage);

        return view(
            'room_images.show', 
            compact('roomImage'),
        );
    }

    /**
     * Display the specified room image.
     *
     * @param  \App\Models\RoomImage  $roomImage
     * @return
     */
    public function edit(RoomImage $roomImage)
    {
        Gate::authorize('view', $roomImage);

        try { 
            $rooms = Room::all();

            return view(
                'room_images.edit', 
                compact(
                    'roomImage','rooms'),
            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create room image view, please try again later.';
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Update the specified room image in storage.
     *
     * @param  UpdateRoomImageRequest  $request
     * @param  \App\Models\RoomImage  $roomImage
     * @return
     */
    public function update(UpdateRoomImageRequest $request, RoomImage $roomImage)
    {
        Gate::authorize('update', $roomImage);

        try {
            $roomImage = $this->roomImageRepository->update($roomImage, $request->all());
            return redirect()
                ->route('room_images.index')
                ->with('success', 'Update room image successful');
        } catch (\Exception $e) {
            Log::debug ("Error updating room image: " . $e->getMessage());
             return redirect()->back()->with('error', 
                'Something went wrong updating the room image, please try again later.'
            );
        } 
    }

    /**
     * Remove the specified room image from storage.
     *
     * @param  \App\Models\RoomImage  $roomImage
     * @return
     */
    public function destroy(RoomImage $roomImage)
    {
        Gate::authorize('delete', $roomImage);

        try {
            $this->roomImageRepository->destroy($roomImage);
            return redirect()
                ->route('room_images.index')
                ->with('success', 'Room Image deleted successfully.');
        } catch (\Exception $e) {
            Log::debug ("Error deleting room image: " .  $e->getMessage());
             return redirect()->back()->with('error', 
                'Something went wrong deleting the room image, please try again later.'
            );
        } 
    }
}

