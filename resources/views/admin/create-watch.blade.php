@extends('layouts.admin')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h6 class="text-muted text-uppercase ls-2 mb-2">Cataloging</h6>
                <h1 class="fs-3 fw-bold text-white">New <span class="text-gold">Acquisition</span></h1>
            </div>
            <a href="{{ route('admin.watches.index') }}" class="btn btn-outline-light rounded-0 text-uppercase ls-2" style="font-size: 0.7rem; opacity: 0.7;">
                &larr; Return to Archive
            </a>
        </div>

        <div class="admin-card">
            <form action="{{ route('admin.watches.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Timepiece Reference Name</label>
                        <input type="text" name="name" class="form-control form-control-dark rounded-0 py-3" placeholder="e.g. Royal Oak Offshore" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Brand House</label>
                        <input type="text" name="brand" class="form-control form-control-dark rounded-0 py-3" placeholder="e.g. Audemars Piguet" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Classification</label>
                        <select name="category_id" class="form-select form-select-dark rounded-0 py-3" required>
                            <option value="" selected disabled>Select Classification...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Valuation (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary text-muted border-end-0 rounded-0">$</span>
                            <input type="number" name="price" class="form-control form-control-dark border-start-0 rounded-0 py-3" placeholder="0.00" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Inventory Count</label>
                        <input type="number" name="stock" class="form-control form-control-dark rounded-0 py-3" placeholder="1" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Heritage & Technical Details</label>
                        <textarea name="description" class="form-control form-control-dark rounded-0" rows="5" placeholder="Describe the movement, caliber, and history..." required></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Visual Asset</label>
                        <input type="file" name="image" class="form-control form-control-dark rounded-0">
                        <small class="text-white opacity-50 mt-2 d-block">Recommended: 1200x1200px (JPG/PNG)</small>
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