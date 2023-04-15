<?php

use App\Http\Controllers\AdminAuth\AdminController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Visitor\VisitorController;
use App\Http\Middleware\TrackVisitors;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Product;
use Illuminate\Http\Request;
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
    $categories = \App\Models\Category::with('images')
        ->take(5)
        ->get()
        ->map(function ($category) {
            return [
                "name" => $category->name,
                "image" => $category->images->map(fn($image)=>[
                    'src' => $image->src
                ])
            ];
        });
    $topSaleProducts = Product::with("images")
        ->take(3)
        ->get()
        ->map(function ($product) {
            return [
                "name" => $product->name,
                "image" => $product->images->map(function ($image) {
                    return [
                        "src" => $image->src
                    ];
                }),
                "price" => $product->price
            ];
        });
    return Inertia::render('Client/Home', [
        "categories" => $categories,
        "products" => $topSaleProducts
    ]);
});
/*** Products Page Route ***/
Route::get('/our-products', function (Request $request) {
    $sort_options = ['price_asc', 'price_desc', 'name_asc', 'name_desc'];
    $categories = \App\Models\Category::all()
    ->map(function ($category){
        return [
            "id" => $category->id,
            "name" => $category->name,
            "quantity" => $category->quantity
        ];
    });
    $products = Product::query()
        ->when($request->input('search'), function ($query, $search){
            $query->where('name', 'like', "%{$search}%");
        })->when($request->input('sort') && in_array($request->input('sort'), $sort_options), function ($query, $sort) use ($sort_options) {
            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        })
        ->paginate(10)
        ->withQueryString()
        ->through(fn($product) => [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'images' => $product->images->map(fn($image) => [
                'id' => $image->id,
                'src' => $image->src
            ])
        ]);
    return Inertia::render('Client/Products', [
        "categories" => $categories,
        "products" => $products,
        "filters" => $request->only(['search']),
        "sorts" => $request->only(['sort'])
    ]);
});

/*** Cart Route ***/
Route::get('/cart', function () {
    return Inertia::render('Client/Cart');
});

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
    /*** Client logout ***/
    Route::post('/logout', [UserController::class, 'logout']);
});
