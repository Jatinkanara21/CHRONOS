@extends('layouts.app')

@section('content')

<div class="container-fluid px-lg-5 pb-5">
    <div class="row g-0">
        
        <div class="col-lg-7 pe-lg-5">
            <div class="sticky-top" style="top: 120px;">
                <div class="luxury-card border-0 overflow-hidden shadow-lg" style="height: 80vh;">
                    <img src="{{ asset('storage/' . $watch->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $watch->name }}">
                </div>
            </div>
        </div>

        <div class="col-lg-5 ps-lg-5 mt-5 mt-lg-0">
            <h6 class="text-uppercase mb-3 ls-2" style="color: var(--gold-flat);">{{ $watch->brand }}</h6>
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Cinzel';">{{ $watch->name }}</h1>
            <h2 class="text-white fw-light mb-5">${{ number_format($watch->price) }}</h2>
            
            <p class="text-muted lh-lg mb-5 fw-light" style="font-size: 1.1rem;">
                {{ $watch->description }}
            </p>

            <div class="border-top border-secondary pt-4 mb-5">
                <div class="row mb-3">
                    <div class="col-4 text-muted small text-uppercase ls-1">Availability</div>
                    <div class="col-8 {{ $watch->stock > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $watch->stock > 0 ? 'Available for Acquisition' : 'Sold Out' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-muted small text-uppercase ls-1">Condition</div>
                    <div class="col-8">Pristine / Collector's Grade</div>
                </div>
            </div>

            <form action="{{ route('cart.add', $watch->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-luxury w-100 py-3" {{ $watch->stock < 1 ? 'disabled' : '' }}>
                    {{ $watch->stock > 0 ? 'Acquire Timepiece' : 'Out of Stock' }}
                </button>
            </form>
        </div>
    </div>
</div>

@endsection