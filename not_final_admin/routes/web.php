<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\orderController;
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

Route::get('/', function () {
    return view('admin.auth.login');
})->name('login');

Route::post('/login/auth', [UserController::class, 'authenticate'])->name('login.auth');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/profile', function () {
        return view('admin.auth.profile');
    })->name('profile');

    Route::post('/profile/update',      [UserController::class,'profile'])->name('profile.update');
    Route::post('/change/password',     [UserController::class,'changePassword'])->name('password.change');
    Route::get('/edit/site_setting',    [UserController::class,'edit_site_setting'])->name('site_setting.edit');
    Route::post('/update/site_setting', [UserController::class,'update_site_setting'])->name('site_setting.update');

    Route::get('/order/create', [orderController::class, 'create'])->name('order.create');
    Route::get('/order', [orderController::class, 'index'])->name('order.index');
    Route::get('/order/new', [orderController::class, 'allNew'])->name('order.allNew');
    Route::get('/order/panding', [orderController::class, 'allPanding'])->name('order.allPanding');
    Route::get('/order/delivered', [orderController::class, 'allDelivered'])->name('order.allDelivered');
    Route::post('/order/store', [orderController::class, 'store'])->name('order.store');
    Route::get('/order/approved/{id}', [orderController::class, 'updateApproved'])->name('order.updateApproved');
    Route::get('/order/delivered/{id}', [orderController::class, 'updateDelivered'])->name('order.updateDelivered');
});
