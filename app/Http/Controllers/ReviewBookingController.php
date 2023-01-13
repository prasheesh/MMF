<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;
use Session;
error_reporting(0);
class ReviewBookingController extends Controller
{
    public function __construct(Request $request){
        $this->api_key = '111930dc08a9e7-b74f-4138-9a6b-97f25dc3a982';
      }

    public function passengerDetails(Request $request)
    {
// dd($request->all());
// $priceIds = explode('&',$request->priceIds);
// dd($priceIds);
       $first_name = $request->first_name;
       $last_name = $request->last_name;
       $gender = $request->gender;
       $passport_no = $request->passport_no;
       $passport_country_code = $request->passport_country_code;
       $passport_expiry_date = $request->passport_expiry_date;
       $email = $request->email;
       $mobile = $request->mobile;
       $country_code = $request->country_code;
       $priceIds = $request->priceIds;
       $whatsapp = $request->whatsapp;


       /////////sessions////////
       Session::put('first_name', $first_name);
       Session::put('last_name', $last_name);
       Session::put('gender', $gender);
       Session::put('passport_no', $passport_no);
       Session::put('passport_country_code', $passport_country_code);
       Session::put('passport_expiry_date', $passport_expiry_date);
       Session::put('email', $email);
       Session::put('mobile', $mobile);
       Session::put('country_code', $country_code);
       Session::put('priceIds', $priceIds);
       Session::put('whatsapp', $whatsapp);
       //dd($request->first_name);
       echo "success";
    }

    public function reviewDetails(Request $request)
    {

        $countries =   Country::all();
       // dd($request->all());

        // $priceId = $request->pKey;
        // $priceIdreturn = $request->rKey;

       $priceId_data = "";
       foreach($request->all() as $k => $priceId){
           $priceId_data = $priceId_data.'" , "'.$priceId;
       }
       $priceId_data =  ltrim($priceId_data,'" , "');
       $data = '{"priceIds" : ["'.$priceId_data.'"]}';

        // dd($data);
        $method = "POST";
        $url = "https://apitest.tripjack.com/fms/v1/review";
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
            'apikey:'.$this->api_key,
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
        //dd($result);

        $result_array =  json_decode($result);

        ///////////getting fair rules start///////////
        $priceId="";
        foreach($request->all() as $k => $priceId){
            $data = '{
            "id":"'.$priceId.'",
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
            'apikey:'.$this->api_key,
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

        $fair_rules[] =  json_decode($result);
        }
        // echo"<pre>";
        // print_r($fair_rules); exit();
        ///////////getting fair rules end///////////

        // echo "<pre>";
        // print_r($result_array->errors[0]); exit();
        if ($result_array->status->httpStatus == 200) {
            // return $result_array;
            return view('site/review_details',compact('result_array','fair_rules','countries'));
              // return $result_array;
        } else {
            echo "<pre>";
            print_r($result_array->errors[0]); exit();
            $errors = $result_array->errors[0];
            $result_array = $result_array;
            return view('site/review_details',compact('result_array','errors'));
        }
       // return view('site/review_details',compact('result_array','fair_rules'));
    }
}
