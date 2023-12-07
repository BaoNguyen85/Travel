<?php
    function generateOrderCode($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $code;
    }

    // Usage
    $orderCode = generateOrderCode();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/index.css')); ?>" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="<?php echo e(asset('../public/frontend/images/logo1.png')); ?>" type="image/x-icon">
    <style>
        #search-suggestions {
            position: absolute;
            width: 27%;
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
    <div class="container">
        <div class="content_order">
            <div class="order_order">
                    <?php $__currentLoopData = $tour_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour_dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour_dt->tour_id == $tour->tour_id): ?>
                        <h1 style="padding-bottom: 1%">Tổng quan</h1>
                            <div class="house">
                                <div class="house-img">
                                    <a href="<?php echo e(URL::to('/tour-detail/'.$tour_dt->tourdetail_id)); ?>">
                                    <img src="../public/uploads/tour/<?php echo e($tour->tour_avt); ?>">
                                    </a>
                                </div>
                                
                                <div class="house-info">
                                    <h3><?php echo e($tour->tour_name); ?></h3>
                                    <p><i class="fa-solid fa-location-dot"></i><b> Các điểm đến:</b> 
                                    <?php $firstPlace = true; ?>
                                    <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <?php if(($pl->place_id == $des_dtl->place_id) && ($des_dtl->destination_id == $tour->tour_destination)): ?>
                                                <?php if($firstPlace): ?>
                                                    <?php echo e($pl->place_name); ?>

                                                    <?php $firstPlace = false; ?>
                                                <?php else: ?>
                                                    - <?php echo e($pl->place_name); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>  
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </p>
                                    <p><i class="fa-solid fa-chair"></i> 
                                        <?php 
                                            $bookedSeats = 0; 
                                        ?>
                                        Số chỗ còn lại:
                                            <?php $__currentLoopData = $all_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($order->tourdetail_id == $tour_dt->tourdetail_id): ?>
                                                    <?php 
                                                        $bookedSeats=$bookedSeats + $order->order_number_of_seats; 
                                                    ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $remainingSeats = $tour_dt->number_of_seats - $bookedSeats; 
                                                echo $remainingSeats;
                                            ?>
                                    </p>
                                    <p><i class="fa-solid fa-clock"></i> Thời gian diễn ra:
                                        <p>Từ: <?php echo e(\Carbon\Carbon::parse($tour_dt->date_start)->format('H:i d/m/Y')); ?></p>
                                        <p>Đến: <?php echo e(\Carbon\Carbon::parse($tour_dt->date_end)->format('H:i d/m/Y')); ?></p>
                                    </p>
                                    
                                    <div class="house-price">
                                        <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($ct->province_id == $tour->tour_city): ?>
                                            <p><i class="fa-solid fa-map-pin"></i> 
                                                <?php echo e($ct->province_name); ?>

                                            </p>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <h4><i class="fa-solid fa-money-check-dollar"></i> <?php echo e(number_format($tour -> tour_price,0,',','.')); ?>đ</h4>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($cus->customer_id == $customerID): ?>
            <form id="orderForm" method="post" action="<?php echo e(URL::to('/add-order')); ?>" enctype="multipart/form-data" onsubmit="onSubmitForm(event)">
                <?php echo e(csrf_field()); ?>

                <?php
                    $total = 0;
                ?>
                <div class="order_form">
                    <h1>Thông tin đặt hàng</h1>
                    <h3 style="padding: 3% 0">Người đặt hàng</h3>
                    <div class="colum-order">
                        <div class="left-order">
                            <div class="order_input">
                                <input type="hidden" name="customer_id" value="<?php echo e($cus->customer_id); ?>">
                                <label for=""><b>Họ tên:</b> <?php echo e($cus->customer_name); ?></label><br>
                            </div>
                            <div class="order_input">
                                <label for=""><b>Email:</b> <?php echo e($cus->customer_mail); ?></label><br>
                            </div>
                            <div class="order_input">
                                <label for=""><b>Địa chỉ:</b> <?php echo e($cus->customer_address); ?></label><br>
                            </div>          
                        </div>
                        <div class="right-order">
                            <div class="order_input">
                                <label for=""><b>Ngày sinh:</b> <?php echo e($cus->customer_birth); ?></label><br>
                            </div>
                            <div class="order_input">
                                <label for=""><b>Số điện thoại:</b> <?php echo e($cus->customer_phone); ?></label><br>
                            </div>
                            
                        </div>
                    </div>

                    <h3 style="padding: 3% 0">Thông tin đơn hàng</h3>
                    <?php $__currentLoopData = $tour_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour_dts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour_dt->tour_id == $tour->tour_id): ?>
                        <?php
                            $currentTourPrice = $tour->tour_price; // Lưu giá trị vào biến tạm
                        ?>
                        <div class="order_input">
                            <input type="hidden" name="tourdetail_id" value="<?php echo e($tour_dts->tourdetail_id); ?>">
                            <input type="hidden" name="tour_id" value="<?php echo e($tour_dts->tour_id); ?>">
                            <label for=""><b>Tên tour:</b> <?php echo e($tour->tour_name); ?></label><br>
                        </div>
                        <div class="order_input">
                            <label for=""><b>Các điểm đến:</b> 
                            <?php $firstPlace = true; ?>
                            <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($pl->place_id == $des_dtl->place_id) && ($des_dtl->destination_id == $tour->tour_destination)): ?>
                                        <?php if($firstPlace): ?>
                                            <?php echo e($pl->place_name); ?>

                                            <?php $firstPlace = false; ?>
                                        <?php else: ?>
                                            - <?php echo e($pl->place_name); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>  
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </label><br>
                        </div>
                        <div class="order_input">
                            <label for=""><b>Thời gian diễn ra:</b> 
                                    Từ: <b><?php echo e(\Carbon\Carbon::parse($tour_dts->date_start)->format('H:i d/m/Y')); ?></b>
                                    đến <b><?php echo e(\Carbon\Carbon::parse($tour_dts->date_end)->format('H:i d/m/Y')); ?></b>
                            </label><br>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <h3 style="padding: 3% 0">Tùy chọn đặt hàng</h3>
                    <div class="order_input">
                        <label for=""><b>Số chỗ:</b> </label><br>
                        <input type="number" name="order_number_of_seats" id="order_number_of_seats" oninput="calculateTotal()" min="1" required>
                        <input type="hidden" name="order_status" value="0" >
                        <input type="hidden" name="order_payment_status" value="0" >
                        <input type="hidden" name="order_code" value="<?php echo $orderCode; ?>" >
                    </div>
                    <div class="order_input">
                        <label for=""><b>Nhập danh sách họ tên khách hàng tham gia:</b> </label><br>
                        <textarea style="margin-top: 2%;border-radius:15px;padding:2%;" name="order_list_customer" id="" cols="50" rows="10"  placeholder="Ví dụ: &#13;&#10; 1. Nguyễn Văn A &#13;&#10; 2. Nguyễn văn B &#13;&#10; ..." required></textarea>
                    </div>
                    <div class="order_input" id="couponInput">
                        <label for=""><b>Mã giảm giá:</b> </label><br>
                        <input type="text" id="coupon_code" oninput="calculateDiscount()" value="">
                        <span id="message" style="color: red;padding-left:1%"></span>
                        <input type="hidden" name="order_discount" id="coupon_discount" value="">
                        <input type="hidden" name="coupon_id" id="coupon_id" value="">
                    </div>
                    <div class="order_input">
                        <label for=""><b>Phương thức thanh toán:</b> </label><br>
                        <input name="order_payment" type="radio" value="0" id="cashPayment" required>Thanh toán tại quầy du lịch<br>
                        <input name="order_payment" id="order_payment_momo" type="radio" value="1" required onclick="openMOMOWindow()">Thanh toán qua ví điện tử &nbsp; <img style="width: 5%;" src="<?php echo e(asset ('../public/frontend/images/momo.png')); ?>" alt="">
                        
                    </div>
                    
                    <iframe id="VNPAYIframe" name="VNPAYIframe" style="display: none;width:200%; height:500px"></iframe>
                    <div class="total_order">
                        <label for=""><b>Tổng:</b> </label>
                        <input type="text" id="order_total" readonly>
                        <input type="hidden" name="order_total" id="order_total_hidden">
                    </div>
                    <div class="order_button">
                        <input type="submit" value="Đặt">
                    </div>
                </div>
            </form>
            
            <form id="momoForm" method="POST" enctype="multipart/form-data" action="<?php echo e(URL::to('/momo-payment')); ?>">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="order_total" id="momo_order_total">
            </form>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="about-msg">
            <h2>About</h2>
            <?php $__currentLoopData = $all_infor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="colum-container-footer">
                <div class="colum1-footer">
                    <p><img src="../public/uploads/logo/<?php echo e($inf->information_logo); ?>" height="100" width="300" style="border-radius: 10px"></p>
                    <p>Công ty du lịch <?php echo e($inf->information_name); ?></p>
                    <p>Địa chỉ: <?php echo e($inf->information_address); ?></p>
                    <p>Email: <?php echo e($inf->information_email); ?></p>
                    <p>Điện thoại: <?php echo e($inf->information_phone); ?></p>
                    <p>Thông tin công ty: <?php echo $inf->information_describe; ?></p>
                </div>
            
                <div class="colum2-footer">
                    <?php echo $inf->information_location; ?>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="footer">
            <a href="https://facabook.com/"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://youtube.com/"><i class="fa-brands fa-youtube"></i></a>
            <a href="https://instagram.com/"><i class="fa-brands fa-instagram"></i></a>
            <hr>
            <p>Copyright</p>
        </div>
    </div>
    
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
        function openVNPAYWindow() {
            // Lấy trường radio thanh toán tiền mặt
            var cashPayment = document.getElementById('cashPayment');

            // Nếu thanh toán qua VNPAY được chọn, disable thanh toán tiền mặt
            if (cashPayment) {
                cashPayment.disabled = true;
            }
            // Lấy form theo ID
            var form = document.getElementById('vnpayForm');

            // Mở cửa sổ mới
            var vnpayWindow = window.open('', 'vnpayWindow', 'width=1000,height=800');

            // Gửi form khi cửa sổ đã được mở
            if (vnpayWindow) {
                form.target = 'vnpayWindow';
                form.submit();
            } else {
                alert('Không thể mở cửa sổ thanh toán.');
            }

        }
    </script>
    <script>
        function openMOMOWindow() {
            // Lấy trường radio thanh toán tiền mặt
            var cashPayment = document.getElementById('cashPayment');

            // Nếu thanh toán qua VNPAY được chọn, disable thanh toán tiền mặt
            if (cashPayment) {
                cashPayment.disabled = true;
            }
            
            // Lấy form theo ID
            var form = document.getElementById('momoForm');

            // Mở cửa sổ mới
            var momoWindow = window.open('', 'momoWindow', 'width=2000,height=1500');

            // Gửi form khi cửa sổ đã được mở
            if (momoWindow) {
                form.target = 'momoWindow';
                form.submit();

            } else {
                alert('Không thể mở cửa sổ thanh toán.');
            }
        }
    </script>

