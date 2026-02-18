

<?php $__env->startSection('content'); ?>

<div class="container-fluid px-lg-5 pb-5">
    <div class="row g-5">
        
        <div class="col-lg-2">
            <div class="sticky-top" style="top: 120px;">
                <h6 class="text-uppercase mb-4" style="color: var(--gold-flat); letter-spacing: 2px;">Collections</h6>
                <div class="d-flex flex-column gap-3">
                    <a href="<?php echo e(route('watches.index')); ?>" class="text-decoration-none <?php echo e(!request('category') ? 'text-white fw-bold' : 'text-muted'); ?> small text-uppercase ls-1">All Timepieces</a>
                    <?php $__currentLoopData = $navCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('watches.index', ['category' => $cat->id])); ?>" 
                           class="text-decoration-none <?php echo e(request('category') == $cat->id ? 'text-white fw-bold' : 'text-muted'); ?> small text-uppercase">
                            <?php echo e($cat->name); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <h6 class="text-uppercase mb-4 mt-5" style="color: var(--gold-flat); letter-spacing: 2px;">Brands</h6>
                <div class="d-flex flex-column gap-3">
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('watches.index', ['brand' => $brand])); ?>" 
                           class="text-decoration-none <?php echo e(request('brand') == $brand ? 'text-white fw-bold' : 'text-muted'); ?> small text-uppercase">
                            <?php echo e($brand); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-10">
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $watches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $watch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-xl-4">
                    <div class="luxury-card h-100">
                        <div style="height: 400px; overflow: hidden;">
                            <img src="<?php echo e(asset('storage/' . $watch->image)); ?>" class="w-100 h-100 object-fit-cover" 
                                 style="filter: brightness(0.8);" alt="<?php echo e($watch->name); ?>">
                        </div>
                        <div class="card-body p-4 text-center">
                            <small class="text-uppercase ls-2 d-block mb-2" style="color: var(--gold-flat);"><?php echo e($watch->brand); ?></small>
                            <h4 class="text-white mb-4" style="font-family: 'Cinzel';"><?php echo e($watch->name); ?></h4>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                                <span class="text-white fw-light">$<?php echo e(number_format($watch->price)); ?></span>
                                <a href="<?php echo e(route('watches.show', $watch->id)); ?>" class="btn btn-outline-warning btn-sm rounded-0 ls-1">DISCOVER</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <h2 class="text-muted serif-font">No timepieces match your selection.</h2>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="mt-5 d-flex justify-content-center">
                <?php echo e($watches->links('pagination::bootstrap-5')); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/user/watches.blade.php ENDPATH**/ ?>