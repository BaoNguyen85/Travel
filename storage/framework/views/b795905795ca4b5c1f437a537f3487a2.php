<!DOCTYPE html>
<html>
<head>
    <title>Travel ViLO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/index.css')); ?>" rel='stylesheet' type='text/css' />
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="<?php echo e(asset('../public/frontend/images/logo1.png')); ?>" type="image/x-icon">
</head>
<body>
    <div class="header">
        <video autoplay muted loop id="background-video">
            <source src="../public/image/bg.mp4" type="video/mp4">
            
        </video>

        <nav id="navBar">
            <a class="logo-name" href="<?php echo e(URL::to('/index')); ?>"><img src="<?php echo e(asset('../public/frontend/images/logo.png')); ?>" class="logo" alt=""></a>
            <ul class="nav-links">
                <li><a href="#" id="tours-type-link">Loại Tour</a></li>
                <li><a href="#" id="trending-link">Xu Hướng</a></li>
                <li><a href="#" id="tour-link">Tour Nổi Bật</a></li>
            </ul>
            <div class="account-customer" id="accountCustomer">
                <?php if(isset($customerName)): ?>
                    <a style="color: white"><?php echo e($customerName); ?></a>
                    <a class="register-btn" onclick="toggleLogout()"><i class="fa-solid fa-user"></i></a>
                    
                    <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
            
                    <!-- Dropdown for Logout -->
                    <div class="logout-dropdown">
                        <i class="fa-solid fa-user-pen"><a href="<?php echo e(URL::to('/profile-customer/'.$customerID)); ?>"> Thông tin tài khoản</a></i> <br>
                        <i class="fa-solid fa-right-from-bracket"><a href="<?php echo e(URL::to('/customer-logout')); ?>"> Đăng xuất</a></i> 
                        <!-- Add more items as needed -->
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(URL::to('/customer-login')); ?>" class="register-btn">Đăng nhập</a>
                    <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
                <?php endif; ?>
            </div>
        </nav>
        <div class="container" style="margin-top: -10%">
            <h1>Search</h1>
            <div class="search-bar">
                <form id="form-search" method="post" action="<?php echo e(URL::to('/search-tour')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="location-input">
                        
                        <input style="width: 100%" autocomplete="off" id="keywords_submit" name="keywords_submit" type="text" placeholder="Tìm kiếm...">
                        
                    </div>
                    
                    
                    <button class="micro" type="button" id="startSpeechRecognition"><i class="fa-solid fa-microphone"></i></button>
                    <button type="submit"><img src="../public/frontend/images/search.png"></button>
                </form>
                <div id="search-suggestions">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: -18%">
        <div class="cta">
            <h3>TRAVEL VILO <br>Thỏa Sức Khám Phá</h3>
            <p>Đem đến những chuyến đi chất lượng</p>
            <p>Khám phá những vùng đất mới</p>
            <p>An toàn - Tiết kiệm </p>
            
        </div>

        <h2 class="sub-title" style="font-size:20pt" id="tourtype">Loại Tour
            <button style="float: right;padding-left:1%" id="next-exclusives" class="exclusives-button"><i class="fa-solid fa-square-caret-right"></i></button>
            <button style="float: right" id="prev-exclusives" class="exclusives-button"><i class="fa-solid fa-square-caret-left"></i></i></button>
        </h2>
        <div id="carousel-exclusives">
            <div class="exclusives">
                <?php $__currentLoopData = $all_tour_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($tourtype->tourtype_status==0): ?>
                <div>
                    <a style="text-decoration: none; color: inherit;" href="<?php echo e(URL::to('/tourtype-detail/'.$tourtype->tourtype_id)); ?>">
                        <img class="exclusives-image" src="public/uploads/tourtype/<?php echo e($tourtype -> tourtype_image); ?>">
                        <h3 class="name" style="text-align: center"><?php echo e($tourtype->tourtype_name); ?></h3>
                    </a>
                    
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

   
        <h2 class="sub-title" style="font-size:20pt" id="trending">Xu Hướng
            <button style="float: right;padding-left:1%" id="next-trending" class="trending-button"><i class="fa-solid fa-square-caret-right"></i></button>
            <button style="float: right" id="prev-trending" class="trending-button"><i class="fa-solid fa-square-caret-left"></i></i></button>
        </h2>
        <div id="carousel-trending">
            
            <div class="trending">
                <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($pl->place_status==0): ?>
                <div>
                    <a style="text-decoration: none; color: inherit;" href="<?php echo e(URL::to('/trending-place/'.$pl->place_id)); ?>">
                        <img class="trending-image" src="public/uploads/place/<?php echo e($pl -> place_image); ?>">
                        <h3 class="name" style="text-align: center"><?php echo e($pl->place_name); ?></h3>
                    </a>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
        </div>
         
        
        
        <h2 class="sub-title" style="font-size:20pt" id="tour">Tour Nổi Bật  
        </h2>
        <div id="carousel-stories">
            
            <div class="stories">
                <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tourdetail->tour_id == $tour->tour_id): ?>
                        <?php if($tourdetail->tour_show==0): ?>
                        <div class="tour-index">
                            <a class="tour-detail" href="<?php echo e(URL::to('/tour-detail/'.$tourdetail->tourdetail_id)); ?>">
                            <img src="public/uploads/tour/<?php echo e($tour -> tour_avt); ?>">
                            
                            <div class="title-frame">
                                <h3 class="name">
                                <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ci): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($ci->province_id == $tour->tour_city): ?>
                                        <?php echo e($ci->province_name); ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </h3>
                                
                                <h3 class="name">
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
                                </h3>
                                <div class="title-time">Thời gian khởi hành:</div>
                                <div class="title-time">
                                    <?php echo e(\Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y')); ?>

                                </div>
                                <?php 
                                    $bookedSeats = 0; 
                                ?>
                                <div class="title-time">Số chỗ còn lại:
                                    <?php $__currentLoopData = $all_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($order->tourdetail_id == $tourdetail->tourdetail_id): ?>
                                            <?php 
                                                $bookedSeats=$bookedSeats + $order->order_number_of_seats; 
                                            ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $remainingSeats = $tourdetail->number_of_seats - $bookedSeats; 
                                        if ($remainingSeats < 0) {
                                            $remainingSeats = 0;
                                        }
                                        echo $remainingSeats;
                                    ?>

                                </div>
                                <h3 class="price_tour"><i class="fa-solid fa-money-check-dollar"></i> <?php echo e(number_format($tour -> tour_price,0,',','.')); ?>đ</h3>
                                
                                <div class="order_now1">
                                    <a style="text-decoration: none; color: inherit;" href="<?php echo e(URL::to('/order/'.$tourdetail->tourdetail_id)); ?>"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</a>
                                </div>
                            </div>
                            
                            </a>
                            
                            
                        </div>

                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
        </div>

        

        <div class="about-msg">
            <h2 style="font-size: 30px">Về Chúng Tôi</h2>
            <?php $__currentLoopData = $all_infor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="colum-container-footer">
                <div class="colum1-footer">
                    <p><img src="public/uploads/logo/<?php echo e($inf->information_logo); ?>" height="100" width="300" style="border-radius: 10px"></p>
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
    var navBar = document.getElementById("navBar");
    function togglebtn(){
        navBar.classList.toggle("hidemenu");
    }

    var tourtypeLink = document.getElementById("tours-type-link");
    tourtypeLink.addEventListener("click", function(event) {
        event.preventDefault();
        var tourtypeSection = document.getElementById("tourtype");
        tourtypeSection.scrollIntoView({ behavior: "smooth" });
    });
</script>
<script>
    var navBar = document.getElementById("navBar");
    function togglebtn(){
        navBar.classList.toggle("hidemenu");
    }

    var toursLink = document.getElementById("trending-link");
    toursLink.addEventListener("click", function(event) {
        event.preventDefault();
        var toursSection = document.getElementById("trending");
        toursSection.scrollIntoView({ behavior: "smooth" });
    });
</script>
<script>
    var navBar = document.getElementById("navBar");
    function togglebtn(){
        navBar.classList.toggle("hidemenu");
    }

    var toursLink = document.getElementById("tour-link");
    toursLink.addEventListener("click", function(event) {
        event.preventDefault();
        var toursSection = document.getElementById("tour");
        toursSection.scrollIntoView({ behavior: "smooth" });
    });
</script>
<script>
    const stories = document.querySelector('.stories');
    const prevButton = document.querySelector('#prev-stories');
    const nextButton = document.querySelector('#next-stories');
    let currentIndex = 0;

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % (stories.children.length - 2);
        updateCarousel();
    });

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + stories.children.length - 2) % (stories.children.length - 2);
        updateCarousel();
    });

    function updateCarousel() {
        const offset = currentIndex * (stories.children[0].offsetWidth + 10);
        stories.style.transform = `translateX(-${offset}px)`;
    }

    updateCarousel();
