<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeatSelectionController extends Controller
{
    public function __construct(Request $request)
    {
        $this->api_key = '11193005ec7393-dd77-4f74-8f1a-417b714d8be1';
    }

    public function seatSelection(Request $request)
    {

        // dd($request->all());
        $uniqueTripPriceId = $request->bookingId;

        $data = '{
              "bookingId":"' . $uniqueTripPriceId . '"
            }';


        $method = "POST";
        $url = "https://apitest.tripjack.com/fms/v1/seat";
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
            'apikey:' . $this->api_key,
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

        // dd(json_decode($result));
        $result_array =  json_decode($result);



        $priceId = $request->pKey;
// dd($priceId);
        $data_review = '{
            "priceIds" : ["'.$priceId.'"]
          }';

        $method = "POST";
        $url = "https://apitest.tripjack.com//fms/v1/review";
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data_review)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_review);
                break;
            default:
                if ($data_review)
                    $url = sprintf("%s?%s", $url, http_build_query(json_decode($data_review)));
        }
        //OPtions:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'apikey:'.$this->api_key,
            'Content-Type:application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //Execute:
        $result1 = curl_exec($curl);

        if (!$result1) {
            die("Connection Failure");
        }
        curl_close($curl);

        $review =  json_decode($result1);
// dd($review);


        if ($result_array->status->success == true) {
        if ($result_array->status->httpStatus == 200) {
        $isBookedtrue =0;
        $isBookedfalse =0;
        $isLegroom =0;
            foreach($result_array->tripSeatMap->tripSeat as $key=>$val){
                if(isset($val->sInfo)){
                foreach($val->sInfo as $key1=>$val1){
                    if($val1->isBooked==true){
                            $isBookedtrue++;
                    }
                    if($val1->isBooked==false){
                            $isBookedfalse++;
                    }
                    if(isset($val1->isLegroom)){
                        if($val1->isLegroom==true){
                            $isLegroom++;
                    }
                }
                }
            }

            }
            // dd($isLegroom);
        }

              return view('site/seat_selection',compact('result_array','isBookedtrue','isBookedfalse','isLegroom','review'));
              // return $result_array;
          } else {
            $errors = $result_array->errors;
            $result_array = $result_array;
            return view('site/seat_selection',compact('result_array','errors','review'));
          }
    }
}
