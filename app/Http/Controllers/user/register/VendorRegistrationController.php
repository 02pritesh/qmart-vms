<?php

namespace App\Http\Controllers\user\register;

use App\Http\Controllers\Controller;
use App\Models\VendorRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  // To log errors and information
use Exception;  // To handle exceptions

class VendorRegistrationController extends Controller
{
    public function vendor_registration(){
        if(session()->has('userloginId')){
            $userloginId = session()->get('vendor_id');
            $vendor = User::where('id',$userloginId)->first();
            $data = VendorRegistration::where('user_id',$userloginId)->first();
            // dd($vendor);
            
            return view("user.register.vendor_registration",compact('vendor','data'));
        }else{
            return redirect('/');
        }
    }

//     public function add_vendor_registration(Request $request){
//     $this->validate($request, [
//     'subject' => 'required',
//     'vendor_name' => 'required|string',
//     'legal_name' => 'required|string',
//     'street_no' => 'required|string',
//     'country_name' => 'required|string',
//     'contact_person1' => 'required|string',
//     'contact_person2' => 'required|string',
//     'gst_number' => 'required|string|size:15',
//     'pan_number' => 'required|string|unique:vendor_registrations,pan_number|size:10',
//     'msme_number' => [
//         'nullable',
//         'regex:/^UDYAM-[A-Z]{2}-\d{2}-\d{7}$/',
        
//     ],
//     'fssai_number' => [
//         'nullable',
//         'numeric',
//         'digits:14',
  
//     ],
//     'rtv_expiry' => 'required|string',
//     'rtv_damage' => 'required|string',
//     'payment_cycle' => 'required|string',
//     'cancelled_cheque' => 'required|mimes:pdf,docx,jpeg,png,jpg,gif,svg|max:5120',
//     'beneficiary_name' => 'required|string',
//     'bank_name' => 'required|string',
//     'bank_address' => 'required|string',
//     'postal_zip_code' => 'required|numeric',
//     'bank_country_name' => 'required|string',
//     'beneficiary_account_type' => 'required|string',
//     'beneficiary_account_name' => 'required|string',
//     'beneficiary_account_number' => 'required|numeric',
//     'branch_ifsc_code' => 'required|string',
//     'listing_charges' => 'required|string',
// ], [
//     'vendor_name.required' => 'The Vendor Name field is required.',
//     'email.required' => 'The Email field is required.',
//     'email.email' => 'The Email must be a valid email address.',
//     'mobile_number1.required' => 'The Mobile Number 1 field is required.',
//     'pan_number.size' => 'The PAN Number must be exactly 10 characters.',
//     'msme_number.regex' => 'The MSME number must be in the format UDYAM-XX-00-0000000.',
//     'fssai_number.digits' => 'The FSSAI Number must be exactly 14 digits.',
//     'postal_zip_code.numeric' => 'The Post Zip Code must be a numeric value.',
//     // Add additional custom error messages here
// ]);



    


//         $data = new VendorRegistration();
//         $data->subject = $request->subject;
//         $data->user_id = session()->get('vendor_id');
//         $data->vendor_name = $request->vendor_name;
//         $data->legal_name = $request->legal_name;
//         $data->street_no = $request->street_no;
//         $data->city = $request->city;
//         $data->country_name  = $request->country_name;
//         $data->telephone_number = $request->telephone_number;
//         $data->mobile_number1 = $request->mobile_number1;
//         $data->contact_person1 = $request->contact_person1;
//         $data->mobile_number2 = $request->mobile_number2;
//         $data->contact_person2 = $request->contact_person2;
//         $data->email = $request->email;
//         $data->gst_number = $request->gst_number;
//         $data->pan_number = $request->pan_number;
//         // $data->tin_number = $request->tin_number;
//         $data->msme_number = $request->msme_number;
//         $data->fssai_number = $request->fssai_number;
//         $data->rtv_expiry = $request->rtv_expiry;
//         $data->rtv_damage = $request->rtv_damage;
//         $data->payment_cycle = $request->payment_cycle;
//         $data->credit_day = $request->credit_day;
//         $data->cancelled_cheque = $request->file('cancelled_cheque')->getClientOriginalName();
//         $request->file('cancelled_cheque')->move('public/assets/upload/', $data->cancelled_cheque);

//         $data->beneficiary_name = $request->beneficiary_name;
//         $data->bank_name = $request->bank_name;
//         $data->bank_address = $request->bank_address;
//         $data->postal_zip_code = $request->postal_zip_code;
//         $data->bank_country_name = $request->bank_country_name;
//         $data->beneficiary_account_type = $request->beneficiary_account_type;
//         $data->beneficiary_account_number = $request->beneficiary_account_number;
//         $data->branch_micr_code = $request->branch_micr_code;
//         $data->branch_ifsc_code = $request->branch_ifsc_code;
//         $data->listing_charges = $request->listing_charges;
//         $data->q_mart_retail = $request->q_mart_retail;
//         $data->vendor_remark = $request->vendor_remark;
//         $data->description = 'Vendor Registration';

//         $result = $data->save();

//         if($result){
//             return redirect('vendor-show-vendor-registration-detail')->with('success','Vendor Registration Successfully!');
//         }
        

//     }


public function add_vendor_registration(Request $request)
    {
        try { // Validate the request
            $this->validate($request, [
                'subject' => 'required',
                'vendor_name' => 'required|string',
                'legal_name' => 'required|string',
                'street_no' => 'required|string',
                'country_name' => 'required|string',
                'contact_person1' => 'required|string',
                'contact_person2' => 'required|string',
                'gst_number' => 'required|string|size:15',
                // 'pan_number' => 'required|string|unique:vendor_registrations,pan_number|size:10',
                'msme_number' => [
                    'nullable',
                    'regex:/^UDYAM-[A-Z]{2}-\d{2}-\d{7}$/',
                ],
                'fssai_number' => [
                    'nullable',
                    'numeric',
                    'digits:14',
                ],
                'rtv_expiry' => 'required|string',
                'rtv_damage' => 'required|string',
                'payment_cycle' => 'required|string',
                'cancelled_cheque' => 'nullable|mimes:pdf,xlsx,xls,png,jpg,zip|max:5120',
                'beneficiary_name' => 'required|string',
                'bank_name' => 'required|string',
                'bank_address' => 'required|string',
                'postal_zip_code' => 'required|numeric',
                'bank_country_name' => 'required|string',
                'beneficiary_account_type' => 'required|string',
                'beneficiary_account_name' => 'required|string',
                'beneficiary_account_number' => 'required|numeric',
                'branch_ifsc_code' => 'required|string',
                'listing_charges' => 'required|string',
            ], [
                'vendor_name.required' => 'The Vendor Name field is required.',
                'email.required' => 'The Email field is required.',
                'email.email' => 'The Email must be a valid email address.',
                'mobile_number1.required' => 'The Mobile Number 1 field is required.',
                // 'pan_number.size' => 'The PAN Number must be exactly 10 characters.',
                'msme_number.regex' => 'The MSME number must be in the format UDYAM-XX-00-0000000.',
                'fssai_number.digits' => 'The FSSAI Number must be exactly 14 digits.',
                'postal_zip_code.numeric' => 'The Post Zip Code must be a numeric value.',
                'cancelled_cheque.*.mimes' => 'Invalid File Formate',
                'cancelled_cheque.*.max' => 'The file size atleast 5MB', 
                // Additional custom error messages
            ]);

        
            // Create a new VendorRegistration instance
            $data = new VendorRegistration();
            $data->subject = $request->subject;
            $data->user_id = session()->get('vendor_id');
            $data->vendor_name = $request->vendor_name;
            $data->legal_name = $request->legal_name;
            $data->street_no = $request->street_no;
            $data->city = $request->city;
            $data->country_name  = $request->country_name;
            $data->telephone_number = $request->telephone_number;
            $data->mobile_number1 = $request->mobile_number1;
            $data->contact_person1 = $request->contact_person1;
            $data->mobile_number2 = $request->mobile_number2;
            $data->contact_person2 = $request->contact_person2;
            $data->email = $request->email;
            $data->gst_number = $request->gst_number;
            $data->pan_number = $request->pan_number;
            $data->msme_number = $request->msme_number;
            $data->fssai_number = $request->fssai_number;
            $data->rtv_expiry = $request->rtv_expiry;
            $data->rtv_damage = $request->rtv_damage;
            $data->payment_cycle = $request->payment_cycle;
            $data->credit_day = $request->credit_day;
            if($request->hasFile('cancelled_cheque')){
                $data->cancelled_cheque = $request->file('cancelled_cheque')->getClientOriginalName();
                $request->file('cancelled_cheque')->move('public/assets/upload/', $data->cancelled_cheque);
            }
            $data->beneficiary_name = $request->beneficiary_name;
            $data->bank_name = $request->bank_name;
            $data->bank_address = $request->bank_address;
            $data->postal_zip_code = $request->postal_zip_code;
            $data->bank_country_name = $request->bank_country_name;
            $data->beneficiary_account_type = $request->beneficiary_account_type;
            $data->beneficiary_account_number = $request->beneficiary_account_number;
            $data->beneficiary_account_name = $request->beneficiary_account_name;
            $data->branch_micr_code = $request->branch_micr_code;
            $data->branch_ifsc_code = $request->branch_ifsc_code;
            $data->listing_charges = $request->listing_charges;
            $data->q_mart_retail = $request->q_mart_retail;
            $data->vendor_remark = $request->vendor_remark;
            $data->description = 'Vendor Registration';

            // Save the data to the database
            $result = $data->save();

            if ($result) {
                return redirect('vendor-show-vendor-registration-detail')->with('success', 'Vendor Registration Successfully!');
            }
        } catch (Exception $e) {
            return redirect('vendor-show-vendor-registration-detail')->with('error', 'Failed to register vendor. Error: ' . $e->getMessage());
        }
    }
}
