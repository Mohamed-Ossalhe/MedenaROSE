<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // Get the start and end dates of the period you're interested in
        $startDate = Carbon::now();
        $endDate = (new \Illuminate\Support\Carbon)->addWeeks(20);

        // Get all the months between the start and end dates
        $months = [];
        while ($startDate->lte($endDate)) {
            $months[$startDate->format('Y-m')] = 0;
            $startDate->addMonth();
        }

        // Get the number of orders for each month
        $ordersByMonth = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total_orders')
            ->groupBy('month')
            ->get();

        // Merge the order counts into the array of months
        foreach ($ordersByMonth as $orders) {
            $months[$orders->month] = $orders->total_orders;
        }
        $totalOrders = Order::all()->count();
        $clients = User::where('role', 'client')->count();
        return Inertia::render('Admin/Analytics', [
            'visitors' => [
                'total' => count(Visitor::all()),
            ],
            'totalOrders' => [
                'total' => $totalOrders
            ],
            'clients' => [
                'total' => $clients
            ],
            'ordersByMonth' => $months
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
