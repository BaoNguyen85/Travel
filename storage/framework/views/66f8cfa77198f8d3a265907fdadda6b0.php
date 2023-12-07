
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH KHÁCH HÀNG</h3>
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
            <th style="width: 20%;">Tên khách hàng</th>
            <th style="width: 15%;">Ngày sinh</th>
            <th style="width: 22%;">Email</th>
            <th style="width: 15%;">Điện thoại</th>
            <th style="width: 20%;">Địa chỉ</th>
            <th style="width: 8%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;"><?php echo e($cus -> customer_name); ?></td>
            <td style="text-align: center;"><?php echo e($cus -> customer_birth); ?></td>
            <td style="text-align: center;"><?php echo e($cus -> customer_mail); ?></td>
            <td style="text-align: center;"><?php echo e($cus -> customer_phone); ?></td>

            <td style="text-align: center;"><span>
                <?php echo $cus -> customer_address; ?>

            </span></td>
            <td style="text-align: center;">
                
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-customer/'.$cus->customer_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_customer.blade.php ENDPATH**/ ?>