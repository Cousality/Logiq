<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\IsAdmin;
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

//Home Controller

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/puzzle/check', [HomeController::class, 'validatePuzzle'])->name('puzzle.check');

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

Route::get('/product/{productSlug}', [ProductController::class, 'index'])->name('product.index');

Route::get('/your_orders', [OrderController::class, 'index'])->name('dashboard.orders');
Route::patch('/your_orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel')->middleware('auth');

Route::get('/forgot-password', function () {
    return view('Frontend.Auth.forgot_password');
});

Route::post('/send-reset-link', function () {
    return back()->with('message', 'A password reset link has been sent to your email.');
})->name('password.email');

Route::get('/about_us', function () {
    return view('Frontend.text.about_us');
})->name('about_us');

Route::get('/privacy_policy', function () {
    return view('Frontend.text.privacy_policy');
});

Route::get('/TermsConditions', function () {
    return view('Frontend.text.TermsConditions');
})->name('terms');

Route::get('/return_policy', function () {
    return view('Frontend.text.return_policy');
})->name('return_policy');

Route::get('/FAQs', function () {
    return view('Frontend.text.FAQs');
});

//Dashboard Routes

Route::get('/your_address', function () {
    return view('Frontend.dashboard.your_address');
})->name('yourAddress');

Route::get('/my_puzzles', function () {
    return view('Frontend.dashboard.my_puzzles');
})->name('mypuzzles');

// Auth Pages
Route::middleware(['auth'])->group(function () {
    Route::get('/customer_service', [ContactController::class, 'index'])->name('customer_service');
    Route::post('/customer_service', [ContactController::class, 'add'])->name('customer_service.add');

    //Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

    //Login & Security Routes
    Route::get('/login_security', [ProfileController::class, 'index'])->name('loginSecurity');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('Frontend.dashboard');
    })->name('dashboard');

    //Review Routes
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/user_management', [UserManagementController::class, 'index'])->name('userManagement');
    Route::patch('/user_management/{id}/make-admin', [UserManagementController::class, 'makeAdmin'])->name('users.makeAdmin');
    Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
    //Basket Routes

    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
    Route::put('/basket/{item}', [BasketController::class, 'update'])->name('basket.update');
    Route::delete('/basket/{item}', [BasketController::class, 'remove'])->name('basket.remove');

    //Wishlist Routes
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

    Route::get('/admin_customer_service', [ContactController::class, 'adminIndex'])->name('admin.customer_service');
    Route::post('/admin/tickets/{supportNum}/resolve', [ContactController::class, 'resolve'])->name('admin.tickets.resolve');

    Route::resource('admin/products', AdminProductController::class)->names('admin.products');

    Route::get('/promotions', function () {
        return view('Frontend.dashboard.promotions');
    })->name('promotions');

    Route::get('/inventory_management', function () {
        return view('Frontend.dashboard.inventory_management');
    })->name('inventory_management');
});

Route::fallback(function () {
    return view('errors.404');
});
