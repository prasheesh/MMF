<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site/index');
    }

    public function aboutUs()
    {
        return view('site/about');
    }
    public function services()
    {
        return view('site/services');
    }
    public function contact()
    {
        return view('site/contact');
    }
    public function privacyPolicy()
    {
        return view('site/privacy_policy');
    }
    public function termsCondition()
    {
        return view('site/terms_condition');
    }

    public function home()
    {

        return view('site/home');

    }
    public function searchFlights()
    {
        return view('site/search_flights');
    }

    public function bookingFinal()
    {
        return view('site/seat_selection');
    }

}
