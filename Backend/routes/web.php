<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get ('/welcome', function () {
    return view('welcome');
}); 

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showloginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('Frontend.home');
})->name('home');
Route::get('/store', function () {
    return view('Frontend.store');
})->name('store');


Route::get('/forgot-password', function () {
    return view('Frontend.forgot_password');
});

Route::post('/send-reset-link', function () {
    return back()->with('message', 'Reset link sent (demo)');
});
Route::get ('/basket', function () {
    return view('Frontend.basket');
});
