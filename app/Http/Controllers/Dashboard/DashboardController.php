<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use DataTables;
use Auth;
use App\Models\Dashboard\Booking;
use App\Models\User;
use DB;
error_reporting(0);
class DashboardController extends Controller
{
    public function index()
    {

        if(Auth::check() && Auth::user()->user_type != 'Admin')
        {
            /** User Dashboard */
            $booking_history_daliys = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliys;
    
            $booking_history_weekly = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;
    
            $booking_history_month = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;
    
            $booking_history_total = Booking::where('users_id', Auth::id())->count();
            $data['booking_history_total'] = $booking_history_total;

            $daily_booking_amount = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::where('users_id', Auth::id())->sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;

        }else{

            /** Admin Dashboard */
            $booking_history_daliys = Booking::whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliys;

            $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;

            $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;

            $booking_history_total = Booking::count();
            $data['booking_history_total'] = $booking_history_total;

            $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;
        }

        $users_b2b = User::where('user_type','B2B')->count();
        $data['users_b2b'] = $users_b2b;
        $users_b2e = User::where('user_type','B2E')->count();
        $data['users_b2e'] = $users_b2e;

        $booking = Booking::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count', 'month_name');

        
        $bookinglabels = $booking->keys();
        $data['bookinglabels'] = $bookinglabels;

        $bookingdata = $booking->values();
        $data['bookingdata'] = $bookingdata;

      

        return view('dashboard.index')->with($data);
    }
}
