
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH THỜI GIAN</h3>
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
            
            <th style="width: 40%;">Thời gian bắt đầu</th>
            <th style="width: 40%;">Thời gian kết thúc</th>
            <th style="width: 20%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            
            <td style="text-align: center;"><?php echo e(\Carbon\Carbon::parse($time->tourdate_start)->format('H:i d/m/Y')); ?> </td>
            <td style="text-align: center;"><?php echo e(\Carbon\Carbon::parse($time->tourdate_end)->format('H:i d/m/Y')); ?></td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-time/'.$time->tourdate_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-time/'.$time->tourdate_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_time.blade.php ENDPATH**/ ?>