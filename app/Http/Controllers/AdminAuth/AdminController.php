<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $pendingOrders = Order::where('status', 'pending')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $yesterday = Carbon::yesterday();
        $orders = [
            'todaysOrders' => Order::whereDate('created_at', today())
                ->get()->count(),
            'totalEarningToday' => Order::whereDate('created_at', today())
                ->sum('totalPrice'),
            'yesterdayOrders' => Order::whereDate('created_at', $yesterday)
                ->get()->count(),
            'totalEarningYesterday' => Order::whereDate('created_at', $yesterday)
                ->sum('totalPrice'),
        ];
        return Inertia::render('Admin/Dashboard', [
            'pendingOrders' => [
                'total' => $pendingOrders
            ],
            'shippedOrders' => [
                'total' => $shippedOrders
            ],
            'orders' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function authenticate(StoreAdminRequest $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $credentials['role'] = 'admin';

        if (Auth::attempt($credentials) && Auth::user()->role === "admin") {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function login(): Response|RedirectResponse
    {
        if(Auth::user() && Auth::user()->role === "admin") {
            return redirect()->intended('admin/dashboard');
        }
        return Inertia::render('Admin/Login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin-login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
