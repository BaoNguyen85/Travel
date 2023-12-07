
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>EDIT SCHEDULE DETAIL</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_scheduledetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $editsch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-schedule-detail/'.$editsch->scheduledetail_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Lịch trình</label>
            <select name="schedule_name">
                <option value="">--Chọn lịch trình--</option>
                <?php $__currentLoopData = $all_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sch->schedule_id == $editsch->schedule_id): ?>
                    <option selected value="<?php echo e($sch->schedule_id); ?>"><?php echo e($sch->schedule_name); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($sch->schedule_id); ?>"><?php echo e($sch->schedule_name); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Mô tả lịch trình</label>
            <textarea rows="10" name="scheduledetail_content" id="ckeditor1" placeholder="Liệt kê các địa điểm du lịch của lịch trình..." required><?php echo e($editsch->scheduledetail_content); ?></textarea>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_scheduleDetail.blade.php ENDPATH**/ ?>