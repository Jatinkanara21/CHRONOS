@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h6 class="text-muted text-uppercase ls-2 mb-2">Comms & Alerts</h6>
        <h1 class="fs-2 fw-bold text-white">Notification <span class="text-gold">Panel</span></h1>
    </div>
</div>

<div class="row g-4">
    <!-- Global Toggle -->
    <div class="col-md-4">
        <div class="admin-card">
            <h5 class="text-white serif-font mb-3">Global Status</h5>
            <p class="text-muted small mb-4">Disable or Enable system triggers globally for all endpoints.</p>
            <form action="{{ route('admin.notifications.toggle') }}" method="POST">
                @csrf
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input bg-secondary border-0" type="checkbox" name="enabled" value="1" id="switchGlobal" onchange="this.form.submit()" {{ $enabled == '1' ? 'checked' : '' }}>
                    <label class="form-check-label text-white ms-2" for="switchGlobal">
                        {{ $enabled == '1' ? 'Active' : 'Disabled' }}
                    </label>
                </div>
            </form>
        </div>
    </div>

    <!-- Broadcast System -->
    <div class="col-md-8">
        <div class="admin-card">
            <h5 class="text-white serif-font mb-3">Broadcast Alert</h5>
            <p class="text-muted small mb-4">Send custom email and database alerts to all registered users.</p>
            <form action="{{ route('admin.notifications.broadcast') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-gold small text-uppercase ls-1">Subject / Title</label>
                    <input type="text" name="title" class="form-control bg-dark border-secondary text-white rounded-0" required placeholder="Ex: Boutique Anniversary Sale">
                </div>
                <div class="mb-3">
                    <label class="form-label text-gold small text-uppercase ls-1">Message Content</label>
                    <textarea name="message" rows="3" class="form-control bg-dark border-secondary text-white rounded-0" required placeholder="Ex: Enjoy 15% off and complimentary shipping this weekend..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label text-gold small text-uppercase ls-1">Landing Actions (files)</label>
                    <input type="file" name="file" class="form-control bg-dark border-secondary text-white rounded-0" accept="image/*">
                </div>
                <button class="btn btn-luxury w-100">Dispatch Broadcast</button>
            </form>
        </div>
    </div>
</div>

<div class="admin-card mt-4">
    <h5 class="text-white serif-font mb-4 pb-2 border-bottom border-secondary border-opacity-25">Notification History Log</h5>
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0">
            <thead>
                <tr>
                    <th class="small text-uppercase text-gold">Recipients</th>
                    <th class="small text-uppercase text-gold">Type</th>
                    <th class="small text-uppercase text-gold">Payload Preview</th>
                    <th class="small text-uppercase text-gold">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                @php $data = is_array($log->data) ? $log->data : json_decode($log->data, true); @endphp
                <tr>
                    <td>{{ $log->notifiable_type == 'App\Models\User' ? 'User #'.$log->notifiable_id : 'Group' }}</td>
                    <td><span class="badge bg-secondary rounded-0 small text-uppercase">{{ class_basename($log->type) }}</span></td>
                    <td class="text-white small">
                        <strong>{{ $data['title'] ?? 'Alert' }}</strong>: {{ \Illuminate\Support\Str::limit($data['message'] ?? '...', 40) }}
                    </td>
                    <td class="text-muted small">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted small">No notification history records logged inside the workspace.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
