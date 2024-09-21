<?php

use App\Http\Controllers\api\BusBookingController;
use App\Http\Controllers\api\BusPaymentController;
use App\Http\Controllers\api\HotelPaymentController;
use App\Http\Controllers\api\OfferController;
use App\Http\Controllers\api\RegisterController;
use Illuminate\Http\Request;
use App\Http\Controllers\api\HotelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BusController;
use App\Http\Controllers\api\FliteController;
use App\Http\Controllers\api\FPaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('login', [AuthController::class, 'loginuser']);

Route::post('resend-otp', [AuthController::class, 'resent_otp']);


Route::post('user-detail', [RegisterController::class, 'user_detail']);

Route::post('checkotp', [RegisterController::class, 'checkotp']);

Route::post('update-profile', [RegisterController::class, 'update_profile']);
Route::post('update_name', [RegisterController::class, 'update_name']);
Route::post('update_number', [RegisterController::class, 'update_number']);

Route::get('offer', [OfferController::class, 'offer']);
// Route::post('verifyemail',[RegisterController::class,'verifyemail']);

// Route::post('checkotp',[RegisterController::class,'checkotp']);
Route::post('login', [AuthController::class, 'loginuser']);
Route::post('send-otp', [AuthController::class, 'reset_otp']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::post('change_password', [AuthController::class, 'changepassword']);

Route::post('bus_list', [BusBookingController::class, 'bus_list']);
Route::get('bus_list_add', [BusBookingController::class, 'bus_list_add']);
Route::post('BusList', [BusBookingController::class, 'BusList']);

Route::get('bus-list', [BusBookingController::class, 'Bus_List_Api']);


Route::post('searchBus', [BusBookingController::class, 'searchBus']);

Route::get('get_detail', [BusBookingController::class, 'get_detail']);
Route::get('/bus-search-results', [BusBookingController::class, 'index']);
Route::post('searchbus_list', [BusBookingController::class, 'searchbus_list']);
Route::get('get_balace', [BusBookingController::class, 'get_balace']);
Route::post('AddseatLayout', [BusBookingController::class, 'AddseatLayout']);
Route::get('seatLayout', [BusBookingController::class, 'seatLayout']);
Route::get('baordpoint', [BusController::class, 'baordpoint']);
Route::post('addboarding', [BusController::class, 'addboarding']);
Route::post('seat-block', [BusPaymentController::class, 'seat_block']);
Route::post('seat-book', [BusPaymentController::class, 'seat_book']);
Route::post('seat-cancel', [BusController::class, 'seat_cancel']);
Route::post('create-bus-payment', [BusPaymentController::class, 'create_bus_Payment']);
Route::post('update-bus-payment', [BusPaymentController::class, 'update_bus_payment']);
Route::post('bus-payment-history', [BusPaymentController::class, 'bus_payment_history']);



// flightapi      

Route::post('flight-search', [FliteController::class, 'flite_search']);
Route::get('flight-list', [FliteController::class, 'flight_list']);
Route::post('get-calender', [FliteController::class, 'get_calendar_fare']);
Route::post('fare-rule', [FliteController::class, 'fare_rule']);
Route::post('farequote', [FliteController::class, 'fare_quote']);
Route::post('ssr', [FliteController::class, 'ssr']);
Route::post('seatmap', [FliteController::class, 'seatmap']);
Route::post('bookllc', [FliteController::class, 'bookllc']);
Route::post('book-hold', [FliteController::class, 'bookgds']);
Route::post('ticketgds', [FliteController::class, 'ticketgds']);
Route::post('flight-cancel', [FliteController::class, 'flight_cancel']);


// Hotel api
Route::post('tests', [HotelController::class, 'tests']);

Route::post('search-hotel', [HotelController::class, 'search_hotel']);

Route::post('hotel-info', [HotelController::class, 'hotel_info']);

Route::post('hotel-room', [HotelController::class, 'hotel_room']);

Route::post('hotel-block', [HotelController::class, 'hotel_block']);

Route::post('hotel-book', [HotelController::class, 'hotel_book']);

Route::post('hotel-cancel', [HotelController::class, 'hotel_cancel']);

Route::post('create-payment', [HotelPaymentController::class, 'create_Payment']);

Route::post('update-payment', [HotelPaymentController::class, 'update_payment']);
Route::post('hotel-payment-history', [HotelPaymentController::class, 'hotel_payment_history']);



Route::post('create-flight-payment', [FPaymentController::class, 'create_flight_Payment']);

Route::post('update-flight-payment', [FPaymentController::class, 'update_flight_payment']);
Route::post('flight-payment-history', [FPaymentController::class, 'flight_payment_history']);




Route::get('get-faq', [OfferController::class, 'get_faq']);


Route::post('test', [FliteController::class, 'test']);

