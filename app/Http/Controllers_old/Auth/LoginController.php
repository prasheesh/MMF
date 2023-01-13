<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function checkEmailExist(Request $request)
    {
        $count = User::where('email', $request->email)->count();
        if($count == 0){
            return 0;
        }else{
            return 1;
        }
    }
    public function checkPwdExist(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // $credentials = array('email' => $email , 'password' => $password);
        $user = User::where('email', '=', $email)->first();

        // $attempt = Auth::attempt($credentials);
       $pwd_check =  Hash::check($password, $user->password);
    //    dd($pwd_check);
      if($pwd_check== true){
        return 1;
      }else{
        return 0;
      }

    }

    public function getOTPNumber(Request $request){
        $email = $request->email;
        $user = User::where('email', '=', $email)->first();
        // dd($user);
        $random=rand(100000,999999);
        $primary_contact_number=$user->mobile_number;
        $count=User::where(['mobile_number'=>$primary_contact_number])->count();
        if($count>0){
            User::where(['mobile_number'=>$primary_contact_number])->update(['otp'=>$random]);
            // return "Please Use OTP Number For Authentication ".$random;
            return response()->json(['message' => "Please Use OTP Number For Authentication ".$random], 200);
        }else{
            $data=['mobile_number'=>$primary_contact_number,'otp'=>$random];
            User::insert($data);
            return response()->json(['message' => "Please Use OTP Number For Authentication ".$random], 200);
            // return "Please Use OTP Number For Authentication ".$random;
        }

    }
    public function checkOtpNumber(Request $request){
        $email = $request->email;
        $login_otp = $request->login_otp;
        $user = User::where('email', '=', $email)->first();
        $count = User::where('email', '=', $email)->count();
        // dd($user);
        if($count >0){
                if($login_otp == $user->otp){
                    return 1;
                }else{
                    return 0;
                }
        }else{
            return "user not found";
        }


    }

    public function forgotPassword(Request $request){
        // dd($request);
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)->first();
        User::where(['email'=>$email])->update(['password'=>Hash::make($password)]);

        return response()->json(['message' => 'Password  has been updated successfully...'], 201);
    }
}
