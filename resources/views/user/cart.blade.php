@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-gold">Your Shopping Cart</h2>
    @if($cartItems->isEmpty())
        <div class="alert alert-dark border-secondary text-white">Your cart is empty. <a href="{{ route('watches.index') }}" class="text-gold">Go Shop</a></div>
    @else
        <div class="row">
            <div class="col-lg-8">
                <div class="card bg-panel border-secondary">
                    <div class="card-body">
                        @foreach($cartItems as $item)
                        <div class="row align-items-center mb-4 border-bottom border-secondary pb-3">
                            <div class="col-3 col-md-2">
                                <img src="{{ asset('storage/' . $item->watch->image) }}" class="img-fluid rounded">
                            </div>
                            <div class="col-9 col-md-5">
                                <h5 class="text-white">{{ $item->watch->name }}</h5>
                                <p class="text-muted mb-0">${{ number_format($item->watch->price) }}</p>
                            </div>
                            <div class="col-6 col-md-3 mt-3 mt-md-0 d-flex align-items-center">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    <button name="action" value="decrease" class="btn btn-sm btn-outline-secondary text-white">-</button>
                                    <input type="text" value="{{ $item->quantity }}" class="form-control bg-dark text-white text-center mx-2" style="width: 40px;" readonly>
                                    <button name="action" value="increase" class="btn btn-sm btn-outline-secondary text-white">+</button>
                                </form>
                            </div>
                            <div class="col-6 col-md-2 mt-3 mt-md-0 text-end">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-danger text-decoration-none">&times; Remove</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card bg-panel border-secondary text-white">
                    <div class="card-body">
                        <h4 class="mb-3">Summary</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total</span>
                            <span class="text-gold fs-4">${{ number_format($cartItems->sum(fn($i) => $i->watch->price * $i->quantity)) }}</span>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-gold w-100">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection