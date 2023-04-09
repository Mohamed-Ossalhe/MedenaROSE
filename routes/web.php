<?php

use App\Http\Controllers\AdminAuth\AdminController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Visitor\VisitorController;
use App\Http\Requests\StoreAdminRequest;
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

Route::get('/', function () {
    return Inertia::render('Client/Home');
});

Route::get('/admin-login', function () {
    if(\Illuminate\Support\Facades\Auth::user()) {
        return redirect()->intended('dashboard');
    }
    return Inertia::render('Admin/Login');
})->name('login');

Route::post('/admin-login', [AdminController::class, 'authenticate']);

Route::middleware('auth', \App\Http\Middleware\TrackVisitors::class)->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard', [
            'ip' => request()->ip()
        ]);
    });
    Route::get('/analytics', function () {
        $visitors = new VisitorController();
        return Inertia::render('Admin/Analytics', [
            'visitors' => [
                'total' => count($visitors->index())
            ]
        ]);
    });
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
    Route::post('/admin-logout', [AdminController::class, 'logout']);
});
