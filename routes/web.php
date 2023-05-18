<?php

use App\Http\Controllers\AdminAuth\AdminController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\PaymentController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Favorites\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Visitor\VisitorController;
use App\Http\Middleware\TrackVisitors;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
/*** Home Page Route ***/
Route::get('/', [HomeController::class, 'index']);
/*** Products Page Route ***/
Route::get('/our-products', [HomeController::class, 'products']);
/*** Product Page ***/
Route::get('/our-products/{product}', [HomeController::class, 'showProduct'])->name("product_page");

/*** User Auth Routes ***/
Route::get('/signup', [UserController::class, 'create']);
Route::post('/signup', [UserController::class, 'store']);
Route::get('/signin', [UserController::class, 'login']);
Route::post('/signin', [UserController::class, 'authenticate'])->name('login');

/*** Admin Login Page Route ***/
Route::get('/admin-login', [AdminController::class, 'login']);
Route::post('/admin-login', [AdminController::class, 'authenticate']);

Route::middleware('auth', TrackVisitors::class)->group(function () {
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'isAdmin',
        'as' => 'admin'
    ], function () {
        /*** Dashboard Route ***/
        Route::get('/dashboard', [AdminController::class, 'index']);

        Route::resource('analytics', VisitorController::class);

        /*** Products Routes ***/
        Route::resource('products', ProductController::class);

        /*** Customers Routes ***/
        Route::resource('customers', UserController::class);

        /*** Categories Routes ***/
        Route::resource('categories', CategoryController::class);

        /*** Orders Routes ***/
        Route::resource('orders', OrderController::class);

        /*** Admin LogOut Route ***/
        Route::post('/admin-logout', [AdminController::class, 'logout']);
    });

    /*** Client Profile ***/
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile');
    Route::patch('/profile/{id}', [UserController::class, 'update']);

    /*** Payment Routes ***/
    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/success', [PaymentController::class, 'success'])->name('success');
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');

    /*** Client logout ***/
    Route::post('/logout', [UserController::class, 'logout']);

    /*** Cart Routes ***/
    Route::resource('cart', CartController::class)->name('index', 'cart');
    Route::patch('cart', [CartController::class, 'update']);

    /*** Favorites Routes ***/
    Route::resource('favorites', FavoriteController::class)->name('index', 'favorites');
});
