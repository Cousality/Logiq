<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');



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
#Authentication 
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showloginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

#Store Controller
Route::get('/store', [StoreController::class, 'index'])->name('store.index');

#Search
Route::get('/search', [StoreController::class, 'index'])->name('search');

#Wishlist Controller
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::get('/', function () {
    return view('Frontend.home');
})->name('home');

Route::get('/forgot-password', function () {
    return view('Frontend.forgot_password');
});

Route::post('/send-reset-link', function () {
    return back()->with('message', 'Reset link sent (demo)');
});
Route::get ('/basket', function () {
    return view('Frontend.basket');
});

Route::get('/about_us', function () {
    return view('Frontend.about_us');
})->name('about_us');

Route::get('/privacy_policy', function () {
    return view('Frontend.privacy_policy');
});

Route::get ('/dashboard', function () {
    return view('Frontend.dashboard');
})-> name('dashboard'); 


Route::get ('/return_policy', function () {
    return view('Frontend.return_policy');
});



Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');

Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');

Route::put('/basket/{item}', [BasketController::class, 'update'])->name('basket.update');

Route::delete('/basket/{item}', [BasketController::class, 'remove'])->name('basket.remove');





