
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH HƯỚNG DẪN VIÊN</h3>
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
            <th style="width: 20%;">Tên hướng dẫn viên</th>
            <th style="width: 10%;">Ngày sinh</th>
            <th style="width: 20%;">Email</th>
            <th style="width: 15%;">Điện thoại</th>
            <th style="width: 20%;">Địa chỉ</th>
            <th style="width: 15%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_tourguide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;"><?php echo e($tg -> tourguide_name); ?></td>
            <td style="text-align: center;"><?php echo e(\Carbon\Carbon::parse($tg->tourguide_birth)->format('d/m/Y')); ?></td>
            <td style="text-align: center;"><?php echo e($tg -> tourguide_email); ?></td>
            <td style="text-align: center;"><?php echo e($tg -> tourguide_phone); ?></td>

            <td style="text-align: center;"><span>
                <?php echo $tg -> tourguide_address; ?>

            </span></td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-tourguide/'.$tg->tourguide_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-tourguide/'.$tg->tourguide_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_tourguide.blade.php ENDPATH**/ ?>