<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $rooms = Room::with('roomImages')
            // ->where('status', 'available')
            ->get();

        return view(
            'welcome',
            compact('rooms')
        );
    }
}
