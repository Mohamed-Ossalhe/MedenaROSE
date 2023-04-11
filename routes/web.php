<?php

use App\Http\Controllers\AdminAuth\AdminController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Visitor\VisitorController;
use App\Http\Middleware\TrackVisitors;
use App\Http\Requests\StoreAdminRequest;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    return Inertia::render('Client/Home');
});

/*** User Auth Routes ***/
Route::get('/signup', [UserController::class, 'create']);
Route::post('/signup', [UserController::class, 'store']);
Route::get('/signin', [UserController::class, 'login']);
Route::post('/signin', [UserController::class, 'authenticate']);

/*** Admin Login Page Route ***/
Route::get('/admin-login', [AdminController::class, 'login'])->name('login');
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
        Route::get('/orders', function () {
            return Inertia::render('Admin/Orders');
        });

        /*** Admin LogOut Route ***/
        Route::post('/admin-logout', [AdminController::class, 'logout']);
    });
});
