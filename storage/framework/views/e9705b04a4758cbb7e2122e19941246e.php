

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <a href="<?php echo e(route('orders.history')); ?>" class="text-gold mb-4 d-inline-block text-decoration-none">&larr; Back to Orders</a>
    
    <div class="card bg-panel border-secondary text-white">
        <div class="card-header border-secondary bg-transparent d-flex justify-content-between align-items-center py-3">
            <h4 class="mb-0">Order <span class="text-gold"><?php echo e($order->order_number); ?></span></h4>
            <span class="badge bg-gold text-dark fs-6"><?php echo e(ucfirst($order->status)); ?></span>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="text-muted small text-uppercase">Shipping To</h5>
                    <p class="mb-1"><?php echo e(Auth::user()->name); ?></p>
                    <p class="mb-1"><?php echo e($order->shipping_address); ?></p>
                    <p class="mb-0">Phone: <?php echo e($order->phone); ?></p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <h5 class="text-muted small text-uppercase">Order Date</h5>
                    <p><?php echo e($order->created_at->format('F d, Y h:i A')); ?></p>
                </div>
            </div>

            <h5 class="text-gold border-bottom border-secondary pb-2 mb-3">Order Items</h5>
            <div class="table-responsive">
                <table class="table table-dark table-borderless">
                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-bottom border-secondary">
                            <td style="width: 80px;">
                                <?php if($item->watch && $item->watch->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->watch->image)); ?>" width="60" class="rounded border border-secondary">
                                <?php else: ?>
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <small>N/A</small>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <h6 class="mb-0"><?php echo e($item->watch_name); ?></h6>
                                <small class="text-muted">$<?php echo e(number_format($item->price)); ?> x <?php echo e($item->quantity); ?></small>
                            </td>
                            <td class="align-middle text-end">
                                <span class="text-gold">$<?php echo e(number_format($item->price * $item->quantity)); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-end pt-4"><strong>Total Amount</strong></td>
                            <td class="text-end pt-4"><h4 class="text-gold">$<?php echo e(number_format($order->total_price)); ?></h4></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/user/orders/show.blade.php ENDPATH**/ ?>