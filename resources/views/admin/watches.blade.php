@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h6 class="text-muted text-uppercase ls-2 mb-2">Inventory Control</h6>
        <h1 class="display-5 fw-bold text-white">Timepiece <span class="text-gold">Manifest</span></h1>
    </div>
    <a href="{{ route('admin.watches.create') }}" class="btn btn-luxury">
        <i class="bi bi-plus-lg me-2"></i> Acquire New
    </a>
</div>

<div class="admin-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th class="ps-4 text-gold text-uppercase ls-2 small" style="border-bottom-color: rgba(255,255,255,0.1);">Visual</th>
                    <th class="text-gold text-uppercase ls-2 small" style="border-bottom-color: rgba(255,255,255,0.1);">Reference / Name</th>
                    <th class="text-gold text-uppercase ls-2 small" style="border-bottom-color: rgba(255,255,255,0.1);">Brand House</th>
                    <th class="text-gold text-uppercase ls-2 small" style="border-bottom-color: rgba(255,255,255,0.1);">Valuation</th>
                    <th class="text-gold text-uppercase ls-2 small" style="border-bottom-color: rgba(255,255,255,0.1);">Status</th>
                    <th class="text-end pe-4 text-gold text-uppercase ls-2 small" style="border-bottom-color: rgba(255,255,255,0.1);">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($watches as $watch)
                <tr>
                    <td class="ps-4 py-3" style="width: 100px;">
                        <div style="width: 60px; height: 60px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); background: #000;">
                            <img src="{{ asset('storage/' . $watch->image) }}" 
                                 class="w-100 h-100 object-fit-cover opacity-75" 
                                 alt="watch thumbnail">
                        </div>
                    </td>
                    
                    <td>
                        <span class="text-white fw-bold d-block serif-font">{{ $watch->name }}</span>
                        <small class="text-muted text-uppercase ls-1" style="font-size: 0.65rem;">REF: {{ str_pad($watch->id, 5, '0', STR_PAD_LEFT) }}</small>
                    </td>
                    
                    <td class="text-white text-uppercase ls-2 small">{{ $watch->brand }}</td>
                    
                    <td class="text-white fw-light">${{ number_format($watch->price) }}</td>
                    
                    <td>
                        @if($watch->stock > 0)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-0 text-uppercase ls-1" style="font-size: 0.6rem;">In Stock ({{ $watch->stock }})</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-0 text-uppercase ls-1" style="font-size: 0.6rem;">Depleted</span>
                        @endif
                    </td>
                    
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.watches.edit', $watch->id) }}" class="btn btn-sm btn-outline-secondary rounded-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            <form action="{{ route('admin.watches.destroy', $watch->id) }}" method="POST" onsubmit="return confirm('Archive this timepiece from the collection?');">
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
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted ls-2 text-uppercase">
                        No timepieces found in the archives.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $watches->links('pagination::bootstrap-5') }}
</div>

@endsection