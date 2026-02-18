

<?php $__env->startSection('content'); ?>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card bg-panel p-5 border-0 shadow-lg" style="width: 100%; max-width: 450px;">
        <div class="text-center mb-4">
            <h3 class="mb-1">Welcome Back</h3>
            <p class="text-muted small">Sign in to access your collection</p>
        </div>
        
        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger bg-transparent text-danger border-danger mb-4">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <button class="btn btn-gold w-100 py-3 mb-3">Sign In</button>
            <div class="text-center">
                <span class="text-muted small">Don't have an account?</span> 
                <a href="<?php echo e(route('register')); ?>" class="text-gold text-decoration-none small ms-1">Create Account</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/auth/login.blade.php ENDPATH**/ ?>