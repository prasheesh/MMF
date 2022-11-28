<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $booking_history = Booking::paginate(10);
        $data['booking_history'] = $booking_history;

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


        $booking_history_daliys = Booking::whereDate('created_at', Carbon::today())->count();
        $data['booking_history_daliy'] = $booking_history_daliys;

        $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['booking_history_weekly'] = $booking_history_weekly;

        $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        $data['booking_history_month'] = $booking_history_month;

        // $booking_history_year = Booking::whereYear('created_at', Carbon::now()->year)->count();
        // $data['booking_history_year'] = $booking_history_year;


        $booking_history_total = Booking::count();
        $data['booking_history_total'] = $booking_history_total;


        return view('dashboard.bookings.bookings')->with($data);
    }

    public function dailybookings(){

        $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->paginate(10);
        $data['booking_history'] = $booking_history_daliy;

        $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->count();
        $data['booking_history_daliy'] = $booking_history_daliy;

        $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['booking_history_weekly'] = $booking_history_weekly;

        $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        $data['booking_history_month'] = $booking_history_month;

        $booking_history_total = Booking::count();
        $data['booking_history_total'] = $booking_history_total;

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

        return view('dashboard.bookings.daily.index')->with($data);

    }
    public function weeklybookings(){

        $booking_history_daliy = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);

        $data['booking_history'] = $booking_history_daliy;

        $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->count();
        $data['booking_history_daliy'] = $booking_history_daliy;

        $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['booking_history_weekly'] = $booking_history_weekly;

        $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        $data['booking_history_month'] = $booking_history_month;

        $booking_history_total = Booking::count();
        $data['booking_history_total'] = $booking_history_total;


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

        return view('dashboard.bookings.weekly.index')->with($data);

    }
    public function monthlybookings(){

        $booking_history_daliy = Booking::whereMonth('created_at', Carbon::now()->month)->paginate(10);
        $data['booking_history'] = $booking_history_daliy;

        $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->count();
        $data['booking_history_daliy'] = $booking_history_daliy;

        $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $data['booking_history_weekly'] = $booking_history_weekly;

        $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        $data['booking_history_month'] = $booking_history_month;

        $booking_history_total = Booking::count();
        $data['booking_history_total'] = $booking_history_total;


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



        return view('dashboard.bookings.monthly.index')->with($data);

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
                    <td>';
                        foreach ($results->bookingdetails  as $booking_details){
                            $searchoutput .= '

                            <span class="badge bg-success">'.$booking_details->airlines_type.' </span><br>

                            ';
                        }


                    $searchoutput .= '</td>
                    <td>'.$results->amount.'</td>
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
