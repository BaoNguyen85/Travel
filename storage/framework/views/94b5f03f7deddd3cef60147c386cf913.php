
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>THÊM ĐỊA DANH</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="<?php echo e(URL::to('/add-place')); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên địa điểm</label>
            <input autocomplete="off" name="place_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input name="place_image" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea rows="10" name="place_describe" id="ckeditor1" placeholder="Mô tả địa điểm..." required></textarea>
        </div>
        <div class="input-content">
            <label for="">Tỉnh thành</label>
            <select name="place_city" required>
                <option value="">--Chọn tỉnh thành phố--</option>
                <?php $__currentLoopData = $place_province; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl_pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pl_pr->province_id); ?>"><?php echo e($pl_pr->province_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="place_status">
                <option value="1">Ẩn</option>
                <option value="0">Hiển thị</option>
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/add_place.blade.php ENDPATH**/ ?>