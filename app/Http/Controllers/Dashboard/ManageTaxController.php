<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\ManageTax;
use App\Models\User;
use Illuminate\Http\Request;

class ManageTaxController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('user_type', ['Admin'])->get();
        $data['users'] = $users;

        $managetax = ManageTax::get();
        $data['managetaxes'] = $managetax;

        return view('dashboard.managetax.index')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_lists' => 'required',
            'type_of_travel' => 'required',
            'type_of_mode' => 'required',
            'enterap' => 'required',
        ]);

        $managetax = new ManageTax();
        $managetax->users_id =  $request->user_lists;
        $managetax->typeoftravel =  $request->type_of_travel;
        $managetax->typeofmode = $request->type_of_mode;
        $managetax->enteramount =  $request->enterap;
        $managetax->save();

        return redirect()->back();
    }
}
