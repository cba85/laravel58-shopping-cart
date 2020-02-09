@extends('layouts.app')

@section('content')
<div class="container">

    @if (Session::has('error'))
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="alert alert-danger text-center">
                😭 {{ Session::get('error') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if ($basket->itemCount())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($basket->all() as $product)
                            <tr>
                                <td><a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a></td>
                                <td>{{ number_format($product->price, 2, ',', ' ') }} €</td>
                                <td>
                                    <form action="{{ route('cart.update', $product->slug) }}" method="post" class="form-inline">
                                        @csrf
                                        <select name="quantity" id="" class="form-control custom-select-sm custom-select ">
                                            @for ($i = 1; $i <= 9; $i++) <option value="{{ $i }}" @if ($i==$product->quantity) selected @endif>
                                                {{ $i }}
                                                </option>
                                                @endfor
                                                <option value="0">Delete</option>
                                        </select>
                                        <input type="submit" value="Update" class="btn btn-link">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Cart summary</h4>

                    @include('cart.partials.summary')

                    <a href="{{ route('order.index') }}" class="btn btn-primary btn-block">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <p class="text-center"><em>Your cart is empty.</em></p>
    <p class="text-center"><a href="{{ route('home') }}" class="btn btn-primary">Go shopping</a></p>
    @endif
</div>
@endsection
