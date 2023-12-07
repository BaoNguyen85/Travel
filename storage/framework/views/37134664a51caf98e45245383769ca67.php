
<?php $__env->startSection('tourguide_content'); ?>
<div class="head-title">
    <h3>TÀI KHOẢN</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
<?php $__currentLoopData = $tourguide_infor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="infor">
        <h2 style="text-align: center">THÔNG TIN TÀI KHOẢN</h2>
        <h2 style="text-align: left; font-size:35px"><i class="fa-solid fa-user"></i></h2>
        <div class="infor-content">
            <b> Họ tên : </b>&nbsp;<?php echo e($inf -> tourguide_name); ?>

        </div>
        <div class="infor-content">
            <b> Ngày sinh : </b>&nbsp;<?php echo e($inf -> tourguide_birth); ?>

        </div>
        <div class="infor-content">
            <b> Giới tính : </b>&nbsp;
            <?php if($inf -> tourguide_sex == 1): ?>
            Nam
            <?php else: ?>
            Nữ
            <?php endif; ?>
        </div>
        <div class="infor-content">
            <b> Email : </b>&nbsp;<?php echo e($inf -> tourguide_email); ?>

        </div>
        <div class="infor-content">
            <b> Số điện thoại : </b>&nbsp;<?php echo e($inf -> tourguide_phone); ?>

        </div>
        <div class="infor-content">
            <b> Địa chỉ : </b>&nbsp;<?php echo e($inf -> tourguide_address); ?>

        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div>
    <a href="<?php echo e(URL::to('/tourguide-infor-edit/'.$tourguideID)); ?>" class="btn-set-infor-admin">Chỉnh sửa</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tourguide_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/tourguide_infor.blade.php ENDPATH**/ ?>