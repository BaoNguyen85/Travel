
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH MÃ GIẢM GIÁ</h3>
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
            <th style="width: 20%;">Tên mã giảm giá</th>
            <th style="width: 20%;">Code</th>
            <th style="width: 20%;">Loại giảm giá</th>
            <th style="width: 15%;">Tổng giảm</th>
            <th style="width: 15%;">Số lượng</th>
            <th style="width: 10%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cou): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;"><?php echo e($cou->coupon_name); ?></td>
            <td style="text-align: center;"><?php echo e($cou->coupon_code); ?></td>
            <td style="text-align: center;">
                <?php if($cou->coupon_type==0): ?>
                Giảm theo %
                <?php else: ?>
                Giảm theo mệnh giá tiền
                <?php endif; ?>
            </td>
            <td style="text-align: center;">
                <?php if($cou->coupon_type==0): ?>
                <?php echo e($cou->coupon_total); ?>%
                <?php else: ?>
                <?php echo e($cou->coupon_total); ?>đ
                <?php endif; ?>
                
            </td>
            <td style="text-align: center;"><?php echo e($cou->coupon_quantity); ?></td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-coupon/'.$cou->coupon_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-coupon/'.$cou->coupon_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_coupon.blade.php ENDPATH**/ ?>