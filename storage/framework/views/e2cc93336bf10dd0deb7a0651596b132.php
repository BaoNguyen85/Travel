<!DOCTYPE html>
<html>
<head>
    <title>Profile</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/index.css')); ?>" rel='stylesheet' type='text/css' />
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?php echo e(asset('../public/frontend/images/logo1.png')); ?>" type="image/x-icon">
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
            <form method="post" action="<?php echo e(URL::to('/search-tour')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="location-input">
                    <input name="keywords_submit" type="text" placeholder="Search...">
                </div>
                <button class="micro" type="button" id="startSpeechRecognition"><i class="fa-solid fa-microphone"></i></button>
                <button type="submit"><img src="<?php echo e(asset ('../public/frontend/images/search.png')); ?>"></button>
            </form>
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
    <?php $__currentLoopData = $edit_profile_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form id="profileForm" method="post" action="<?php echo e(URL::to('/update-profile-customer/'.$customerID)); ?>" enctype="multipart/form-data" onsubmit="onSubmitForm(event)">
        <?php echo e(csrf_field()); ?>

    <div class="edit-profile-customer">
        <h2 style="text-align: center">CHỈNH SỬA THÔNG TIN CÁ NHÂN</h2>
        <h2 style="text-align: left; margin-left:5%; font-size:30px"><i class="fa-solid fa-user"></i></h2>
        <p><b>Họ tên :</b> <input type="text" value="<?php echo e($pro->customer_name); ?>" name="customer_name" required></p>
        <p><b>Ngày sinh :</b> <input type="date" value="<?php echo e($pro->customer_birth); ?>" name="customer_birth" required></p>
        <p><b>Email :</b> <?php echo e($pro->customer_mail); ?></p>
        <p><b>Số điện thoại :</b> <input type="text" value="<?php echo e($pro->customer_phone); ?>" name="customer_phone" required></p>
        <p><b>Địa chỉ :</b> <input type="text" value="<?php echo e($pro->customer_address); ?>" name="customer_address" required></p>
        <p></p>
        <input class="profile-update" type="submit" value="Cập nhật">
    </div>
    </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function onSubmitForm(event) {
        // Ngăn chặn việc gửi form mặc định
        event.preventDefault();

        // Thực hiện các xử lý đặt hàng ở đây
        // ...

        // Hiển thị thông báo SweetAlert2
        Swal.fire({
            title: 'Cập nhật thông tin thành công!',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            // Nếu người dùng nhấp vào nút "OK" trong alert, hãy thực hiện hành động cụ thể
        if (result.isConfirmed) {

                // Nếu không có URL được cung cấp, mặc định sẽ gửi form
                document.getElementById('profileForm').submit();
           
        }
        });
    }
</script>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_profile_customer.blade.php ENDPATH**/ ?>