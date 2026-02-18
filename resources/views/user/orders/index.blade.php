@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-gold mb-4">My Order History</h2>
    
    @if($orders->isEmpty())
        <div class="alert alert-dark border-secondary text-white">
            You haven't placed any orders yet. <a href="{{ route('watches.index') }}" class="text-gold">Start Shopping</a>
        </div>
    @else
        <div class="card bg-panel border-secondary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr class="text-gold">
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($order->status) {
                                            'pending' => 'bg-warning text-dark',
                                            'shipped' => 'bg-primary',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>${{ number_format($order->total_price) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-gold">View Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection