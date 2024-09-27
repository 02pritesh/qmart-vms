<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DebitCredit;
use App\Models\InnvoicesMrn;
use App\Models\PaymentFollow;
use App\Models\RequestReport;
use App\Models\SkuRegistration;
use App\Models\SkuVendorEntityNameDetail;
use App\Models\User;
use App\Models\VendorRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception; 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validate;



class AdminController extends Controller
{


    public function dashboard()
    {
        if (session()->has('adminloginId')) {
            $users = VendorRegistration::orderBy('created_at', 'desc')->get();
            $skuRegistrations = SkuRegistration::orderBy('created_at', 'desc')->get();
            $requestReports = RequestReport::orderBy('created_at', 'desc')->get();
            $innvoices = InnvoicesMrn::orderBy('created_at', 'desc')->get();
            $debits = DebitCredit::orderBy('created_at', 'desc')->get();
            $payments = PaymentFollow::orderBy('created_at', 'desc')->get();

            return view('admin.show_all_registration', compact('users', 'skuRegistrations', 'requestReports','innvoices','debits','payments'));
        } else {
            return redirect('/');
        }
    }






    public function show_registration()
    {
        if (session()->has('adminloginId')) {

            $registration = SkuRegistration::all();
            $registration = $registration->sortByDesc('created_at');
            return view('admin.show_registration_detail', compact('registration'));
        } else {
            return redirect('/');
        }
    }



    //    public function view_sku_vendor_entity_detail($id)
    //     {
    //         if(session()->has('adminloginId')){
    //             $skuProducts = SkuVendorEntityNameDetail::where('sku_registration_id', $id)->get();
    //             $sku = SkuRegistration::find($id);

    //             return view('admin.show_sku_registration_product', compact('skuProducts','sku'));
    //         }else{
    //             return redirect('/');
    //         }
    //     }




