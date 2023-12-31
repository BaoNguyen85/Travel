<!DOCTYPE html>
<html>
<head>
    <title>Listing Page</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset ('/../resources/css/index.css')); ?>" rel='stylesheet' type='text/css' />
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav id="navBar" class="navbar-white">
        <a href="<?php echo e(URL::to('/')); ?>"><img src="../public/frontend/images/logo.png" class="logo" alt=""></a>
        <ul class="nav-links">
            <li><a href="#" class="active">Popular Places</a></li>
            <li><a href="#">Travel Outside</a></li>
            <li><a href="#">Online Packages</a></li>
        </ul>
        <a href="<?php echo e(URL::to('/customer-login')); ?>" class="register-btn">Login</a>
        <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
    </nav>
    <div class="container">
        <div class="list-container">
            <div class="left-col">
                <p>200+ Options</p>
                <h1>Recommended Places In San Francisco</h1>
                <div class="house">
                    <div class="house-img">
                        <img src="../public/frontend/images/r1.jpg">
                    </div>
                    <div class="house-info">
                        <p>Private Villa in San Francisco</p>
                        <h3>Deluxe Queen oom With Street View</h3>
                        <p>1 Bedroom / 1 Bathroom / Wifi / Kitchen</p>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="house-price">
                            <p>2 Guest</p>
                            <h4>$ 100 <span>/ day</span></h4>
                        </div>
                    </div>
                </div>
                <div class="house">
                    <div class="house-img">
                        <img src="../public/frontend/images/r2.jpg">
                    </div>
                    <div class="house-info">
                        <p>Private Villa in San Francisco</p>
                        <h3>Deluxe Queen oom With Street View</h3>
                        <p>1 Bedroom / 1 Bathroom / Wifi / Kitchen</p>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="house-price">
                            <p>2 Guest</p>
                            <h4>$ 100 <span>/ day</span></h4>
                        </div>
                    </div>
                </div>
                <div class="house">
                    <div class="house-img">
                        <img src="../public/frontend/images/r3.jpg">
                    </div>
                    <div class="house-info">
                        <p>Private Villa in San Francisco</p>
                        <h3>Deluxe Queen oom With Street View</h3>
                        <p>1 Bedroom / 1 Bathroom / Wifi / Kitchen</p>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="house-price">
                            <p>2 Guest</p>
                            <h4>$ 100 <span>/ day</span></h4>
                        </div>
                    </div>
                </div>
                <div class="house">
                    <div class="house-img">
                        <img src="../public/frontend/images/r4.jpg">
                    </div>
                    <div class="house-info">
                        <p>Private Villa in San Francisco</p>
                        <h3>Deluxe Queen oom With Street View</h3>
                        <p>1 Bedroom / 1 Bathroom / Wifi / Kitchen</p>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="house-price">
                            <p>2 Guest</p>
                            <h4>$ 100 <span>/ day</span></h4>
                        </div>
                    </div>
                </div>
                <div class="house">
                    <div class="house-img">
                        <img src="../public/frontend/images/r5.jpg">
                    </div>
                    <div class="house-info">
                        <p>Private Villa in San Francisco</p>
                        <h3>Deluxe Queen oom With Street View</h3>
                        <p>1 Bedroom / 1 Bathroom / Wifi / Kitchen</p>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="house-price">
                            <p>2 Guest</p>
                            <h4>$ 100 <span>/ day</span></h4>
                        </div>
                    </div>
                </div>
                <div class="house">
                    <div class="house-img">
                        <img src="../public/frontend/images/r1.jpg">
                    </div>
                    <div class="house-info">
                        <p>Private Villa in San Francisco</p>
                        <h3>Deluxe Queen oom With Street View</h3>
                        <p>1 Bedroom / 1 Bathroom / Wifi / Kitchen</p>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="house-price">
                            <p>2 Guest</p>
                            <h4>$ 100 <span>/ day</span></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-col">
                <div class="sidebar">
                    <h2>Select Filters</h2>
                    <h3>Property Type</h3>
                    <div class="filter">
                        <input type="checkbox"> <p>House</p> <span>(0)</span>
                    </div>
                    <div class="filter">
                        <input type="checkbox"> <p>Hostel</p> <span>(0)</span>
                    </div>
                    <div class="filter">
                        <input type="checkbox"> <p>Flat</p> <span>(0)</span>
                    </div>
                    <div class="filter">
                        <input type="checkbox"> <p>Villa</p> <span>(0)</span>
                    </div>
                    <div class="filter">
                        <input type="checkbox"> <p>Guest Suite</p> <span>(0)</span>
                    </div>
                    <h3>Amenities</h3>
                    <div class="filter">
                        <input type="checkbox"> <p>Air Conditioning</p> <span>(0)</span>
                    </div>
                    <div class="filter">
                        <input type="checkbox"> <p>Gym</p> <span>(0)</span>
                    </div>
                    <div class="filter">
                        <input type="checkbox"> <p>Pool</p> <span>(0)</span>
                    </div>
                    <div class="filter">
                        <input type="checkbox"> <p>Kitchen</p> <span>(0)</span>
                    </div>

                    <div class="sidebar-link">
                        <a href="#">View More</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagination">
            <img src="../public/frontend/images">
            <span class="current">1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>5</span>
            <span>&middot; &middot; &middot; &middot;</span>
            <span>20</span>
            <img src="../public/frontend/images" class="right-arrow">
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
    var navBar = document.getElementById("navBar");
    function togglebtn(){
        navBar.classList.toggle("hidemenu");
    }
</script>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/listing.blade.php ENDPATH**/ ?>