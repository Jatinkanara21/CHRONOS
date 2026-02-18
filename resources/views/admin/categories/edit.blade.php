@extends('layouts.admin')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h6 class="text-muted text-uppercase ls-2 mb-2">Modification</h6>
                <h1 class="display-6 fw-bold text-white">Edit <span class="text-gold">Classification</span></h1>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-light rounded-0 text-uppercase ls-2" style="font-size: 0.7rem; opacity: 0.7;">&larr; Cancel</a>
        </div>

        <div class="admin-card">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label text-gold text-uppercase small ls-2">Category Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control form-control-dark rounded-0 py-3" required>
                </div>

                <div class="mb-4">
                     <label class="form-label text-gold text-uppercase small ls-2">Description</label>
                     <textarea name="description" class="form-control form-control-dark rounded-0" rows="3">{{ $category->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-luxury w-100 py-3 ls-2">Update Classification</button>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control-dark {
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
    }
    .form-control-dark:focus {
        background-color: rgba(0, 0, 0, 0.4);
        border-color: #d4af37;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.15);
        color: #fff;
        outline: none;
    }
</style>
@endsection