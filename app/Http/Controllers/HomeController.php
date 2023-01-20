<?php

namespace App\Http\Controllers;

use App\Models\AirportDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

error_reporting(0);
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.index');
    }

    public function aboutUs()
    {
        return view('site.about');
    }
    public function services()
    {
        return view('site.services');
    }
    public function contact()
    {
        return view('site.contact');
    }
    public function privacyPolicy()
    {
        return view('site.privacy_policy');
    }
    public function termsCondition()
    {
        return view('site.terms_condition');
    }

    public function home()
    {
        $airports = AirportDetail::orderBy('order_by')->get();
        return view('site.home', get_defined_vars());
    }
    public function searchFlights()
    {
        return view('site.search_flights');
    }

    public function bookingFinal()
    {
        return view('site.seat_selection');
    }
}
