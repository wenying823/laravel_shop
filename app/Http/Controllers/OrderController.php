<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    //
    public function create(Request $request)
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return response()->json(['message' => 'Cart is empty!'], 400);
        }

        $totalPrice = array_reduce($cart, function ($sum, $item) {
            return $sum + $item['quantity'] * $item['product']['price'];
        }, 0);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            $order->items()->create([
                'product_id' => $item['product']['id'],
                'quantity' => $item['quantity'],
                'price' => $item['product']['price']*$item['quantity'],
            ]);
        }

        Session::forget('cart');

        return response()->json(['message' => 'Order created successfully!', 'order' => $order], 201);
    }

    public function index()
    {
        $orders = Order::with('items.product')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return Inertia::render('Orders/OrderList', ['orders' => $orders]);
    }
}
