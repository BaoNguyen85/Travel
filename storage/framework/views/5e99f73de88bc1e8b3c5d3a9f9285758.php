
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>CẬP NHẬT MÃ GIẢM GIÁ</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edit_cou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-coupon/'.$edit_cou->coupon_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên mã giãm giá</label>
            <input value="<?php echo e($edit_cou->coupon_name); ?>" name="coupon_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Code</label>
            <input value="<?php echo e($edit_cou->coupon_code); ?>" name="coupon_code" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Loại mã giãm giá</label>
            <select name="coupon_type">
                <?php if($edit_cou->coupon_type == 0): ?>
                <option selected value="0">Giảm theo %</option>
                <option value="1">Giảm theo mệnh giá tiền</option>
                <?php else: ?>
                <option value="0">Giảm theo %</option>
                <option selected value="1">Giảm theo mệnh giá tiền</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Mức giảm</label>
            <input value="<?php echo e($edit_cou->coupon_total); ?>" name="coupon_total" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Số lượng mã</label>
            <input value="<?php echo e($edit_cou->coupon_quantity); ?>" name="coupon_quantity" type="number" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_coupon.blade.php ENDPATH**/ ?>