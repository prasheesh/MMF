<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Carbon\Carbon;
use UserHelper;
use DB;
class SearchFlightsController extends Controller
{
    public function __construct(Request $request){

    }


    /**** Get Filter Flights Lists *****/
    public function filterfilghts(Request $request)
    {

        if (Session::has('deptminvalue') && Session::has('deptmaxvalue') && Session::has('deptarriv')) 
        {   
                Session::forget('deptminvalue');
                Session::forget('deptmaxvalue');
                Session::forget('deptarriv');
        }
        
        $tripType = $request->tripType;
        $flightBookingDepart = $request->flightBookingDepart;
        $travelClass = $request->travelClass;        
        $adultval = $request->adultval;
        $fromPlace = $request->fromPlace;
        $toPlace = $request->toPlace;
        $flightBookingReturn = $request->flightBookingReturn ? $request->flightBookingReturn : null;
        $childsvalue = $request->childval;
        $infantvalue = $request->infantval;

        Session::put('tripType', $tripType);
        Session::put('flightBookingDepart', $flightBookingDepart);
        Session::put('travelClass', $travelClass);
        Session::put('adultval', $adultval);
        Session::put('fromPlace', $fromPlace);
        Session::put('toPlace', $toPlace);
        Session::put('flightBookingReturn', $flightBookingReturn);
        Session::put('childsvalue', $childsvalue);
        Session::put('infantvalue', $infantvalue);

        $result_arrays = UserHelper::airplanes($tripType,$flightBookingDepart,$travelClass,$adultval,$fromPlace,$toPlace,$flightBookingReturn,$childsvalue,$infantvalue);
        
        
        Session::put('results', $result_arrays);

        

        return redirect()->route('SearchFlights');
        
    }
    /**** End Get Filter Flights Lists *****/




    /**** Get All Flights Lists *****/
    public function SearchFlights(Request $request)
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
        // dd($result_array, $tripType);

        $city_name_from = DB::table('airport_details')->where('code', $fromPlace)->first('city');
        $city_name_to = DB::table('airport_details')->where('code', $toPlace)->first('city');

        $result_array = Session::get('results');

