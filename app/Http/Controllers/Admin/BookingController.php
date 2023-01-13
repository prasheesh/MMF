<?php

namespace App\Http\Controllers\Admin;
use App\Models\Booking;
use Carbon\Carbon;
error_reporting(0);
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $booking_history = Booking::get();
        $data['booking_history'] = $booking_history;


        $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->count();
        $data['booking_history_daliy'] = $booking_history_daliy;

        $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['booking_history_weekly'] = $booking_history_weekly;
        
        $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        $data['booking_history_month'] = $booking_history_month;

        $booking_history_year = Booking::whereYear('created_at', Carbon::now()->year)->count();
        $data['booking_history_year'] = $booking_history_year;

        $booking_history_total = Booking::count();
        $data['booking_history_total'] = $booking_history_total;

        
        return view('dashboard.bookings.bookings')->with($data);
    }
}
