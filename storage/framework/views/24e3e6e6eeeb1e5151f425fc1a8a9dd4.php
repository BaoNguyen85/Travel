
<?php $__env->startSection('tourguide_content'); ?>
    <div class="head-title">
        <h3>THỐNG KÊ</h3>
    </div>
    <div class="colum-access">
        <div class="colum-access1">
            <label style="font-size: 17px">Tổng đơn hàng</label>
            <?php
                $tourTotal = 0;
            ?>
            <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($tourguideID == $tourdetail->tourguide_id): ?>
                    <?php
                    $tourTotal++;
                    ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <h1 style="padding-top: 6%"><?php echo e($tourTotal); ?> &nbsp;<i class="fa-solid fa-cart-shopping"></i></h1>
        </div>
        <div class="colum-access2">
            <label style="font-size: 17px">Chưa hoàn thành</label>
            <?php
                $tournotsuccessTotal = 0;
            ?>
            <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($tourguideID == $tourdetail->tourguide_id && $tourdetail->tour_success==0): ?>
                    <?php
                    $tournotsuccessTotal++;
                    ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <h1 style="padding-top: 6%"><?php echo e($tournotsuccessTotal); ?> &nbsp;<i class="fa-solid fa-xmark"></i></h1>
        </div>
        <div class="colum-access3">
            <label style="font-size: 17px">Đã hoàn thành</label>
            <?php
                $toursuccessTotal = 0;
            ?>
            <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($tourguideID == $tourdetail->tourguide_id && $tourdetail->tour_success==1): ?>
                    <?php
                    $toursuccessTotal++;
                    ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <h1 style="padding-top: 6%"><?php echo e($toursuccessTotal); ?> &nbsp;<i class="fa-solid fa-check"></i></h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tourguide_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/tourguideDashboard.blade.php ENDPATH**/ ?>