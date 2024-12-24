<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully!'], 200);
    }

    public function count()
    {
        $cart = Session::get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return response()->json(['count' => $count]);
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        $cartContent = [];

        foreach ($cart as $item) {
            $cartContent[] = [
                'product' => $item['product'],
                'quantity' => $item['quantity'],
                'total' => $item['product']->price * $item['quantity'],
            ];
        }
        return Inertia::render('Cart/Cart', [
            'cart' => $cartContent,
        ]);
    }
    
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $cart = Session::get('cart', []);
    
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            $cart[$request->product_id]['total'] = $cart[$request->product_id]['product']->price * $request->quantity;
            Session::put('cart', $cart);
    
            return response()->json(['message' => 'Cart updated successfully!', 'cart' => $cart], 200);
        }
    
        return response()->json(['message' => 'Product not found in cart!'], 404);
    }
}
