
<?php $__env->startSection('tourguide_content'); ?>
    <div class="head-title">
        <h3>CẬP NHẬT LÝ DO</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_tourguide_reason; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tg_rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <form method="post" action="<?php echo e(URL::to('/update-schedule-reason/'.$tg_rs->tourguide_schedule_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Sự cố</label>
            <input value="<?php echo e($tg_rs->tourguide_schedule_reason); ?>" autocomplete="off" name="tourguide_schedule_reason" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
        
    </form>
    <div class="back-page">
        <a href="<?php echo e(URL::to ('/tourguide-schedule/'.$tg_rs->tourguide_schedule_tour)); ?>">
            <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tourguide_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_tourguidereason.blade.php ENDPATH**/ ?>