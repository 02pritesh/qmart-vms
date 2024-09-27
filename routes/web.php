<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\auth\AdminAuthController;
use App\Http\Controllers\admin\register\VendorRegistration;
use App\Http\Controllers\user\register\VendorRegistrationController;
use App\Http\Controllers\user\auth\RegisterController;
use App\Http\Controllers\user\auth\UserAuthController;
use App\Http\Controllers\user\UserController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ****************************  Admin Dashboard Route *****************************************
// Route::get('/', function () {
//     return "test";
// });

Route::get('admin-logout',[AdminAuthController::class,'admin_logout']);
Route::get('vendor-detail',[AdminAuthController::class,'vendor_detail']);
Route::get('admin-dashboard',[AdminController::class,'home']);
Route::get('dashboard',[AdminController::class,'dashboard']);
Route::get('all-vendor-registration',[AdminController::class,'show_all_registration']);


Route::get('add-sub-admin',[AdminAuthController::class,'add_sub_admin']);
Route::post('add-sub-admin',[AdminAuthController::class,'register_sub_admin']);


Route::get('edit-vendor-detail/{id}',[AdminController::class,'edit_vendor_detail']);
Route::post('edit-vendor-detail',[AdminController::class,'update_vendor_detail']);


Route::get('registration-detail',[AdminController::class,'show_registration']);
Route::get('vendor-registration-detail',[AdminController::class,'vendor_registration_detail']);
Route::post('delete-vendor-registration-detail',[AdminController::class,'delete_vendor_registration_detail'])->name('delete-vendor-registration-detail');
Route::get('edit-vendor-registration-detail/{id}',[AdminController::class,'edit_vendor_registration_detail']);
Route::post('edit-vendor-registration-detail',[AdminController::class,'update_vendor_registration_detail']);
Route::get('edit-sku-registration-detail/{id}',[AdminController::class,'edit_sku_registration_detail']);
Route::post('edit-sku-registration-detail',[AdminController::class,'update_sku_registration_detail']);
Route::get('edit-request-report/{id}',[AdminController::class,'edit_request_report']);
Route::post('edit-request-report',[AdminController::class,'update_request_report']);
Route::get('view-sku-vendor-entity-detail/{id}',[AdminController::class,'view_sku_vendor_entity_detail']);
Route::post('delete-sku-vendor-entity-detail',[AdminController::class,'delete_sku_vendor_entity_detail'])->name('delete-sku-vendor-entity-detail');


// *********** this route for change status of vendor eighter activate or deactivate ***************
Route::post('update-vendor-status',[AdminController::class,'update_vendor_status']);
Route::post('update-sku-registration-status',[AdminController::class,'update_sku_registration_status']);
Route::post('update-message-status',[AdminController::class,'update_message_status']);


// -----------------------------------------------------------------------------------------------


Route::get('request-report-detail',[AdminController::class,'show_request_report_detail']);
Route::get('admin-reply/{id}',[AdminController::class,'admin_message_reply']);
Route::post('admin-reply',[AdminController::class,'sent_admin_message']);
Route::post('delete-vendor-reply',[AdminController::class,'delete_vendor_reply'])->name('delete-vendor-reply');



// ------------------------------------------Innvoices & MRN ---------------------------------------------

Route::get('innvoice-mrn-detail',[AdminController::class,'show_innvoice_mrn_detail']);
Route::get('innvoice-message',[AdminController::class,'innvoice_message']);
Route::post('innvoice-message',[AdminController::class,'add_innvoice_message']);
Route::get('edit-innvoice-message/{id}',[AdminController::class,'edit_innvoice_message']);
Route::post('edit-innvoice-message',[AdminController::class,'update_innvoice_message']);
Route::post('delete-innvoice-mrn-reply',[AdminController::class,'delete_innvoice_mrn_reply'])->name('delete-innvoice-mrn-reply');

Route::get('/get-gstin',[AdminController::class,'get_gstin']);

// ----------------------------------------- End Innvoices & MRN -------------------------------------------





// ------------------------------------------- Debit/Credit Note -------------------------------------------

Route::get('debit-credit-detail',[AdminController::class,'show_debit_credit_detail']);
Route::get('debit-credit-message',[AdminController::class,'debit_credit_message']);
Route::post('debit-credit-message',[AdminController::class,'add_debit_credit_message']);
Route::get('edit-debit-credit-message/{id}',[AdminController::class,'edit_debit_credit_message']);
Route::post('edit-debit-credit-message',[AdminController::class,'update_debit_credit_message']);
Route::post('delete-debit-credit-reply',[AdminController::class,'delete_debit_credit_reply'])->name('delete-debit-credit-reply');

// ------------------------------------------- Payment Follow-Up -------------------------------------------

