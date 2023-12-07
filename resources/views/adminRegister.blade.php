<!DOCTYPE html>
<html>
<head>
    <title>Admin</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset ('/../resources/css/adminLogin.css') }}" rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/font-awesome/5.15.3/css/all.min.css' rel='stylesheet'>
    <link rel="icon" href="{{asset('../public/frontend/images/logo2.png') }}" type="image/x-icon">
<body>
    <div class="wrapper">
        <h1>ĐĂNG KÝ</h1>
        <form action="{{URL::to ('/ad-register') }}" method="post">
            {{ csrf_field() }}
            <?php
            $message = Session::get('message');
            if($message){
            echo '<span class="mess">'.$message.'</span>';
            Session::put('message',null);
            }
            ?>
            <div class="input-box">
                <input type="text" placeholder="Fullname" required="required" name="admin_name">
            </div>
            <div class="input-box">
                <input type="date" required="required" name="admin_birth">
            </div>
            <div class="input-box">
                <select name="admin_sex">
                    <option hidden>Sex</option>
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email" required="required" name="admin_email">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Address" required="required" name="admin_address">
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required="required" name="admin_password">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Phone" required="required" name="admin_phone">
            </div>
            <span>
                <input type="submit" value="Đăng ký">
            </span>
        </form>
        <!-- <div class="terms">
            <input type="checkbox" id="checkbox">
            <label for="checkbox">I agree to these <a href="">Tern & Conditions</a></label>
        </div> -->
        <div class="member">
            <a href="admin-login">Đăng nhập</a>
        </div>
    </div>
</body>
</html>