@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">

                    <h1>Order #{{ $order->id }}</h1>
                    <hr class="mb-5">

                    <div class="row">
                        <div class="col-md-6">
                            <h2>Shipping to</h2>

                            {{ $order->address->address1 }}<br>
                            @if ($order->address->address2)
                            {{ $order->address->address2 }}<br>
                            @endif
                            {{ $order->address->postal_code }} {{ $order->address->city }}
                        </div>
                        <div class="col-md-6">
                            <h2>Products</h2>
                            @foreach ($order->products as $product)
                            {{ $product->pivot->quantity }} x <a href="{{ route('product.show', ['slug' => $product->slug ]) }}">{{ $product->title }}</a>: {{ number_format($product->price, 2, ',', ' ') }} €<br>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr>

                            <p>Shipping : 5,00 €<br>
                                <strong>Order total: {{ number_format($order->total, 2, ',', ' ') }} €</strong></<strong>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

</div>

@endsection
