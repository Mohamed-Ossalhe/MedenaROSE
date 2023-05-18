<?php

namespace App\Http\Controllers\Favorites;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use JetBrains\PhpStorm\NoReturn;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $favorites = Favorite::where('user_id', Auth::user()->id)
            ->get();
        return Inertia::render('Client/Favorites', [
            'favorites' => $favorites
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    #[NoReturn] public function create(Request $request)
    {
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $favorite = $request->validate([
            'product_id' => 'required'
        ]);
        $favorite['user_id'] = Auth::user()->id;
        $favoriteExist = Favorite::where('user_id', $favorite['user_id'])
            ->where('product_id', $favorite['product_id'])
            ->first();
        if($favoriteExist):
            $favoriteExist->delete();
            return back()->with([
                'message' => 'Removed from Favorite'
            ]);
        endif;
        Favorite::create($favorite);
        return back()->with([
            'message' => 'Added to Favorite'
        ]);
    }

    /**
     * Display the specified resource.
     */
    #[NoReturn] public function show(string $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
