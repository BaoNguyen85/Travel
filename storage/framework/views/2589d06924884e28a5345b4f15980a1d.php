<!DOCTYPE html>
<html>
<head>
    <title>Profile</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/index.css')); ?>" rel='stylesheet' type='text/css' />
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="<?php echo e(asset('../public/frontend/images/logo1.png')); ?>" type="image/x-icon">
    <style>
        #search-suggestions {
            position: absolute;
            width: 30%;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            background-color: #fff;
        }

    </style>
</head>

<body>
    <nav class="nav-style" style="background-color: #ffffff" id="navBar">
        <a class="logo-name" href="<?php echo e(URL::to('/index')); ?>"><img src="<?php echo e(asset ('../public/frontend/images/logo.png')); ?>" class="logo" alt=""></a>
        <ul class="nav-links">
            <li><a style="color: black" href="#" id="tours-type-link"></a></li>
            <li><a style="color: black" href="#" id="trending-link"></a></li>
            <li><a style="color: black" href="#" id="tour-link"></a></li>
        </ul>
        <div class="search-bar">
            <form id="form-search" method="post" action="<?php echo e(URL::to('/search-tour')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="location-input">
                    <input style="width: 100%" autocomplete="off" id="keywords_submit" name="keywords_submit" type="text" placeholder="Tìm kiếm...">
                    
                </div>
                <button class="micro" type="button" id="startSpeechRecognition"><i class="fa-solid fa-microphone"></i></button>
                <button type="submit"><img src="<?php echo e(asset ('../public/frontend/images/search.png')); ?>"></button>
            </form>
            <div id="search-suggestions"></div>
        </div>
        <div class="account-customer" id="accountCustomer" style="white-space: nowrap">
            <?php if(isset($customerName)): ?>
                <a style="color: rgb(0, 0, 0)"><?php echo e($customerName); ?></a>
                <a class="register-btn" onclick="toggleLogout()"><i class="fa-solid fa-user"></i></a>
                
                <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
        
                <!-- Dropdown for Logout -->
                <div class="logout-dropdown">
                    <i class="fa-solid fa-user-pen"><a href="<?php echo e(URL::to('/profile-customer/'.$customerID)); ?>"> Thông tin tài khoản</a></i> <br>
                    <i class="fa-solid fa-right-from-bracket"><a href="<?php echo e(URL::to('/customer-logout')); ?>"> Đăng xuất</a></i> 
                    <!-- Add more items as needed -->
                </div>
            <?php else: ?>
                <a href="<?php echo e(URL::to('/customer-login')); ?>" class="register-btn"> Đăng nhập</a>
                <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
            <?php endif; ?>
        </div>
    </nav>
    <?php $__currentLoopData = $profile_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="colum-profile">
        <div class="colum1-profile">
            <div class="profile-customer">
                <h2>THÔNG TIN CÁ NHÂN</h2>
                <h2 style="text-align: left; margin-left:5%; font-size:30px"><i class="fa-solid fa-user"></i></h2>
                <p><b>Họ tên :</b> <?php echo e($pro->customer_name); ?></p>
                <p><b>Ngày sinh :</b> <?php echo e(\Carbon\Carbon::parse($pro->customer_birth)->format('d/m/Y')); ?></p>
                <p><b>Email :</b> <?php echo e($pro->customer_mail); ?></p>
                <p><b>Số điện thoại :</b> <?php echo e($pro->customer_phone); ?></p>
                <p><b>Địa chỉ :</b> <?php echo e($pro->customer_address); ?></p>
                <p></p>
                <a style="padding: 1% 1%" href="<?php echo e(URL::to ('/edit-profile-customer/'.$customerID)); ?>">Chỉnh sửa</a>
            </div>
        </div>
        <div class="colum2-profile">
            <div class="profile-history">
                <h2>LỊCH SỬ ĐƠN HÀNG</h2>
                <?php $__currentLoopData = $all_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                    <?php if($order->customer_id == $customerID): ?>
                    <div class="history-frame">
                    <p style="display: inline-block;"><b>Trạng thái:</b>
                        <?php if($order -> order_status==1): ?>
                        <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px;display: inline-block;padding:0.5%">Đã duyệt</div>
                        <?php elseif($order -> order_status==0): ?>
                        <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px;display: inline-block;padding:0.5%">Chờ duyệt</div>
                        <?php else: ?>
                        <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px;display: inline-block;padding:0.5%">Đã hủy</div>
                        <?php endif; ?>
                    </p>
                    <p><b>Đơn hàng:</b> <?php echo e($order->order_code); ?></p>
                    <p><b>Tour: </b>
                        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($order->tour_id == $tour->tour_id): ?>
                            <?php echo e($tour->tour_name); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                    <p><b>Số chỗ:</b> <?php echo e($order->order_number_of_seats); ?></p>
                    <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($order->tourdetail_id == $tourdetail->tourdetail_id): ?>
                        <p><b>Ngày bắt đầu :</b> 
                        <?php echo e(\Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y')); ?>

                        </p>
                        <p><b>Ngày kết thúc :</b> 
                        <?php echo e(\Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y')); ?>

                        </p>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $all_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($order->tourdetail_id == $tourdetail->tourdetail_id && $order->coupon_id == $coupon->coupon_id): ?>
                            <p><b>Mã áp dụng :</b> <?php echo e($coupon->coupon_code); ?></p>
                            <p><b>Tổng giảm :</b>
                                <?php
                                $couponApplied = false;
                                ?>
                                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($tourdetail->tourdetail_id == $order->tourdetail_id): ?>
                                            <?php if($order->coupon_id == $coupon->coupon_id && $coupon->coupon_type==1): ?>
                                            <?php echo e(number_format($order -> order_discount,0,',','.')); ?>đ
                                            <?php elseif($order->coupon_id == $coupon->coupon_id && $coupon->coupon_type==0): ?>
                                            <?php echo e($order -> order_discount); ?>%
                                            <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$couponApplied && $order->coupon_id == NULL): ?>
                                    0đ
                                <?php endif; ?>
                            </p>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <p><b>Phương thức thanh toán:</b> 
                        <?php if($order->order_payment==0): ?>
                        Thanh toán tại quầy giao dịch
                        <?php else: ?>
                        Thanh toán qua VNPAY
                        <?php endif; ?>
                    </p>
                    <p><b>Trạng thái thanh toán:</b> 
                        <?php if($order->order_payment_status==0): ?>
                        Chưa thanh toán
                        <?php else: ?>
                        Đã thanh toán
                        <?php endif; ?>
                    </p>
                    <p style="text-align: right"><b>Tổng thanh toán:</b> <?php echo e(number_format($order -> order_total,0,',','.')); ?>đ</p>
                    <form method="post" action="<?php echo e(URL::to('/update-order-customer/'.$order->order_id)); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <?php if($order->order_status==1 || $order->order_status==2): ?>
                            <input style="background-color: rgb(239, 136, 136);border:1px solid rgb(239, 136, 136);" class="customer_cancel" type="submit" value="Hủy đơn" disabled>
                        <?php else: ?>
                            <input class="customer_cancel" type="submit" value="Hủy đơn">
                            <input name="order_status" type="hidden" value="2">
                        <?php endif; ?>
                    </form>
                    </div>
                            
                    
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
<script>
    $(document).ready(function(){
        const recognition = new webkitSpeechRecognition() || speechRecognition();
        recognition.lang = 'vi-VN';

        $('#startSpeechRecognition').on('click', function(){
            recognition.start();
        });

        recognition.onresult = function(event) {
            const result = event.results[0][0].transcript;
            $('#keywords_submit').val(result);
        }

        recognition.onerror = function(event) {
            console.error("Speech recognition error:", event.error);
        }

        recognition.onend = function() {
            $('#search-suggestions').hide();
        }
        $('#keywords_submit').on('input', function(){
            var keywords = $(this).val();
    
            $.ajax({
                type: 'GET',
                url: '<?php echo e(URL::to('/search-suggestions')); ?>',
                data: {'keywords': keywords},
                success: function(data){
                    // Sử dụng dữ liệu nhận được trực tiếp, không cần parse
                    var suggestions = data;
    
                    // Hiển thị gợi ý tìm kiếm trong một dropdown
                    $('#search-suggestions').html('');
                    for (var i = 0; i < suggestions.length; i++) {
                        $('#search-suggestions').append('<a href="#" class="tour-name">' + suggestions[i] + '</a><br>');
                    }
                    $('#search-suggestions').show();
                },
                error: function(xhr, status, error){
                    console.error("AJAX request failed:", status, error);
                    console.log("Raw response data:", xhr.responseText);
                }
            });
        });
    
        // Xử lý sự kiện khi click vào một tour_name trong dropdown
        $(document).on('click', '.tour-name', function(e){
            e.preventDefault();
            
            // Lấy giá trị của tour_name từ phần tử được click
            var selectedTourName = $(this).text();
            
            // Đặt giá trị vào ô input
            $('#keywords_submit').val(selectedTourName);

            // Gửi form
            $('#form-search').submit();
            
            // Ẩn dropdown
            $('#search-suggestions').hide();
        });
    
        // Ẩn dropdown khi click ra khỏi ô tìm kiếm
        $(document).on('click', function(e){
            if (!$(e.target).closest('.search-bar').length) {
                $('#search-suggestions').hide();
            }
        });
    });
</script>
<script>
    function toggleLogout(event) {
        event.stopPropagation();
        var logoutDropdown = document.querySelector('.logout-dropdown');
        logoutDropdown.classList.toggle('show-logout-dropdown');
    }

    document.querySelector('.fa-user').addEventListener('click', function (event) {
        toggleLogout(event);
    });

    window.onclick = function (event) {
        var dropdowns = document.getElementsByClassName('show-logout-dropdown');
        for (var i = 0; i < dropdowns.length; i++) {
            dropdowns[i].classList.remove('show-logout-dropdown');
        }
    }
</script>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/profile_customer.blade.php ENDPATH**/ ?>