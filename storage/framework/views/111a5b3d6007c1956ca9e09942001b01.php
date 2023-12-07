<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
        <link href="<?php echo e(asset ('/../resources/css/dashboard.css')); ?>" rel='stylesheet' type='text/css' />
        <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>TourGuide</title>
        <link rel="icon" href="<?php echo e(asset('../public/frontend/images/logo2.png')); ?>" type="image/x-icon">
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <div class="menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="head">
                    <div class="user-img">
                        <img src="<?php echo e(asset('../public/frontend/images/user.png')); ?>">
                    </div>
                    <div class="user-details">
                        <p class="title">TourGuide</p>
                        <p class="name">
                            <?php
                            $name = Session::get('tourguide_name');
                            echo $name;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="nav">
                    <div class="menu">
                        <p class="title">Main</p>
                        <ul>
                            <li>
                                <a href="<?php echo e(URL::to('/tourguideDashboard')); ?>">
                                    <i class="fa-solid fa-house"></i>
                                    <span class="text">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(URL::to('/tourguide-new-tour')); ?>">
                                    <i class="fa-solid fa-bell"></i>
                                    <span class="text">Tour mới</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="menu">
                        <p class="title">Settings</p>
                        <ul>
                            <li>
                                <a href="<?php echo e(URL::to('/tourguide-infor/'.$tourguideID)); ?>">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="text">Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="menu">
                    <p class="title">Account</p>
                    <ul>
                        
                        <li>
                            <a href="<?php echo e(URL::to('/tourguide-logout')); ?>">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <?php echo $__env->yieldContent('tourguide_content'); ?>
            </div>
        </div>
        

        <script
        src="https://cdjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?php echo e(asset ('/../resources/js/script.js')); ?>"></script>
        <script>
            CKEDITOR.replace('ckeditor1');
            CKEDITOR.replace('ckeditor2');
            CKEDITOR.replace('ckeditor3');
            CKEDITOR.replace('ckeditor4');
            CKEDITOR.replace('ckeditor5');
            CKEDITOR.replace('ckeditor6');
        </script>        
    </body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/tourguide_layout.blade.php ENDPATH**/ ?>