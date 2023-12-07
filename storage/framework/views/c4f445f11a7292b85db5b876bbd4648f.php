
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>THÊM CHI TIẾT TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="<?php echo e(URL::to('/add-tour-detail')); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên tour</label>
            <select name="tourdetail_tour">
                <option value="">--Chọn tour--</option>
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tour->tour_id); ?>">
                        <?php echo e($tour->tour_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Thời gian bắt đầu</label>
            <input name="tourdetail_start" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Thời gian kết thúc</label>
            <input name="tourdetail_end" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Số lượng chỗ</label>
            <input name="number_of_seats" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="tour_show">
                <option value="1">Ẩn</option>
                <option value="0">Hiển thị</option>
            </select>
        </div>
        <div class="input-content">
            <input name="tour_success" type="hidden" value="0">
        </div>
        <div class="input-content">
            <label for="">Hướng dẫn viên đảm nhận</label>
            <select name="tourdetail_tourguide" required>
                <option value="">--Chọn hướng dẫn viên--</option>
                <?php $__currentLoopData = $all_tourguide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourguide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tourguide->tourguide_id); ?>">
                        <?php echo e($tourguide->tourguide_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/add_tour_detail.blade.php ENDPATH**/ ?>