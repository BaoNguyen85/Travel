<!DOCTYPE html>
<html>
<head>
    <title>Test</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/customerLogin.css')); ?>" rel='stylesheet' type='text/css' />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <video autoplay muted loop id="background-video">
            <source src="<?php echo e(asset('../public/image/bg.mp4')); ?>" type="video/mp4">
            
        </video>
        <nav id="navBar">
            <a class="logo-name" href="<?php echo e(URL::to('/')); ?>"><img src="<?php echo e(asset('../public/frontend/images/logo.png')); ?>" class="logo" alt=""></a>
            <ul class="nav-links">
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
            <div class="account-customer">
                <a href="<?php echo e(URL::to('/customer-register')); ?>" class="register-btn">Đăng ký</a>
                <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
            </div>
            
        </nav>
        <div class="wrapper">
            <form action="<?php echo e(URL::to ('/customer-dashboard')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <?php
                $message = Session::get('message');
                if($message){
                echo '<span class="mess">'.$message.'</span>';
                Session::put('message',null);
                }
                ?>
                <h1>Đăng Nhập</h1>
                <div class="input-box">
                    <input type="text" placeholder="Mail" name="customer_mail" required>
                    <i class='bx bxl-gmail'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="customer_password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="remember-forgot">
                    
                </div>
                <button type="submit" class="btn">Đăng nhập</button>
                <div class="register-link">
                    <a href="<?php echo e(URL::to('/login-customer-google')); ?>"><img src="<?php echo e(asset('../public/frontend/images/google.png')); ?>" style="width: 8%;padding: 4% 0" alt=""></a><p> Or <a href="<?php echo e(URL::to('/customer-register')); ?>">Đăng Ký</a></p>
                </div>
            </form>
        </div>   
    </div>
    
<script>
    var navBar = document.getElementById("navBar");
    function togglebtn(){
        navBar.classList.toggle("hidemenu");
    }
</script>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/customerLogin.blade.php ENDPATH**/ ?>