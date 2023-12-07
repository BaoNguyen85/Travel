
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH ĐƠN HÀNG</h3>
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
            <th style="width: 5%;">STT</th>
            <th style="width: 10%;">Mã đơn</th>
            <th style="width: 15%;">Khách hàng</th>
            <th style="width: 15%;">Tour</th>
            <th style="width: 5%;">Số chỗ</th>
            <th style="width: 10%;">Duyệt</th>
            <th style="width: 10%;">Trạng thái tour</th>
            <th style="width: 13%;">Thanh toán</th>
            <th style="width: 12%;">Tổng</th>
            <th style="width: 5%;">Xử lý</th>
        </tr>
    </thead>
    <?php
        $i = 0;
    ?>
    <tbody>
        <?php $__currentLoopData = $all_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php
                $i++;
            ?>
                
            <td style="text-align: center;"><?php echo e($i); ?></td>
            <td style="text-align: center;"><?php echo e($order->order_code); ?></td>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($order->customer_id == $cus->customer_id): ?>
                        <?php echo e($cus->customer_name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </td>
            <td style="text-align: center;">
                
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($order->tour_id == $tour->tour_id): ?>
                            <?php echo e($tour->tour_name); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </td>
            <td style="text-align: center;"><?php echo e($order -> order_number_of_seats); ?></td>
            <td style="text-align: center;">
                <?php if($order -> order_status==1): ?>
                <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px">Đã duyệt</div>
                <?php elseif($order -> order_status==0): ?>
                <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px">Chưa duyệt</div>
                <?php else: ?>
                <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px">Đã hủy</div>
                <?php endif; ?>
            </td>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($order->tourdetail_id == $tourdetail->tourdetail_id): ?>
                    <?php if($tourdetail->tour_success==1): ?>
                    <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px">Hoàn thành</div>
                    <?php elseif($tourdetail->tour_success==0): ?>
                    <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px">Tour mới</div>
                    <?php else: ?>
                    <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px">Đã hủy</div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;">
                <?php if($order -> order_payment_status==0): ?>
                <div style="background-color:rgb(7, 106, 205);color: rgb(255, 255, 255);border-radius:15px">Chưa thanh toán</div>
                <?php else: ?>
                <div style="background-color:green;color: rgb(255, 255, 255);border-radius:15px">Đã thanh toán</div>
                <?php endif; ?>
            </td>
            <td style="text-align: center;"><?php echo e(number_format($order -> order_total,0,',','.')); ?>đ</td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-order/'.$order->order_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_order.blade.php ENDPATH**/ ?>