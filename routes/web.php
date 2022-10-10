<?php

use App\Http\Controllers\AirportDetailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewBookingController;
use App\Http\Controllers\SearchFlightsController;
use App\Http\Controllers\SeatSelectionController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//site
Route::group(['middleware' => 'auth'],function(){
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/search-flights', [HomeController::class, 'searchFlights'])->name('search-flights');
    Route::any('/SearchFlights', [SearchFlightsController::class, 'SearchFlights'])->name('SearchFlights');
    Route::any('/getFarePrices', [SearchFlightsController::class, 'getFarePrices'])->name('getFarePrices');

    Route::get('/reviewDetails', [ReviewBookingController::class, 'reviewDetails'])->name('reviewDetails');
    Route::get('/seatSelection', [SeatSelectionController::class, 'seatSelection'])->name('seatSelection');
    Route::post('/passengerDetails', [ReviewBookingController::class, 'passengerDetails'])->name('passengerDetails');
    Route::get('/booking-final', [HomeController::class, 'bookingFinal'])->name('booking-final');

    Route::get('/reviewDetailsRoundTrip', [ReviewBookingController::class, 'reviewDetailsRoundTrip'])->name('reviewDetailsRoundTrip');

});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy');
Route::get('/terms-condition', [HomeController::class, 'termsCondition'])->name('terms-conditions');

Route::post('/contact-form', [ContactController::class, 'contactSubmit'])->name('contact-form-submit');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/check-exist-email', [LoginController::class, 'checkEmailExist'])->name('check-exist-email');
Route::post('/check-exist-pwd', [LoginController::class, 'checkPwdExist'])->name('check-exist-pwd');

Route::post('/get-otp',[LoginController::class, 'getOTPNumber'])->name('getOTPNumber');
Route::post('/check-otp',[LoginController::class, 'checkOtpNumber'])->name('checkOtpNumber');
Route::any('/forgot-pwd', [LoginController::class, 'forgotPassword'])->name('forgot-pwd');

Route::any('/get-airports', [AirportDetailController::class, 'getAirports'])->name('get-airports');
