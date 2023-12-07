
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>CẬP NHẬT HƯỚNG DẪN VIÊN</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_tourguide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edit_tg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-tourguide/'.$edit_tg->tourguide_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên hướng dẫn viên</label>
            <input value="<?php echo e($edit_tg->tourguide_name); ?>" name="tourguide_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Ngày sinh</label>
            <input value="<?php echo e($edit_tg->tourguide_birth); ?>" name="tourguide_birth" type="date" required>
        </div>
        <div class="input-content">
            <label for="">Giới tính</label>
            <select name="tourguide_sex">
                <?php if($edit_tg->tourguide_sex == 1): ?>
                <option selected value="1">Nam</option>
                <option value="0">Nữ</option>
                <?php else: ?>
                <option value="1">Nam</option>
                <option selected value="0">Nữ</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Email</label>
            <input value="<?php echo e($edit_tg->tourguide_email); ?>" name="tourguide_email" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Điện thoại</label>
            <input value="<?php echo e($edit_tg->tourguide_phone); ?>" name="tourguide_phone" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Địa chỉ</label>
            <input value="<?php echo e($edit_tg->tourguide_address); ?>" name="tourguide_address" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Mật khẩu</label>
            <input value="<?php echo e($edit_tg->tourguide_password); ?>" name="tourguide_password" type="password" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_tourguide.blade.php ENDPATH**/ ?>