<?php

namespace App\Http\Controllers\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorRegistration;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register()
    {
        return view("user.auth.register");
    }

    public function add_user(Request $request)
    {
        $validate = $this->validate($request, [
    "vendor_name" => "required",
    "email" => "required|email|unique:users,email",
    'password' => [
        'required',
        'string',
        'min:6',
        'regex:/^\S*$/u', // No spaces
        'regex:/[!@#$%^&*(),.?":{}|<>]/', // At least one special character
        'regex:/[0-9]/', // At least one number
    ],
   "gstin" => [
    "required",
    "string",
    "min:15",
    "max:15",
    "unique:users,gstin",
    "regex:/^[0-9]{2}(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{13}$/"
],

    "contact_person" => "required",
    "phone_number" => "required|min:10",
    "brands" => "required|string",
], [
    'password.regex' => 'The password must be at least 6 characters, contain no spaces, at least one special character, and one number.',
    'gstin.required' => 'The GSTIN is required.',
    'gstin.string' => 'The GSTIN must be a string.',
    'gstin.min' => 'The GSTIN must be exactly 15 characters long.',
    'gstin.max' => 'The GSTIN must be exactly 15 characters long.',
    'gstin.unique' => 'This GSTIN is already registered.',
    'gstin.regex' => 'The GSTIN must start with two digits, followed by alphanumeric characters.',
]);


        if (!$validate) {
            return redirect('register')->withErrors($validate)->withInput();
        } else {
            $user = new User();
            $user->vendor_name = $request->vendor_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->gstin = $request->gstin;
            $user->contact_person = $request->contact_person;
            $user->phone_number = $request->phone_number;
            $user->brands = $request->brands;

            $result = $user->save();

            if ($result) {
                return redirect('/')->with('success', 'Your Registration is Successful, Please contact your Q-Mart Co-ordinate to Activate your account!!');
            } else {
                return redirect()->back()->with('error', 'Registration Failed!!');
            }
        }
    }

    public function edit_user_registration(){
        $id = session()->get('vendor_id');
        $data = User::find($id);
        return view('user.auth.edit_user_registration',compact('data'));
    }

    public function update_user_registration(Request $request){
        
        $data = User::find($request->id);
        $vendor = VendorRegistration::where('user_id',$data->id)->first();
        
        $data->vendor_name = $request->vendor_name;
        
        $data->gstin = $request->gstin;
        if($vendor){
            $vendor->gst_number = $request->gstin; 
        }

        $data->contact_person = $request->contact_person;
        $data->phone_number = $request->phone_number;
        $data->brands = $request->brands;
       
        $result = $data->save();
        if($vendor){
            $vendor->save();
        }
        if($result){
            return redirect('edit-user-registration')->with('success','User Registration Update Successfully!');
        }
        else{
            return redirect('edit-user-registration')->with('fail','Could not Update User Registration!');
        }
    }
}