    public function vendor_registration_detail()
    {
        if (session()->has('adminloginId')) {
            // Fetch data sorted by 'updated_at' in ascending order directly in the query
            $vendorDetail = VendorRegistration::orderBy('id', 'desc')->get();
            // dd($vendorDetail);

            return view('admin.vendor_registration_detail', compact('vendorDetail'));
        } else {
            return redirect('/');
        }
    }
    
    
    public function edit_vendor_detail($id){
        try{
             if (session()->has('adminloginId')) {
               
               $data = User::find($id);
                return view('admin.auth.edit_vendor_detail', compact('data'));
                
            } else {
                return redirect('/');
            }
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }
    
    
    
    
    public function update_vendor_detail(Request $request){
        try{
             if (session()->has('adminloginId')) {
               
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
                    return redirect('vendor-detail')->with('success','User Registration Update Successfully!');
                }
                else{
                    return redirect('vendor-detail')->with('fail','Does not Update User Registration!');
                }
            } else {
                return redirect('/');
            }
            
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }





    public function delete_vendor_registration_detail(Request $request)
    {
        // Validate that the selected_ids array is provided
        $request->validate([
            'selected_ids' => 'required|array',
        ]);
    
        // Perform the deletion
        VendorRegistration::whereIn('id', $request->selected_ids)->delete();
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Selected items have been deleted.');
       
    }




    public function edit_vendor_registration_detail($id)
    {
        if (session()->has('adminloginId')) {


            $vendorDetail = VendorRegistration::find($id);

            return view('admin.edit_vendor_registration_detail', compact('vendorDetail'));
        } else {
            return redirect('/');
        }
    }




    public function update_vendor_registration_detail(Request $request)
    {
            $this->validate(
                $request,
                [
                    'cancelled_cheque' => 'nullable|mimes:pdf,png,jpg,xls,xlsx,zip|max:5120',
                ],
                [
                    'cancelled_cheque.*.mimes' => 'Invalid File Formate',
                    'cancelled_cheque.*.max' => 'The file size atleast 5MB',
                ]
            );
        try {
            $data = VendorRegistration::find($request->id);
            // $user = User::where('id',$vendor_id)->first();

            $user_id = $data->user_id;
            $user = User::where('id', $user_id)->first();

            $data->subject = $request->subject;
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
            $user->gstin = $request->gst_number;
            $data->pan_number = $request->pan_number;
            $data->msme_number = $request->msme_number;
            $data->fssai_number = $request->fssai_number;
            $data->rtv_expiry = $request->rtv_expiry;
            $data->rtv_damage = $request->rtv_damage;
            $data->payment_cycle = $request->payment_cycle;
            $data->credit_day = $request->credit_day;

            // Check if a new file is uploaded
            if ($request->hasFile('cancelled_cheque')) {
                $data->cancelled_cheque = $request->file('cancelled_cheque')->getClientOriginalName();
                $request->file('cancelled_cheque')->move('public/assets/upload/', $data->cancelled_cheque);
            } else {
                // Retain the existing file path
                $data->cancelled_cheque = $request->input('existing_cancelled_cheque');
            }

            $data->beneficiary_name = $request->beneficiary_name;
            $data->bank_name = $request->bank_name;
            $data->bank_address = $request->bank_address;
            $data->postal_zip_code = $request->postal_zip_code;
            $data->bank_country_name = $request->bank_country_name;
            $data->beneficiary_account_type = $request->beneficiary_account_type;
            $data->beneficiary_account_number = $request->beneficiary_account_number;
            $data->branch_micr_code = $request->branch_micr_code;
            $data->branch_ifsc_code = $request->branch_ifsc_code;
            $data->listing_charges = $request->listing_charges;
            $data->q_mart_retail = $request->q_mart_retail;
            $data->vendor_remark = $request->vendor_remark;
            $data->description = 'Vendor Registration';
            $data->status = 'Approved';
            $data->approved_by = $request->approved_by;
            $user->save();
            $data->save();

            return redirect('vendor-registration-detail')->with('success', 'Vendor registration details Updated Successfully!');
        } catch (Exception $e) {

            return redirect('vendor-registration-detail')->with('error', 'Vendor registration details update failed! Error: ' . $e->getMessage());
        }
    }





    public function edit_sku_registration_detail($id)
    {
        if (session()->has('adminloginId')) {


            $skuDetail = SkuRegistration::find($id);

            // dd($skuEntity);

            return view('admin.edit_sku_registration_detail', compact('skuDetail'));
        } else {
            return redirect('/');
        }
    }



    public function update_sku_registration_detail(Request $request)
    {
        $this->validate($request, [
            'erp_code.*' => 'required|digits_between:1,11|numeric',
            'approved_by' => 'required',
        ], [
            'erp_code.*.required' => 'The ERP Product Code must be required.',
            'erp_code.*.digits_between' => 'The ERP Product Code can be less than 11 digits.',
            'erp_code.*.numeric' => 'The ERP Product Code must be a numeric value.'

        ]);
        // Update the SkuRegistration model
        $skuData = SkuRegistration::find($request->id);
        $skuData->subject =  $request->brand;
        $skuData->vendor_name = $request->vendor_name;
        $skuData->description = 'Sku Registration';
        $skuData->status = 'Approved';
        $skuData->approved_by = $request->approved_by;

        $skuData->product_name = $request->product_name;
        $skuData->category = $request->category;
        $skuData->rtv = $request->rtv;
        $skuData->unit = $request->unit;
        $skuData->case_qty = $request->case_qty;
        $skuData->EAN_Code = $request->EAN_Code;
        $skuData->shelf_life = $request->shelf_life;
        $skuData->HSN_Code = $request->HSN_Code;
    
        $skuData->cess = $request->cess;
        $skuData->cess_percentage = $request->cess_percentage;
        $skuData->additional_cess = $request->additional_cess;
        $skuData->gst_percentage = $request->gst_percentage;
        $skuData->margin_percentage = $request->margin_percentage;
        $skuData->mrp = $request->mrp;
        $skuData->margin = $request->margin;
        $skuData->landing_price = $request->landing_price;
        $skuData->gst_price = $request->gst_price;
        $skuData->basic_cost = $request->basic_cost;
        $skuData->sku_remark = $request->sku_remark;
        $skuData->erp_code = $request->erp_code;

        $skuData->save();


        return redirect("registration-detail")->with("success", "Sku Details Updated successfully!");
    }



    public function edit_request_report($id)
    {
        if (session()->has('adminloginId')) {

            $messages = RequestReport::find($id);
            return view('admin.edit_request_report', compact('messages'));
        } else {
            return redirect('/');
        }
    }


    

    public function update_request_report(Request $request)
    {
        $data = RequestReport::find($request->id);
        $data->subject = $request->subject;
        $data->vendor_name = $request->vendor_name;
        $data->vendor_message = $request->vendor_message;
        $data->description = 'Request Report';

        if ($request->hasFile('vendor_file')) {
            $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
            $request->file('vendor_file')->move('public/assets/upload/', $data->vendor_file);
        } else {
            // Retain the existing file path
            $data->vendor_file = $request->input('exists_vendor_file');
        }

        // $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
        // $request->file('vendor_file')->move('public/assets/upload/',$data->vendor_file);
        $data->status = 'Approved';
        $data->approved_by = $request->approved_by;
        // dd($data);
        $data->save();

        return redirect("request-report-detail")->with("success", "Request Report Details Updated successfully!");
    }



    public function delete_sku_vendor_entity_detail(Request $request)
    {
         // Validate that the selected_ids array is provided
        $request->validate([
            'selected_ids' => 'required|array',
        ]);
    
        // Perform the deletion
        SkuRegistration::whereIn('id', $request->selected_ids)->delete();
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Selected items have been deleted.');
        
       
    }

    

    public function show_request_report_detail()
    {
        if (session()->has('adminloginId')) {


            $messages = RequestReport::orderBy('created_at', 'desc')->get();
            return view('admin.show_request_report_detail', compact('messages'));
        } else {
            return redirect('/');
        }
    }





    public function admin_message_reply($id)
    {
        if (session()->has('adminloginId')) {

            $messages = RequestReport::find($id);
            return view('admin.admin_message_reply', compact('messages'));

        } else {
            return redirect('/');
        }
    }




    public function delete_vendor_reply(Request $request)
    {
        // Validate that the selected_ids array is provided
        $request->validate([
            'selected_ids' => 'required|array',
        ]);
    
        // Perform the deletion
        RequestReport::whereIn('id', $request->selected_ids)->delete();
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Selected items have been deleted.');
        
    }





    public function sent_admin_message(Request $request)
    {
        $this->validate(
            $request,
            [
                'vendor_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                'admin_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                'admin_message' => 'required',
            ],
            [
                'vendor_file.*.mimes' => 'Invalid File Formate',
                'admin_file.*.mimes' => 'Invalid File Formate',
                'vendor_file.*.max' => 'The file size atleast 5MB',
                'admin_file.*.max' => 'The file size atleast 5MB',
            ]
        );

        $data = RequestReport::where('id', $request->id)->first();
        // dd($data);
        $data->vendor_message = $request->vendor_message;
        $data->vendor_name = $request->vendor_name;
        $data->subject = $request->subject;


        if ($request->hasFile('vendor_file')) {
            $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
            $request->file('vendor_file')->move('public/assets/upload/', $data->vendor_file);
        }
        if ($request->hasFile('admin_file')) {
            $data->admin_file = $request->file('admin_file')->getClientOriginalName();
            $request->file('admin_file')->move('public/assets/upload/', $data->admin_file);
        }
        if ($request->hasFile('existing_vendor_file') || $request->hasFile('existing_vendor_file')) {
            // Retain the existing file path
            $data->vendor_file = $request->input('existing_vendor_file');

            // Retain the existing file path
            $data->admin_file = $request->input('existing_admin_file');
        }

        $data->admin_message = $request->admin_message;


        // if ($request->hasFile('admin_file')) {
        //   $data->admin_file = $request->file('admin_file')->getClientOriginalName();
        //   $request->file('admin_file')->move('public/assets/upload/', $data->admin_file);
        // } else {

        // }

        $data->status = 'Replied';
        $data->approved_by = $request->approved_by;
        // dd($data);
        $result = $data->save();
        if ($result) {
            return redirect('request-report-detail')->with('success', 'Data Sent Successfully!');
        } else {
            return redirect('request-report-detail')->with('error', 'Data does not sent');
        }
    }



    // ------------------------------------------------Innvoices & MRN -----------------------------------

    public function show_innvoice_mrn_detail(){
        
        try{
            if (session()->has('adminloginId')) {

                $messages = InnvoicesMrn::orderBy('created_at', 'desc')->get();
                return view('admin.innvoice.show_innvoice_mrn_detail', compact('messages'));

            } else {
                return redirect('/');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function innvoice_message(){
        try{

            if (session()->has('adminloginId')) {

                $admin = session()->get('admin_id');
                $admin = User::where('id',$admin)->first();
               
                $details = User::where('role','!=',1)->where('role','!=',2)->where('status','=','Active')->get();
                // dd($details);
                return view('admin.innvoice.innvoice_message',compact('admin','details'));

            } else {
                return redirect('/');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function get_gstin(Request $request){
        
        $vendor = User::find($request->id); // Assuming your model is Vendor
        return response()->json(['gstin' => $vendor->gstin]);
    }




    public function add_innvoice_message(Request $request){
        

            $this->validate(
                $request,
                [
                    'admin_message' => 'required',
                    'vendor_name' => 'required',
                    'admin_document' => 'required|numeric',
                    'admin_amount' => 'required|numeric',
                    'admin_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120'
                ],
                [
                    'vendor_name.*.required' =>'The Vendor name must be required',
                    // 'vendor_file.*.mimes' => 'Invalid File Formate',
                    'admin_file.*.mimes' => 'Invalid File Formate',
                    // 'vendor_file.*.max' => 'The file size atleast 5MB',
                    'admin_file.*.max' => 'The file size atleast 5MB',
                ]
            );
        try{
            $message = new InnvoicesMrn();
            $vendor_name = User::where('id',$request->vendor_name)->first();
            
            $message->user_id = $request->vendor_name;
            $message->vendor_name = $vendor_name->vendor_name;
            $message->admin_document = $request->admin_document;
            $message->admin_amount = $request->admin_amount;
            $message->gst_number = $request->gst_number;
            $message->admin_message = $request->admin_message;
            $message->approved_by = $request->approved_by;
            
            if ($request->hasFile('admin_file')) {
                $message->admin_file = $request->file('admin_file')->getClientOriginalName();
                $request->file('admin_file')->move('public/assets/upload/innvoices', $message->admin_file);
            }
            // dd($message);
            $message->save();

            if($message->save()){
                return redirect('innvoice-mrn-detail')->with('success','Data Sent Successfully!');
            }else{
                return redirect('innvoice-mrn-detail')->with('error','Data does not sent!');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function edit_innvoice_message($id){
        try{
            if (session()->has('adminloginId')) {

                $messages = InnvoicesMrn::find($id);
                
                return view('admin.innvoice.edit_innvoice_message', compact('messages'));
                
            } else {
                return redirect('/');
            }
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function update_innvoice_message(Request $request){
        

            $this->validate(
                $request,
                [
                    'vendor_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                    'admin_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                    'admin_message' => 'required',
                    'admin_amount' => 'required|numeric',
                    'admin_document' =>'required|numeric',
                    'vendor_amount' => 'required|numeric',
                    'vendor_document' =>'required|numeric',
                ],
                [
                    'vendor_file.*.mimes' => 'Invalid File Formate',
                    'admin_file.*.mimes' => 'Invalid File Formate',
                    'vendor_file.*.max' => 'The file size atleast 5MB',
                    'admin_file.*.max' => 'The file size atleast 5MB',
                ]
            );
        try{
    
            $data = InnvoicesMrn::where('id', $request->id)->first();
            // dd($data);
            $data->vendor_message = $request->vendor_message;
            $data->vendor_name = $request->vendor_name;
            $data->vendor_document = $request->vendor_document;
            $data->vendor_amount = $request->vendor_amount;
    
    
            if ($request->hasFile('vendor_file')) {
                $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
                $request->file('vendor_file')->move('public/assets/upload/innvoices', $data->vendor_file);
            }
            if ($request->hasFile('admin_file')) {
                $data->admin_file = $request->file('admin_file')->getClientOriginalName();
                $request->file('admin_file')->move('public/assets/upload/innvoices', $data->admin_file);
            }
            if ($request->hasFile('existing_vendor_file') || $request->hasFile('existing_vendor_file')) {
                // Retain the existing file path
                $data->vendor_file = $request->input('existing_vendor_file');
    
                // Retain the existing file path
                $data->admin_file = $request->input('existing_admin_file');
            }
    
            $data->admin_message = $request->admin_message;
            $data->admin_document = $request->admin_document;
            $data->admin_amount = $request->admin_amount;
    
            $data->status = 'Aligned';
            $data->approved_by = $request->approved_by;
            // dd($data);
            $result = $data->save();
            if ($result) {
                return redirect('innvoice-mrn-detail')->with('success', 'Data Sent Successfully!');
            } else {
                return redirect('innvoice-mrn-detail')->with('error', 'Data does not sent');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function delete_innvoice_mrn_reply(Request $request){
        
        // Validate that the selected_ids array is provided
        $request->validate([
            'selected_ids' => 'required|array',
        ]);
    
        // Perform the deletion
        InnvoicesMrn::whereIn('id', $request->selected_ids)->delete();
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Selected items have been deleted.');
        
        // $result = InnvoicesMrn::find($id);
        // $result->delete();
        // return redirect('innvoice-mrn-detail')->with('success', 'Delete Innvoice & MRN Detail!!');
    }

     

   // ----------------------------------------------End Innvoices & MRN -----------------------------------






    // ---------------------------------------------- Debit/Credit Note -----------------------------------



    public function show_debit_credit_detail(){
        try{
            if (session()->has('adminloginId')) {

                $messages = DebitCredit::orderBy('created_at', 'desc')->get();
                return view('admin.debit.show_debit_credit_detail', compact('messages'));

            } else {
                return redirect('/');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function debit_credit_message(){
        try{

            if (session()->has('adminloginId')) {

                $admin = session()->get('admin_id');
                $admin = User::where('id',$admin)->first();
               
                $details = User::where('role','!=',1)->where('role','!=',2)->where('status','=','Active')->get();
                // dd($details);
                return view('admin.debit.debit_credit_message',compact('admin','details'));

            } else {
                return redirect('/');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }





    public function add_debit_credit_message(Request $request){
       

            $this->validate(
                $request,
                [
                    'admin_message' => 'required',
                    'vendor_name' => 'required',
                    'admin_document' => 'required|numeric',
                    'admin_amount' => 'required|numeric',
                    'admin_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120'
                ],
                [
                    'vendor_name.*.required' => 'The vendor name must be required.',
                    'admin_file.*.mimes' => 'Invalid File Formate',
                    // 'vendor_file.*.max' => 'The file size atleast 5MB',
                    'admin_file.*.max' => 'The file size atleast 5MB',
                ]
            );
        try{
            $message = new DebitCredit();
            $vendor_name = User::where('id',$request->vendor_name)->first();

            $message->user_id = $request->vendor_name;
            $message->vendor_name = $vendor_name->vendor_name;
             $message->admin_document = $request->admin_document;
            $message->admin_amount = $request->admin_amount;
            $message->gst_number = $request->gst_number;
            $message->admin_message = $request->admin_message;
            $message->approved_by = $request->approved_by;
            
            if ($request->hasFile('admin_file')) {
                $message->admin_file = $request->file('admin_file')->getClientOriginalName();
                $request->file('admin_file')->move('public/assets/upload/debit', $message->admin_file);
            }

            $message->save();

            if($message->save()){
                return redirect('debit-credit-detail')->with('success','Data Sent Successfully!');
            }else{
                return redirect('debit-credit-detail')->with('error','Data does not sent!');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }





    public function edit_debit_credit_message($id){
        try{
            if (session()->has('adminloginId')) {

                $messages = DebitCredit::find($id);
                
                return view('admin.debit.edit_debit_credit_message', compact('messages'));
                
            } else {
                return redirect('/');
            }
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }





    public function update_debit_credit_message(Request $request){
       

            $this->validate(
                $request,
                [
                    'vendor_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                    'admin_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                    'admin_message' => 'required',
                    'admin_amount' => 'required|numeric',
                    'admin_document' =>'required|numeric',
                    'vendor_amount' => 'required|numeric',
                    'vendor_document' =>'required|numeric',
                ],
                [
                    'vendor_file.*.mimes' => 'Invalid File Formate',
                    'admin_file.*.mimes' => 'Invalid File Formate',
                    'vendor_file.*.max' => 'The file size atleast 5MB',
                    'admin_file.*.max' => 'The file size atleast 5MB',
                ]
            );
        try{
            $data = DebitCredit::where('id', $request->id)->first();
            // dd($data);
            $data->vendor_message = $request->vendor_message;
            $data->vendor_name = $request->vendor_name;
            
            $data->vendor_document = $request->vendor_document;
            $data->vendor_amount = $request->vendor_amount;
    
    
            if ($request->hasFile('vendor_file')) {
                $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
                $request->file('vendor_file')->move('public/assets/upload/debit', $data->vendor_file);
            }
            if ($request->hasFile('admin_file')) {
                $data->admin_file = $request->file('admin_file')->getClientOriginalName();
                $request->file('admin_file')->move('public/assets/upload/debit', $data->admin_file);
            }
            if ($request->hasFile('existing_vendor_file') || $request->hasFile('existing_vendor_file')) {
                // Retain the existing file path
                $data->vendor_file = $request->input('existing_vendor_file');
    
                // Retain the existing file path
                $data->admin_file = $request->input('existing_admin_file');
            }
    
            $data->admin_message = $request->admin_message;
            $data->admin_document = $request->admin_document;
            $data->admin_amount = $request->admin_amount;
    
            $data->status = 'Aligned';
            $data->approved_by = $request->approved_by;
            // dd($data);
            $result = $data->save();
            if ($result) {
                return redirect('debit-credit-detail')->with('success', 'Data Sent Successfully!');
            } else {
                return redirect('debit-credit-detail')->with('error', 'Data does not sent');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }



    public function delete_debit_credit_reply(Request $request){
        
        // Validate that the selected_ids array is provided
        $request->validate([
            'selected_ids' => 'required|array',
        ]);
    
        // Perform the deletion
        DebitCredit::whereIn('id', $request->selected_ids)->delete();
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Selected items have been deleted.');
        
       
    }


    // ----------------------------------------------End Debit/Credit Note -----------------------------------





    // ---------------------------------------------- Payment Follow-Up -----------------------------------


    public function show_payment_follow_detail(){
        try{

            if (session()->has('adminloginId')) {

                $messages = PaymentFollow::orderBy('created_at', 'desc')->get();
                return view('admin.payment.show_payment_follow_detail', compact('messages'));

            } else {
                return redirect('/');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }



    public function payment_follow_message(){
        try{

            if (session()->has('adminloginId')) {

                $admin = session()->get('admin_id');
                $admin = User::where('id',$admin)->first();
               
                $details = User::where('role','!=',1)->where('role','!=',2)->where('status','=','Active')->get();
                // dd($details);
                return view('admin.payment.payment_follow_message',compact('admin','details'));

            } else {
                return redirect('/');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function add_payment_follow_message(Request $request){
        

            $this->validate(
                $request,
                [
                    'admin_message' => 'required',
                    'vendor_name' => 'required',
                    'subject' => 'nullable',
                    'admin_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120'
                ],
                [
                    // 'vendor_file.*.mimes' => 'Invalid File Formate',
                    'admin_file.*.mimes' => 'Invalid File Formate',
                    // 'vendor_file.*.max' => 'The file size atleast 5MB',
                    'admin_file.*.max' => 'The file size atleast 5MB',
                ]
            );
        try{

            $message = new PaymentFollow();
            $vendor_name = User::where('id',$request->vendor_name)->first();

            $message->user_id = $request->vendor_name;
            $message->vendor_name = $vendor_name->vendor_name;
            $message->subject = $request->subject;
            $message->gst_number = $request->gst_number;
            $message->admin_message = $request->admin_message;
            $message->approved_by = $request->approved_by;
            
            if ($request->hasFile('admin_file')) {
                $message->admin_file = $request->file('admin_file')->getClientOriginalName();
                $request->file('admin_file')->move('public/assets/upload/payment', $message->admin_file);
            }

            $message->save();

            if($message->save()){
                return redirect('payment-follow-detail')->with('success','Data Sent Successfully!');
            }else{
                return redirect('payment-follow-detail')->with('error','Data does not sent!');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function edit_payment_follow_message($id){
        try{
            if (session()->has('adminloginId')) {

                $messages = PaymentFollow::find($id);
                
                return view('admin.payment.edit_payment_follow_message', compact('messages'));
                
            } else {
                return redirect('/');
            }
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function update_payment_follow_message(Request $request){
        

            $this->validate(
                $request,
                [
                    'vendor_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                    'admin_file' => 'nullable|mimes:pdf,png,jpg,zip,xls,xlsx|max:5120',
                    'admin_message' => 'required',
                ],
                [
                    'vendor_file.*.mimes' => 'Invalid File Formate',
                    'admin_file.*.mimes' => 'Invalid File Formate',
                    'vendor_file.*.max' => 'The file size atleast 5MB',
                    'admin_file.*.max' => 'The file size atleast 5MB',
                ]
            );
        try{
    
            $data = PaymentFollow::where('id', $request->id)->first();
            // dd($data);
            $data->vendor_message = $request->vendor_message;
            $data->vendor_name = $request->vendor_name;
            $data->subject = $request->subject;
    
    
            if ($request->hasFile('vendor_file')) {
                $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
                $request->file('vendor_file')->move('public/assets/upload/payment', $data->vendor_file);
            }
            if ($request->hasFile('admin_file')) {
                $data->admin_file = $request->file('admin_file')->getClientOriginalName();
                $request->file('admin_file')->move('public/assets/upload/payment', $data->admin_file);
            }
            if ($request->hasFile('existing_vendor_file') || $request->hasFile('existing_vendor_file')) {
                // Retain the existing file path
                $data->vendor_file = $request->input('existing_vendor_file');
    
                // Retain the existing file path
                $data->admin_file = $request->input('existing_admin_file');
            }
    
            $data->admin_message = $request->admin_message;
    
            $data->status = 'Replied';
            $data->approved_by = $request->approved_by;
            
            $result = $data->save();
            if ($result) {
                return redirect('payment-follow-detail')->with('success', 'Data Sent Successfully!');
            } else {
                return redirect('payment-follow-detail')->with('error', 'Data does not sent');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }



    public function delete_payment_follow_reply(Request $request){
        
        // Validate that the selected_ids array is provided
        $request->validate([
            'selected_ids' => 'required|array',
        ]);
    
        // Perform the deletion
        PaymentFollow::whereIn('id', $request->selected_ids)->delete();
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Selected items have been deleted.');
      
    }



    // ----------------------------------------------End Payment Follow-Up -----------------------------------





    public function update_vendor_status(Request $request)
    {
        $status = $request->vendor_status;

        if ($status == 'Active') {
            $data = User::where('id', $request->id)->first();
            $data->status = 'Active';

            $data->save();

            return redirect()->back()->with('success', 'Status Update Successfully');
        } else {
            $data = User::where('id', $request->id)->first();
            $data->status = 'De-Active';

            $data->save();
            return redirect()->back()->with('success', 'Status Update Successfully');
        }
    }





    public function update_sku_registration_status(Request $request)
    {
        // Fetch the SkuRegistration record based on the provided ID
        $skuData = SkuRegistration::where('id', $request->id)->first();

        // Fetch the VendorRegistration record based on the provided ID
        $vendorData = VendorRegistration::where('id', $request->id)->first();

        $status = $request->sku_status;

        if ($vendorData) {
            if ($status == 'Replied') {

                $vendorData->status = 'Approved';

                $vendorData->save();
                return redirect('dashboard')->with('success', 'Vendor Status Update Successfully');
            } else {

                $vendorData->status = 'Pending';
                $vendorData->save();
                return redirect('dashboard')->with('success', 'Vendor Status Update Successfully');
            }
        } else {
            if ($status == 'Replied') {

                $skuData->status = 'Approved';
                $skuData->save();

                return redirect('dashboard')->with('success', 'Sku Status Update Successfully');
            } else {

                $skuData->status = 'Pending';
                $skuData->save();

                return redirect('dashboard')->with('success', 'Sku Status Update Successfully');
            }
        }
    }




    public function update_message_status(Request $request)
    {
        $status = $request->status;

        if ($status == 'Replied') {
            $data = RequestReport::where('id', $request->id)->first();
            $data->status = 'Replied';

            $data->save();
            return redirect('all-vendor-registration')->with('success', 'Status Update Successfully');
        } else {
            $data = RequestReport::where('id', $request->id)->first();
            $data->status = 'Pending';

            $data->save();
            return redirect('all-vendor-registration')->with('success', 'Status Update Successfully');
        }
    }










}
