<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Address;
use Stripe\Stripe as Stripe;
use App\Payment;
use App\Order;
use Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $this->basket->refresh();

        if (!$this->basket->subTotal()) {
            return redirect()->route('home');
        }
        return view('order.index', [
            'basket' => $this->basket,
            'user' => Auth::user()
        ]);
    }

    public function show(Request $request, $hash, Order $order)
    {
        $order = $order->where('hash', $hash)->with(['address', 'products'])->firstOrFail();

        if (!Auth::check()) {
            return redirect()->route('home');
        }

        if ($order->user_id != Auth::user()->id) {
            return redirect()->route('home');
        }

        return view('order.show', compact('order'));
    }

    public function create(Request $request, User $user, Address $address, Payment $payment)
   {
        $this->basket->refresh();

        if (!$this->basket->subTotal()) {
            return redirect()->route('home');
        }

        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'address1' => 'required',
            'address2' => '',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        $hash = bin2hex(random_bytes(32));

        if (!Auth::check()) {
            $user = $user->firstOrCreate([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        } else {
            $user = Auth::user();
        }

        $address = $address->firstOrCreate([
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'postal_code' => $request->postal_code
        ]);

        $shipping = 5;
        $total = $this->basket->subTotal() + $shipping;

        $order = $user->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'total' => $total,
            'address_id' => $address->id
        ]);

        $order->products()->saveMany(
            $this->basket->all(),
            $this->getQuantites($this->basket->all())
        );

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $stripeTotal = $total * 100;

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $stripeTotal,
                'currency' => 'eur',
                'source' => $request->stripeToken
            ]);
        } catch (\Stripe\Error\Card $e) {
            return redirect()->route('order.index')->with('error', $e->getMessage());
        }

        // Create payment
        $payment = $order->payment()->create([
            'charge_id' => $charge->id
        ]);

        // Update stock
        foreach ($this->basket->all() as $product) {
            $product->decrement('stock', $product->quantity);
        }

        // Mark order paid
        $order->update([
            'paid' => true
        ]);

        // Empty basket
        $this->basket->clear();

        return redirect()->route('order.show', ['hash' => $order->hash]);

   }

   protected function getQuantites($items)
   {
       $quantities = [];

       foreach ($items as $item) {
           $quantities[] = ['quantity' => $item->quantity];
       }

       return $quantities;
   }
}
