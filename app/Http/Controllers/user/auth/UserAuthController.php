<?php

namespace App\Http\Controllers\user\auth;
use URL;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validate;

class UserAuthController extends Controller
{
    //
    public function login(){
        $check = 1;
        session()->put('check',$check);
        return view("user.auth.login");
       
        
    }
    
public function sendEmailOtp(Request $request)
{
    // Validate that the email is required and exists in the users table
    $this->validate($request, [
        'email' => 'required|email|exists:users,email',
    ],[
        'email.exists' => 'Please enter your registerd email Id.'
        ]);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        $otp = mt_rand(1000, 9999);

        // Prepare the data array with all required variables
        $data['otp'] = $otp;
        $data['email'] = $request->email;
        $data['title'] = 'Password Reset OTP';
        $data['body'] = 'Your OTP for password reset is: ' . $otp;
        $data['name'] = $user->name; // Add the user's name to the data array

        Mail::send('user/auth/send_otp', $data, function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });

        $datetime = now()->format('Y-m-d H:i:s');
        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'otp' => $otp,
                'created_at' => $datetime
            ]
        );

        return redirect('/reset-password')->with('success', 'Check your email to get the OTP for password reset.');
    }

    return back()->withErrors(['email' => 'Email not found in our records.']);
}

    
    
    public function forgot_password(){
        return view('user.auth.forgot_password');
    }
    
    
    
    
    public function reset_password(){
        return view('user.auth.reset_password');
    }
    
     public function resetPassword(Request $request)
    {
      $validatedData = $request->validate([
        'otp' => 'required|numeric',
        'password' => [
            'required',
            'string',
            'min:6',
            'regex:/^\S*$/u', // No spaces
            'regex:/[!@#$%^&*(),.?":{}|<>]/', // At least one special character
            'regex:/[0-9]/', // At least one number
        ],
        'new_password' => 'required|same:password', // Ensure new_password matches password
    ], [
        // Custom validation messages
        'password.regex' => 'The password must be at least 6 characters long, contain no spaces, include at least one special character, and one number.',
        'new_password.same' => 'The new password must match the current password.',
    ]);



      $token = $request->token;

      $data = DB::table('password_resets')->where('otp', $request->otp)->first();

      $user = User::where('email', $data->email)->first();
      $user->password = Hash::make($request->new_password);
      $user->save();

      return redirect('/')->with('success','successfully password change');
  }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    public function user_login(Request $request){
        $validate = $this->validate($request,[
            "email"=> "required",
            "password"=> "required",
        ]);

        $admin = User::where("email", $request->email)->first();
  

        $email = $request->email;
        $password = $request->password;

        if($admin){
            if(Hash::check($password, $admin->password)){
                if($admin->role == 1 || ($admin->role == 2 && $admin->status == 'Active'))
                {
                    $request->session()->put("adminloginId", $admin->role);
                    $request->session()->put('admin_name',$admin->vendor_name);
                    $request->session()->put('admin_id',$admin->id);
                    
                    return redirect("dashboard")->with("success","Login Successfully😊!");
                    
                }else if($admin->role == 2 && $admin->status == 'De-Active'){
                    // $request->session()->put("adminloginId", $admin->role);
                    // $request->session()->put('admin_name',$admin->vendor_name);
                    
                    return redirect("/")->with("fail","Login failed. Your Account are Deactiavte so, Please contact administrator!!");
                    
                }else if($admin->role == 0 && $admin->status == 'Active'){
                    $request->session()->put("userloginId", $admin->role);
                    $request->session()->put("vendor_id", $admin->id);
                    $request->session()->put("vendor_name", $admin->vendor_name);
                    return redirect("user-dashboard")->with("success","Login Successfully😊!");
                }
                else if($admin->role == 0 && $admin->status == 'De-Active'){
                    return redirect("/")->with("fail","Login failed. Your Account are Deactiavte so, Please contact administrator!!");
                }
                else{
                    return redirect("/")->with("fail","Invalid Credintial!");
                }
            }
            else{
                
                return redirect("/")->with("fail","Incorrect Password");
            }
        }
        else{
            return redirect("/")->with("fail","Email is incorrect");
        }
    }
    
    
    

    public function logout(Request $request)
    {
        if (session()->has("userloginId")) {
            session()->forget('userloginId');
            return redirect("/")->with("success", "Logout Successfully!");
        
        } else {
            return redirect("/")->with("error", "No user is logged in.");
        }
    }
    
    

}
