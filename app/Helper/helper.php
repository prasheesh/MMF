<?php

use App\Models\Dashboard\CancelFee;

function apikey() {

    $apikey = '111930dc08a9e7-b74f-4138-9a6b-97f25dc3a982';
    return $apikey;
}


function getdetails()
{
        $tripType = Session::get('tripType'); 
        $flightBookingDepart = Session::get('flightBookingDepart');
        $travelClass = Session::get('travelClass');
        $adultval = Session::get('adultval');
        $fromPlace = Session::get('fromPlace');
        $toPlace = Session::get('toPlace');
        $flightBookingReturn = Session::get('flightBookingReturn');
        $childsvalue = Session::get('childsvalue');
        $infantvalue = Session::get('infantvalue');

        $city_name_from = DB::table('airport_details')->where('code', $fromPlace)->first('city');
        $city_name_to = DB::table('airport_details')->where('code', $toPlace)->first('city');
        
        $result_arrays =  Session::get('results_arrays');
        // $result_arrays = UserHelper::airplanes($tripType,$flightBookingDepart,$travelClass,$adultval,$fromPlace,$toPlace,$flightBookingReturn,$childsvalue,$infantvalue);

    $array = [
        'result_arrays' => $result_arrays,
        'tripType' => $tripType,
        'flightBookingDepart' => $flightBookingDepart,
        'travelClass' => $travelClass,
        'adultval' => $adultval,
        'fromPlace' => $fromPlace,
        'toPlace' => $toPlace,
        'flightBookingReturn' => $flightBookingReturn,
        'childsvalue' => $childsvalue,
        'infantvalue' => $infantvalue,
        'city_name_from' => $city_name_from,
        'city_name_to' => $city_name_to,
    ];
        return $array;
}



function cancelfees($key)
{
    return CancelFee::where('key_name' ,'=', $key)->first()->value ?? '';
}

function airportdetails()
{
    return DB::table('airport_details')->orderBy('order_by', 'asc')->get();
}

