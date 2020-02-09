@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="img-fluid img-thumbnail">
                </div>
                <div class="col-md-8">
                    @if ($product->hasLowStock)
                    <span class="badge badge-warning">Low stock</span>
                    @endif

                    @if ($product->outOfStock)
                    <span class="badge badge-danger">Out of stock</span>
                    @endif

                    <h1>{{ $product->title }}</h1>
                    <p>{{ $product->description }}</p>

                    @if ($product->inStock)
                    <a href="{{ route('cart.add', ['slug' => $product->slug, 'quantity' => 1]) }}" class="btn btn-primary">Add to cart</a>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
