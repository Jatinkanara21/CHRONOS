

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h6 class="text-muted text-uppercase ls-2 mb-2">Overview</h6>
        <h1 class="display-5 fw-bold text-white">Performance <span class="text-gold">Metrics</span></h1>
    </div>
    <a href="<?php echo e(route('admin.watches.create')); ?>" class="btn btn-luxury">
        <i class="bi bi-plus-lg me-2"></i> Add New Timepiece
    </a>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="admin-card h-100">
            <div class="d-flex justify-content-between mb-4">
                <i class="bi bi-currency-dollar fs-4 text-gold"></i>
                <span class="badge bg-dark border border-secondary text-muted">YTD</span>
            </div>
            <h6 class="text-muted text-uppercase small ls-2 mb-2">Total Revenue</h6>
            <h3 class="serif-font text-white mb-0">$<?php echo e(number_format(\App\Models\Order::sum('total_price'))); ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="admin-card h-100">
            <div class="d-flex justify-content-between mb-4">
                <i class="bi bi-bag-check fs-4 text-gold"></i>
                <span class="badge bg-dark border border-secondary text-muted">All Time</span>
            </div>
            <h6 class="text-muted text-uppercase small ls-2 mb-2">Total Acquisitions</h6>
            <h3 class="serif-font text-white mb-0"><?php echo e(\App\Models\Order::count()); ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="admin-card h-100">
            <div class="d-flex justify-content-between mb-4">
                <i class="bi bi-watch fs-4 text-gold"></i>
                <span class="badge bg-dark border border-secondary text-muted">Inventory</span>
            </div>
            <h6 class="text-muted text-uppercase small ls-2 mb-2">Active Timepieces</h6>
            <h3 class="serif-font text-white mb-0"><?php echo e(\App\Models\Watch::count()); ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="admin-card h-100">
            <div class="d-flex justify-content-between mb-4">
                <i class="bi bi-people fs-4 text-gold"></i>
                <span class="badge bg-dark border border-secondary text-muted">Clients</span>
            </div>
            <h6 class="text-muted text-uppercase small ls-2 mb-2">Registered Collectors</h6>
            <h3 class="serif-font text-white mb-0"><?php echo e(\App\Models\User::count()); ?></h3>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary">
        <h4 class="fs-5 serif-font text-white mb-0">Recent Acquisitions</h4>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-gold text-decoration-none small text-uppercase ls-2">View All Orders &rarr;</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0">
            <thead>
                <tr>
                    <th>Reference ID</th>
                    <th>Client Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="text-end">Value</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = \App\Models\Order::latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-gold">#ORD-<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></td>
                    <td class="text-white"><?php echo e($order->user->name); ?></td>
                    <td><?php echo e($order->created_at->format('M d, Y')); ?></td>
                    <td>
                        <?php if($order->status == 'pending'): ?>
                            <span class="badge bg-warning text-dark rounded-0">Pending</span>
                        <?php elseif($order->status == 'completed'): ?>
                            <span class="badge bg-success rounded-0">Completed</span>
                        <?php else: ?>
                            <span class="badge bg-secondary rounded-0"><?php echo e(ucfirst($order->status)); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end fw-bold text-white">$<?php echo e(number_format($order->total_price)); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-outline-secondary rounded-0 text-uppercase" style="font-size: 0.6rem;">Details</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>