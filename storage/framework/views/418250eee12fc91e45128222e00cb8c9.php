<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            font-family:DejaVu Sans;
            font-size: 15px;
        }
        h1{
            text-align: center;
            font-size: 20px;
        }
        h2{
            font-size: 20px;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1>ĐƠN HÀNG</h1>
    <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <p><b>Mã đơn hàng:</b>  <?php echo e($od->order_code); ?>

            </p>
            <h2>Thông tin khách hàng</h2>
            <p><b>Họ tên:</b> 
                <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($od->customer_id == $cus->customer_id): ?>
                <?php echo e($cus->customer_name); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Email:</b> 
                <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($od->customer_id == $cus->customer_id): ?>
                <?php echo e($cus->customer_mail); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Số điện thoại:</b> 
                <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($od->customer_id == $cus->customer_id): ?>
                <?php echo e($cus->customer_phone); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Địa chỉ:</b> 
                <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($od->customer_id == $cus->customer_id): ?>
                <?php echo e($cus->customer_address); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <h2>Thông tin đơn hàng</h2>
            <p><b>Tên tour:</b> 
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($od->tour_id == $tour->tour_id): ?>
                <?php echo e($tour->tour_name); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Các điểm đến:</b> 
                <?php $firstPlace = true; ?>
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($od->tour_id == $tour->tour_id): ?>
                    <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(($od->tour_id == $tour->tour_id) && ($pl->place_id == $des_dtl->place_id) && ($des_dtl->destination_id == $tour->tour_destination)): ?>
                            <?php if($firstPlace): ?>
                                <?php echo e($pl->place_name); ?>

                                <?php $firstPlace = false; ?>
                            <?php else: ?>
                                - <?php echo e($pl->place_name); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Thời gian bắt đầu:</b> 
                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                    <?php echo e(\Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y')); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Thời gian kết thúc:</b> 
                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                    <?php echo e(\Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y')); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Số chỗ:</b> 
                <?php echo e($od->order_number_of_seats); ?>

            </p>
            <p><b>Danh sách khách hàng tham gia:</b><br>
                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                    <pre><?php echo $od->order_list_customer; ?></pre>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Giá tour:</b> 
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tour->tour_id == $od->tour_id): ?>
                    <?php echo e(number_format($tour -> tour_price,0,',','.')); ?>đ
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Mã giảm giá áp dụng:</b> 
                <?php
                    $couponApplied = false;
                ?>
                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                        <?php $__currentLoopData = $all_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($od->coupon_id == $coupon->coupon_id): ?>
                            <?php echo e($coupon->coupon_code); ?>

                            <?php
                                $couponApplied = true;
                            ?>
                            <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$couponApplied && $od->coupon_id == NULL): ?>
                    Không
                <?php endif; ?>
            </p>
            <p><b>Đã giảm:</b> 
                <?php
                    $couponApplied = false;
                ?>
                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                        <?php $__currentLoopData = $all_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($od->coupon_id == $coupon->coupon_id && $coupon->coupon_type==1): ?>
                            <?php echo e(number_format($od -> order_discount,0,',','.')); ?>đ
                            <?php elseif($od->coupon_id == $coupon->coupon_id && $coupon->coupon_type==0): ?>
                            <?php echo e($od -> order_discount); ?>%
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$couponApplied && $od->coupon_id == NULL): ?>
                    0đ
                <?php endif; ?>
            </p>
            <p><b>Phương thức thanh toán:</b> 
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tour->tour_id == $od->tour_id): ?>
                        <?php if($od->order_payment == 0): ?>
                        Thanh toán tiền mặt
                        <?php else: ?>
                        Thanh toán qua ví điện tử
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p><b>Trạng thái thanh toán:</b> 
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tour->tour_id == $od->tour_id): ?>
                        <?php if($od->order_payment_status == 0): ?>
                        Chưa thanh toán
                        <?php else: ?>
                        Đã thanh toán
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            <p style="float: right"><b>Tổng:</b> 
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tour->tour_id == $od->tour_id): ?>
                    <?php echo e(number_format($od -> order_total,0,',','.')); ?>đ
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
            
        </div>
        <br><br><br>
        <div>
            <span style="padding-left: 5%;font-size:22px;font-weight:bold">Người nhận</span><span style="padding-left: 35%;font-size:22px;font-weight:bold">Người lập hóa đơn</span><br>
            <i style="padding-left: 5%;">(Ký, ghi rõ họ tên)</i><i style="padding-left: 40%;">(Ký, ghi rõ họ tên)</i>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/print_order.blade.php ENDPATH**/ ?>