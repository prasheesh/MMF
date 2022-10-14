<?php

namespace App\Http\Controllers;

use App\Models\AirportDetail;
use Exception;
use Illuminate\Http\Request;

class AirportDetailController extends Controller
{

    public function getAirports(Request $request){
// dd($request->filterText);
        try{
if($request->q != ''){
    $airpot_list = AirportDetail::where('name','LIKE', '%'.$request->q.'%')->get();
    return json_encode($airpot_list);
}else{
    $airpot_list = AirportDetail::all();
    return json_encode($airpot_list);
}

        }
        catch(Exception $e){
            return $e->getMessage();
        }


    }
}
