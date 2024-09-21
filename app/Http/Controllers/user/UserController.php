<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\DebitCredit;
use App\Models\InnvoicesMrn;
use App\Models\PaymentFollow;
use App\Models\RequestReport;
use App\Models\SkuRegistration;
use App\Models\VendorRegistration;
use App\Models\User;
use App\Models\SkuVendorEntityNameDetail;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validate;
use Mockery\Expectation;

class UserController extends Controller
{


    public function sku_registration()
    {
        if (session()->has('userloginId')) {

            try {
                $userloginId = session()->get('vendor_id');
                $vendor = User::where('id', $userloginId)->first();

                return view('user.sku_registration', compact('vendor'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }




    public function user_dashboard()
    {
        if (session()->has('userloginId')) {

            try {
                $id = session()->get('vendor_id');
                $users = VendorRegistration::where('user_id', $id)->get();
                $skuRegistrations = SkuRegistration::where('user_id', $id)->get();
                $requestReports = RequestReport::where('user_id', $id)->get();
                $innvoices = InnvoicesMrn::where('user_id', $id)->get();
                $debits = DebitCredit::where('user_id', $id)->get();
                $payments = PaymentFollow::where('user_id', $id)->get();

                $users = $users->sortByDesc('updated_at');
                $skuRegistrations = $skuRegistrations->sortByDesc('updated_at');
                $requestReports = $requestReports->sortByDesc('updated_at');
                $innvoices = $innvoices->sortByDesc('updated_at');
                $debits = $debits->sortByDesc('updated_at');
                $payments = $payments->sortByDesc('updated_at');

                return view('user.user_dashboard', compact('users', 'skuRegistrations', 'requestReports','innvoices','debits','payments'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }







    public function add_sku_registration(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required',
            'product_name' => 'required|string',
            'category' => 'required|string',
            'case_qty' => 'required|numeric',
            'EAN_Code' => 'required|string|max:13',
            'shelf_life' => 'required|string',

            'gst_percentage' => 'required|numeric',
            'margin_percentage' => 'required|numeric',
            'mrp' => 'required|numeric',
            'rtv' => 'required',
            'unit' => 'required',
            'HSN_Code' => 'required|digits_between:6,8',
            // 'CGST_Code' => 'required',
            // 'SGST_Code' => 'required',
            // 'IGST_Code' => 'required',
            'cess_percentage' => 'nullable|numeric',
            'additional_cess' => 'nullable|numeric',

        ], [
            'EAN_Code.*.required' => 'The EAN Code field is required.',
            'EAN_Code.*.regex' => 'The EAN Code must be exactly 13 alphanumeric characters.',
            'EAN_Code.*.max' => 'The EAN Code can be less than 13 characters',
            'product_name.*.required' => 'The Product Name field is required.',
            'category.*.required' => 'The Category field is required.',
            'case_qty.*.required' => 'The Case Quantity field is required.',
            'case_qty.*.numeric' => 'The Case Quantity must be a number.',
            'shelf_life.*.required' => 'The Shelf Life field is required.',
            'HSN_Code.*required' => 'The HSN Code field is required.',
            // 'CGST_Code.*required' => 'The HSN Code field is required.',
            // 'SGST_Code.*required' => 'The HSN Code field is required.',
            // 'IGST_Code.*required' => 'The HSN Code field is required.',
            'cess_percentage.*required' => 'The HSN Code field is required.',
            'additional_cess.*required' => 'The HSN Code field is required.',
            'HSN_Code.*.numeric' => 'The HSN Code must be a numeric value.',
            'HSN_Code.*.digits_between' => 'HSN Code must be between 6 and 8 digits for each entry.',
            // 'HSN_Code.*.min' => 'The HSN Code must be atleast 6 digits.',
            // 'HSN_Code.*.max' => 'The HSN Code must be atmost 8 digits.',
            'gst_percentage.*.required' => 'The GST Percentage field is required.',
            'gst_percentage.*.numeric' => 'The GST Percentage must be a numeric value.',
            'margin_percentage.*.required' => 'The Margin Percentage field is required.',
            'margin_percentage.*.numeric' => 'The Margin Percentage must be a numeric value.',
            'mrp.*.required' => 'The MRP field is required.',
            'mrp.*.numeric' => 'The MRP must be a numeric value.',
            'rtv.*.required' => 'The RTV field is required.',
            'unit.*.required' => 'The Unit field is required.',
        ]);



        try {
            $data = new SkuRegistration();
            $data->subject = $request->brand;
            $data->user_id = session()->get('vendor_id');
            $data->vendor_name = $request->vendor_name;
            $data->description = 'Sku Registration';

            $vendor = session()->get('vendor_id');
            $vendor = User::where('id', $vendor)->first();
            $gstin = $vendor->gstin;

            $data->gst_number = $gstin;
            $data->product_name = $request->product_name;
            $data->category = $request->category;
            $data->rtv = $request->rtv;
            $data->unit = $request->unit;
            $data->case_qty = $request->case_qty;
            $data->EAN_Code = $request->EAN_Code;
            $data->shelf_life = $request->shelf_life;
            $data->HSN_Code = $request->HSN_Code;
            // $data->CGST_Code = $request->CGST_Code;
            // $data->SGST_Code = $request->SGST_Code;
            // $data->IGST_Code = $request->IGST_Code;
            $data->cess_percentage = $request->cess_percentage;
            $data->cess = $request->cess;
            $data->additional_cess = $request->additional_cess;
            $data->gst_percentage = $request->gst_percentage;
            $data->margin_percentage = $request->margin_percentage;
            $data->mrp = $request->mrp;
            $data->margin = $request->margin;
            $data->landing_price = $request->landing_price;
            $data->gst_price = $request->gst_price;
            $data->basic_cost = $request->basic_cost;
            $data->sku_remark = $request->sku_remark;

            $data->save();

            return redirect("vendor-show-sku-registration-detail")->with("success", "Sku Details submitted successfully!");
        } catch (Exception $exception) {
            // Extract the relevant part of the error message
            $errorMessage = $exception->getMessage();
            $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

            return redirect('vendor-show-sku-registration-detail')->with('error', 'An error occurred: ' . $shortMessage);
        }
    }




    public function request_report()
    {
        if (session()->has('userloginId')) {

            try {
                $userloginId = session()->get('vendor_id');
                $vendor = User::where('id', $userloginId)->first();
                return view('user.request_report', compact('vendor'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }






    public function vendor_show_vendor_registration_detail()
    {
        if (session()->has('userloginId')) {

            try {
                $id = session()->get('vendor_id');

                // Fetch the vendor details using the vendor ID from the session
                $vendorDetail = VendorRegistration::where('user_id', $id)->get()->sortByDesc('created_at');

                // Return the view with the vendor details
                return view('user.vendor_show_vendor_registration', compact('vendorDetail'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }



    


    public function vendor_show_sku_registration_detail()
    {
        if (session()->has('userloginId')) {

            try {
                $id = session()->get('vendor_id');
                $registration = SkuRegistration::where('user_id', $id)->get()->sortByDesc('created_at');
               
                return view('user.vendor_show_sku_registration', compact('registration'));

            } catch (Exception $exception) {

                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }





    public function vendor_show_view_sku_vendor_entity_detail($id)
    {
        if (session()->has('userloginId')) {

            try {
                $skuProducts = SkuVendorEntityNameDetail::where('sku_registration_id', $id)->get()->sortByDesc('created_at');
                $sku = SkuRegistration::find($id);

                return view('user.vendor_show_view_sku_vendor_entity_detail', compact('skuProducts', 'sku'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }




    public function vendor_show_request_report_registration_detail()
    {
        if (session()->has('userloginId')) {

            try {

                $id = session()->get('vendor_id');
                $messages = RequestReport::where('user_id', $id)->get()->sortByDesc('created_at');
                return view('user.vendor_show_request_report', compact('messages'));

            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }





    public function vendor_show_message($id)
    {
        if (session()->has('userloginId')) {
            try {
                $messages = RequestReport::find($id);
                return view('user.vendor_show_message', compact('messages'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }



    public function add_request_report(Request $request)
    {
        $this->validate($request, [
            'vendor_file' => 'nullable|mimes:pdf,png,jpg,xlsx,xls,zip|max:5120',
            'subject' => 'nullable',
            'vendor_message' => 'required'

        ], [
            'vendor_file' => 'Invalide File Formate'
        ]);

        try {

            $data = new RequestReport();

            $data->user_id = session()->get('vendor_id');
            $data->subject = $request->subject;
            $data->vendor_name = $request->vendor_name;
            $data->vendor_message = $request->vendor_message;
            $data->description = 'Request Report';

            $vendor = session()->get('vendor_id');
            $vendor = User::where('id', $vendor)->first();
            $gstin = $vendor->gstin;

            $data->gst_number = $gstin;

            if ($request->has('vendor_file')) {
                $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
                $request->file('vendor_file')->move('public/assets/upload/', $data->vendor_file);
            }

            // dd($data);
            $result = $data->save();
            if ($result) {
                return redirect('vendor-show-request-report-registration-detail')->with('success', 'Message Sent Successfully!!');
            } else {
                return redirect('vendor-show-request-report-registration-detail')->with('error', 'Message doest not sent');
            }
        } catch (Exception $exception) {
            // Extract the relevant part of the error message
            $errorMessage = $exception->getMessage();
            $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

            return redirect('vendor-show-request-report-registration-detail')->with('error', 'An error occurred: ' . $shortMessage);
        }
    }







    public function show_request_report()
    {
        if (session()->has('userloginId')) {

            try {
                $id = session()->get('vendor_id');
                $messages = RequestReport::where('user_id', $id)->get()->sortByDesc('created_at');
                return view('user.show_request_report', compact('messages'));
            } catch (Exception $exception) {

                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }


    public function show_vendor_registration($id)
    {
        if (session()->has('userloginId')) {

            try {
                $vendorDetail = VendorRegistration::find($id);
                // dd($vendorDetail);
                // dd($messages);
                return view('user.show_vendor_registration', compact('vendorDetail'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }

    public function show_sku_registration($id)
    {
        if (session()->has('userloginId')) {

            try {
                $skuDetail = SkuRegistration::find($id);
               
                // dd($messages);
                return view('user.show_sku_registration', compact('skuDetail'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }



    public function show_request_report_message($id)
    {
        if (session()->has('userloginId')) {

            try {
                $messages = RequestReport::where('id', $id)->get();
                return view('user.show_request_report_message', compact('messages'));
            } catch (Exception $exception) {
                // Extract the relevant part of the error message
                $errorMessage = $exception->getMessage();
                $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

                return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
            }
        } else {
            return redirect('/');
        }
    }




    // ------------------------------------- Innvoices & MRN -------------------------------------


    
    public function innvoices_mrn(){
        try{

            if(session()->has('userloginId')){

                $userloginId = session()->get('vendor_id');
                $vendor = User::where('id', $userloginId)->first();
                return view('user.innvoices.innvoices_mrn',compact('vendor'));

            }else{
                return redirect('/');
            }

        }catch(Exception $exception){
            $errorMessage = $exception->getMessage();
            $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

            return redirect()->back()->with('error', 'An error occurred: ' . $shortMessage);
        }
    }





    public function add_innvoices_mrn(Request $request){
        try {
                $this->validate($request, [
                'vendor_file' => 'nullable|mimes:pdf,png,jpg,xlsx,xls,zip|max:5120',
                'subject' => 'nullable',
                'vendor_message' => 'required'

                ], [
                    'vendor_file.*.mimes' => 'Invalide File Formate',
                    'vendor_file.*.max' => 'The vendor file size be less than 5MB'
                ]);

        
            $data = new InnvoicesMrn();

            $data->user_id = session()->get('vendor_id');
            $data->subject = $request->subject;
            $data->vendor_name = $request->vendor_name;
            $data->vendor_message = $request->vendor_message;
           

            $vendor = session()->get('vendor_id');
            $vendor = User::where('id', $vendor)->first();
            $gstin = $vendor->gstin;

            $data->gst_number = $gstin;

            if ($request->has('vendor_file')) {
                $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
                $request->file('vendor_file')->move('public/assets/upload/innvoices', $data->vendor_file);
            }

            // dd($data);
            $result = $data->save();
            if ($result) {
                return redirect('vendor-show-innvoices-detail')->with('success', 'Message Sent Successfully!!');
            } else {
                return redirect('vendor-show-innvoices-detail')->with('error', 'Message doest not sent');
            }
        } catch (Exception $exception) {
            // Extract the relevant part of the error message
            $errorMessage = $exception->getMessage();
            $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('

            return redirect('vendor-show-request-report-registration-detail')->with('error', 'An error occurred: ' . $shortMessage);
        }
    }







    public function vendor_show_innvoices_detail(){
        try{

            if(session()->has('userloginId')){
                $id = session()->get('vendor_id');
                $messages = InnvoicesMrn::where('user_id', $id)->get()->sortByDesc('created_at');
                return view('user.innvoices.vendor_show_innvoices_detail', compact('messages'));
            }else{
                return redirect('/');
            }
            
            

        }catch(Exception $exception){

             // Extract the relevant part of the error message
             $errorMessage = $exception->getMessage();
             $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('
 
             return redirect('vendor-show-innvoices-detail')->with('error', 'An error occurred: ' . $shortMessage);
        }
    }

    


    public function vendor_show_innvoices_message($id){
        try{

            if(session()->has('vendor_id')){

                $messages = InnvoicesMrn::find($id);
                return view('user.innvoices.vendor_show_innvoices_message',compact('messages'));

            }else{
                return redirect('/');
            }
        }catch(Exception $exception){
             // Extract the relevant part of the error message
             $errorMessage = $exception->getMessage();
             $shortMessage = strtok($errorMessage, '('); // This will truncate the message at the first '('
 
             return redirect('vendor-show-innvoices-detail')->with('error', 'An error occurred: ' . $shortMessage);
        }
    }

// -----------------------------------------End Innvoices MRN ------------------------------------





// --------------------------------------- Debit/Credit Note ------------------------------------

    public function debit_credit(){
        try{

            if(session()->has('userloginId')){

                $userloginId = session()->get('vendor_id');
                $vendor = User::where('id', $userloginId)->first();

                return view('user.debit.debit_credit',compact('vendor'));

            }else{
                return  redirect('/');
            }
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured '.$sortmessage);
        }
    }



    public  function add_debit_credit_detail(Request $request){
        try{
            $this->validate($request, [
                'vendor_file' => 'nullable|mimes:pdf,png,jpg,xlsx,xls,zip|max:5120',
                'subject' => 'nullable',
                'vendor_message' => 'required'

                ], [
                    'vendor_file.*.mimes' => 'Invalide File Formate',
                    'vendor_file.*.max' => 'The vendor file size be less than 5MB'
                ]);

        
            $data = new DebitCredit();

            $data->user_id = session()->get('vendor_id');
            $data->subject = $request->subject;
            $data->vendor_name = $request->vendor_name;
            $data->vendor_message = $request->vendor_message;
           

            $vendor = session()->get('vendor_id');
            $vendor = User::where('id', $vendor)->first();
            $gstin = $vendor->gstin;

            $data->gst_number = $gstin;

            if ($request->has('vendor_file')) {
                $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
                $request->file('vendor_file')->move('public/assets/upload/debit', $data->vendor_file);
            }

            // dd($data);
            $result = $data->save();
            if ($result) {
                return redirect('vendor-show-credit-detail')->with('success', 'Message Sent Successfully!!');
            } else {
                return redirect('vendor-show-credit-detail')->with('error', 'Message doest not sent');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function  vendor_show_credit_detail(){
        try{
            if(session()->has('userloginId')){

                $id = session()->get('vendor_id');
                $messages = DebitCredit::where('user_id', $id)->get();
                $messages = $messages->sortByDesc('created_at');
                return view('user.debit.vendor_show_credit_details',compact('messages'));

            }else{
                return redirect('/');
            }

        }catch(Exception $exception){

            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function  vendor_show_credit_message($id){
        try{
            if(session()->has('vendor_id')){

                $messages = DebitCredit::find($id);
               
                return view('user.debit.vendor_show_credit_message',compact('messages'));

            }else{
                return redirect('/');
            }
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }


    // ----------------------------------------End Debit/Credit Note ----------------------------






// ----------------------------------------- Payment Follow-up -------------------------------


    public  function payment_follow(){
        try{

            if(session()->has('userloginId')){

                $userloginId = session()->get('vendor_id');
                $vendor = User::where('id', $userloginId)->first();

                return view('user.payment.payment_follow',compact('vendor'));

            }else{

                return redirect('/');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');
            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }




    public function add_payment_follow(Request $request){
        try{
            $this->validate($request, [
                'vendor_file' => 'nullable|mimes:pdf,png,jpg,xlsx,xls,zip|max:5120',
                'subject' => 'nullable',
                'vendor_message' => 'required'

                ], [
                    'vendor_file.*.mimes' => 'Invalide File Formate',
                    'vendor_file.*.max' => 'The vendor file size be less than 5MB'
                ]);

        
            $data = new PaymentFollow();

            $data->user_id = session()->get('vendor_id');
            $data->subject = $request->subject;
            $data->vendor_name = $request->vendor_name;
            $data->vendor_message = $request->vendor_message;
           

            $vendor = session()->get('vendor_id');
            $vendor = User::where('id', $vendor)->first();
            $gstin = $vendor->gstin;

            $data->gst_number = $gstin;

            if ($request->has('vendor_file')) {
                $data->vendor_file = $request->file('vendor_file')->getClientOriginalName();
                $request->file('vendor_file')->move('public/assets/upload/payment', $data->vendor_file);
            }

            // dd($data);
            $result = $data->save();
            if ($result) {
                return redirect('vendor-show-payment-detail')->with('success', 'Message Sent Successfully!!');
            } else {
                return redirect('vendor-show-payment-detail')->with('error', 'Message doest not sent');
            }

        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }
    




    public function vendor_show_payment_detail(){
        try{

            if(session()->has('userloginId')){

                $id = session()->get('vendor_id');
                $messages = PaymentFollow::where('user_id', $id)->get();
                $messages = $messages->sortByDesc('created_at');
                return view('user.payment.vendor_show_payment_details',compact('messages'));

            }else{
                return redirect('/');
            }

        }catch(Exception $exception){
            
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }






    public function vendor_show_payment_message($id){
        try{
            if(session()->has('vendor_id')){

                $messages = PaymentFollow::find($id);
               
                return view('user.payment.vendor_show_payment_message',compact('messages'));

            }else{
                return redirect('/');
            }
        }catch(Exception $exception){
            $message = $exception->getMessage();
            $sortmessage = strtok($message,'(');

            return redirect()->back()->with('error','An error occured: '.$sortmessage);
        }
    }

}
