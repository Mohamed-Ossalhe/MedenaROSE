<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\CategoryImage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_options = ['name_asc', 'name_desc'];
        $categories = Category::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->when($request->input('sort') && in_array($request->input('sort'), $sort_options), function ($query, $sort) use ($sort_options) {
                if($sort === 'name_asc') {
                    $query->orderBy('name', 'asc');
                }else if($sort === 'name_desc'){
                    $query->orderBy('name', 'desc');
                }
//                switch ($sort) {
//                    case 'name_asc':
//                        $query->orderBy('name', 'asc');
//                        break;
//                    case 'name_desc':
//                        $query->orderBy('name', 'desc');
//                        break;
//                }
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($category) => [
                'id' => $category->id,
                'name' => $category->name,
                'products' => $category->products->count(),
                'images' => $category->images->map(fn($image)=>[
                    'id' => $image->id,
                    'src' => $image->src
                ])
            ]);
        return Inertia::render('Admin/Categories', [
            'categories' => $categories,
            "filters" => $request->only(['search']),
            "sort" => $request->only(['sort'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Forms/AddCategoryForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => '0',
            'image' => $request->image
        ];
        $category = Category::create($categoryData);
        $imageFile = $categoryData['image']->store('public/CategoryImages');
        $imageName = explode('/', $imageFile);
        $imageData = [
            'src' => $imageName[2],
            'category_id' => $category->id
        ];
        $image = CategoryImage::create($imageData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
