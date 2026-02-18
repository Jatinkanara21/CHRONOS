@extends('layouts.admin')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h6 class="text-muted text-uppercase ls-2 mb-2">Cataloging</h6>
                <h1 class="display-6 fw-bold text-white">New <span class="text-gold">Acquisition</span></h1>
            </div>
            <a href="{{ route('admin.watches.index') }}" class="btn btn-outline-light rounded-0 text-uppercase ls-2" style="font-size: 0.7rem; opacity: 0.7;">
                &larr; Return to Archive
            </a>
        </div>

        <div class="admin-card">
            <form action="{{ route('admin.watches.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    {{-- NAME --}}
                    <div class="col-md-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Timepiece Reference Name</label>
                        <input type="text" 
                               name="name" 
                               class="form-control form-control-dark rounded-0 py-3 @error('name') is-invalid @enderror" 
                               placeholder="e.g. Royal Oak Offshore" 
                               value="{{ old('name') }}" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BRAND --}}
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Brand House</label>
                        <input type="text" 
                               name="brand" 
                               class="form-control form-control-dark rounded-0 py-3 @error('brand') is-invalid @enderror" 
                               placeholder="e.g. Audemars Piguet" 
                               value="{{ old('brand') }}" 
                               required>
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- CATEGORY --}}
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Classification</label>
                        <select name="category_id" class="form-select form-select-dark rounded-0 py-3 @error('category_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Select Classification...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PRICE --}}
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Valuation (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary text-muted border-end-0 rounded-0">$</span>
                            <input type="number" 
                                   name="price" 
                                   step="0.01" 
                                   min="0"
                                   class="form-control form-control-dark border-start-0 rounded-0 py-3 @error('price') is-invalid @enderror" 
                                   placeholder="0.00" 
                                   value="{{ old('price') }}" 
                                   required>
                        </div>
                        @error('price')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- STOCK --}}
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Inventory Count</label>
                        <input type="number" 
                               name="stock" 
                               min="0"
                               class="form-control form-control-dark rounded-0 py-3 @error('stock') is-invalid @enderror" 
                               placeholder="1" 
                               value="{{ old('stock', 1) }}" 
                               required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="col-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Heritage & Technical Details</label>
                        <textarea name="description" 
                                  class="form-control form-control-dark rounded-0 @error('description') is-invalid @enderror" 
                                  rows="5" 
                                  placeholder="Describe the movement, caliber, and history..." 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Visual Asset</label>
                        <input type="file" 
                               name="image" 
                               accept="image/*"
                               class="form-control form-control-dark rounded-0 @error('image') is-invalid @enderror">
                        <small class="text-white opacity-50 mt-2 d-block">Recommended: 1200x1200px (JPG/PNG)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-luxury w-100 py-3 ls-2">
                            Catalog Timepiece
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control-dark, .form-select-dark {
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        transition: all 0.3s ease;
    }
    
    .form-control-dark:focus, .form-select-dark:focus {
        background-color: rgba(0, 0, 0, 0.4);
        border-color: #d4af37;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.15);
        color: #fff;
        outline: none;
    }
    
    /* Error state styling */
    .form-control-dark.is-invalid, .form-select-dark.is-invalid {
        border-color: #dc3545; /* Red border */
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.25);
    }
    
    .form-control-dark::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }
    
    /* Fix for select dropdown options visibility */
    .form-select-dark option {
        background-color: #1a1a1a;
        color: #fff;
    }
</style>

@endsection