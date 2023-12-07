<!DOCTYPE html>
<html>
<head>
    <title>Tour Detail</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/index.css')); ?>" rel='stylesheet' type='text/css' />
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
    <?php $__currentLoopData = $tour_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour_dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($tour_dt->tour_id == $tour->tour_id): ?>
        <div class="house-details">
            <div class="house-title">
                <h1>
                    Tour: 
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
                </h1>
                <div class="row">
                    <div>
                        
                        
                        
                    </div>
                    <div>
                        
                    </div>
                </div>
            </div>
            <div class="gallery">
                    <div class="image-show"><img src="../public/uploads/tour/<?php echo e($tour -> tour_image); ?>"></div>
                    
            </div>
            <div class="small-details">
                <h2>
                    <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($tour->tour_city == $ct->province_id): ?>
                        Tỉnh thành: <?php echo e($ct->province_name); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </h2>
                
                <h4 style="font-size: 25px"><i style="color: #ff5361;" class="fa-solid fa-money-check-dollar"></i> <?php echo e(number_format($tour -> tour_price,0,',','.')); ?>đ</h4>
            </div>
            <hr class="line">
            <div class="check-form">
                <div>
                    <label>
                    Thời gian bắt đầu: 
                    <?php echo e(\Carbon\Carbon::parse($tour_dt->date_start)->format('H:i d/m/Y')); ?>

                    </label>
                </div>
                <div>
                    <label>
                    Thời gian kết thúc:
                    <?php echo e(\Carbon\Carbon::parse($tour_dt->date_end)->format('H:i d/m/Y')); ?>

                    </label>
                </div>
                <div class="guest-field">
                    <label>
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
                    </label>
                </div>
                <div class="order_now">
                    <a style="text-decoration: none; color: inherit;" href="<?php echo e(URL::to('/order/'.$tour_dt->tourdetail_id)); ?>"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</a>
                </div>
                
            </div>
            <table style="width:100%; margin-bottom:-5%">
                <tr>
                    <td style="width:30%">
                        <label><i class="fa-solid fa-calendar-days"></i> Lịch trình</label>
                        <?php $__currentLoopData = $all_scheduledetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($tour->tour_schedule == $schd->scheduledetail_id): ?>
                            <?php echo $schd->scheduledetail_content; ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td style="width:70%">
                        <?php echo $tour->tour_weather; ?>

                    </td>
                </tr>
            </table>
            <hr class="line">
            <h3>Điểm nổi bật</h3>
            <p class="home-desc"><?php echo $tour->tour_outstanding; ?></p>
            <hr class="line">    
            <div class="map">
                <h3>Bản đồ vị trí khởi hành</h3>
                <?php echo $tour->tour_start_location; ?>

                <b>
                    <?php echo e($tour->tour_departure); ?>

                </b>
                
            </div>
            
            <hr class="line">
            <form id="commentForm" method="post" action="<?php echo e(URL::to('/add-comment')); ?>" enctype="multipart/form-data" onsubmit="onSubmitForm(event)">
                <?php echo e(csrf_field()); ?>

                <div class="comment-customer">
                    <input type="hidden" name="tour_id" value="<?php echo e($tour_dt->tour_id); ?>">
                    <input type="hidden" name="customer_id" id="customer_id" value="<?php echo e($customerID); ?>">
                    <h2 style="padding-bottom:1%">Đánh giá</h2>
                    <textarea name="comment_content" id="" cols="100" rows="10" required></textarea>
                </div>
                <div class="comment-button"><button type="submit">Đăng tải</button></div>
            </form>

            <br>
            
            <div class="list-comment">
                <h1>Nội dung đánh giá</h1>
                <?php $__currentLoopData = $all_comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($cus->customer_id == $cmt->customer_id && $cmt->tour_id == $tour_dt->tour_id && $tour_dt->tour_id == $tour->tour_id): ?>
                            <div class="customer-cus">
                                <h2><i class="fa-regular fa-user"></i> <?php echo e($cus->customer_name); ?></h2>
                                <p><i class="fa-regular fa-envelope"></i> : <?php echo e($cus->customer_mail); ?></p>
                                <p><?php echo e($cmt->comment_content); ?></p>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <div class="container">
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
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="Travel ViLO"
  agent-id="331143be-b90c-41f3-a40a-ece5d0d55094"
  language-code="vi"
  chat-icon="<?php echo e(asset('../public/frontend/images/chat-icon.png')); ?>"
></df-messenger>
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
        var navBar = document.getElementById("navBar");
        function togglebtn(){
            navBar.classList.toggle("hidemenu");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function onSubmitForm(event) {
            // Ngăn chặn việc gửi form mặc định
            event.preventDefault();
    
            // Kiểm tra nếu customerID không tồn tại (chưa đăng nhập)
            if (!document.getElementById('customer_id').value) {
                // Hiển thị thông báo SweetAlert2
                Swal.fire({
                    title: 'Bạn chưa đăng nhập!',
                    text: 'Vui lòng đăng nhập để thực hiện đánh giá.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            } else {
                // Nếu đã đăng nhập, thực hiện các xử lý đặt hàng ở đây
                // ...
    
                // Hiển thị thông báo SweetAlert2
                Swal.fire({
                    title: 'Đăng tải thành công!',
                    text: 'Cảm ơn bạn đã đánh giá!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Nếu người dùng nhấp vào nút "OK" trong alert, hãy gửi form
                    if (result.isConfirmed) {
                        document.getElementById('commentForm').submit();
                    }
                });
            }
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
</body>

</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/tour_detail.blade.php ENDPATH**/ ?>