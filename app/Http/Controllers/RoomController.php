<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\MessageResponse;
use App\Http\Responses\ErrorResponse;
use App\Http\Request\StoreRoomRequest;
use App\Http\Request\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Repositories\RoomRepository; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    public function __construct(
        protected RoomRepository $roomRepository, 
    ) {
    }

    /**
     * Display a listing of the room.
     *
     * @return
     */
    public function index(Request $request)
    {
      //  Gate::authorize('viewAny', Room::class);

        try {  
            $rooms = $this->roomRepository->paginate($request->all());
            return view('rooms.index', compact('rooms'));
        } catch (\Exception $e) {
            Log::debug ("Error getting room: " . $e->getMessage());
            $msg = 'Something went wrong getting rooms, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Create room view.
     *
     * @param  Request  $request
     * @return
     */
    public function create(Request $request)
    {
       // Gate::authorize('create', Room::class);

        try {

            return view(
                'rooms.create',

            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create room view, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Store a newly created room in storage.
     *
     * @param  StoreRoomRequest  $request
     * @return
     */
    public function store(StoreRoomRequest $request)
    {
        // Gate::authorize('create', Room::class);

        try { 
            $room = $this->roomRepository->create($request->all()); 
            return redirect()
                ->route('rooms.index')
                ->with('success', 'Create room successful');
        } catch (\Exception $e) {
            Log::debug ("Error creating room: " . $e->getMessage());
            $msg = 'Something went wrong creating room, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Display the specified room.
     *
     * @param  \App\Models\Room  $room
     * @return
     */
    public function show(Room $room)
    {
        // Gate::authorize('view', $room);

        return view(
            'rooms.show', 
            compact('room'),
        );
    }

    /**
     * Display the specified room.
     *
     * @param  \App\Models\Room  $room
     * @return
     */
    public function edit(Room $room)
    {
        // Gate::authorize('view', $room);

        try {

            return view(
                'rooms.edit', 
                compact(
                    'room',),
            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create room view, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Update the specified room in storage.
     *
     * @param  UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        // Gate::authorize('update', $room);

        try {
            $room = $this->roomRepository->update($room, $request->all());
            return redirect()
                ->route('rooms.index')
                ->with('success', 'Update room successful');
        } catch (\Exception $e) {
            Log::debug ("Error updating room: " . $e->getMessage());
             return redirect()->back()->withErrors(
                'Something went wrong updating the room, please try again later.'
            );
        } 
    }

    /**
     * Remove the specified room from storage.
     *
     * @param  \App\Models\Room  $room
     * @return
     */
    public function destroy(Room $room)
    {
        // Gate::authorize('delete', $room);

        try {
            $this->roomRepository->destroy($room);
            return redirect()
                ->route('rooms.index')
                ->with('success', 'Room deleted successfully.');
        } catch (\Exception $e) {
            Log::debug ("Error deleting room: " .  $e->getMessage());
             return redirect()->back()->withErrors(
                'Something went wrong deleting the room, please try again later.'
            );
        } 
    }
}

