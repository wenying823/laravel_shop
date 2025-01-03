<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Cache::remember('products', 60 * 60, function () {
            return Product::all();
        });

        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        $product = Cache::remember("product_{$id}", 60 * 60, function () use ($id) {
            return Product::findOrFail($id);
        });

        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    }
}
