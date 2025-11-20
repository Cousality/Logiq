<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
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

Route::get('/welcome', function () {
    return view('welcome');
});
//Authentication
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showloginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Store Controller
Route::get('/store', [StoreController::class, 'index'])->name('store.index');

//Search
Route::get('/search', [StoreController::class, 'index'])->name('search');

//Wishlist Controller
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::get('/product/{productSlug}', [ProductController::class, 'index'])->name('product.index');

Route::get('/your_orders', [OrderController::class, 'index'])->name('dashboard.orders');

Route::get('/', function () {
    return view('Frontend.home');
})->name('home');

Route::get('/forgot-password', function () {
    return view('Frontend.forgot_password');
});

Route::post('/send-reset-link', function () {
    return back()->with('message', 'Reset link sent (demo)');
});
Route::get('/basket', function () {
    return view('Frontend.basket');
});

Route::get('/About_us', function () {
    return view('Frontend.about_us');
})->name('About_us');

Route::get('/privacy_policy', function () {
    return view('Frontend.privacy_policy');
});

Route::get('/TermsConditions', function () {
    return view('Frontend.TermsConditions');
});

//Dashboard Routes
Route::get('/dashboard', function () {
    return view('Frontend.dashboard');
})->name('dashboard');

Route::get('/admin_dashboard', function () {
    return view('Frontend.admin_dashboard');
})->name('admin.dashboard');

Route::get('/login_security', function () {
    return view('Frontend.login_security');
})->name('login.security');

Route::get('/return_policy', function () {
    return view('Frontend.return_policy');
})->name('return_policy');

Route::get('/FAQs', function () {
    return view('Frontend.FAQs');
})->name('FAQs');
