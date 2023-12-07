
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>CẬP NHẬT THÔNG TIN WEBSITE</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $all_information; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $infor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-information/'.$infor->information_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên công ty</label>
            <input value="<?php echo e($infor->information_name); ?>" autocomplete="off" name="information_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Logo</label>
            <input value="<?php echo e($infor->information_logo); ?>" name="information_logo" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Địa chỉ</label>
            <input value="<?php echo e($infor->information_address); ?>" name="information_address" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Email</label>
            <input value="<?php echo e($infor->information_email); ?>" name="information_email" type="email" required>
        </div>
        <div class="input-content">
            <label for="">Số điện thoại</label>
            <input value="<?php echo e($infor->information_phone); ?>" name="information_phone" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea rows="10" name="information_describe" id="ckeditor1" placeholder="Mô tả thông tin..." required><?php echo e($infor->information_describe); ?></textarea>
        </div>
        <div class="input-content">
            <label for="">Bản đồ</label>
            <textarea rows="10" name="information_location" required><?php echo e($infor->information_location); ?></textarea>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_information.blade.php ENDPATH**/ ?>