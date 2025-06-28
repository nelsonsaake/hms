<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BookingsReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\BookingReportRepository;

class BookingReportController extends Controller
{
    public function __construct(
        protected BookingReportRepository $repository
    ) {}

    public function index(Request $request)
    {
        $bookings = $this->repository
            ->filtered($request)
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return view('reports.bookings', compact('bookings'));
    }

    public function export(Request $request)
    {
        $bookings = $this->repository->export($request);

        return Excel::download(new BookingsReportExport($bookings), 'bookings_report.xlsx');
    }
}
