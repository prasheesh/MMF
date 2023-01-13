<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\Booking;
use Carbon\Carbon;
use DB;
error_reporting(0);
class ReportController extends Controller
{
    public function index()
    {
        $booking_history = Booking::get();
        
        $booking = Booking::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count', 'month_name');

        
        $bookinglabels = $booking->keys();
      

        $bookingdata = $booking->values();
        
        return view('dashboard.report.reports',get_defined_vars());
    }
}
