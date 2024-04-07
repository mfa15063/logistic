<?php

use App\Http\Controllers\API\orderController;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\utellityController;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// utellities routes
Route::get('admin/contect-details', [utellityController::class, 'getAdminContactDetails']);

Route::post('register', [userController::class, 'register']);
Route::post('login', [userController::class, 'authenticate']);

Route::post('forget-password', [userController::class, 'forgetPassword']);
Route::post('verify-otp',   [userController::class, 'verifyOtp']);
Route::post('change-password', [userController::class, 'changePasswordOTP']);
Route::get('order/by-id', [orderController::class, 'orderById']);
// get inqueries
Route::get('inqueries', [GeneralController::class, 'getListOfInquery']);
// protected routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('profile', [userController::class, 'profile']);
    Route::post('profile-update', [userController::class, 'profileUpdate']);
    Route::post('change-password', [userController::class, 'changePassword']);
    Route::post('order/store', [orderController::class, 'store']);
    Route::get('order/my', [orderController::class, 'myOrder']);
    Route::post('logout', [userController::class, 'logout']);
});
