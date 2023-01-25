<?php

use App\Http\Controllers\AirportDetailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TickerControler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewBookingController;
use App\Http\Controllers\SearchFlightsController;
use App\Http\Controllers\SeatSelectionController;
use App\Http\Controllers\ConfirmBookingController;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\FinanceController;
use App\Http\Controllers\Dashboard\BalanceController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserController;
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
    Route::post('/getfilterfilghts', [SearchFlightsController::class, 'filterfilghts'])->name('filterfilghts');
    
    Route::any('/SearchFlightss', [SearchFlightsController::class, 'SearchFlights'])->name('SearchFlightss');
    
    Route::any('/getFarePrices', [SearchFlightsController::class, 'getFarePrices'])->name('getFarePrices');

    Route::get('/reviewDetails', [ReviewBookingController::class, 'reviewDetails'])->name('reviewDetails');
    Route::get('/seatSelection', [SeatSelectionController::class, 'seatSelection'])->name('seatSelection');
    Route::post('/passengerDetails', [ReviewBookingController::class, 'passengerDetails'])->name('passengerDetails');
    Route::get('/booking-final', [HomeController::class, 'bookingFinal'])->name('booking-final');

    Route::get('/reviewDetailsRoundTrip', [ReviewBookingController::class, 'reviewDetailsRoundTrip'])->name('reviewDetailsRoundTrip');
    Route::get('/reviewDetailsMultiCity', [ReviewBookingController::class, 'reviewDetailsMultiCity'])->name('reviewDetailsMultiCity');
    
    
    
    // ////////dashboard
//Bookings
Route::prefix('dashboard/')->name('dashboard.')->controller(DashboardController::class)->group(function(){
    Route::get('', 'index')->name('index');
});


Route::prefix('bookings/')->name('bookings.')->controller(BookingController::class)->group(function(){
    Route::get('', 'index')->name('index');
    Route::get('daily','dailybookings')->name('dailybookings');
    Route::get('weekly','weeklybookings')->name('weeklybookings');
    Route::get('monthly','monthlybookings')->name('monthlybookings');
});


Route::prefix('ticket/')->name('tickets.')->controller(TickerControler::class)->group(function(){
    Route::get('', 'index')->name('index');
   
});


//Create User B-B
Route::prefix('create-user/')->name('create.user.')->controller(UserController::class)->group(function(){
    Route::get('', 'index')->name('index');
    Route::post('store-user', 'storeUser')->name('store');
});

//Manage Users
Route::prefix('manage-user/')->name('manage.user.')->controller(UserController::class)->group(function(){
    Route::get('get', 'manage_user')->name('index');
    Route::post('change-visibility-show', 'change_visibility_show')->name('change-visibility-show');
    Route::post('delete-user', 'delete_user')->name('delete-user');
});

//Number Of Users
Route::prefix('number-of-user/')->name('number.of.user.')->controller(UserController::class)->group(function(){
    Route::get('get', 'number_of_users')->name('index');
});



//Finance
Route::prefix('finance/')->name('finance.')->controller(FinanceController::class)->group(function(){
    Route::get('', 'index')->name('index');
    Route::get('daily','dailyamount')->name('dailyamount');
    Route::get('weekly','weeklyamount')->name('weeklyamount');
    Route::get('monthly','monthlyamount')->name('monthlyamount');
});

//Payment Summery
Route::prefix('payment-summery/')->name('paymnet.summery.')->controller(BalanceController::class)->group(function(){
    Route::get('', 'payment_summery')->name('index');
});

//Balance With Users
Route::prefix('balance-with-users/')->name('balance.with.users.')->controller(BalanceController::class)->group(function(){
    Route::get('', 'index')->name('index');
});

//Credit Limit
Route::prefix('credit-limit/')->name('credit.limit.')->controller(BalanceController::class)->group(function(){
    Route::get('', 'credit_limit')->name('index');
});

// //Reports
Route::prefix('reports/')->name('report.')->controller(ReportController::class)->group(function(){
    Route::get('','index')->name('index');
});


// ///////////dashboard

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
Route::any('/proceed_to_pay',[ConfirmBookingController::class, 'proceedToPay'])->name('proceed-to-pay');

//Admin routes
// Route::group(['namespace'=> 'App\Http\Controllers\Admin','prefix' => 'admin'],function(){
    
//     Route::middleware('auth', 'admin.auth')->group(function(){
        
//         Route::get('/','DashboardController@index')->name('admin');
//         Route::get('/dashboard','DashboardController@index')->name('dashboard');
//     });
    
// });


// // USER DASHBOARD
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'user'])->name('dashboard');

// // ADMIN DASHBOARD
// Route::get('/admin_dashboard', function () {
//     return view('admin_dashboard');
// })->middleware(['auth', 'admin'])->name('admin_dashboard');



