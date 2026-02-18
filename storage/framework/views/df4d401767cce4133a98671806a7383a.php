

<?php $__env->startSection('content'); ?>

<section class="position-relative d-flex align-items-center justify-content-start" style="height: 95vh; margin-top: -90px; overflow: hidden;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(90deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 100%), url('https://images.unsplash.com/photo-1523170335258-f5ed11844a49?q=80&w=2680&auto=format&fit=crop') center/cover no-repeat;">
    </div>
    
    <div class="position-relative z-1 container text-start">
        <div class="row">
            <div class="col-lg-8">
                 <div style="width: 60px; height: 2px; background: var(--gold-flat);" class="mb-4"></div>
                
                <h6 class="text-gold-flat text-uppercase ls-5 mb-3">The 2024 Collection</h6>
                
                <h1 class="display-1 fw-bold text-white mb-4" style="line-height: 1; text-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    ELEGANCE <br> <span class="text-gold-gradient">REDEFINED</span>
                </h1>
                
                <p class="lead text-light opacity-75 mb-5 fw-light ls-3" style="max-width: 500px; font-size: 1rem;">
                    Discover the pinnacle of Swiss engineering. Where heritage meets modernity in perfect horological harmony.
                </p>
                
                <a href="<?php echo e(route('watches.index')); ?>" class="btn btn-gold">Explore The Collection</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 my-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h6 class="text-gold-flat text-uppercase ls-5 mb-2">Curated Selection</h6>
            <h2 class="display-5 text-white">Featured Masterpieces</h2>
        </div>

        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $featuredWatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $watch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="luxury-card">
                    <div class="img-zoom-container">
                        <img src="<?php echo e($watch->image ? asset('storage/' . $watch->image) : 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?q=80&w=2680&auto=format&fit=crop'); ?>" alt="<?php echo e($watch->name); ?>">
                    </div>
                    
                    <div class="card-body p-5 text-center">
                        <small class="text-gold-flat text-uppercase ls-3 d-block mb-3"><?php echo e($watch->brand); ?></small>
                        <h4 class="text-white serif-font mb-4 fs-4"><?php echo e($watch->name); ?></h4>
                        
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top border-secondary border-opacity-25">
                            <span class="text-white fs-5" style="font-weight: 300;">$<?php echo e(number_format($watch->price)); ?></span>
                            <a href="<?php echo e(route('watches.show', $watch->id)); ?>" class="text-gold-flat text-decoration-none ls-3 small">DISCOVER &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted ls-3">The collection is currently being curated.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="position-relative py-5">
    <div class="container-fluid px-0">
        <div class="row g-0">
             <div class="col-lg-6 d-flex align-items-center bg-black" style="min-height: 600px;">
                <div class="p-5 m-lg-5 text-center text-lg-start">
                    <h6 class="text-gold-flat ls-5 mb-3">The Atelier</h6>
                    <h2 class="display-4 serif-font text-white mb-4">Crafting Eternity</h2>
                    <p class="text-muted lh-lg mb-5 ls-3 fw-light" style="max-width: 500px;">
                        Every timepiece is a testament to hundreds of hours of meticulous hand-craftsmanship, ensuring a legacy that lasts generations.
                    </p>
                    <a href="#" class="text-white text-decoration-none pb-2 border-bottom border-warning ls-3 text-uppercase">Read Our Story</a>
                </div>
            </div>
             <div class="col-lg-6" style="min-height: 600px;">
                <img src="https://images.unsplash.com/photo-1619134778706-7015533a6150?q=80&w=2670&auto=format&fit=crop" 
                     class="w-100 h-100 object-fit-cover" 
                     style="filter: grayscale(100%) contrast(1.2) brightness(0.8);" alt="Watchmaker">
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/user/home.blade.php ENDPATH**/ ?>