Route::get('payment-follow-detail',[AdminController::class,'show_payment_follow_detail']);
Route::get('payment-follow-message',[AdminController::class,'payment_follow_message']);
Route::post('payment-follow-message',[AdminController::class,'add_payment_follow_message']);
Route::get('edit-payment-follow-message/{id}',[AdminController::class,'edit_payment_follow_message']);
Route::post('edit-payment-follow-message',[AdminController::class,'update_payment_follow_message']);
Route::post('delete-payment-follow-reply',[AdminController::class,'delete_payment_follow_reply'])->name('delete-payment-follow-reply');





// ------------------------------------------- End Payment Follow-Up -------------------------------------------










// ****************************  User Dashboard Route *****************************************

Route::get('/',[UserAuthController::class,'login']);
Route::get('forgot-password',[UserAuthController::class,'forgot_password']);
Route::post('/send-otp', [UserAuthController::class, 'sendEmailOtp']);
Route::get('reset-password',[UserAuthController::class,'reset_password']);
Route::post('/reset-password', [UserAuthController::class, 'resetPassword']);


Route::post('user-login', [UserAuthController::class,'user_login']);
Route::get('logout',[UserAuthController::class,'logout']);
Route::get('user-dashboard',[UserController::class,'user_dashboard']);

Route::get('register',[RegisterController::class,'register']);
Route::post('register',[RegisterController::class,'add_user']);
Route::get('edit-user-registration',[RegisterController::class,'edit_user_registration']);
Route::post('update-user-registration',[RegisterController::class,'update_user_registration']);

Route::get('vendor-registration',[VendorRegistrationController::class,'vendor_registration']);
Route::post('add-vendor-registration',[VendorRegistrationController::class,'add_vendor_registration']);

// Route::get('dashboard',[UserController::class,'dashboard']);
Route::get('sku-registration',[UserController::class,'sku_registration']);
Route::post('sku-registration',[UserController::class,'add_sku_registration']);

Route::post('edit-sku-registration',[UserController::class,'edit_sku_registration']);


Route::get('request-report',[UserController::class,'request_report']);
Route::post('request-report',[UserController::class,'add_request_report']);

Route::post('edit-request-report',[UserController::class,'edit_request_report']);


Route::get('show-request-report',[UserController::class,'show_request_report']);
Route::get('show-vendor-registration/{id}',[UserController::class,'show_vendor_registration']);
Route::get('show-sku-registration/{id}',[UserController::class,'show_sku_registration']);
Route::get('show-sku-entity/{id}',[UserController::class,'show_sku_entity']);
Route::get('show-request-report/{id}',[UserController::class,'show_request_report_message']);

// Route::get('message-list',[UserController::class,'message_list']);

Route::get('vendor-show-vendor-registration-detail',[UserController::class,'vendor_show_vendor_registration_detail']);
Route::get('vendor-show-sku-registration-detail',[UserController::class,'vendor_show_sku_registration_detail']);
Route::get('vendor-show-view-sku-vendor-entity-detail/{id}',[UserController::class,'vendor_show_view_sku_vendor_entity_detail']);
Route::get('vendor-show-request-report-registration-detail',[UserController::class,'vendor_show_request_report_registration_detail']);
Route::get('vendor-show-message/{id}',[UserController::class,'vendor_show_message']);


// ----------------------------------- Innvoice and MRN --------------------------------------

Route::get('innvoices-mrn',[UserController::class,'innvoices_mrn']);
Route::post('innvoices-mrn',[UserController::class,'add_innvoices_mrn']);

Route::get('vendor-show-innvoices-detail',[UserController::class,'vendor_show_innvoices_detail']);
Route::get('vendor-show-innvoices-message/{id}',[UserController::class,'vendor_show_innvoices_message']);

Route::post('edit-innvoices-mrn',[UserController::class,'edit_innvoices_mrn']);

Route::post('vendor-innvoice-reply',[UserController::class,'vendor_innvoice_reply']);


// ------------------------------------ End Innvoice and MRN -----------------------------------





// ------------------------------------ Debit/Credit Note -------------------------------------

Route::get('debit-credit',[UserController::class,'debit_credit']);
Route::post('debit-credit',[UserController::class,'add_debit_credit_detail']);
Route::get('vendor-show-credit-detail',[UserController::class,'vendor_show_credit_detail']);
Route::get('vendor-show-credit-message/{id}',[UserController::class,'vendor_show_credit_message']);

Route::post('edit-debit-note',[UserController::class,'edit_debit_note']);

Route::post('vendor-debit-reply',[UserController::class,'vendor_debit_reply']);


// ------------------------------------ End Debit/Credit Note -----------------------------------





// ------------------------------------ Payment Follow-up ---------------------------------------

Route::get('payment-follow',[UserController::class,'payment_follow']);
Route::post('payment-follow',[UserController::class,'add_payment_follow']);

Route::post('edit-payment-follow',[UserController::class,'edit_payment_follow']);

Route::get('vendor-show-payment-detail',[UserController::class,'vendor_show_payment_detail']);
Route::get('vendor-show-payment-message/{id}',[UserController::class,'vendor_show_payment_message']);

Route::post('vendor-payment-follow-reply',[UserController::class,'vendor_payment_follow_reply']);







