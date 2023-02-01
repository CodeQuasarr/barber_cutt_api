<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Models\OtherProduct\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get 4 random products
        $products = Product::query()->where('category_product_id', 7)->inRandomOrder()->take(4)->get();
        return response()->json($products);
    }

    public function randomShampoos(Request $request)
    {
        // get 4 random products
        $products = Product::query()->where('category_product_id', 7)->take(4)->get();
        return response()->json($products);
    }
}
