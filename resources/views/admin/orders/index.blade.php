@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h6 class="text-muted text-uppercase ls-2 mb-2">Sales</h6>
        <h1 class="display-5 fw-bold text-white">Transaction <span class="text-gold">Log</span></h1>
    </div>
</div>

<div class="admin-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th class="ps-4">Order ID</th>
                    <th>Client Identity</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total Value</th>
                    <th class="text-end pe-4">Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="ps-4 py-3">
                        <span class="text-gold font-monospace">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <span class="text-white d-block">{{ $order->user->name }}</span>
                        <small class="text-muted">{{ $order->user->email }}</small>
                    </td>
                    <td class="text-muted small">{{ $order->created_at->format('M d, Y • h:i A') }}</td>
                    <td>
                        @php
                            $statusColors = [
                                'pending' => 'warning',
                                'processing' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                            $color = $statusColors[$order->status] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} border border-{{ $color }} rounded-0 text-uppercase ls-1">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="fw-bold text-white">${{ number_format($order->total_price) }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary rounded-0 text-uppercase" style="font-size: 0.7rem;">
                            Inspect
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No transactions recorded.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $orders->links('pagination::bootstrap-5') }}
</div>

@endsection