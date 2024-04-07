<?php

use App\Http\Controllers\Admin\clientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\orderController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.auth.login');
// })->name('login');

Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login/auth', [UserController::class, 'authenticate'])->name('login.auth');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/profile', function () {
        return view('admin.auth.profile');
    })->name('profile');

    Route::post('/profile/update',      [UserController::class, 'profile'])->name('profile.update');
    Route::post('/change/password',     [UserController::class, 'changePassword'])->name('password.change');
    Route::get('/edit/site_setting',    [UserController::class, 'edit_site_setting'])->name('site_setting.edit');
    Route::post('/update/site_setting', [UserController::class, 'update_site_setting'])->name('site_setting.update');
    Route::get('/contact-us',    [GeneralController::class, 'contactUs'])->name('contact_us');
    Route::delete('/contact-us/{id}',    [GeneralController::class, 'deleteContactUs'])->name('contact_us.delete');

    Route::get('/order/create', [orderController::class, 'create'])->name('order.create');
    Route::get('/order', [orderController::class, 'index'])->name('order.index');
    Route::get('/order/new', [orderController::class, 'allNew'])->name('order.allNew');
    Route::get('/order/rejected', [orderController::class, 'allrejected'])->name('order.allrejected');
    Route::get('/order/underprocessing', [orderController::class, 'allPanding'])->name('order.allPanding');
    Route::get('/order/delivered', [orderController::class, 'allDelivered'])->name('order.allDelivered');
    Route::post('/order/store', [orderController::class, 'store'])->name('order.store');
    Route::match(['get','post'],'/order/approved/{type}/{id}', [orderController::class, 'updateApproved'])->name('order.updateApproved');
    Route::get('/order/delivered/{id}', [orderController::class, 'updateDelivered'])->name('order.updateDelivered');
    Route::delete('/order/{id}', [orderController::class, 'delete'])->name('order.delete');
    Route::get('/order/edit/{id}', [orderController::class, 'edit'])->name('order.edit');
    Route::match(['put','patch'],'/order/update/{id}', [orderController::class, 'update'])->name('order.update');
    Route::match(['put','patch'],'/order/update/status/{id}', [orderController::class, 'update_status'])->name('order.update_status');

    Route::get('/client', [clientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [clientController::class, 'create'])->name('client.create');
    Route::post('/client/store', [clientController::class, 'store'])->name('client.store');
    Route::get('/client/edit/{id}', [clientController::class, 'edit'])->name('client.edit');
    Route::match(['put', 'patch'], '/client/update/{id}', [clientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id}', [clientController::class, 'delete'])->name('client.delete');
    // inqueries
    Route::get('/inquiry', [GeneralController::class, 'indexInquiry'])->name('inquiry.index');
    Route::get('/inquiry/create', [GeneralController::class, 'createInquiry'])->name('inquiry.create');
    Route::post('/inquiry/store', [GeneralController::class, 'storeInquiry'])->name('inquiry.store');
    Route::get('/inquiry/edit/{id}', [GeneralController::class, 'editInquiry'])->name('inquiry.edit');
    Route::match(['put', 'patch'], '/inquiry/update/{id}', [GeneralController::class, 'updateInquiry'])->name('inquiry.update');
    Route::delete('/inquiry/{id}', [GeneralController::class, 'deleteInquiry'])->name('inquiry.delete');

});