<script>
    var navBar = document.getElementById("navBar");
    function togglebtn(){
        navBar.classList.toggle("hidemenu");
    }
</script>
<script>
    var couponTotal = 0;

    function calculateTotal() {
        var numberOfSeats = parseInt(document.getElementById('order_number_of_seats').value);
        var tourPrice = <?php echo isset($currentTourPrice) ? $currentTourPrice : 0; ?>;
        var couponDiscount = parseFloat(document.getElementById('coupon_discount').value);
        var remainingSeats = <?php echo $remainingSeats; ?>;

        if (!isNaN(numberOfSeats) && numberOfSeats >= 0) {
            // Kiểm tra nếu số chỗ đặt lớn hơn số chỗ còn lại
            if (numberOfSeats > remainingSeats) {
                // Nếu vượt quá, đặt lại giá trị nhập thành số chỗ còn lại
                alert('Không được đặt quá số chỗ còn lại!');
                document.getElementById('order_number_of_seats').value = remainingSeats;
                numberOfSeats = remainingSeats; // Cập nhật giá trị của numberOfSeats
            }

            var totalBeforeDiscount = numberOfSeats * tourPrice;
            // var totalAfterCoupon = totalBeforeDiscount - couponTotal;
            var totalAfterCoupon;

            if (couponDiscount > 0) {
                // Kiểm tra loại mã giảm giá
                var couponType = <?php echo json_encode($all_coupon->keyBy('coupon_code')->map(function ($item) {
                    return $item['coupon_type'];
                })); ?>[document.getElementById('coupon_code').value];

                if (couponType === 1) {
                    // Loại giảm giá theo giá trị cố định
                    totalAfterCoupon = totalBeforeDiscount - couponDiscount;
                } else if (couponType === 0) {
                    // Loại giảm giá theo phần trăm
                    totalAfterCoupon = totalBeforeDiscount - (totalBeforeDiscount * couponDiscount / 100);
                }
            } else {
                totalAfterCoupon = totalBeforeDiscount;
            }
            document.getElementById('order_total').value = totalAfterCoupon.toLocaleString() + 'đ';
            document.getElementById('order_total_hidden').value = totalAfterCoupon;
            // document.getElementById('vnpay_order_total').value = totalAfterCoupon;
            document.getElementById('momo_order_total').value = totalAfterCoupon;
        } else {
            document.getElementById('order_total').value = '0đ';
        }
    }

    function calculateDiscount() {
        var enteredCode = document.getElementById('coupon_code').value.trim();
        var messageDiv = document.getElementById('message');
        var couponDetails = <?php echo json_encode($all_coupon->keyBy('coupon_code')->toArray()); ?>;
        var couponIdInput = document.getElementById('coupon_id');
        console.log(couponIdInput);  // Kiểm tra xem phần tử có tồn tại không

        if (enteredCode === '') {
            // Nếu mã giảm giá rỗng, thiết lập lại couponTotal về 0
            couponTotal = 0;
            document.getElementById('coupon_discount').value = couponTotal;
            messageDiv.innerHTML = '';  // Xóa thông báo
        } else if (couponDetails.hasOwnProperty(enteredCode)) {
            var couponDetail = couponDetails[enteredCode];

            // Kiểm tra nếu mã giảm giá hợp lệ và còn tồn tại
            if (couponDetail.coupon_quantity > 0) {
                couponTotal = parseFloat(couponDetail.coupon_total);
                document.getElementById('coupon_discount').value = couponTotal;
                document.getElementById('coupon_id').value = couponDetail.coupon_id || 0;
                messageDiv.innerHTML = 'Mã giảm giá hợp lệ!';
                messageDiv.style.color = 'green';
            } else {
                couponTotal = 0;
                messageDiv.innerHTML = 'Mã giảm giá đã hết lượt sử dụng!';
                messageDiv.style.color = 'red';
                // document.getElementById('coupon_code').value = '';  // Xóa giá trị mã giảm giá
            }

            
        } else {
            couponTotal = 0;  // Nếu mã giảm giá không hợp lệ, thiết lập lại couponTotal về 0
            messageDiv.innerHTML = 'Mã giảm giá không hợp lệ!';
            document.getElementById('coupon_discount').value = couponTotal;
            messageDiv.style.color = 'red';
        }

        calculateTotal();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function onSubmitForm(event) {
        // Ngăn chặn việc gửi form mặc định
        event.preventDefault();
        // Thực hiện các xử lý đặt hàng ở đây
        // ...

        // Hiển thị thông báo SweetAlert2
        Swal.fire({
            title: 'Đặt hàng thành công!',
            text: 'Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn sớm nhất có thể.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            // Nếu người dùng nhấp vào nút "OK" trong alert, hãy thực hiện hành động cụ thể
        if (result.isConfirmed) {

                // Nếu không có URL được cung cấp, mặc định sẽ gửi form
                document.getElementById('orderForm').submit();
           
        }
        });
    }
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var orderNumberOfSeatsInput = document.getElementById('order_number_of_seats');
    var cashPaymentRadio = document.getElementById('cashPayment');
    var momoPaymentRadio = document.getElementById('order_payment_momo');
    // var vnPayPaymentRadio = document.getElementById('order_payment_vnpay');

    function updatePaymentOptions() {
        var numberOfSeats = parseInt(orderNumberOfSeatsInput.value);

        if (isNaN(numberOfSeats) || numberOfSeats <= 0) {
            // Nếu order_number_of_seats là null hoặc <= 0, disable cả hai phương thức thanh toán
            cashPaymentRadio.disabled = true;
            momoPaymentRadio.disabled = true;
            // vnPayPaymentRadio.disabled = true;
        } else {
            // Ngược lại, enable chúng
            cashPaymentRadio.disabled = false;
            momoPaymentRadio.disabled = false;
            // vnPayPaymentRadio.disabled = false;
        }
    }

    // Gọi hàm để cập nhật trạng thái ban đầu
    updatePaymentOptions();

    // Thêm sự kiện cho trường order_number_of_seats
    orderNumberOfSeatsInput.addEventListener('input', updatePaymentOptions);
});
</script>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/order_customer.blade.php ENDPATH**/ ?>