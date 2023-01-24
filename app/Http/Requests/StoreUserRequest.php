<?php

namespace App\Http\Requests;
use App\Models\Dashboard\File;
use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => ['required'],
            'name' => ['required'],
            'mobile_number' => ['required'],
            'email' => ['required','email', 'unique:users,email'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password'],
            
            'aadhar_no' => ['required'],
            'pan_no' => ['required'],
            'gst_no' => ['required'],
            
            // 'role' => ['required'],
            'aadhar_card' => ['required'],
            'pan_card' => ['required'],
            'gst_certificate' => ['required'],
            'address' => ['required']
        ];
    }

    public function storeUser($user_data)
    {
        // dd($user_data);
        $store_aadhar_card = $this->storeAadharCard($user_data);
        $store_pan_card = $this->storePanCard($user_data);
        $store_gst_certificate = $this->storeGstCertificate($user_data);

        $data = [
            'name' => $user_data['name'],
            'company_name' => $user_data['company_name'],
            'email' => $user_data['email'],
            //'password' => $user_data['password'],
            'password' => Hash::make($user_data['password']),
            'mobile_number' => $user_data['mobile_number'],
            'company_name' => $user_data['company_name'],
            // 'role' => $user_data['role'],
            'user_type' => $user_data['userType'],
            'address' =>$user_data['address'],
            'aadhar_no' =>$user_data['aadhar_no'],
            'pan_no' =>$user_data['pan_no'],
            'gst_no' =>$user_data['gst_no'],
            'status' => 1,
        ];
        $save_user = User::create($data);
        $save_user->save();
        $save_user->aadharCard()->saveMany($store_aadhar_card);
        $save_user->panCard()->saveMany($store_pan_card);
        $save_user->gstCertificate()->saveMany($store_gst_certificate);
    }



    public function storeAadharCard($user_data)
    {
        if(!empty($user_data['aadhar_card']))
        {
            $avatar_array = [];
                 $file = $user_data['aadhar_card'];
                // $file = $aadhar;
                $originalName = 'files/'.time().$file->getClientOriginalName();
                $path = 'public/'.$originalName;
                Storage::disk('local')->put($path, file_get_contents($file->getRealPath()));
                $avatar = new File([
                    'url' => $originalName,
                    'file_name' => $file->getClientOriginalName(),
                    'source' => 'local',
                    'fileable_params' => 'aadhar_card',
                    'description' => '',
                    'title' => ''
                ]);
                array_push($avatar_array, $avatar);
            return $avatar_array;
        }
    }

    public function storePanCard($user_data)
    {
        $avatar_array = [];
                //$file = $user_data['aadhar_card'];
                $file = $user_data['pan_card'];
                // $file = $aadhar;
                $originalName = 'files/'.time().$file->getClientOriginalName();
                $path = 'public/'.$originalName;
                Storage::disk('local')->put($path, file_get_contents($file->getRealPath()));
                $avatar = new File([
                    'url' => $originalName,
                    'file_name' => $file->getClientOriginalName(),
                    'source' => 'local',
                    'fileable_params' => 'pan_card',
                    'description' => '',
                    'title' => ''
                ]);
                array_push($avatar_array, $avatar);
            return $avatar_array;
    }

    public function storeGstCertificate($user_data)
    {
        $avatar_array = [];
                //$file = $user_data['aadhar_card'];
                $file = $user_data['gst_certificate'];
                // $file = $aadhar;
                $originalName = 'files/'.time().$file->getClientOriginalName();
                $path = 'public/'.$originalName;
                Storage::disk('local')->put($path, file_get_contents($file->getRealPath()));
                $avatar = new File([
                    'url' => $originalName,
                    'file_name' => $file->getClientOriginalName(),
                    'source' => 'local',
                    'fileable_params' => 'gst_certificate',
                    'description' => '',
                    'title' => ''
                ]);
                array_push($avatar_array, $avatar);
            return $avatar_array;
    }
}
