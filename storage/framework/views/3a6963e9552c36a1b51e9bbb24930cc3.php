
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH CHUỖI ĐIỂM ĐẾN</h3>
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
            <th style="width: 40%;">Tên điểm đến</th>
            <th style="width: 40%;">Chuỗi điểm đến</th>
            <th style="width: 20%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_destination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($des->destination_id == $des_dtl->destination_id): ?>
                <?php echo e($des -> destination_name); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($pl->place_id == $des_dtl->place_id): ?>
                <?php echo e($pl -> place_name); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-destination-detail/'.$des_dtl->destinationdetail_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-destination-detail/'.$des_dtl->destinationdetail_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_destinationdetail.blade.php ENDPATH**/ ?>