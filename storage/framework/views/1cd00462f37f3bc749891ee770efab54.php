
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>THÊM THỜI GIAN</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="<?php echo e(URL::to('/add-time')); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Thời gian bắt đầu</label>
            <input name="tourdate_start" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Thời gian kết thúc</label>
            <input name="tourdate_end" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/add_time.blade.php ENDPATH**/ ?>