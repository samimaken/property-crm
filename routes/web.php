<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>'admin.guest'],function(){
        Route::view('/', 'admin.auth.login')->name('admin.login');
        Route::post('login', [App\Http\Controllers\admin\LoginController::class, 'index'])->name('admin.login');

        //forgot password
		Route::get('forget-password',[App\Http\Controllers\admin\ForgotPasswordController::class, 'getEmail'])->name('admin.forget-password');
		Route::post('forget-password',[App\Http\Controllers\admin\ForgotPasswordController::class, 'postEmail'])->name('admin.forget-password');

		Route::get('reset-password/{token}', [App\Http\Controllers\admin\ResetPasswordController::class, 'getPassword']);
		Route::post('reset-password',[App\Http\Controllers\admin\ResetPasswordController::class, 'updatePassword']);
    });

    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('dashboard/{lang?}',[App\Http\Controllers\admin\AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('logout',[App\Http\Controllers\admin\LoginController::class, 'logout'])->name('admin.logout');
    });
});