        /**
         * Ajax Request Getting the filter
         */
        if($request->ajax()){

            
           Session::put('deptminvalue', $request->deptminvalue);
           Session::put('deptmaxvalue', $request->deptmaxvalue);
           Session::put('deptarriv', $request->deptarriv);
           if($request->valuestopclick)
           {
            Session::put('noofstops', $request->valuestopclick);
           }
            
           if($request->airlinesclickstopsclickvalue)
           {
            Session::put('airlinesclickstopsclickvalue', $request->airlinesclickstopsclickvalue);
           }

           if($request->price_minvalue && $request->price_maxvalue)
           {
            Session::put('price_minvalue', $request->price_minvalue);
            Session::put('price_maxvalue', $request->price_maxvalue);
           }

           $deptminvalue  = Session::get('deptminvalue');
           $deptmaxvalue  = Session::get('deptmaxvalue');
           $deptarriv = Session::get('deptarriv');

           if(Session::has('noofstops'))
           {
                $noofstops = Session::get('noofstops');
           }

           if(Session::has('airlinesclickstopsclickvalue'))
           {
                $airlinesdata = Session::get('airlinesclickstopsclickvalue');
           }

           if(Session::has('price_minvalue') && Session::has('price_maxvalue'))
           {
                $price_minvalue = Session::get('price_minvalue');
                $price_maxvalue = Session::get('price_maxvalue');
                
           }
           
            if ($result_array) {
               
                if ($result_array->status->success == true) {
                    
                    /**
                     * Arrival and Depture timing filter get the flight details
                     */
                    if (!empty($deptminvalue) && !empty($deptmaxvalue) && !empty($deptarriv)) {

                        /***
                         * Depature Filters When time minimum and maximum will get flights details
                         */
                        if ($deptarriv == 'dept') {
                            $deptfilterresult = $result_array->searchResult->tripInfos->ONWARD;

                            $deptaurefilterarray = [];

                            foreach ($deptfilterresult as $key => $deptsfilterresult) {
                                $timefinddept = Carbon::parse($deptsfilterresult->sI[0]->dt)->format('H:m');
                                if ($timefinddept >= $deptminvalue && $timefinddept <= $deptmaxvalue) {
                                    array_push($deptaurefilterarray, $deptsfilterresult);

                                }
                            }

                            $searchdept['searchResult']['tripInfos']['ONWARD'] = $deptaurefilterarray;
                            $searchdept['status']['success'] = true;
                            $searchdept['status']['httpStatus'] = 200;

                            $depaturejsonencode = json_encode($searchdept);

                            $result_array = json_decode($depaturejsonencode);
                            $options = view("site.searchflights.flightsdetails.oneway.onewayflightdetails",get_defined_vars())->render();
                            return response()->json(['data' => $options], 200);
                            
                        }



                        /***
                         * Arrival Filters When Time minimum and maximum will get Flights details
                         */
                        if($deptarriv == 'arriv')
                        {
                            $arrivalresult_array = [];
                            foreach($result_array->searchResult->tripInfos->ONWARD as $key => $arrivfilterresult)
                            {
                                $timefindarriv = Carbon::parse($arrivfilterresult->sI[count($arrivfilterresult->sI)-1]->at)->format('H:m');
                                if($timefindarriv >= $deptminvalue && $timefindarriv <= $deptmaxvalue)
                                {
                                    array_push($arrivalresult_array,$arrivfilterresult);
                                }

                                
                            }

                            $searcharriv['searchResult']['tripInfos']['ONWARD'] = $arrivalresult_array;
                            $searcharriv['status']['success'] = true;
                            $searcharriv['status']['httpStatus'] = 200;
                            $arrivaljsonencode = json_encode($searcharriv);

                            $result_array = json_decode($arrivaljsonencode);
                            $options = view("site.searchflights.flightsdetails.oneway.onewayflightdetails",get_defined_vars())->render();
                            return response()->json(['data' => $options], 200);
                            
                        }
                    }
                    
                    /**
                     * Numbers stops filter get the filghts details
                     */
                    if ($request->valuestopclick) {
                        if (!empty($noofstops)) {

                            $noofstops_array = [];
                            foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $noofstopsresult) {
                                $countsI = count($noofstopsresult->sI);
                                if ($countsI == $noofstops) {
                                    array_push($noofstops_array, $noofstopsresult);
                                }

                            }

                            $searchnoofstops['searchResult']['tripInfos']['ONWARD'] = $noofstops_array;
                            $searchnoofstops['status']['success'] = true;
                            $searchnoofstops['status']['httpStatus'] = 200;

                            $noofstopsjsonencode = json_encode($searchnoofstops);

                            $result_array = json_decode($noofstopsjsonencode);

                            $options = view("site.searchflights.flightsdetails.oneway.onewayflightdetails", get_defined_vars())->render();
                            return response()->json(['data' => $options], 200);

                        }
                    }


                    /**
                     * Get The Flights Details accoring through Airlines(Company)
                     */
                   
                    if($request->airlinesclickstopsclickvalue){
                        if(!empty($airlinesdata))
                        {
                            $airlinesfilter_array = [];

                            foreach($result_array->searchResult->tripInfos->ONWARD as $key => $airlinesnames)
                            {
                                foreach($airlinesnames->sI as $airlinesnamelist)
                                {
                                    if($airlinesnamelist->fD->aI->name == $airlinesdata)
                                    {
                                        array_push($airlinesfilter_array, $airlinesnames);

                                    }

                                }
                            }

                            $searchairlinesdetails['searchResult']['tripInfos']['ONWARD'] = $airlinesfilter_array;
                            $searchairlinesdetails['status']['success'] = true;
                            $searchairlinesdetails['status']['httpStatus'] = 200;

                            $airlinesdetailsjsonencode = json_encode($searchairlinesdetails);

                            $result_array = json_decode($airlinesdetailsjsonencode);

                            $options = view("site.searchflights.flightsdetails.oneway.onewayflightdetails", get_defined_vars())->render();
                            return response()->json(['data' => $options], 200);

                        }
                    }
                    
                    /**
                     * Price range Filter get the flights details
                     */
                    if($request->price_minvalue && $request->price_maxvalue)
                    {
                        
                        if(!empty($price_minvalue) && !empty($price_maxvalue))
                        {
                            $pricerangefilter_array = [];

                            foreach($result_array->searchResult->tripInfos->ONWARD as $key => $pricerange)
                            {
                                foreach($pricerange->totalPriceList as $listprices)
                                {
                                    $pricelistflight = round($listprices->fd->ADULT->fC->TF);
                                    
                                    if($price_minvalue <= $pricelistflight && $price_maxvalue >= $pricelistflight)
                                    {
                                        $pricerangefilter_array[] = $pricerange;
                                        

                                    }
                               
                                }
                            }

                            $pricerangedetails['searchResult']['tripInfos']['ONWARD'] = $pricerangefilter_array;
                            $pricerangedetails['status']['success'] = true;
                            $pricerangedetails['status']['httpStatus'] = 200;

                            $pricerangejsonencode = json_encode($pricerangedetails);

                            $result_array = json_decode($pricerangejsonencode);

                            $options = view("site.searchflights.flightsdetails.oneway.onewayflightdetails", get_defined_vars())->render();
                            return response()->json(['data' => $options], 200);
                            
                        }
                    }
                    

                     

                }
            }
        }
        /**
         * End Ajax Request 
         */


        
        if($result_array){
            if ($result_array->status->success == true) { 

               
                if(!empty($result_array->searchResult->tripInfos))
                {
                    /**
                     * Fliter search with priceranges
                     */
        
                    $stops_filter = [];
                    $ttl_stops_flight_cnt = [];
                    $stops_flight_cnt = [];
                    $priceranges = [];

                    $stops_array = [];

                    $airlines_details_array = [];
                    
                    foreach($result_array->searchResult->tripInfos->ONWARD as $key=>$stops){

                        
                        
                        /**
                         * number of stops counts filter
                         */
                        array_push($stops_array, $stops);

                        if(count($stops->sI) >=1 ){

                            array_push($stops_filter, count($stops->sI)-1);
                            array_push($ttl_stops_flight_cnt, count($stops->sI)-1);
                            
                        }
        
        
                        /**
                         * Pushing the Array Arrival City Name
                         */
                        array_push($stops_flight_cnt, $stops->sI[count($stops->sI)-1]->aa->city);
        
                        /**
                         * Price Ranges
                         */
                        foreach($stops->totalPriceList as $key=>$totalPriceList){

                            array_push($priceranges, $totalPriceList->fd->ADULT->fC->TF);
                        }


                        /**
                         * Airlines filter get information count
                         */
                        foreach($stops->sI as $stopin)
                        {
                            array_push($airlines_details_array, $stopin->fD->aI->name);
                        }

                        

                        
                    
                    }

                    
                    /**
                     * number of stops counts filter variable
                     */
                    $flights_cnt = array_count_values($ttl_stops_flight_cnt);
                    $all_stops =  array_unique($stops_filter);
                
                
                    /**
                     * @var mixed $arrival_cityname
                     * Arrival City Name
                     */
                    $arrival_cityname = array_unique($stops_flight_cnt);

                    
    
                    /**
                     * @var mixed $priceRange
                     * 
                     * Get the Price Range
                     */
                    $minpricevalue = min($priceranges);
                    $maxpricevalue = max($priceranges);
    
                    /**
                     * Get Flight names when get filter get data variables
                     */

                    $airlinesnames = array_unique($airlines_details_array);
                    $airlinesnames_counts = array_count_values($airlines_details_array);
                    $airlinesnames_count = array_values($airlinesnames_counts);

                    





                    /**
                     * RETURN Filter Search 
                     */
        
                    if(!empty($result_array->searchResult->tripInfos->RETURN)){
                        $cityname = [];
        
                        foreach($result_array->searchResult->tripInfos->RETURN as $key => $arrivalstops)
                        {
                            $cityname[] = $arrivalstops->sI[0]->da->city;
                        }
        
                        
        
                        $unique_cityname = array_unique($cityname);
                    }
                 
    
                
                 
                    /**
                     * End RETURN Filter Search 
                     */
        
                    /**
                     * End Fliter search with priceranges
                     */
                }
                
                
                return view('site.searchflights.index',get_defined_vars());
               
            }
            else {
                abort(400);
             
            }
        }else{
            abort(400);
        }
    }
    /**** End Get All Flights Lists *****/

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
