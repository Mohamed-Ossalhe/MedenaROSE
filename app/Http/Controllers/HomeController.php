<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    // Home Page
    public function index(): Response
    {
        $categories = Category::with('images')
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
    }

    // Products page
    public function products(Request $request): Response
    {
        $categories = Category::all()
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
            })->when($request->input('sort'), function ($query, $sort) {
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
            })->when($request->input('category'), function ($query, $categroy) {
                $query->where('category_id', $categroy);
            })
            ->paginate(8)
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
            "sort" => $request->only(['sort']),
            "category" => $request->only(['category'])
        ]);
    }

    // show product
    public function showProduct(string $id) {
        $product = Product::find($id);
        $relatedProducts = Product::with('images')
            //->getQuery()
            ->where('category_id', $product->category_id)
            ->where('id', '<>', $product->id)
            ->take(4)
            ->get();
        return Inertia::render('Client/ProductPage', [
            "product" => [
                "id" => $product->id,
                "name" => $product->name,
                "description" => $product->description,
                "price" => $product->price,
                "images" => $product->images->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'src' => $image->src
                    ];
                })
            ],
            "relatedProducts" => $relatedProducts//$relatedProducts->map(function ($product) {
//                return [
//                    "id" => $product->id,
//                    "name" => $product->name,
//                    "description" => $product->description,
//                    "price" => $product->price,
//                    "images" => $product->images->map(function ($image) {
//                        return [
//                            'id' => $image->id,
//                            'src' => $image->src
//                        ];
//                    })
              //  ];
            //})
        ]);
    }
}
