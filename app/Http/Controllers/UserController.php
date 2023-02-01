<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Dashboard\Role;
use App\Models\User;
use Illuminate\Http\Request;

error_reporting(0);
class UserController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('dashboard.user.index', get_defined_vars());
    }

    public function storeUser(StoreUserRequest $request)
    {

        $request->storeUser($request->all());
        return response()->json(['msg' => 'User added successfully...!'], 201);
    }

    public function manage_user()
    {
        if (!empty(request()->company_name) || !empty(request()->user_name) || !empty(request()->phone_name)) {

            $users = User::where('company_name', 'LIKE', '%' . request()->company_name . '%')
                ->where(function ($query) {
                    return $query->where('name', 'LIKE', '%' . request()->user_name . '%')
                        ->where('mobile_number', 'LIKE', '%' . request()->phone_name . '%');
                })
                ->orderBy('id', 'desc')->get();
        } else {

            $users = User::orderBy('id', 'desc')->get();
        }

        return view('dashboard.user.manage_user', get_defined_vars());
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.userdetails', get_defined_vars());
    }

    public function change_visibility_show(Request $request)
    {
        $change_visibility = User::where('id', $request->user_id)->update(['status' => $request->status]);
        return response()->json(['msg' => 'User is Invisible now...!'], 201);
    }

    public function delete_user(Request $request)
    {
        $delete_user = User::find($request->user_id)->delete();
        return response()->json(['msg' => 'User removed successfully...!'], 201);
    }

    public function number_of_users()
    {
        $users_b2b = User::where('user_type', 'B2B')->orderBy('id', 'desc')->get();
        $users_b2e = User::where('user_type', 'B2E')->orderBy('id', 'desc')->get();
        return view('dashboard.user.number_of_users', get_defined_vars());
    }
}
