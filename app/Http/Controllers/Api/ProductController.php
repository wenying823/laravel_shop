<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => '產品列表獲取成功'
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => '產品未找到'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => '產品詳情獲取成功'
        ]);
    }
}
