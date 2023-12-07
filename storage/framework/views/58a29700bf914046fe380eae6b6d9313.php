
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>CẬP NHẬT LỊCH TRÌNH</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $editsch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-schedule/'.$editsch->schedule_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên lịch trình</label>
            <input value="<?php echo e($editsch->schedule_name); ?>" autocomplete="off" name="schedule_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_schedule.blade.php ENDPATH**/ ?>