@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $product)
        <div class="col-md-4 col-sm-6">
            @include('products.partials.product')
        </div>
        @endforeach
    </div>
</div>
@endsection
