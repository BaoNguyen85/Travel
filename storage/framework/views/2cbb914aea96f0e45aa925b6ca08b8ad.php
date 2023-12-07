<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/dashboard.css')); ?>" rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <?php
                            $name = Session::get('admin_name');
                        echo '<span class="title">'.$name.'</span>';
                        
                        ?>  
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(URL::to('/dashboard')); ?>">
                        <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(URL::to('/new-tour')); ?>">
                        <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                        <span class="title">Tours</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                        <span class="title">Brand Name</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                        <span class="title">Brand Name</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(url('/admin-logout')); ?>">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <!-- search -->
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search...">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <!-- user img -->
                <div class="user">
                    <img src="./images/user.png">
                </div>
        </div>
        
        <div class="container">
            <div class="content">
                <label>Name</label>
                <input type="text" >
            </div>
        </div>

    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        // menu toggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main'); 

        toggle.onclick = function(){
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }

        // add hover class in selected list item
        let list = document.querySelectorAll('.navigation li');
        function activeLink(){
            list.forEach((item) =>
            item.classList.remove('hovered'));
            this.classList.add('hovered');
        }
        list.forEach((item)=>
        item.addEventListener('mouseover',activeLink));
    </script>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/newtours.blade.php ENDPATH**/ ?>