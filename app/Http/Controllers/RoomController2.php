<?php

namespace App\Http\Controllers;

use App\Enums\RoomStatus;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class RoomController2 extends Controller
{
    public function __construct(
        protected RoomRepository $roomRepository, 
    ) {
    }

    public function availableRooms(Request $request)
    {
        $rooms = $this->roomRepository->paginate($request->all(
            [
                'status' => RoomStatus::AVAILABLE
            ]
        ));
        return view('rooms.available', compact('rooms'));
    }
     
    /**
     * Update the specified room in storage.
     *
     * @param  UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return
     */
    public function makeAvailable(UpdateRoomRequest $request, Room $room)
    {
        Gate::authorize('update', $room);

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
     * Update the specified room in storage.
     *
     * @param  UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return
     */
    public function makeOOS(UpdateRoomRequest $request, Room $room)
    {
        Gate::authorize('update', $room);

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
}
