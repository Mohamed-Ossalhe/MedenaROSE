<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    /**
     * Process payment with stripe
     */
    public function payment(StoreOrderRequest $request): \Symfony\Component\HttpFoundation\Response
    {
        $products = Cart::all()
            ->where('user_id', Auth::user()->id);
        $orderData = [
            "user_id" => Auth::user()->id,
            "shipping_address" => Auth::user()->street_address . ', ' . Auth::user()->city . ', ' . Auth::user()->region . ', ' . Auth::user()->zip_code,
            "totalPrice" => $request->totalPrice,
            "payment_method" => $request->payment_method,
            "status" => $request->status,
            "delivery_date" => now()->addDays(3),
            "products" => []
        ];
        //dd($orderData);

        switch ($orderData["payment_method"]) {
            case 'credit-card':
                Stripe::setApiKey(env("STRIPE_SECRET"));
                $lineItems = [];
                foreach ($products as $product) {
                    $orderData["products"][] = ['id' => $product->products->id, 'quantity' => $product->quantity];
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $product->products->name,
                                'images' => [$product->products->images[0]->src]
                            ],
                            'unit_amount' => $product->products->price * 100,
                        ],
                        'quantity' => $product->quantity,
                    ];
                }
                $checkout_session = Session::create([
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => route('success', [], true),
                    'cancel_url' => route('cancel', [], true),
                ]);
                session(['orderData' => $orderData]);
                return Inertia::location($checkout_session->url);
                break;
            case 'cash-on-delivery':
                foreach ($products as $product) {
                    $orderData["products"][] = ['id' => $product->products->id, 'quantity' => $product->quantity];
                }
                //$order = ['orderData' => $orderData];
                //dd($orderData);
                $order = Order::create($orderData);
                foreach ($orderData["products"] as $product) {
                    $orderProduct = Product::find($product["id"]);
                    $orderProduct->update(['quantity' => $orderProduct->quantity - $product["quantity"]]);
                    $order->products()->attach($product["id"], ["order_id" => $order->id, 'quantity' => $product["quantity"]]);
                };
                Cart::where('user_id', Auth::user()->id)
                    ->delete();
                break;
        }
        return back()->with([
            "message" => "Your Order Placed Successfully."
        ]);
    }

    /**
     * Fires when the payment is successfully processed
     */
    public function success(): Response
    {
        $orderData = session('orderData');
        //dd($orderData['payment_method']);
        $order = Order::create($orderData);
        foreach ($orderData["products"] as $product) {
            //dd($product);
            $orderProduct = Product::find($product["id"]);
            $orderProduct->update(['quantity' => $orderProduct->quantity - $product["quantity"]]);
            $order->products()->attach($product["id"], ["order_id" => $order->id, 'quantity' => $product["quantity"]]);
        };
        Cart::where('user_id', Auth::user()->id)
            ->delete();
        return Inertia::render('Client/Payment/Success');
    }

    /**
     * Fires when the payment is canceled
     */
    public function cancel(): Response
    {
        return Inertia::render('Client/Payment/Cancel');
    }
}
