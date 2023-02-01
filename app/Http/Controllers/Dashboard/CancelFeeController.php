<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\CancelFee;
use Illuminate\Http\Request;

class CancelFeeController extends Controller
{
    public function index()
    {
        return view('dashboard.cancelfee.index');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'cancellation_fee' => 'required',
            'cancellation_fee_tax' => 'required',
            'reschedule_fee' => 'required',
            'reschedule_fee_tax' => 'required',
        ]);
        $data = $request->only([
            'cancellation_fee',
            'cancellation_fee_tax',
            'reschedule_fee',
            'reschedule_fee_tax',
        ]);

        foreach($data as $key => $value)
        {
            $cancelfee = CancelFee::where('key_name', $key);
            if($cancelfee->exists())
            {
                $cancelfee->first()->update(['value' => $value]);
            }
        }

        return redirect()->back();
    }
}
