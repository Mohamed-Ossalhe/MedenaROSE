<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_options = ['price_asc', 'price_desc', 'name_asc', 'name_desc'];
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
        return Inertia::render('Admin/Products', [
            'products' => $products,
            "filters" => $request->only(['search']),
            "sort" => $request->only(['sort'])
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
        $totalProductInCategory = Product::where('category_id', $product->category_id)->get()->count();
        $category = Category::find($product->category_id);
        $category->update(['quantity' => $totalProductInCategory]);
        foreach ($productData['image'] as $image) {
            $imageFile = $image->store('public/ProductImages');
            $imageName = explode('/', $imageFile);
            $productImageData = [
                'src' => $imageName[2],
                'product_id' => $product->id
            ];
            $productImage = ProductImage::create($productImageData);
        }
        return redirect('admin/products')->with([
            "message" => "Product Created Successfully."
        ]);
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
        $product->delete();
        $totalProductInCategory = Product::where('category_id', $product->category_id)->get()->count();
        $category = Category::find($product->category_id);
        $category->update(['quantity' => $totalProductInCategory]);
    }
}
