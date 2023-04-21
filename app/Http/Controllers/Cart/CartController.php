<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $cartProducts = Cart::with('products')
            ->where('user_id', Auth::user()->id)
            ->get();
        $totalPrice = $cartProducts->sum(function ($cart) {
            return $cart->quantity * $cart->products->price;
        });
        return Inertia::render('Client/Cart', [
            "carts" => $cartProducts->map(function ($cart){
                return [
                    "id" => $cart->id,
                    "quantity" => $cart->quantity,
                    "products" => [
                        "image" => $cart->products->images[0],
                        "name" => $cart->products->name,
                        "price" => $cart->products->price,
                        "totalPrice" => $cart->products->price * $cart->quantity,
                        "description" => $cart->products->description,
                        "created_at" => $cart->products->created_at
                    ],
                    "inStock" => $cart->quantity > 0,
                ];
            }),
            "total_price" => $totalPrice,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "id" => "required",
            "quantity" => "required"
        ]);

        $cartExist = Cart::where('product_id', $data["id"])
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($cartExist) {
            //dd($cartExist);
            $cartExist->update(["quantity" => $cartExist->quantity+=1]);
        }else {
            //dd('helloo');
            $cartData = [
                "user_id" => Auth::user()->id,
                "product_id" => $data["id"],
                "quantity" => $data["quantity"]
            ];
            $cart = Cart::create($cartData);
        }
        return redirect()->intended('our-products')->with([
            "message" => "Added To Cart Successfully."
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $cartData = $request->validate([
            'quantity' => 'required'
        ]);
        $cart->update(["quantity" => $cartData["quantity"]]);
        return back()->with([
            "message" => "Cart Updated Successfully."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with([
            "message" => "Product Removed Successfully."
        ]);
    }
}