</script>
<script>
    const exclusives = document.querySelector('.exclusives');
    const prevExclusivesButton = document.querySelector('#prev-exclusives');
    const nextExclusivesButton = document.querySelector('#next-exclusives');
    let currentExclusivesIndex = 0;

    nextExclusivesButton.addEventListener('click', () => {
        currentExclusivesIndex = (currentExclusivesIndex + 1) % (exclusives.children.length - 3);
        updateExclusivesCarousel();
    });

    prevExclusivesButton.addEventListener('click', () => {
        currentExclusivesIndex = (currentExclusivesIndex - 1 + exclusives.children.length - 3) % (exclusives.children.length - 3);
        updateExclusivesCarousel();
    });

    function updateExclusivesCarousel() {
        const offset = currentExclusivesIndex * (exclusives.children[0].offsetWidth + 10);
        exclusives.style.transform = `translateX(-${offset}px)`;
    }

    updateExclusivesCarousel();
</script>

<script>
    const trending = document.querySelector('.trending');
    const prevTrendingButton = document.querySelector('#prev-trending');
    const nextTrendingButton = document.querySelector('#next-trending');
    let currentTrendingIndex = 0;

    nextTrendingButton.addEventListener('click', () => {
        currentTrendingIndex = (currentTrendingIndex + 1) % (trending.children.length - 2);
        updateTrendingCarousel();
    });

    prevTrendingButton.addEventListener('click', () => {
        currentTrendingIndex = (currentTrendingIndex - 1 + trending.children.length - 2) % (trending.children.length - 2);
        updateTrendingCarousel();
    });

    function updateTrendingCarousel() {
        const offset = currentTrendingIndex * (trending.children[0].offsetWidth + 10);
        trending.style.transform = `translateX(-${offset}px)`;
    }

    updateTrendingCarousel();
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
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/index.blade.php ENDPATH**/ ?>