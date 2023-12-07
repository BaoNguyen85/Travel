
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>CẬP NHẬT THÔNG TIN TÀI KHOẢN</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
<?php $__currentLoopData = $edit_admin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form method="post" action="<?php echo e(URL::to ('/update-admin/'.$edit->admin_id)); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>


<div class="infor">
    <h2 style="text-align: left; font-size:35px"><i class="fa-solid fa-user"></i></h2>
    <div class="infor-content">
        <b>Họ tên : </b>&nbsp;<input name="admin_name" class="input-infor" value="<?php echo e($edit -> admin_name); ?>" type="text">
    </div>
    <div class="infor-content">
        <b>Ngày sinh : </b>&nbsp;<input name="admin_birth" class="input-infor" value="<?php echo e($edit -> admin_birth); ?>" type="date">
    </div>
    <div class="infor-content">
        <b>Email : </b>&nbsp;<input name="admin_email" class="input-infor" value="<?php echo e($edit -> admin_email); ?>" type="text">
    </div>
    <div class="infor-content">
        <b>Số điện thoại : </b>&nbsp;<input name="admin_phone" class="input-infor" value="<?php echo e($edit -> admin_phone); ?>" type="text">
    </div>
    <div class="infor-content">
        <b>Địa chỉ : </b>&nbsp;<input name="admin_address" class="input-infor" value="<?php echo e($edit -> admin_address); ?>" type="text">
    </div>
    <div class="infor-content">
        <b>Mật khẩu : </b>&nbsp;<input name="admin_password" class="input-infor" value="<?php echo e($edit -> admin_password); ?>" type="password">
    </div>
</div>
<div>
    <input class="btn-set-infor-admin" type="submit" value="Cập nhật">
</div>
</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/admin_infor_edit.blade.php ENDPATH**/ ?>