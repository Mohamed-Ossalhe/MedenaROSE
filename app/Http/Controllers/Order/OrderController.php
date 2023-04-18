<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_options = ['price_asc', 'price_desc', 'name_asc', 'name_desc'];
        $orders = Order::query()
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
            ->with('products')
            ->paginate(10)
            ->withQueryString()
            ->through(fn($order) => [
                'id' => $order->id,
                'order_address' => $order->order_address,
                'total_price' => $order->total_price,
                'status' => $order->status
            ]);
        return Inertia::render('Admin/Orders', [
            "orders" => $orders,
            "filters" => $request->only(["search"]),
            "sort" => $request->only(["sort"])
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
    public function store(StoreOrderRequest $request)
    {
        $orderData = [
            'user_id' => Auth::user()->id,
            'order_address' => Auth::user()->street_address,
            'total_price' => $request->total_price * $request->quantity,
            'status' => $request->status
        ];
        $order = Order::create($orderData);
        $order->products()->attach([
            ["product_id" => $request->id, "quantity" => 1]
        ]);
        return back()->with([
            "message" => "Order Placed Successfully."
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
