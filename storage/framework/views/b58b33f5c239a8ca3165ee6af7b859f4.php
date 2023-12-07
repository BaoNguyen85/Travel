
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH ĐIỂM ĐẾN</h3>
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
            <th style="width: 20%;">STT</th>
            <th style="width: 60%;">Tên điểm đến</th>
            <th style="width: 20%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
        ?>
        <?php $__currentLoopData = $all_destination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;">
                <?php echo e($i++); ?>

            </td>
            <td style="text-align: center;">
                <?php echo e($des -> destination_name); ?>

            </td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-destination/'.$des->destination_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-destination/'.$des->destination_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_destination.blade.php ENDPATH**/ ?>