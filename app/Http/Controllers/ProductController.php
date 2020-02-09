<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.product',[
            'basket' => $this->basket,
            'product' => $product
            ]);
    }
}
