<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Response;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'images')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
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
        return Inertia::render('Admin/Products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->map(fn($category) => [
            'id' => $category->id,
            'name' => $category->name
        ]);
        return Inertia::render('Admin/Forms/AddProductForm', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $productData = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id
        ];
        $product = Product::create($productData);
        foreach ($productData['image'] as $image) {
            $imageFile = $image->store('public/ProductImages');
            $imageName = explode('/', $imageFile);
            $productImageData = [
                'src' => $imageName[2],
                'product_id' => $product->id
            ];
            $productImage = ProductImage::create($productImageData);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
