<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetails;
use App\Models\passengerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmBookingController extends Controller
{
    public function __construct(Request $request)
    {
        $this->api_key = '11193005ec7393-dd77-4f74-8f1a-417b714d8be1';
    }

    public function proceedToPay(Request $request){
        $traveller_details = $request->session()->all();
        // dd($traveller_details);
        // dd(Auth::id(), Auth::user());
        $first_name = $request->session()->get('first_name');
        $last_name = $request->session()->get('last_name');
        $genders = $request->session()->get('gender');
        $passport_no = $request->session()->get('passport_no');
        $passport_country_code = $request->session()->get('passport_country_code');
        $passport_expiry_date = $request->session()->get('passport_expiry_date');
        $email = $request->session()->get('email');
        $mobile = $request->session()->get('mobile');
        $phone_country_code = $request->session()->get('country_code');
        $whatsup_status = $request->session()->get('whatsapp');

        $keyIds = $request->session()->get('priceIds');
        $keyIds = explode('&', $keyIds);

        foreach ($keyIds as $key => $val){
            $priceIds[] = substr($val,6);  //pkey1= by default removing 6 str
        }

        $seats = $request->seats;
        if(is_array($seats)){
            foreach($seats as $k=>$v){
                $ssrSeat[$v['segment_key']][]= $v['value'];  //seats loop

            }
        }


        $meals = $request->meals;
        if(is_array($meals)){
        foreach($meals as $k=>$v){
            $ssrMeal[$v['segment_key']][]= $v['value'];  //meals loop

        }
    }
        // dd($ssrMeal);


        $req =array();
        $req['bookingId']= $request->bookingId;
        $req['paymentInfos'] =array();
        $row['amount'] = $request->ttl_price;
        array_push($req['paymentInfos'],$row);
        $req['travellerInfo']=array();
        for($i=0;$i<count($first_name);$i++){
            if($genders[$i] == 'female'){
                $gender = 'Mrs';
            }else{
                $gender = 'Mr';
            }
            $expiry_date = date('Y-m-d',strtotime($passport_expiry_date[$i]));
            $adults['ti']=$gender;
            $adults['fN']=$first_name[$i];
            $adults['lN']=$last_name[$i];
            $adults['pt']='ADULT';
            $adults['dob']='1996-08-09';
            $adults['pNat']=$passport_country_code[$i];
            $adults['pNum']=$passport_no[$i];
            $adults['eD']=$expiry_date;
            // $adults['ssrBaggageInfos'] = array();
            // foreach($priceIds as $v){
            //     $ssrBaggageInfos['key']= $v;
            //     $ssrBaggageInfos['code']= 'BAG';
            // }

            // array_push($adults['ssrBaggageInfos'],$ssrBaggageInfos);

            if(is_array($meals)){
                $adults['ssrMealInfos']=array();
                foreach($ssrMeal as $k => $v){
                    $ssrMealInfos['key']=$k;
                    $ssrMealInfos['code']=$v[$i];
                    array_push($adults['ssrMealInfos'],$ssrMealInfos);
                }

            }

            if(is_array($seats)){  ///seats loop
                $adults['ssrSeatInfos']=array();
                foreach($ssrSeat as $k => $v){
                $ssrSeatInfos['key']=$k;
                $ssrSeatInfos['code']=$v[$i];
                array_push($adults['ssrSeatInfos'],$ssrSeatInfos);
                }

            }

            array_push($req['travellerInfo'],$adults);
        }
        $req['deliveryInfo']['emails'] = array();
        array_push($req['deliveryInfo']['emails'],$email);

        $req['deliveryInfo']['contacts'] = array();
        array_push($req['deliveryInfo']['contacts'],$mobile);

        // dd(($req));

        $data = json_encode($req);

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

       $res =  json_decode($result);
        // print_r($res->status->success);exit;


        //booking details
        if(isset($res->status->success)){

            $req_data =array();
            $req_data['bookingId']= $request->bookingId;

            $param_data = json_encode($req_data);

        $method = "POST";
        $url = "https://apitest.tripjack.com/oms/v1/booking-details";
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($param_data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $param_data);
                break;
            default:
                if ($param_data)
                    $url = sprintf("%s?%s", $url, http_build_query(json_decode($param_data)));
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

        $booking_details = json_decode($result);
        // dd($booking_details);
        // dd(($booking_details->itemInfos->AIR->tripInfos));

        $travellers_cnt =  count($booking_details->itemInfos->AIR->travellerInfos);
        $amount = $booking_details->order->amount;
        $aborted_status = $booking_details->order->status;
            //  new booking();
            // $booking = Booking::create([
            //         'booking_id'=>$request->bookingId,
            //         'users_id'=>Auth::id(),
            //         'noofpassenger'=>$travellers_cnt,
            //         'phone_country_code'=>$phone_country_code,
            //         'phone_number'=>$mobile,
            //         'email_id'=>$email,
            //         'whatsup_status'=>$whatsup_status,
            //         'amount'=>$amount,
            //         'aborted_status'=>$aborted_status,
            // ]);

// dd(count($booking_details->itemInfos->AIR->tripInfos));
// dd($booking_details->itemInfos->AIR->travellerInfos);

         foreach($booking_details->itemInfos->AIR->travellerInfos as  $k=>$v){
            $pnr_details = $v;
            dd($pnr_details->pnrDetails);
            $fN = $v->fN;
            $lN = $v->lN;
            $gender_name = $v->ti;
                    passengerDetail::create([
                        'booking_id'=>$booking->id,
                        'pnr_details'=>$booking->id,
                        'first_name'=>$fN,
                        'last_name'=>$lN,
                        'gender_name'=>$gender_name,
                        'passport_no'=>$passport_no,
                        'passport_expiry_date'=>$passport_expiry_date,
                        'passport_country_code'=>$passport_country_code,

                    ]);
         }

exit;
        foreach($booking_details->itemInfos->AIR->tripInfos as $key => $si){

            foreach($si as $k => $v){
                $flight_name = $v[0]->fD->aI->name;
                $airport_name_from = $v[0]->da->name;
                $airport_city_from = $v[0]->da->city;
                $airport_country_from = $v[0]->da->country;
                $flight_departure = $v[0]->dt;


                $airport_name_to = $v[0]->aa->name;
                $airport_city_to = $v[0]->aa->city;
                $airport_country_to = $v[0]->aa->country;
                $flight_arrival = $v[0]->at;
                // print_r($v[0]->da->city);
                // print_r($v[$key]);


                BookingDetails::create([
                    'booking_id'=>$booking->id,
                    'airlines_type'=>  $flight_name,
                    'airport_city_from'=>  $airport_city_from,
                    'airport_city_to'=>  $airport_city_to,
                    'airport_country_from'=>  $airport_country_from,
                    'airport_country_to'=>  $airport_country_to,
                    'airport_name_from'=>  $airport_name_from,
                    'airport_name_to'=>  $airport_name_to,
                    'flight_departure'=>  $flight_departure,
                    'flight_arrival'=>  $flight_arrival,
            ]);
            }


}

        }



        $result_array =  json_decode($result);




    }





}
