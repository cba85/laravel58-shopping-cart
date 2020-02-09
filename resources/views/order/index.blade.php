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

    <script src="https://js.stripe.com/v3/"></script>

    <form action="{{ route('order.create') }}" method="post" id="payment-form">
        @csrf
        <div class="row">
            <div class="col-md-6">
                @if (!Auth::check())
                <div class="card mb-4">
                    <div class="card-body text-center">
                        Already registrered? <a href="{{ route('login') }}">Sign-in</a>.
                    </div>
                </div>
                @endif
                <div class="card mb-4">
                    <div class="card-body">
                        @if (!Auth::check())
                        <h3 class="mb-4">Your details</h3>
                        <hr>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <span class="text-danger">
                                <small>{{ $errors->first('email', ":message") }}</small>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" name="name" id="name" class="form-control @if ($errors->has('name')) is-invalid @endif" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">
                                <small>{{ $errors->first('name', ":message") }}</small>
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-5">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control @if ($errors->has('password')) is-invalid @endif" required>
                            @if ($errors->has('password'))
                            <span class="text-danger">
                                <small>{{ $errors->first('password', ":message") }}</small>
                            </span>
                            @endif
                        </div>
                        @endif

                        <h3 class="mb-4">Shipping address</h3>
                        <hr>

                        <div class="form-group">
                            <label for="address1">Address line 1</label>
                            <input type="text" name="address1" id="address1" class="form-control @if ($errors->has('address1')) is-invalid @endif" value="@if (Auth::check() and !old('address1')) {{ $user->address1 }} @else {{ old('address1') }} @endif" required>
                            @if ($errors->has('address1'))
                            <span class="text-danger">
                                <small>{{ $errors->first('address1', ":message") }}</small>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address2">Address line 2</label>
                            <input type="text" name="address2" id="address2" class="form-control @if ($errors->has('address2')) is-invalid @endif" value="@if (Auth::check() and !old('address2')) {{ $user->address2 }} @else {{ old('address2') }} @endif">
                            @if ($errors->has('address2'))
                            <span class="text-danger">
                                <small>{{ $errors->first('address2', ":message") }}</small>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control @if ($errors->has('city')) is-invalid @endif" value="@if (Auth::check() and !old('city')) {{ $user->city }} @else {{ old('city') }} @endif" required>
                            @if ($errors->has('city'))
                            <span class="text-danger">
                                <small>{{ $errors->first('city', ":message") }}</small>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal code</label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control @if ($errors->has('postal_code')) is-invalid @endif" value="@if (Auth::check() and !old('postal_code')) {{ $user->postal_code }} @else {{ old('postal_code') }} @endif" required>
                            @if ($errors->has('postal_code'))
                            <span class="text-danger">
                                <small>{{ $errors->first('postal_code', ":message") }}</small>
                            </span>
                            @endif
                        </div>

                        <h3 class="mt-5 mb-4">Payment</h3>
                        <hr>

                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element"></div>

                            <div id="card-errors" role="alert"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4">Your order</h3>
                        @include('cart.partials.contents')
                        @include('cart.partials.summary')

                        <button class="mt-4 btn btn-primary btn-block">Place order</button>
                    </div>
                </div>
            </div>
    </form>

</div>
@endsection

@section('scripts')
@include('order.partials.stripe')
@endsection
