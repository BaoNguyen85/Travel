<!DOCTYPE html>
<html>
<head>
    <title>House Detials Page</title><meta charset="utf-8">
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
            <li><a href="listing.html">Online Packages</a></li>
        </ul>
        <a href="<?php echo e(URL::to('/customer-login')); ?>" class="register-btn">Login</a>
        <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
    </nav>
    <div class="house-details">
        <div class="house-title">
            <h1>Wenge House</h1>
            <div class="row">
                <div>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <span>245 Reviews</span>
                </div>
                <div>
                    <p>Location:Korea, Seoul</p>
                </div>
            </div>
        </div>
        <div class="gallery">
                <div class="gallery-img-1"><img src="../public/frontend/images/r1.jpg" alt=""></div>
                <div><img src="images/r1.jpg" alt=""></div>
                <div><img src="images/r1.jpg" alt=""></div>
                <div><img src="images/r1.jpg" alt=""></div>
                <div><img src="images/r1.jpg" alt=""></div>
        </div>
        <div class="small-details">
            <h2>Entrie rental unit hosted by Brandon</h2>
            <p>2 guest &nbsp;&nbsp; 2 beds &nbsp;&nbsp; 1 bathroom </p>
            <h4>$ 100 / day</h4>
        </div>
        <hr class="line">
        <form class="check-form" action="">
            <div>
                <label>Check-in</label>
                <input type="text" placeholder="Add date">
            </div>
            <div>
                <label>Check-out</label>
                <input type="text" placeholder="Add date">
            </div>
            <div class="guest-field">
                <label>Guest</label>
                <input type="text" placeholder="2 guest">
            </div>
            <button type="submit">Check Availability</button>
        </form>

        <ul class="details-list">
            <li><i class="fa-solid fa-house"></i>Entire Home
                <span>You will have the entire flat for you.</span>
            </li>
            <li><i class="fa-solid fa-paintbrush"></i>Enhanced Clean
                <span>This host has committed to staybnb's clearning process.</span>
            </li>
            <li><i class="fa-sharp fa-solid fa-location-dot"></i>Great Location
                <span>90% of recent guest gave the location a 5 star rating.</span>
            </li>
            <li><i class="fa-solid fa-heart"></i>Grate Cehck-in Experience
                <span>100% of recent guest gave the check-in process a 5 star rating.</span>
            </li>
        </ul>

        <hr class="line">

        <p class="home-desc">Philippine police said on Tuesday they have rescued more than 1,000 people allegedly trafficked into the country to work for an online casino in Manila.
            Chinese, Vietnamese, Singaporean and Malaysian victims were among those found when police raided buildings in the capital on Monday night.
            People from Indonesia, Pakistan, Cameroon, Sudan, and Myanmar were also found inside the compound.
            More than 2,700 people were detained during the raids – over 1,500 were Filipinos.
            Philippine authorities are interviewing the detainees to identify who was a victim or suspect, said police Captain Michelle Sabino, a spokeswoman for the anti-cybercrime unit.
            International concern has been growing over internet scams in the Asia-Pacific region, often staffed by trafficking victims tricked or coerced into promoting bogus crypto investments.</p>
        <hr class="line">    
        <div class="map">
            <h3>Location on map</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1005495.1089029668!2d104.87278233867697!3d10.122376427462923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f927382cd%3A0x72a463d91109ec67!2zQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1687940778294!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <b>Can Tho, VietNam</b>
            <p>It's like a homw away from home.</p>
        </div>
        <hr class="line">
        <div class="host">
            <!-- avata -->
            <img src="../public/frontend/images" alt="">
            <div>
                <h2>Hosted by Brandon</h2>
                <p><span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </span>&nbsp;&nbsp; 245 reviews &nbsp;&nbsp; response rate 100% &nbsp;&nbsp; Response time: 60 min</p>
            </div>
        </div>
        <a href="#" class="contact-host">Contact Host</a>
    </div>
    <div class="container">
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
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/house.blade.php ENDPATH**/ ?>