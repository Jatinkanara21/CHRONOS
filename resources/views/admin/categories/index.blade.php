@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h6 class="text-muted text-uppercase ls-2 mb-2">Structure</h6>
        <h1 class="display-5 fw-bold text-white">Collection <span class="text-gold">Categories</span></h1>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-luxury">
        <i class="bi bi-plus-lg me-2"></i> New Classification
    </a>
</div>

<div class="admin-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th class="ps-4 text-gold text-uppercase ls-2 small">ID</th>
                    <th class="text-gold text-uppercase ls-2 small">Classification Name</th>
                    <th class="text-gold text-uppercase ls-2 small">Inventory Count</th>
                    <th class="text-gold text-uppercase ls-2 small">Created At</th>
                    <th class="text-end pe-4 text-gold text-uppercase ls-2 small">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td class="ps-4 text-muted small">#{{ $category->id }}</td>
                    <td><span class="text-white fw-bold serif-font fs-5">{{ $category->name }}</span></td>
                    <td>
                        <span class="badge bg-dark border border-secondary text-white rounded-0 px-3 py-2">
                            {{ $category->watches_count }} Timepieces
                        </span>
                    </td>
                    <td class="text-white small">{{ $category->created_at->format('M d, Y') }}</td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary rounded-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this classification?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted">No categories defined.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">{{ $categories->links('pagination::bootstrap-5') }}</div>
@endsection