@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-gold">Checkout</h2>
    <div class="row">
        <div class="col-md-7">
            <div class="card bg-panel border-secondary p-4 text-white">
                <h4 class="mb-3">Shipping Details</h4>
                <form action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" required placeholder="+1 234 567 8900">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Shipping Address</label>
                        <textarea name="address" class="form-control" rows="3" required placeholder="123 Luxury Ave, New York, NY"></textarea>
                    </div>
                    <button class="btn btn-gold w-100 mt-3">Confirm Order</button>
                </form>
            </div>
        </div>
        <div class="col-md-5 mt-4 mt-md-0">
            <div class="card bg-panel border-secondary text-white p-4">
                <h4 class="mb-3">Order Summary</h4>
                @foreach($cartItems as $item)
                <div class="d-flex justify-content-between mb-2 border-bottom border-secondary pb-2">
                    <span>{{ $item->quantity }}x {{ $item->watch->name }}</span>
                    <span>${{ number_format($item->watch->price * $item->quantity) }}</span>
                </div>
                @endforeach
                <div class="d-flex justify-content-between mt-3">
                    <h4>Total</h4>
                    <h4 class="text-gold">${{ number_format($total) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection