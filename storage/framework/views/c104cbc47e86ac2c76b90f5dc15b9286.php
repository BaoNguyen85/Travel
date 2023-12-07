<!DOCTYPE html>
<html>
<head>
    <title>Trending Place</title><meta charset="utf-8">
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
    <div class="container">
        <div class="list-container">
            <div class="left-col">
                <div class="sidebar">
                    <h3 style="background-color: #2e9cca;padding: 5% 0;text-align:center;color:white">Danh sách loại tour</h3>
                    <?php $__currentLoopData = $all_tour_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="filter">
                        <a href="<?php echo e(URL::to('/tourtype-detail/'.$tourtype->tourtype_id)); ?>"><p><?php echo e($tourtype->tourtype_name); ?></p></a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                </div>
            </div>
            <div class="right-col">
                
                <?php $__currentLoopData = $trending_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trend_pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h1><?php echo e($trend_pl->place_name); ?></h1>
                <p><?php echo $trend_pl->place_describe; ?><br></p>
                    <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_destination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($trend_pl->place_id == $des_dtl->place_id && $des_dtl->destination_id == $des->destination_id && $des->destination_id == $tour->tour_destination && $tour->tour_id == $tourdetail->tour_id): ?>
                                <div class="house">
                                    <div class="house-img">
                                        <a href="<?php echo e(URL::to('/tour-detail/'.$tourdetail->tourdetail_id)); ?>">
                                        <img src="../public/uploads/tour/<?php echo e($tour->tour_avt); ?>">
                                        </a>
                                    </div>
                                    
                                    <div class="house-info">
                                        <a style="text-decoration: none" href="<?php echo e(URL::to('/tour-detail/'.$tourdetail->tourdetail_id)); ?>">
                                        <h3><?php echo e($tour->tour_name); ?></h3>
                                        </a>
                                        <p><i class="fa-solid fa-location-dot"></i><b> Các điểm đến:</b> 
                                            <?php $firstPlace = true; ?>
                                            <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($pl->place_id == $des_dtls->place_id && $des_dtls->destination_id == $tour->tour_destination): ?>
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
                                                    <?php if($order->tourdetail_id == $tourdetail->tourdetail_id): ?>
                                                        <?php 
                                                            $bookedSeats=$bookedSeats + $order->order_number_of_seats; 
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php 
                                                    $remainingSeats = $tourdetail->number_of_seats - $bookedSeats; 
                                                    echo $remainingSeats;
                                                ?>
                                        </p>
                                        <p><i class="fa-solid fa-clock"></i> Thời gian diễn ra:
                                                <p>Từ: <?php echo e(\Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y')); ?></p>
                                                <p>Đến: <?php echo e(\Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y')); ?></p>
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
                                            
                                            <div class="order_now2">
                                                <a style="text-decoration: none; color: inherit;" href="<?php echo e(URL::to('/order/'.$tourdetail->tourdetail_id)); ?>"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
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
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/trending_place.blade.php ENDPATH**/ ?>