
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>EDIT TIME</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
<?php $__currentLoopData = $edit_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-time/'.$time->tourdate_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Thời gian bắt đầu</label>
            <input value="<?php echo e($time->tourdate_start); ?>" name="tourdate_start" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Thời gian kết thúc</label>
            <input value="<?php echo e($time->tourdate_end); ?>" name="tourdate_end" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_time.blade.php ENDPATH**/ ?>