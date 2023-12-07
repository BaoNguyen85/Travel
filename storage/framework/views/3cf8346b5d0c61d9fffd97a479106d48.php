
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>THÊM TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="<?php echo e(URL::to('/add-tour')); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên Tour</label>
            <input name="tour_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Loại tour</label>
            <select name="tour_tourtype" required>
                <option value="">--Chọn loại tour--</option>
                <?php $__currentLoopData = $all_tourtype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tt->tourtype_id); ?>">
                        <?php echo e($tt->tourtype_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Thành phố</label>
            <select name="tour_city" required>
                <option value="">--Chọn thành phố--</option>
                <?php $__currentLoopData = $all_province; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($pr->province_id); ?>">
                        <?php echo e($pr->province_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Điểm đến</label>
            <select name="tour_destination" required>
                <option value="">--Chọn điểm đến--</option>
                <?php $__currentLoopData = $all_destination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($des->destination_id); ?>">
                        <?php echo e($des->destination_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Ảnh đại diện</label>
            <input name="tour_avt" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input name="tour_image" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Giá tour</label>
            <input name="tour_price" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Lịch trình</label>
            <select name="tour_schedule" required>
                <option value="">--Chọn lịch trình--</option>
                <?php $__currentLoopData = $all_scheduledetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schdl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($schdl->scheduledetail_id); ?>">
                    <?php $__currentLoopData = $all_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sch->schedule_id == $schdl->schedule_id): ?>
                        <?php echo e($sch->schedule_name); ?>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Điểm nổi bật</label>
            <textarea class="form-control " rows="10" id="ckeditor1" name="tour_outstanding" required></textarea>
        </div>
        <div class="input-content">
            <label for="">Nơi khởi hành</label>
            <input name="tour_departure" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Vị trí khởi hành</label>
            <input name="tour_start_location" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Thời tiết</label>
            <input name="tour_weather" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Phương tiện di chuyển</label>
            <input name="tour_vehicle" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/add_tour.blade.php ENDPATH**/ ?>