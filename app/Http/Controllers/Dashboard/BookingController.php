<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
error_reporting(0);

use DataTables;
use Auth;



class BookingController extends Controller
{
    public function index()
    {
        $booking_history = Booking::paginate(10);
        $data['booking_history'] = $booking_history;

        /*** Ajax Request By Datatable */
        if(request()->ajax()){

            if(Auth::check() && Auth::user()->user_type != 'Admin'){
                
                $data = Booking::where('users_id', Auth::id())->get();
                
            }else{
               
                // $data = Booking::get()->orderBy('DESC');

               $data= Booking::orderBy('id','DESC')->get();
            }
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('users_id', function($row){
                    $username = $row->users->name;
                    return $username;
                })
                ->addColumn('sector', function($row){
                    $sector = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $sector .= '<span class="badge bg-info">'.$booking_details->airport_city_from.' to '.$booking_details->airport_city_to.'</span><br>';
                    }
                    return $sector;

                })
                ->addColumn('airlines', function($row){
                    $airlines_type = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $airlines_type .= '<span class="badge bg-info">'.$booking_details->airlines_type.'</span><br>';
                    }
                    return $airlines_type;

                })
                ->addColumn('aborted_status', function($row){
                    $aborted = '';
                    if ($row->aborted_status == 'SUCCESS'){

                        $aborted .= '<small class="bg-success text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }

                    elseif ($row->aborted_status == 'Cancel'){

                        $aborted .= '<small class="bg-warning text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    else{

                        $aborted .= '<small class="bg-danger text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    
                    return $aborted;

                })
                
                ->rawColumns(['sector','airlines', 'aborted_status'])
                ->make(true);

        }

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
        }
        return view('dashboard.bookings.bookings')->with($data);
    }

    public function dailybookings()
    {


        if(Auth::check() && Auth::user()->user_type != 'Admin')
        {
             /**** User Dashboard *****/
            $booking_history_daliy = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliy;

            $booking_history_weekly = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;

            $booking_history_month = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;

            $booking_history_total = Booking::where('users_id', Auth::id())->count();
            $data['booking_history_total'] = $booking_history_total;

            
        }else{

            /**** Admin Dashboard *****/
            $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliy;

            $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;

            $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;

            $booking_history_total = Booking::count();
            $data['booking_history_total'] = $booking_history_total;
           
            
        }
        /** Ajax Request by Table */
        if(request()->ajax()){

            if(Auth::check() && Auth::user()->user_type != 'Admin'){
                $data = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->get();
            }else{
               
                $data = Booking::whereDate('created_at', Carbon::today())->get();
            }

            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('users_id', function($row){
                    $username = $row->users->name;
                    return $username;
                })
                ->addColumn('sector', function($row){
                    $sector = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $sector .= '<span class="badge bg-info">'.$booking_details->airport_city_from.' to '.$booking_details->airport_city_to.'</span><br>';
                    }
                    return $sector;

                })
                ->addColumn('airlines', function($row){
                    $airlines_type = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $airlines_type .= '<span class="badge bg-info">'.$booking_details->airlines_type.'</span><br>';
                    }
                    return $airlines_type;

                })
                ->addColumn('aborted_status', function($row){
                    $aborted = '';
                    if ($row->aborted_status == 'SUCCESS'){

                        $aborted .= '<small class="bg-success text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }

                    elseif ($row->aborted_status == 'Cancel'){

                        $aborted .= '<small class="bg-warning text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    else{

                        $aborted .= '<small class="bg-danger text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    
                    return $aborted;

                })
                ->rawColumns(['sector','airlines', 'aborted_status'])
                ->make(true);

        }

        return view('dashboard.bookings.daily.index')->with($data);

    }
    public function weeklybookings()
    {

        if(Auth::check() && Auth::user()->user_type != 'Admin')
        {
            /** User Dashboard */

            $booking_history_daliy = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliy;

            $booking_history_weekly = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;

            $booking_history_month = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;

            $booking_history_total = Booking::where('users_id', Auth::id())->count();
            $data['booking_history_total'] = $booking_history_total;


        }else{

            /** Admin Dashboard */
            $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliy;

            $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;

            $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;

            $booking_history_total = Booking::count();
            $data['booking_history_total'] = $booking_history_total;

        }
        
        /** Ajax Request By Table */
        if(request()->ajax())
        {
            if(Auth::check() && Auth::user()->user_type != 'Admin'){
                $data = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            }else{
               
                $data = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            }

            $data = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('users_id', function($row){
                    $username = $row->users->name;
                    return $username;
                })
                ->addColumn('sector', function($row){
                    $sector = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $sector .= '<span class="badge bg-info">'.$booking_details->airport_city_from.' to '.$booking_details->airport_city_to.'</span><br>';
                    }
                    return $sector;

                })
                ->addColumn('airlines', function($row){
                    $airlines_type = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $airlines_type .= '<span class="badge bg-info">'.$booking_details->airlines_type.'</span><br>';
                    }
                    return $airlines_type;

                })
                ->addColumn('aborted_status', function($row){
                    $aborted = '';
                    if ($row->aborted_status == 'SUCCESS'){

                        $aborted .= '<small class="bg-success text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }

                    elseif ($row->aborted_status == 'Cancel'){

                        $aborted .= '<small class="bg-warning text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    else{

                        $aborted .= '<small class="bg-danger text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    
                    return $aborted;

                })
                
                ->rawColumns(['sector','airlines', 'aborted_status'])
                ->make(true);

        }

        return view('dashboard.bookings.weekly.index')->with($data);

    }
    public function monthlybookings()
    {


        if(Auth::check() && Auth::user()->user_type != 'Admin')
        {

            /** User Dashboard */
            $booking_history_daliy = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliy;

            $booking_history_weekly = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;

            $booking_history_month = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;

            $booking_history_total = Booking::where('users_id', Auth::id())->count();
            $data['booking_history_total'] = $booking_history_total;

        }else{

            /** Admin Dashboard */
            $booking_history_daliy = Booking::whereDate('created_at', Carbon::today())->count();
            $data['booking_history_daliy'] = $booking_history_daliy;

            $booking_history_weekly = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['booking_history_weekly'] = $booking_history_weekly;

            $booking_history_month = Booking::whereMonth('created_at', Carbon::now()->month)->count();
            $data['booking_history_month'] = $booking_history_month;

            $booking_history_total = Booking::count();
            $data['booking_history_total'] = $booking_history_total;
            
        }

        /** Ajax Request By Table */
        if(request()->ajax()){

            if(Auth::check() && Auth::user()->user_type != 'Admin'){
                $data = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->get();
            }else{
               
                $data = Booking::whereMonth('created_at', Carbon::now()->month)->get();
            }

            $data = Booking::whereMonth('created_at', Carbon::now()->month)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('users_id', function($row){
                    $username = $row->users->name;
                    return $username;
                })
                ->addColumn('sector', function($row){
                    $sector = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $sector .= '<span class="badge bg-info">'.$booking_details->airport_city_from.' to '.$booking_details->airport_city_to.'</span><br>';
                    }
                    return $sector;

                })
                ->addColumn('airlines', function($row){
                    $airlines_type = '';
                    foreach ($row->bookingdetails  as $booking_details){
                        $airlines_type .= '<span class="badge bg-info">'.$booking_details->airlines_type.'</span><br>';
                    }
                    return $airlines_type;

                })
                ->addColumn('aborted_status', function($row){
                    $aborted = '';
                    if ($row->aborted_status == 'SUCCESS'){

                        $aborted .= '<small class="bg-success text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }

                    elseif ($row->aborted_status == 'Cancel'){

                        $aborted .= '<small class="bg-warning text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    else{

                        $aborted .= '<small class="bg-danger text-white plr-2 radius-3">'.$row->aborted_status.'</small>';
                    }
                    
                    return $aborted;

                })
                ->rawColumns(['sector','airlines', 'aborted_status'])
                ->make(true);

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
