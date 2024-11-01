<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('products')->orderBy('created_at', 'desc')->get();
        
        return view('orders.order-list', ["orders" => $orders]);
    }


    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.product_name' => 'required|string',
            'cart.*.quantity' => 'required|integer|min:1',
        ]);

        $cartData = $validated['cart'];
        $outOfStockProducts = [];

        foreach ($cartData as $item) {
            $product = Product::find($item['id']);
            if ($product->stock < $item['quantity']) {
                $outOfStockProducts[] = $product->product_name;
            }
        }
    
        if (!empty($outOfStockProducts)) {
            $outOfStockNames = implode(', ', $outOfStockProducts);
            return response()->json(['message' => "The following products are out of stock: $outOfStockNames."], 400);
        }

        $order = Order::create();
    
        foreach ($cartData as $item) {
            $product = Product::find($item['id']);
            $totalPrice = $item['quantity'] * $product->price;
    
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'total_price' => $totalPrice
            ]);
    
            $product->stock -= $item['quantity'];
            $product->save();
        }
    
        return response()->json(['success'=> true,'message' => "Product order successful. Your order number is $order->id."]);
    }
    

    public function getInvoice(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Order::with('products');

        if ($start_date) {
            $query->where('created_at', '>=', Carbon::parse($start_date)->startOfDay());
        }
    
        if ($end_date) {
            $query->where('created_at', '<=', Carbon::parse($end_date)->endOfDay());
        }

        $orders = $query->orderBy('created_at', 'asc')->get();
        $date = [
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        return view('orders.invoice-get', ['orders' => $orders, 'date' => $date ]);
    }
}
