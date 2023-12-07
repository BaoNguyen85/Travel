
<?php $__env->startSection('tourguide_content'); ?>
    <div class="head-title">
        <h3>DANH SÁCH DU KHÁCH</h3>
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
                <th style="width: 5%;">Thứ tự</th>
                <th style="width: 10%;">Tên khách hàng</th>
                <th style="width: 10%;">Số điện thoại</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 5%;">Số chỗ</th>
                <th style="width: 15%;">Danh sách</th>
                
                <th style="width: 35%;">Xử lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            ?>
            
            <?php $__currentLoopData = $edit_tourist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $all_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $hasTouristData = false;
                    ?>
                    <?php if($tourist->tourdetail_id == $order->tourdetail_id && $order->customer_id == $cus->customer_id &&  $order->order_status==1): ?>    
                    <tr>
                        <td style="text-align: center;">
                            <?php echo e($i++); ?>

                        </td>
                        <td style="text-align: center;"> 
                            <?php echo e($cus -> customer_name); ?>

                            
                        </td>
                        <td style="text-align: center;">
                            <?php echo e($cus -> customer_phone); ?>

                            
                        </td>
                        <td style="text-align: center;">
                            <?php echo e($cus -> customer_mail); ?>

                            
                        </td>
                        <td style="text-align: center;">
                            <?php echo e($order -> order_number_of_seats); ?>

                        </td>
                        <td>
                            <pre><?php echo e($order -> order_list_customer); ?></pre>
                        </td>
                        
                        
                        <td style="text-align: center;">
                            <form class="touristForm" method="post" action="<?php echo e(URL::to('/add-tourist')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php $__currentLoopData = $all_tourist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $alltourist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($order->customer_id == $alltourist->tourist_customer_id && $order->tourdetail_id == $alltourist->tourdetail_id): ?>
                                    <?php
                                    $hasTouristData = true;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" value="<?php echo e($order -> tourdetail_id); ?>" name="tourdetail_id">
                            <input type="hidden" value="<?php echo e($cus -> customer_id); ?>" name="tourist_customer_id">
                            <input type="hidden" value="<?php echo e($cus -> customer_name); ?>" name="tourist_name">
                            <input type="hidden" value="<?php echo e($cus -> customer_phone); ?>" name="tourist_phone">
                            <input type="hidden" value="<?php echo e($cus -> customer_mail); ?>" name="tourist_email">
                            
                            
                            
                            <?php if($hasTouristData): ?>
                                Đã điểm danh
                                <?php $__currentLoopData = $all_tourist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $alltourist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($order->customer_id == $alltourist->tourist_customer_id && $order->tourdetail_id == $alltourist->tourdetail_id): ?>
                                        <p style="float: left;padding:1%">Ghi chú: <?php echo e($alltourist->tourist_note); ?></p>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            <?php else: ?>
                                <p style="float: left;padding:1%">Ghi chú&nbsp;&nbsp;</p><input style="float: left;border:none;padding:1%" type="text" name="tourist_note" value="Không" required>
                                <input name="tourist_status" type="radio" value="1" onclick="submitForm(this)"> Đủ &nbsp;&nbsp;
                                <input name="tourist_status" type="radio" value="0" onclick="submitForm(this)"> Vắng
                            <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </tbody>
    </table>


<div class="back-pages">
    <a href="<?php echo e(URL::to('/tourguide-new-tour')); ?>">
        <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
</div>
<script>
    function submitForm(radio) {
        radio.closest('.touristForm').submit();
    }
</script>
<script>
    document.getElementById('external_note_input').addEventListener('input', function(event) {
        document.getElementById('tourist_note_hidden').value = event.target.value;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tourguide_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/tourist_tour.blade.php ENDPATH**/ ?>