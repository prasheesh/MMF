<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Session;
error_reporting(0);
class ReviewBookingController extends Controller
{
    public function __construct(Request $request)
    {
        // $this->api_key = '111930dc08a9e7-b74f-4138-9a6b-97f25dc3a982';
    }

    public function passengerDetails(Request $request)
    {
        // adult
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $gender = $request->gender;
        $passport_no = $request->passport_no;
        $passport_country_code = $request->passport_country_code;
        $passport_expiry_date = $request->passport_expiry_date;

        //    children
        $first_name_child = $request->first_name_child;
        $last_name_child = $request->last_name_child;
        $gender_child = $request->gender_child;
        $passport_no_child = $request->passport_no_child;
        $passport_country_code_child = $request->passport_country_code_child;
        $passport_expiry_date_child = $request->passport_expiry_date_child;

        //    infants
        $first_name_infant = $request->first_name_infant;
        $last_name_infant = $request->last_name_infant;
        $gender_infant = $request->gender_infant;
        $dob_infant = $request->dob_infant;
        $passport_no_infant = $request->passport_no_infant;
        $passport_country_code_infant = $request->passport_country_code_infant;
        $passport_expiry_date_infant = $request->passport_expiry_date_infant;


        $adult_count = $request->adult_count;
        $child_count = $request->child_count;
        $infant_count = $request->infant_count;
        $is_domestic = $request->is_domestic;
        $email = $request->email;
        $mobile = $request->mobile;
        $country_code = $request->country_code;
        $priceIds = $request->priceIds;
        $whatsapp = $request->whatsapp;


        ////////sessions////////
        //    adults details
        Session::put('first_name', $first_name);
        Session::put('last_name', $last_name);
        Session::put('gender', $gender);
        if ($is_domestic != true) {
            Session::put('passport_no', $passport_no);
            Session::put('passport_country_code', $passport_country_code);
            Session::put('passport_expiry_date', $passport_expiry_date);
        }


        // children details
        if ($child_count > 0) {
            Session::put('first_name_child', $first_name_child);
            Session::put('last_name_child', $last_name_child);
            Session::put('gender_child', $gender_child);
            if ($is_domestic != true) {
                Session::put('passport_no_child', $passport_no_child);
                Session::put('passport_country_code_child', $passport_country_code_child);
                Session::put('passport_expiry_date_child', $passport_expiry_date_child);
            }
        }


        //infant details
        if ($infant_count > 0) {
            Session::put('first_name_infant', $first_name_infant);
            Session::put('last_name_infant', $last_name_infant);
            Session::put('gender_infant', $gender_infant);
            Session::put('dob_infant', $dob_infant);
            if ($is_domestic != true) {
                Session::put('passport_no_infant', $passport_no_infant);
                Session::put('passport_country_code_infant', $passport_country_code_infant);
                Session::put('passport_expiry_date_infant', $passport_expiry_date_infant);
            }
        }


        Session::put('adult_count', $adult_count);
        Session::put('child_count', $child_count);
        Session::put('infant_count', $infant_count);
        Session::put('is_domestic', $is_domestic);
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

        $priceId_data = "";
        foreach ($request->all() as $k => $priceId) {
            $priceId_data = $priceId_data . '" , "' . $priceId;
        }
        $priceId_data =  ltrim($priceId_data, '" , "');
        $data = '{"priceIds" : ["' . $priceId_data . '"]}';

        // dd($data);
        $method = "POST";
        $url = env('API_URL') . "/fms/v1/review";
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
        //dd($result);

        $result_array =  json_decode($result);

        ///////////getting fair rules start///////////
        $priceId = "";
        foreach ($request->all() as $k => $priceId) {
            $data = '{
            "id":"' . $priceId . '",
            "flowType":"SEARCH"
            }';

            $method = "POST";
            $url = env('API_URL') . "/fms/v1/farerule";
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

            $fair_rules[] =  json_decode($result);
        }
        ///////////getting fair rules end///////////


        if ($result_array->status->httpStatus == 200) {
            // return $result_array;
            return view('site/review_details', compact('result_array', 'fair_rules', 'countries'));
            // return $result_array;
        } else {
            echo "<pre>";
            print_r($result_array->errors[0]);
            exit();
            $errors = $result_array->errors[0];
            $result_array = $result_array;
            return view('site/review_details', compact('result_array', 'errors'));
        }
    }
}
