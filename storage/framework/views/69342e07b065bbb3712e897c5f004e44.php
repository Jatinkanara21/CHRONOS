

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h6 class="text-muted text-uppercase ls-2 mb-2">Sales</h6>
        <h1 class="display-5 fw-bold text-white">Transaction <span class="text-gold">Log</span></h1>
    </div>
</div>

<div class="admin-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th class="ps-4">Order ID</th>
                    <th>Client Identity</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total Value</th>
                    <th class="text-end pe-4">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="ps-4 py-3">
                        <span class="text-gold font-monospace">#ORD-<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></span>
                    </td>
                    <td>
                        <span class="text-white d-block"><?php echo e($order->user->name); ?></span>
                        <small class="text-muted"><?php echo e($order->user->email); ?></small>
                    </td>
                    <td class="text-muted small"><?php echo e($order->created_at->format('M d, Y • h:i A')); ?></td>
                    <td>
                        <?php
                            $statusColors = [
                                'pending' => 'warning',
                                'processing' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                            $color = $statusColors[$order->status] ?? 'secondary';
                        ?>
                        <span class="badge bg-<?php echo e($color); ?> bg-opacity-10 text-<?php echo e($color); ?> border border-<?php echo e($color); ?> rounded-0 text-uppercase ls-1">
                            <?php echo e($order->status); ?>

                        </span>
                    </td>
                    <td class="fw-bold text-white">$<?php echo e(number_format($order->total_price)); ?></td>
                    <td class="text-end pe-4">
                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-outline-secondary rounded-0 text-uppercase" style="font-size: 0.7rem;">
                            Inspect
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">No transactions recorded.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    <?php echo e($orders->links('pagination::bootstrap-5')); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>