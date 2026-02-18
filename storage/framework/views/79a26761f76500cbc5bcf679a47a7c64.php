

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="text-gold mb-4">My Order History</h2>
    
    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-dark border-secondary text-white">
            You haven't placed any orders yet. <a href="<?php echo e(route('watches.index')); ?>" class="text-gold">Start Shopping</a>
        </div>
    <?php else: ?>
        <div class="card bg-panel border-secondary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr class="text-gold">
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($order->order_number); ?></td>
                                <td><?php echo e($order->created_at->format('M d, Y')); ?></td>
                                <td>
                                    <?php
                                        $badgeClass = match($order->status) {
                                            'pending' => 'bg-warning text-dark',
                                            'shipped' => 'bg-primary',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    ?>
                                    <span class="badge <?php echo e($badgeClass); ?>"><?php echo e(ucfirst($order->status)); ?></span>
                                </td>
                                <td>$<?php echo e(number_format($order->total_price)); ?></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="btn btn-sm btn-gold">View Details</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <?php echo e($orders->links('pagination::bootstrap-5')); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/user/orders/index.blade.php ENDPATH**/ ?>