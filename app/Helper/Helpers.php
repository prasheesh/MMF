<?php

namespace App\Helper;
use UserHelper;



class Helpers {

    public static function airplanes($tripType,$flightBookingDepart,$travelClass,$adultval,$fromPlace,$toPlace,$flightBookingReturn,$childsvalue=0,$infantvalue=0)
    {
        if($tripType == 'oneway'){

            $travelDate = date('Y-m-d', strtotime($flightBookingDepart));

            $req['searchQuery']['cabinClass'] = $travelClass;
            $req['searchQuery']['paxInfo']['ADULT']=$adultval;
            $req['searchQuery']['paxInfo']['CHILD']= $childsvalue ;
            $req['searchQuery']['paxInfo']['INFANT']= $infantvalue ;
            $req['searchQuery']['routeInfos'] = array();

            $airport['fromCityOrAirport']['code']= $fromPlace;
            $airport['toCityOrAirport']['code']= $toPlace;
            $airport['travelDate']= $travelDate;
            array_push($req['searchQuery']['routeInfos'],$airport);
            $req['searchQuery']['searchModifiers']['isDirectFlight']='true';
            $req['searchQuery']['searchModifiers']['isConnectingFlight']='true';

            $data =   json_encode($req);


        }else if($tripType == 'round'){

            $travelDate = date('Y-m-d', strtotime($flightBookingDepart));
            $travelReturnDate = date('Y-m-d', strtotime($flightBookingReturn));

            $req['searchQuery']['cabinClass'] = $travelClass;
            $req['searchQuery']['paxInfo']['ADULT']=$adultval;
            $req['searchQuery']['paxInfo']['CHILD']= $childsvalue ;
            $req['searchQuery']['paxInfo']['INFANT']= $infantvalue ;
            $req['searchQuery']['routeInfos'] = array();
            $airport['fromCityOrAirport']['code']= $fromPlace;
            $airport['toCityOrAirport']['code']= $toPlace;
            $airport['travelDate']= $travelDate;
            array_push($req['searchQuery']['routeInfos'],$airport);
            $airportto['fromCityOrAirport']['code']= $toPlace;
            $airportto['toCityOrAirport']['code']= $fromPlace;
            $airportto['travelDate']= $travelReturnDate;
            array_push($req['searchQuery']['routeInfos'],$airportto);
            $req['searchQuery']['searchModifiers']['isDirectFlight']='true';
            $req['searchQuery']['searchModifiers']['isConnectingFlight']='true';

              $data =   json_encode($req);


          }else if($tripType == 'multi'){

              $req['searchQuery']['cabinClass'] = $travelClass;
              $req['searchQuery']['paxInfo']['ADULT']=$adultval;
              $req['searchQuery']['paxInfo']['CHILD']= $childsvalue ;
              $req['searchQuery']['paxInfo']['INFANT']= $infantvalue ;
              $req['searchQuery']['routeInfos'] = array();
              for($i=0;$i<count($fromPlace);$i++){
                  $travelDate = date('Y-m-d', strtotime($flightBookingDepart[$i]));
                  $airport['fromCityOrAirport']['code']= $fromPlace[$i];
                  $airport['toCityOrAirport']['code']= $toPlace[$i];
                  $airport['travelDate']= $travelDate;
                  array_push($req['searchQuery']['routeInfos'],$airport);
              }
              $req['searchQuery']['searchModifiers']['isDirectFlight']='true';
              $req['searchQuery']['searchModifiers']['isConnectingFlight']='true';


              $data = json_encode($req);

        }



        $url = env('API_URL')."/fms/v1/air-search-all";

        $result = UserHelper::curlresult($data, $url);


        $results =  json_decode($result);

        return $results;
    }


    public static function curlresult($data, $urls)
    {
        $method = "POST";
        $url = $urls;
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
            'apikey:' . apikey(),
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
        return $result;
    }

}
