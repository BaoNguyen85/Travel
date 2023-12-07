
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>CHI TIẾT ĐƠN HÀNG</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $od): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form id="orderconfirmForm" method="post" action="<?php echo e(URL::to ('/confirm-order/'.$od->order_id)); ?>" enctype="multipart/form-data" onsubmit="onSubmitForm(event)">
        <?php echo e(csrf_field()); ?>

        <div class="order-order">
            <h1>Đơn Hàng</h1>
            <div class="order-content">
                <label for=""><b>Mã đơn hàng: </b><?php echo e($od->order_code); ?></label>
            </div>
            <div class="order-content">
                <label for=""><b> Ngày đặt hàng: </b><?php echo e(\Carbon\Carbon::parse($od->order_time)->format('H:i d/m/Y')); ?></label>
            </div>
            <div class="order-content">
                <div class="colum-order">
                    <div class="colum-order1">
                        <label for=""><b>Khách hàng: </b>
                            <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($cus->customer_id == $od->customer_id): ?>
                                <?php echo e($cus->customer_name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </label>
                    </div>
                    <div class="colum-order2">
                        <label for=""><b>Email: </b>
                            <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($cus->customer_id == $od->customer_id): ?>
                                <?php echo e($cus->customer_mail); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </label>
                    </div>
                </div>
                
            </div>
            <div class="order-content">
                <div class="colum-order">
                    <div class="colum-order1">
                        <label for=""><b>Địa chỉ: </b>
                            <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($cus->customer_id == $od->customer_id): ?>
                                <?php echo e($cus->customer_address); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </label>
                    </div>
                    <div class="colum-order2">
                        <label for=""><b>Số điện thoại: </b>
                            <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($cus->customer_id == $od->customer_id): ?>
                                <?php echo e($cus->customer_phone); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="order-content">
                <label for=""><b>Tour đã đặt: </b>
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour->tour_id == $od->tour_id): ?>
                        <?php echo e($tour->tour_name); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Các điểm đến của tour: </b>
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
                </label>
            </div>
            <div class="order-content">
                <div class="colum-order">
                    <div class="colum-order1">
                    <label for=""><b>Thời gian bắt đầu: </b>
                        <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                            <?php echo e(\Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y')); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </label>
                    </div>
                    <div class="colum-order2">
                    <label for=""><b>Thời gian kết thúc: </b>
                        <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                            <?php echo e(\Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y')); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </label>
                    </div>
                </div>
            </div>
            <div class="order-content">
                <label for=""><b>Số chỗ: </b>
                    
                        
                        
                        <?php echo e($od->order_number_of_seats); ?>

                        
                    
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Danh sách khách hàng tham gia: </b><br>
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour->tour_id == $od->tour_id): ?>
                        <pre><?php echo $od->order_list_customer; ?></pre>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Giá: </b>
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour->tour_id == $od->tour_id): ?>
                        <?php echo e(number_format($tour -> tour_price,0,',','.')); ?>đ
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Mã giảm giá áp dụng: </b>
                    <?php
                        $couponApplied = false;
                    ?>
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour->tour_id == $od->tour_id): ?>
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
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Mức giảm: </b>
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
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Phương thức thanh toán: </b>
                    <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tourdetail->tourdetail_id == $od->tourdetail_id): ?>
                            <?php if($od->order_payment == 0): ?>
                            Thanh toán tiền mặt
                            <?php elseif($od->order_payment == 1): ?>
                            Thanh toán qua ví điện tử
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Trạng thái thanh toán: </b>
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour->tour_id == $od->tour_id): ?>
                            <?php if($od->order_payment_status == 0): ?>
                            Chưa thanh toán
                            <?php else: ?>
                            Đã thanh toán
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </label>
            </div>
            <div style="text-align: right" class="order-content">
                <label for=""><b>Tổng: </b>
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour->tour_id == $od->tour_id): ?>
                        <?php echo e(number_format($od -> order_total,0,',','.')); ?>đ
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </label>
            </div>
        </div>
        <div class="input-content">
            <label for="">Trạng thái thanh toán</label>
            <select name="order_payment_status">
                <?php if($od->order_payment_status == 0): ?>
                <option selected value="0">Chưa thanh toán</option>
                <option value="1">Thanh toán</option>
                <?php else: ?>
                <option value="0">Chưa thanh toán</option>
                <option selected value="1">Đã thanh toán</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Trạng thái xử lý</label>
            <select name="order_status">
                <?php if($od->order_status == 0): ?>
                <option selected value="0">Chưa duyệt</option>
                <option value="1">Duyệt</option>
                <option value="2">Hủy</option>
                <?php elseif($od->order_status == 1): ?>
                <option value="0">Chưa duyệt</option>
                <option selected value="1">Đã duyệt</option>
                <option value="2">Hủy</option>
                <?php else: ?>
                <option value="0">Chưa duyệt</option>
                <option value="1">Duyệt</option>
                <option selected  value="2">Hủy</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="input-content">
            <a style="text-decoration: none; color:black" href="<?php echo e(URL::to('/print-order/'.$od->order_code)); ?>"><i class="fa-solid fa-file-pdf"></i> In đơn hàng</a>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function onSubmitForm(event) {
        // Ngăn chặn việc gửi form mặc định
        event.preventDefault();

        // Thực hiện các xử lý đặt hàng ở đây
        // ...

        // Hiển thị thông báo SweetAlert2
        Swal.fire({
            title: 'Xử lý đơn hàng thành công!',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            // Nếu người dùng nhấp vào nút "OK" trong alert, hãy gửi form
            if (result.isConfirmed) {
                document.getElementById('orderconfirmForm').submit();
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/order_detail.blade.php ENDPATH**/ ?>