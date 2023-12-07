<!DOCTYPE html>
<html>
<head>
    <title>Admin</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/adminLogin.css')); ?>" rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/font-awesome/5.15.3/css/all.min.css' rel='stylesheet'>
    <link rel="icon" href="<?php echo e(asset('../public/frontend/images/logo2.png')); ?>" type="image/x-icon">
<body>
    <div class="wrapper">
        <h1>ĐĂNG NHẬP</h1>
        <form action="<?php echo e(URL::to ('/admin-dashboard')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <?php
            $message = Session::get('message');
            if($message){
            echo '<span class="mess">'.$message.'</span>';
            Session::put('message',null);
            }
            ?>
            <div class="input-box">
                <input type="text" placeholder="Email" required="required" name="admin_email">
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required="required" name="admin_password">
            </div>
            <span>
                <input type="submit" value="Đăng nhập">
            </span>
        </form>
        <!-- <div class="terms">
            <input type="checkbox" id="checkbox">
            <label for="checkbox">I agree to these <a href="">Tern & Conditions</a></label>
        </div> -->
        <div class="member">
            <a href="admin-register">Đăng ký</a>
        </div>
    </div>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/adminLogin.blade.php ENDPATH**/ ?>