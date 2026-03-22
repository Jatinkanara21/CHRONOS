@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-gold Serif-font">Your Wishlist</h2>
    @if($wishlistItems->isEmpty())
        <div class="alert alert-dark border-secondary text-white">
            Your wishlist is currently empty. 
            <a href="{{ route('watches.index') }}" class="text-gold text-decoration-none">Explore Timepieces</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($wishlistItems as $item)
            <div class="col-md-4 col-xl-3">
                <div class="luxury-card h-100">
                    <div style="height: 300px; overflow: hidden; position: relative;">
                        <img src="{{ asset('storage/' . $item->watch->image) }}" class="w-100 h-100 object-fit-cover" style="filter: brightness(0.8);" alt="{{ $item->watch->name }}">
                        
                        <form action="{{ route('wishlist.remove', $item->watch->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                            @csrf
                            <button class="btn btn-dark bg-opacity-75 btn-sm border-0 rounded-circle text-danger" title="Remove from wishlist">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body p-4 text-center">
                        <small class="text-uppercase ls-2 d-block mb-2 text-gold-flat">{{ $item->watch->brand }}</small>
                        <h6 class="text-white mb-3 serif-font" style="font-size: 0.9rem;">{{ $item->watch->name }}</h6>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-25">
                            <span class="text-white fw-light small">${{ number_format($item->watch->price) }}</span>
                            <form action="{{ route('cart.add', $item->watch->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-warning btn-sm rounded-0 ls-1" style="font-size: 0.65rem;">ADD TO BAG</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
