<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

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

//Basket Controller
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::put('/basket/{item}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/{item}', [BasketController::class, 'remove'])->name('basket.remove');

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

Route::get('/about_us', function () {
    return view('Frontend.about_us');
})->name('about_us');

Route::get('/privacy_policy', function () {
    return view('Frontend.privacy_policy');
});

Route::get('/TermsConditions', function () {
    return view('Frontend.TermsConditions');
});

Route::get('/return_policy', function () {
    return view('Frontend.return_policy');
})->name('return_policy');

Route::get('/FAQs', function () {
    return view('Frontend.FAQs');
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
})->name('loginSecurity');

Route::get('/your_address', function () {
    return view('Frontend.your_address');
})->name('yourAddress');

Route::get('/customer_service', function () {
    return view('Frontend.customer_service');
})->name('customer_service');

Route::get('/my_puzzles', function () {
    return view('Frontend.my_puzzles');
})->name('mypuzzles');
