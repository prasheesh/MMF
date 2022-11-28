<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Booking;
use Carbon\Carbon;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $finance_history = Booking::paginate(10);
        $data['finance_historys'] = $finance_history;

        $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
        $data['daily_booking_amount'] = $daily_booking_amount;

        $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $data['weekly_booking_amount'] = $weekly_booking_amount;

        $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $data['monthly_booking_amount'] = $monthly_booking_amount;

        $total_booking_amount = Booking::sum('amount');
        $data['total_booking_amount'] = $total_booking_amount;

        // Ajax Request when ge search key
        if(request()->ajax())
        {
            $searchvalue = request()->searchvalue;

            $searchresults = Booking::where('booking_id', 'like', "%$searchvalue%")
            ->orWhere('phone_number', 'like', "%$searchvalue%")
            ->orderBy('booking_id')->paginate(10);

            $searchoutput = $this->searchfind($searchresults);


            return response()->json($searchoutput, 200);

        }

        return view('dashboard.finance.finance')->with($data);
    }

    public function dailyamount()
    {
        $finance_history = Booking::whereDate('created_at', Carbon::today())->paginate(10);
        $data['finance_historys'] = $finance_history;

        $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
        $data['daily_booking_amount'] = $daily_booking_amount;

        $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $data['weekly_booking_amount'] = $weekly_booking_amount;

        $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $data['monthly_booking_amount'] = $monthly_booking_amount;

        $total_booking_amount = Booking::sum('amount');
        $data['total_booking_amount'] = $total_booking_amount;

         // Ajax Request when ge search key
         if(request()->ajax())
         {
             $searchvalue = request()->searchvalue;

             $searchresults = Booking::whereDate('created_at', Carbon::today())->where('booking_id', 'like', "%$searchvalue%")
             ->orWhere('phone_number', 'like', "%$searchvalue%")
             ->orderBy('booking_id')->paginate(10);

             $searchoutput = $this->searchfind($searchresults);


             return response()->json($searchoutput, 200);

         }

        return view('dashboard.finance.finance')->with($data);
    }

    public function weeklyamount()
    {
        $finance_history = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $data['finance_historys'] = $finance_history;

        $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
        $data['daily_booking_amount'] = $daily_booking_amount;

        $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $data['weekly_booking_amount'] = $weekly_booking_amount;

        $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $data['monthly_booking_amount'] = $monthly_booking_amount;

        $total_booking_amount = Booking::sum('amount');
        $data['total_booking_amount'] = $total_booking_amount;

        // Ajax Request when ge search key
        if(request()->ajax())
        {
            $searchvalue = request()->searchvalue;

            $searchresults = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('booking_id', 'like', "%$searchvalue%")
            ->orWhere('phone_number', 'like', "%$searchvalue%")
            ->orderBy('booking_id')->paginate(10);

            $searchoutput = $this->searchfind($searchresults);


            return response()->json($searchoutput, 200);

        }

        return view('dashboard.finance.finance')->with($data);
    }

    public function monthlyamount()
    {
        $finance_history = Booking::whereMonth('created_at', Carbon::now()->month)->paginate(10);
        $data['finance_historys'] = $finance_history;

        $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
        $data['daily_booking_amount'] = $daily_booking_amount;

        $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $data['weekly_booking_amount'] = $weekly_booking_amount;

        $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
        $data['monthly_booking_amount'] = $monthly_booking_amount;

        $total_booking_amount = Booking::sum('amount');
        $data['total_booking_amount'] = $total_booking_amount;

        // Ajax Request when ge search key
        if(request()->ajax())
        {
            $searchvalue = request()->searchvalue;

            $searchresults = Booking::whereMonth('created_at', Carbon::now()->month)->where('booking_id', 'like', "%$searchvalue%")
            ->orWhere('phone_number', 'like', "%$searchvalue%")
            ->orderBy('booking_id')->paginate(10);

            $searchoutput = $this->searchfind($searchresults);


            return response()->json($searchoutput, 200);

        }

        return view('dashboard.finance.finance')->with($data);
    }


    public function payment_summery()
    {
        return view('dashboard.finance.payment_summery');
    }

    public function balance_with_users()
    {
        return view('dashboard.finance.balance_with_users');
    }

    public function credit_limit()
    {
        return view('dashboard.finance.credit_limit');
    }



    /******  Search Result For One Query  *******/
    public function searchfind($searchresult)
    {

        $searchoutput = '';
        $i = 1;
        foreach ($searchresult as $results)
        {
            $searchoutput .= '<tr>

                    <td>'.$i++ .'</td>
                    <td>'.$results->users->name.'</td>
                    <td>'.$results->booking_id.'</td>
                    <td>';
                        foreach ($results->bookingdetails  as $booking_details){
                            $searchoutput .= '
                            <span class="badge bg-info">'.$booking_details->airport_city_from.' to '.$booking_details->airport_city_to.'</span><br>
                            ';
                        }
                    $searchoutput .= '</td>

                    <td>'.$results->noofpassenger.'</td>

                    <td class="d-flex justify-content-between">
                        <span>MMFInv158478</span>
                        <span><a href="#"><i class="fa fa-eye"></i></a></span>
                    </td>

                    <td>';
                    if ($results->aborted_status == 'SUCCESS'){
                        $searchoutput .= ' <small class="bg-success text-white plr-2 radius-3">'.$results->aborted_status.'</small>';
                    }elseif ($results->aborted_status == 'Cancel'){
                        $searchoutput .= '<small class="bg-warning text-white plr-2 radius-3">'.$results->aborted_status.'</small>';
                    }else{
                        $searchoutput .= ' <small class="bg-danger text-white plr-2 radius-3">'.$results->aborted_status.'</small>';
                    }
                    $searchoutput .= '</td>
                    </tr>';
        }
        return $searchoutput;
    }


}
