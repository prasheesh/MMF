<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmBookingController extends Controller
{
    public function __construct(Request $request)
    {
        $this->api_key = '11193005ec7393-dd77-4f74-8f1a-417b714d8be1';
    }

    public function proceedToPay(Request $request){
        $traveller_details = $request->session()->all();
        $first_name = $request->session()->get('first_name');
        $last_name = $request->session()->get('last_name');
        $genders = $request->session()->get('gender');
        $passport_no = $request->session()->get('passport_no');
        $passport_country_code = $request->session()->get('passport_country_code');
        $passport_expiry_date = $request->session()->get('passport_expiry_date');
        $email = $request->session()->get('email');
        $mobile = $request->session()->get('mobile');
        $priceIds = trim($request->session()->get('priceIds'),'pKey=');
        $key_id = explode('&rKey=',$priceIds);
        $seats = $request->seats;
        $meals = $request->meals;

        // dd($priceIds);
        // dd($key_id);
        dd($seats);
        // dd($traveller_details);
        $data = '{
                        "bookingId": "'.$request->bookingId.'",
            "paymentInfos": [
              {
                "amount": "'.$request->ttl_price.'"
              }
            ],
            "travellerInfo": [';

        for($i=0;$i<count($first_name);$i++){
                if($genders[$i] == 'female'){
                    $gender = 'Mrs';
                }else{
                    $gender = 'Mr';
                }

                $expiry_date = date('Y-m-d',strtotime($passport_expiry_date[$i]));


                $data .= '{
                        "ti": "'.$gender.'",
                        "fN": "'.$first_name[$i].'",
                        "lN": "'.$last_name[$i].'",
                        "pt": "ADULT",
                        "dob":"1996-08-09",
                        "pNat":"'.$passport_country_code[$i].'",
                        "pNum":"'.$passport_no[$i].'",
                        "pid":"2022-11-20",
                        "eD":"'.$expiry_date.'",


                        "ssrBaggageInfos":[
                            {
                                "key":"'.$priceIds.'",
                                "code":"BAG01"
                            }
                            ]';

                    if(is_array($meals)){
                            $data .=  ',"ssrMealInfos":[';

                            foreach($key_id as $k=> $k_val){

                                $data .= '{
                                    "key":"'.$k_val.'",
                                    "code":"'.$meals[$k].'"
                                }';

                            }


                    $data .= '],';
                    }

                    if(is_array($seats)){
                        $data .= '"ssrSeatInfos":[
                                {
                                "key":"'.$priceIds.'",
                                "code":"'.$seats[$i].'"
                            }]';
                    }

        $data .= '}';

                        if($i < (count($first_name))-1){
                        $data .= ',';
                        }

        }

        // dd($data);
                    $data .= '],

                    "deliveryInfo": {
                      "emails": [
                        "'.$email.'"
                      ],
                      "contacts": [
                        "'.$mobile.'"
                      ]
                    }
                  }';

          dd($data);

          $method = "POST";
        $url = "https://apitest.tripjack.com/oms/v1/air/book";
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

        dd(json_decode($result));
        $result_array =  json_decode($result);

    }
}
