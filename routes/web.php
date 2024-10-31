<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
})->name('welcome');

Route::get('/admin', function () {
    return view('auth/admin');
});

Route::get('restricted', function () {
    return redirect()->route('welcome')->withSuccess("Anda berusia lebih dari 18 tahun!");
})->middleware('checkage');

Route::get('admin', function () {
    return redirect()->route('welcome')->withSuccess("Selamat datang pada laman admin!");
})->middleware('admin');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register','register')->name('register');
    Route::post('/store','store')->name('store');
    Route::get('/login','login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('/users','users')->name('users123');
    Route::post('/logout','logout')->name('logout');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/users','users')->name('users123');
});

Route::resource('users', UserController::class);

Route::resource('edit', UserController::class);