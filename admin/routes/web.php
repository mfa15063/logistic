<?php

use App\Http\Controllers\Admin\UserController;
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
    return view('welcome');
});
Route::prefix('administrator')->name('admin.')->group(function () {

    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('login');
    Route::post('/login/auth', [UserController::class, 'authenticate'])->name('login.auth');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('/profile', function () {
            return view('admin.auth.profile');
        })->name('profile');
        Route::post('/profile/update', [UserController::class, 'profile'])->name('profile.update');
    });
});
