<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;

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
                'shipping_address' => $order->shipping_address,
                'totalPrice' => $order->totalPrice,
                'status' => $order->status,
                'deliveryDate' => $order->delivery_date,
                'products' => $order->products
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): Response
    {
        $orderProducts = $order->products;
        return Inertia::render('Admin/ViewOrders', [
            "products" => $orderProducts
        ]);
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
        $orderStatus = $request->status;
        //dd($orderStatus, $order);
        $order->update(['status' => $orderStatus]);
        return back()->with([
            "message" => "Order ". $order->id ." Status Changed to " . $orderStatus
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
