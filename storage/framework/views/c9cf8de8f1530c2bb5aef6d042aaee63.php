

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="mb-4 text-gold">Your Shopping Cart</h2>
    <?php if($cartItems->isEmpty()): ?>
        <div class="alert alert-dark border-secondary text-white">Your cart is empty. <a href="<?php echo e(route('watches.index')); ?>" class="text-gold">Go Shop</a></div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="card bg-panel border-secondary">
                    <div class="card-body">
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row align-items-center mb-4 border-bottom border-secondary pb-3">
                            <div class="col-3 col-md-2">
                                <img src="<?php echo e(asset('storage/' . $item->watch->image)); ?>" class="img-fluid rounded">
                            </div>
                            <div class="col-9 col-md-5">
                                <h5 class="text-white"><?php echo e($item->watch->name); ?></h5>
                                <p class="text-muted mb-0">$<?php echo e(number_format($item->watch->price)); ?></p>
                            </div>
                            <div class="col-6 col-md-3 mt-3 mt-md-0 d-flex align-items-center">
                                <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="d-flex">
                                    <?php echo csrf_field(); ?>
                                    <button name="action" value="decrease" class="btn btn-sm btn-outline-secondary text-white">-</button>
                                    <input type="text" value="<?php echo e($item->quantity); ?>" class="form-control bg-dark text-white text-center mx-2" style="width: 40px;" readonly>
                                    <button name="action" value="increase" class="btn btn-sm btn-outline-secondary text-white">+</button>
                                </form>
                            </div>
                            <div class="col-6 col-md-2 mt-3 mt-md-0 text-end">
                                <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-link text-danger text-decoration-none">&times; Remove</button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card bg-panel border-secondary text-white">
                    <div class="card-body">
                        <h4 class="mb-3">Summary</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total</span>
                            <span class="text-gold fs-4">$<?php echo e(number_format($cartItems->sum(fn($i) => $i->watch->price * $i->quantity))); ?></span>
                        </div>
                        <a href="<?php echo e(route('checkout')); ?>" class="btn btn-gold w-100">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/user/cart.blade.php ENDPATH**/ ?>