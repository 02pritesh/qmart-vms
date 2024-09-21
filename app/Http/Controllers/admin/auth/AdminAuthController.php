<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validate;
class AdminAuthController extends Controller
{
    // public function login(){
    //     return view("admin.auth.login");
    // }

    // public function admin_login(Request $request){
    //     $validate = $this->validate($request,[
    //         "email"=> "required",
    //         "password"=> "required",
    //     ]);

    //     $admin = User::where("email", $request->email)->first();
    //     $user = User::where('email',$request->email)->first();

    //     $email = $request->email;
    //     $password = $request->password;

    //     if($admin){
    //         if(Hash::check($password, $admin->password)){
    //             if($admin->role == 1)
    //             {
    //                 $request->session()->put("loginId", $admin->role);
    //                 $request->session()->put('admin_name',$admin->vendor_name);
    //                 return redirect("all-vendor-registration")->with("success","Login Successfully😊!");
    //             }
    //             else{
    //                 return redirect("/")->with("fail","Login failed because Invalid Credintial!");
    //             }
    //         }
    //         else{
                
    //             return redirect("/")->with("fail","Login failed because password is incorrect");
    //         }
    //     }else if($user){
    //         if(Hash::check($password, $user->password)){
    //             if($user->role == 0 && $user->status == 'Activate')
    //             {
    //                 $request->session()->put("loginId", $user->role);
    //                 $request->session()->put("vendor_id", $user->id);
    //                 $request->session()->put("vendor_name", $user->vendor_name);
    //                 return redirect("vendor-registration")->with("success","Login Successfully😊!");
    //             }else if($user->role == 0 && $user->status == 'Deactivate'){
    //                 return redirect("/")->with("fail","Login failed because Your Account are Deactiavte so,Please You Contact your Admin!!");
    //             }
    //             else{
    //                 return redirect("/")->with("fail","Login failed because Invalid Credintial!");
    //             }
    //         }
    //         else{
    //             return redirect("/")->with("fail","Login failed because password is Incorrect");
    //         }
    //     }
    //     else{
    //         return redirect("/")->with("fail","Login Failed because email is incorrect");
    //     }
    // }
    
    
    
    public function add_sub_admin(){
        $data = User::where('role',2)->get()->sortByDesc('created_at');
        return view('admin.auth.add_sub_admin',compact('data'));
    }
    
    public function register_sub_admin(Request $request){
         $validate  = $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/^\S*$/u', // No spaces
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // At least one special character
                'regex:/[0-9]/', // At least one number
            ],[
                'password.regex' => 'The password must be at least 6 characters, contain no spaces, at least one special character, and one number.',
            ]
        ]);
        
        $data = new User();
        $data->vendor_name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = '2';
        
        $result = $data->save();
        if($result){
            
            
            return redirect('add-sub-admin')->with('success','Sub-Admin Add Successfully!');
        }
    }
    
    
    
    

    public function vendor_detail(){
        if(session()->has('adminloginId')){
            $data = User::where('role',0)->get()->sortByDesc('created_at');
            return view ('admin.auth.vendor_detail',compact('data'));
        }else{
            return redirect('/');
        }
    }
    public function admin_logout(Request $request){
         
     if (session()->has("adminloginId")) {
            session()->forget('adminloginId');

            return redirect("/")->with("success", "Logout Successfully!");
        } else {
            return redirect("/")->with("error", "No user is logged in.");
        }
    }
}
