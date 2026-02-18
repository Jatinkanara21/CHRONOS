@extends('layouts.app')

@section('content')

<div class="container-fluid px-lg-5 pb-5">
    <div class="row g-5">
        
        <div class="col-lg-2">
            <div class="sticky-top" style="top: 120px;">
                <h6 class="text-uppercase mb-4" style="color: var(--gold-flat); letter-spacing: 2px;">Collections</h6>
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('watches.index') }}" class="text-decoration-none {{ !request('category') ? 'text-white fw-bold' : 'text-muted' }} small text-uppercase ls-1">All Timepieces</a>
                    @foreach($navCategories as $cat)
                        <a href="{{ route('watches.index', ['category' => $cat->id]) }}" 
                           class="text-decoration-none {{ request('category') == $cat->id ? 'text-white fw-bold' : 'text-muted' }} small text-uppercase">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>

                <h6 class="text-uppercase mb-4 mt-5" style="color: var(--gold-flat); letter-spacing: 2px;">Brands</h6>
                <div class="d-flex flex-column gap-3">
                    @foreach($brands as $brand)
                        <a href="{{ route('watches.index', ['brand' => $brand]) }}" 
                           class="text-decoration-none {{ request('brand') == $brand ? 'text-white fw-bold' : 'text-muted' }} small text-uppercase">
                            {{ $brand }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-10">
            <div class="row g-4">
                @forelse($watches as $watch)
                <div class="col-md-6 col-xl-4">
                    <div class="luxury-card h-100">
                        <div style="height: 400px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $watch->image) }}" class="w-100 h-100 object-fit-cover" 
                                 style="filter: brightness(0.8);" alt="{{ $watch->name }}">
                        </div>
                        <div class="card-body p-4 text-center">
                            <small class="text-uppercase ls-2 d-block mb-2" style="color: var(--gold-flat);">{{ $watch->brand }}</small>
                            <h4 class="text-white mb-4" style="font-family: 'Cinzel';">{{ $watch->name }}</h4>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                                <span class="text-white fw-light">${{ number_format($watch->price) }}</span>
                                <a href="{{ route('watches.show', $watch->id) }}" class="btn btn-outline-warning btn-sm rounded-0 ls-1">DISCOVER</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h2 class="text-muted serif-font">No timepieces match your selection.</h2>
                </div>
                @endforelse
            </div>
            
            <div class="mt-5 d-flex justify-content-center">
                {{ $watches->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection