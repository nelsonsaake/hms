<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (authUser()->hasRole(Roles::ADMINISTRATOR)) {
            return redirect()->route('bookings.index');
        }

        return redirect()->route('reservations.index');
    }
}
