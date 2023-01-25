<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard\Booking;
use Carbon\Carbon;
use DB;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

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

        return view('dashboard.report.reports', get_defined_vars());
    }

    public function filterReports(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $days_history = $request->days_history;
        // dd($days_history);
        if ($days_history) {
            if ($days_history == "1") {
                $days = date(today());
                $booking_history = DB::table('bookings')
                    ->where('created_at', date(now()))
                    ->get();
            } else if ($days_history == "30") {
                $month = Carbon::now()->month;
                $booking_history = DB::table('bookings')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->get();
            } else if ($days_history == "2") {
                $booking_history = DB::table('bookings')
                    ->get();
            } else {
            }
        } else {
            $booking_history = DB::table('bookings')
                ->whereBetween('created_at', [$from_date, $to_date])
                ->get();
        }

        $validate = $request->validate([
            // 'to_date' => ['required_if:from_date, from_date'],
            // 'days_history' => ['required_if:from_date, ==, '],
            'from_date' => ['nullable'],
            'to_date' => ['required_with:from_date'],
            'days_history' => ['required_without:from_date']
        ]);
        $booking = Booking::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count', 'month_name');

        // $booking_history = DB::table('bookings')
        //     ->whereBetween('created_at', [$from_date, $to_date])
        //     // ->where('created_at', '>=', $from_date)
        //     // ->where('created_at', '<=', $to_date)
        //     ->get();

        $booking_history_length = sizeof($booking_history);
        $bookinglabels = $booking_history->keys();
        $bookingdata = $booking_history->values();
        // return get_defined_vars();
        return view('dashboard.report.reports', get_defined_vars());
    }

    public function getUserDetails(Request $request)
    {
        $booking_id = $request->segment('3');

        $bookings = DB::table('bookings')
            ->where('booking_id', $booking_id)
            ->first();

        $user = DB::table('users')
            ->where('id', $bookings->users_id)
            ->first();

        $booking_details = DB::table('passenger_details')
            ->where('booking_id', $bookings->id)
            ->get();

        // dd($booking_details);
        return view('dashboard.report.user_details', get_defined_vars());
    }
}
