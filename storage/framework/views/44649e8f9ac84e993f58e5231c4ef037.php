<?php $__currentLoopData = $suggestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="suggestion-item" data-tourname="<?php echo e($tour->tour_name); ?>">
        <?php echo e($tour->tour_name); ?>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\XAMPP\htdocs\travel\resources\views/search-suggestions.blade.php ENDPATH**/ ?>