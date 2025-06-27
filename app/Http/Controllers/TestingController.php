<?php

namespace App\Http\Controllers;

use App\Services\RoomImageSeederService;
use App\Services\RoomSeederService;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    /**
     * Make room details and room images make sense
     * 
     * @param \App\Services\RoomSeederService $roomSeederService
     * @param \App\Services\RoomImageSeederService $roomImageSeederService
     * @return  
     */
    public function seed(
        RoomSeederService $roomSeederService,
        RoomImageSeederService $roomImageSeederService,
    ) {
        $roomSeederService->run();
        $roomImageSeederService->run();
    }
}
