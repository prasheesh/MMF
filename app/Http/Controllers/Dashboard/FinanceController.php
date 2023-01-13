<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Booking;
use Carbon\Carbon;
use DataTables;
use Auth; 
error_reporting(0);
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $finance_history = Booking::paginate(10);
        $data['finance_historys'] = $finance_history;


        if(Auth::check() && Auth::user()->user_type != 'Admin')
        {
           
            /*** User Dashboard  */
            $daily_booking_amount = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;
    
            $weekly_booking_amount = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;
    
            $monthly_booking_amount = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;
    
            $total_booking_amount = Booking::where('users_id', Auth::id())->sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;


        }else{

            /*** Admin Dashboard */
            $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;
    
            $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;
    
            $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;
    
            $total_booking_amount = Booking::sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;

            

        }

        if(request()->ajax()){

            if(Auth::check() && Auth::user()->user_type != 'Admin')
            {
                $data = Booking::where('users_id', Auth::id())->get();

            }else{
                $data = Booking::get();
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
                ->addColumn('invoice', function($row){
                    $invoice = '<div class="d-flex justify-content-between"> <span>MMFInv158478</span>
                    <span><a href="#"><i class="fa fa-eye"></i></a></span></div>';
                   
                    return $invoice;

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
                
                ->rawColumns(['sector','invoice', 'aborted_status'])
                ->make(true);

        }

        return view('dashboard.finance.finance')->with($data);
    }

    public function dailyamount()
    {
        $finance_history = Booking::whereDate('created_at', Carbon::today())->paginate(10);
        $data['finance_historys'] = $finance_history;

        

        if(Auth::check() && Auth::user()->user_type != 'Admin'){

            $daily_booking_amount = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::where('users_id', Auth::id())->sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;

        }else{

            $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;

        }

        if(request()->ajax()){


            if(Auth::check() && Auth::user()->user_type != 'Admin')
            {
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
                ->addColumn('invoice', function($row){
                    $invoice = '<div class="d-flex justify-content-between"> <span>MMFInv158478</span>
                    <span><a href="#"><i class="fa fa-eye"></i></a></span></div>';
                   
                    return $invoice;

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
                
                ->rawColumns(['sector','invoice', 'aborted_status'])
                ->make(true);

        }

        return view('dashboard.finance.daily.index')->with($data);
    }

    public function weeklyamount()
    {
        $finance_history = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $data['finance_historys'] = $finance_history;

        

        if(Auth::check() && Auth::user()->user_type != 'Admin')
        {

            $daily_booking_amount = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::where('users_id', Auth::id())->sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;

        }else{

            $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;

        }

        if(request()->ajax()){

            if(Auth::check() && Auth::user()->user_type != 'Admin')
            {
                $data = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

            }else{
                $data = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
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
                ->addColumn('invoice', function($row){
                    $invoice = '<div class="d-flex justify-content-between"> <span>MMFInv158478</span>
                    <span><a href="#"><i class="fa fa-eye"></i></a></span></div>';
                   
                    return $invoice;

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
                
                ->rawColumns(['sector','invoice', 'aborted_status'])
                ->make(true);

        }

        return view('dashboard.finance.weekly.index')->with($data);
    }

    public function monthlyamount()
    {
        

        if(Auth::check() && Auth::user()->user_type != 'Admin')
        {

            $finance_history = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->paginate(10);
            $data['finance_historys'] = $finance_history;

            $daily_booking_amount = Booking::where('users_id', Auth::id())->whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::where('users_id', Auth::id())->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::where('users_id', Auth::id())->sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;

        }else{

            $daily_booking_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
            $data['daily_booking_amount'] = $daily_booking_amount;

            $weekly_booking_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $data['weekly_booking_amount'] = $weekly_booking_amount;

            $monthly_booking_amount = Booking::whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $data['monthly_booking_amount'] = $monthly_booking_amount;

            $total_booking_amount = Booking::sum('amount');
            $data['total_booking_amount'] = $total_booking_amount;


        }

        if(request()->ajax())
        {

            if(Auth::check() && Auth::user()->user_type != 'Admin')
            {
                $data = Booking::where('users_id', Auth::id())->whereMonth('created_at', Carbon::now()->month)->get();

            }else{
                $data = Booking::whereMonth('created_at', Carbon::now()->month)->get();
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
                ->addColumn('invoice', function($row){
                    $invoice = '<div class="d-flex justify-content-between"> <span>MMFInv158478</span>
                    <span><a href="#"><i class="fa fa-eye"></i></a></span></div>';
                   
                    return $invoice;

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
                
                ->rawColumns(['sector','invoice', 'aborted_status'])
                ->make(true);

        }

        return view('dashboard.finance.monthly.index')->with($data);
    }


    public function payment_summery()
    {
        return view('dashboard.finance.payment_summery');
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
