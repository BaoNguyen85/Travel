
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>THÊM MÃ GIẢM GIÁ</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="<?php echo e(URL::to('/add-coupon')); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên mã giãm giá</label>
            <input name="coupon_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Code</label>
            <input name="coupon_code" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Loại mã giãm giá</label>
            <select name="coupon_type" required>
                <option value="">--Chọn loại giảm giá--</option>
                <option value="0">Giảm theo %</option>
                <option value="1">Giảm theo mệnh giá tiền</option>
            </select>
        </div>
        <div class="input-content">
            <label for="">Mức giảm</label>
            <input name="coupon_total" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Số lượng mã</label>
            <input name="coupon_quantity" type="number" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/add_coupon.blade.php ENDPATH**/ ?>