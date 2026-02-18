@extends('layouts.admin')

@section('content')

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h6 class="text-muted text-uppercase ls-2 mb-2">Transaction Details</h6>
            <h1 class="display-6 fw-bold text-white">Order <span class="text-gold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></h1>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-0 text-uppercase ls-2" style="font-size: 0.7rem;">&larr; Back to Log</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <h5 class="serif-font text-white border-bottom border-secondary pb-3 mb-4">Acquired Items</h5>
                
                @foreach($order->items as $item)
                <div class="d-flex align-items-center border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                    <div style="width: 60px; height: 60px; background: #000; border: 1px solid #333; margin-right: 1rem;">
                        @if($item->watch)
                        <img src="{{ asset('storage/' . $item->watch->image) }}" class="w-100 h-100 object-fit-cover opacity-75">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-white mb-0">{{ $item->watch->name ?? 'Unknown Item' }}</h6>
                        <small class="text-gold text-uppercase ls-1">{{ $item->watch->brand ?? 'N/A' }}</small>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">Qty: {{ $item->quantity }}</div>
                        <div class="text-white fw-bold">${{ number_format($item->price) }}</div>
                    </div>
                </div>
                @endforeach

                <div class="d-flex justify-content-between align-items-center pt-3">
                    <span class="text-muted text-uppercase ls-2">Total Transaction Value</span>
                    <span class="fs-3 serif-font text-gold">${{ number_format($order->total_price) }}</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-4">
                <h6 class="text-muted text-uppercase ls-2 mb-4">Client Profile</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center text-gold border border-secondary" style="width: 40px; height: 40px; margin-right: 15px;">
                        <i class="bi bi-person"></i>
                    </div>
                    <div>
                        <div class="text-white">{{ $order->user->name }}</div>
                        <small class="text-muted">{{ $order->user->email }}</small>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                    <small class="text-muted d-block mb-1">Shipping Address</small>
                    <div class="text-white small">{{ $order->address }}</div>
                </div>
            </div>

            <div class="admin-card">
                <h6 class="text-muted text-uppercase ls-2 mb-4">Update Status</h6>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select form-select-dark rounded-0 mb-3 bg-dark text-white border-secondary">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button class="btn btn-luxury w-100">Update Record</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection