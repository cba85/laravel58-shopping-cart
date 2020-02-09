<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basket\Basket;
use App\Product;
use App\Basket\Exceptions\QuantityExceededException;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index', ['basket' => $this->basket]);
    }

    public function add($slug, $quantity)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $basket = new Basket($product);
        try {
            $basket->add($product, $quantity);
        } catch (QuantityExceededException $e) {
            return redirect()->route('cart.index')->with('error', "We're sorry, we don't have enough of this product in stock.");
        }

        return redirect()->route('cart.index');
    }

    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $basket = new Basket($product);
        try {
            $basket->update($product, $request->quantity);
        } catch (QuantityExceededException $e) {
            return redirect()->route('cart.index')->with('error', "We're sorry, we don't have enough of this product in stock.");
        }

        return redirect()->route('cart.index');
    }
}
