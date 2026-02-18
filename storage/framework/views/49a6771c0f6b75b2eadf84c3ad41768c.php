

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h6 class="text-muted text-uppercase ls-2 mb-2">Modification</h6>
                <h1 class="display-6 fw-bold text-white">Update <span class="text-gold">Record</span></h1>
            </div>
            <a href="<?php echo e(route('admin.watches.index')); ?>" class="btn btn-outline-light rounded-0 text-uppercase ls-2" style="font-size: 0.7rem; opacity: 0.7;">
                &larr; Cancel
            </a>
        </div>

        <div class="admin-card">
            <form action="<?php echo e(route('admin.watches.update', $watch->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="row g-4">
                    <div class="col-12 mb-4 text-center">
                        <label class="form-label text-gold text-uppercase small ls-2 d-block mb-3">Current Asset</label>
                        <div class="d-inline-block p-1 border border-secondary" style="background: #000;">
                            <img src="<?php echo e(asset('storage/' . $watch->image)); ?>" alt="Current Image" style="width: 150px; height: 150px; object-fit: cover; opacity: 0.8;">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Timepiece Reference Name</label>
                        <input type="text" name="name" value="<?php echo e($watch->name); ?>" class="form-control form-control-dark rounded-0 py-3" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Brand House</label>
                        <input type="text" name="brand" value="<?php echo e($watch->brand); ?>" class="form-control form-control-dark rounded-0 py-3" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Classification</label>
                        <select name="category_id" class="form-select form-select-dark rounded-0 py-3" required>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e($watch->category_id == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Valuation (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary text-muted border-end-0 rounded-0">$</span>
                            <input type="number" name="price" value="<?php echo e($watch->price); ?>" class="form-control form-control-dark border-start-0 rounded-0 py-3" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gold text-uppercase small ls-2">Inventory Count</label>
                        <input type="number" name="stock" value="<?php echo e($watch->stock); ?>" class="form-control form-control-dark rounded-0 py-3" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Heritage & Technical Details</label>
                        <textarea name="description" class="form-control form-control-dark rounded-0" rows="5" required><?php echo e($watch->description); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-gold text-uppercase small ls-2">Update Visual Asset (Optional)</label>
                        <input type="file" name="image" class="form-control form-control-dark rounded-0">
                        <small class="text-white opacity-50 mt-2 d-block">Leave blank to keep current image.</small>
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-luxury w-100 py-3 ls-2">
                            Update Record
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control-dark, .form-select-dark {
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        transition: all 0.3s ease;
    }
    
    .form-control-dark:focus, .form-select-dark:focus {
        background-color: rgba(0, 0, 0, 0.4);
        border-color: #d4af37;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.15);
        color: #fff;
        outline: none;
    }

    .form-select-dark option {
        background-color: #1a1a1a;
        color: #fff;
    }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\watch_store\resources\views/admin/edit-watch.blade.php ENDPATH**/ ?>