<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class SearchFlightsController extends Controller
{
  public function __construct(Request $request){

  }

    public function SearchFlights(Request $request)
    {

      // dd($request->all());

        if($request->tripType == 'oneway'){
          $travelDate = date('Y-m-d', strtotime($request->flightBookingDepart));

        $req['searchQuery']['cabinClass'] = $request->travelClass;
        $req['searchQuery']['paxInfo']['ADULT']=$request->adultval;
        $req['searchQuery']['paxInfo']['CHILD']= 0 ;
        $req['searchQuery']['paxInfo']['INFANT']= 0 ;
        $req['searchQuery']['routeInfos'] = array();

        $airport['fromCityOrAirport']['code']= $request->fromPlace;
        $airport['toCityOrAirport']['code']= $request->toPlace;
        $airport['travelDate']= $travelDate;
        array_push($req['searchQuery']['routeInfos'],$airport);
        $req['searchQuery']['searchModifiers']['isDirectFlight']='true';
        $req['searchQuery']['searchModifiers']['isConnectingFlight']='true';

      $data =   json_encode($req);


        }else if($request->tripType == 'round'){
          $travelDate = date('Y-m-d', strtotime($request->flightBookingDepart));
        $travelReturnDate = date('Y-m-d', strtotime($request->flightBookingReturn));

        $req['searchQuery']['cabinClass'] = $request->travelClass;
        $req['searchQuery']['paxInfo']['ADULT']=$request->adultval;
        $req['searchQuery']['paxInfo']['CHILD']= 0 ;
        $req['searchQuery']['paxInfo']['INFANT']= 0 ;
        $req['searchQuery']['routeInfos'] = array();
        $airport['fromCityOrAirport']['code']= $request->fromPlace;
        $airport['toCityOrAirport']['code']= $request->toPlace;
        $airport['travelDate']= $travelDate;
        array_push($req['searchQuery']['routeInfos'],$airport);
        $airportto['fromCityOrAirport']['code']= $request->toPlace;
        $airportto['toCityOrAirport']['code']= $request->fromPlace;
        $airportto['travelDate']= $travelReturnDate;
        array_push($req['searchQuery']['routeInfos'],$airportto);
        $req['searchQuery']['searchModifiers']['isDirectFlight']='true';
        $req['searchQuery']['searchModifiers']['isConnectingFlight']='true';

        $data =   json_encode($req);


        }else if($request->tripType == 'multi'){

          $req['searchQuery']['cabinClass'] = $request->travelClass;
          $req['searchQuery']['paxInfo']['ADULT']=$request->adultval;
          $req['searchQuery']['paxInfo']['CHILD']= 0 ;
          $req['searchQuery']['paxInfo']['INFANT']= 0 ;
          $req['searchQuery']['routeInfos'] = array();
          for($i=0;$i<count($request->fromPlace);$i++){
            $travelDate = date('Y-m-d', strtotime($request->flightBookingDepart[$i]));
            $airport['fromCityOrAirport']['code']= $request->fromPlace[$i];
            $airport['toCityOrAirport']['code']= $request->toPlace[$i];
            $airport['travelDate']= $travelDate;
            array_push($req['searchQuery']['routeInfos'],$airport);
          }
          $req['searchQuery']['searchModifiers']['isDirectFlight']='true';
          $req['searchQuery']['searchModifiers']['isConnectingFlight']='true';

// dd($req);
$data = json_encode($req);

        //   $data = '{
        //     "searchQuery": {
        //       "cabinClass": "' . $request->travelClass . '",
        //       "paxInfo": {
        //         "ADULT": "' . $request->adultval . '",
        //         "CHILD": "0",
        //         "INFANT": "0"
        //       },
        //       "routeInfos": [';

        //       for($i=0;$i<count($request->fromPlace);$i++){

        //         $travelDate = date('Y-m-d', strtotime($request->flightBookingDepart[$i]));

        //         $data .=    '{
        //           "fromCityOrAirport": {
        //             "code": "' . $request->fromPlace[$i] . '"
        //           },
        //           "toCityOrAirport": {
        //             "code": "' . $request->toPlace[$i] . '"
        //           },
        //           "travelDate": "' . $travelDate . '"
        //         }';

        //        if($i < (count($request->fromPlace)-1)){
        //         $data .= ',';
        //        }

        //       }



        //     $data .= '],
        //       "searchModifiers": {
        //         "isDirectFlight": true,
        //         "isConnectingFlight": false
        //       }
        //     }
        //   }';
        }


// dd($data);
        $method = "POST";
        $url = "https://apitest.tripjack.com/fms/v1/air-search-all";
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query(json_decode($data)));
        }
        //OPtions:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'apikey:'.apikey(),
            'Content-Type:application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //Execute:
        $result = curl_exec($curl);

        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        // dd($result);

        $result_array =  json_decode($result);

        // dd($result_array->searchResult->tripInfos->COMBO[185]);
        if ($result_array->status->success == true) {
          // return $result_array;
            return view('site/search_flights',compact('result_array'));
            // return $result_array;
        } else {
          $errors = $result_array->errors;
          $result_array = $result_array;
          return view('site/search_flights',compact('result_array','errors'));
        }
    }

    public function getFarePrices(Request $request)
    {

          $uniqueTripPriceId = $request->uniqueTripPriceId;

          $data = '{
            "id":"'.$uniqueTripPriceId.'",
            "flowType":"SEARCH"
          }';


        $method = "POST";
        $url = "https://apitest.tripjack.com/fms/v1/farerule";
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query(json_decode($data)));
        }
        //OPtions:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'apikey:'.apikey(),
            'Content-Type:application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //Execute:
        $result = curl_exec($curl);

        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);

        $result_array =  $result;
        return $result_array;
    }


}
