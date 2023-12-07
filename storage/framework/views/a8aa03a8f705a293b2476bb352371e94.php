
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH LỊCH TRÌNH CHI TIẾT</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
<table>
    <thead>
        <tr>
            <th style="width: 45%;">Tên lịch trình chi tiết</th>
            <th style="width: 45%;">Mô tả</th>
            
            <th style="width: 10%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_scheduledetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sch->schedule_id == $schd->schedule_id): ?>
                    <?php echo e($sch->schedule_name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: left;"><?php echo $schd -> scheduledetail_content; ?></td>
            
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-schedule-detail/'.$schd->scheduledetail_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-schedule-detail/'.$schd->scheduledetail_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_scheduleDetail.blade.php ENDPATH**/ ?>