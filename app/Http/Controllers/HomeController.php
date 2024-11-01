<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $todayOrders = Order::with('products')->whereDate('created_at', Carbon::today())->get();
        $weekOrders = Order::with('products')->whereBetween('created_at',[$startOfWeek, $endOfWeek])->get();
        $monthOrders = Order::with('products')->whereBetween('created_at',[$startOfMonth, $endOfMonth])->get();
        $yearOrders = Order::with('products')->whereBetween('created_at',[$startOfYear, $endOfYear])->get();
        $totalOrders = Order::with('products')->get();
        
        $todayProductOrder = 0;
        $todayProductRev = 0;
        foreach ($todayOrders as $item) {
            foreach($item->products as $p_item){
                $todayProductRev += $p_item->price * $p_item->pivot->quantity;
                $todayProductOrder += $p_item->pivot->quantity;
            }
        }


        $weekProductOrder = 0;
        $weekProductRev = 0;
        foreach ($weekOrders as $item) {
            foreach($item->products as $p_item){
                $weekProductRev += $p_item->price * $p_item->pivot->quantity;
                $weekProductOrder += $p_item->pivot->quantity;
                
            }
        }


        $monthProductOrder = 0;
        $monthProductRev = 0;
        foreach ($monthOrders as $item) {
            foreach($item->products as $p_item){
                $monthProductRev += $p_item->price * $p_item->pivot->quantity;
                $monthProductOrder += $p_item->pivot->quantity;
            }
        }

        $yearProductOrder = 0;
        $yearProductRev = 0;
        foreach ($yearOrders as $item) {
            foreach($item->products as $p_item){
                $yearProductRev += $p_item->price * $p_item->pivot->quantity;
                $yearProductOrder += $p_item->pivot->quantity;
            }
        }
        $totalProductOrder = 0;
        $totalProductRev = 0;
        foreach ($totalOrders as $item) {
            foreach($item->products as $p_item){
                $totalProductRev += $p_item->price * $p_item->pivot->quantity;
                $totalProductOrder += $p_item->pivot->quantity;
            }
        }

        $data = [
                'today' => [
                    'total' => $todayOrders->count(),
                    'product_order' => $todayProductOrder,
                    'product_rev' => $todayProductRev,
                ],
                'week' => [
                    'total' => $weekOrders->count(),
                    'product_order' => $weekProductOrder,
                    'product_rev' => $weekProductRev,
                ],
                'month' => [
                    'total' => $monthOrders->count(),
                    'product_order' => $monthProductOrder,
                    'product_rev' => $monthProductRev,
                ],
                'year' => [
                    'total' => $yearOrders->count(),
                    'product_order' => $yearProductOrder,
                    'product_rev' => $yearProductRev,
                ],
                'total' => [
                    'total' => $totalOrders->count(),
                    'product_order' => $totalProductOrder,
                    'product_rev' => $totalProductRev,
                ]
            ];
        return view('home', ['data' => $data]);
    }
}
