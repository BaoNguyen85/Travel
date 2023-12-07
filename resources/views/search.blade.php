<!DOCTYPE html>
<html>
<head>
    <title>Tìm kiếm</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset ('/../resources/css/index.css') }}" rel='stylesheet' type='text/css' />
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="{{asset('../public/frontend/images/logo1.png') }}" type="image/x-icon">
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
        <a class="logo-name" href="{{ URL::to('/index') }}"><img src="{{asset ('../public/frontend/images/logo.png') }}" class="logo" alt=""></a>
        <ul class="nav-links">
            <li><a style="color: black" href="#" id="tours-type-link"></a></li>
            <li><a style="color: black" href="#" id="trending-link"></a></li>
            <li><a style="color: black" href="#" id="tour-link"></a></li>
        </ul>
        <div class="search-bar">
            <form id="form-search" method="post" action="{{ URL::to('/search-tour') }}">
                {{ csrf_field() }}
                <div class="location-input">
                    <input style="width: 100%" autocomplete="off" id="keywords_submit" name="keywords_submit" type="text" placeholder="Tìm kiếm...">
                    
                </div>
                <button class="micro" type="button" id="startSpeechRecognition"><i class="fa-solid fa-microphone"></i></button>
                <button type="submit"><img src="{{asset ('../public/frontend/images/search.png') }}"></button>
            </form>
            <div id="search-suggestions"></div>
        </div>
        
        <div class="account-customer" id="accountCustomer" style="white-space: nowrap">
            @if(isset($customerName))
                <a style="color: rgb(0, 0, 0)">{{ $customerName }}</a>
                <a class="register-btn" onclick="toggleLogout()"><i class="fa-solid fa-user"></i></a>
                {{-- <a href="{{ URL::to('/customer-logout') }}" class="register-btn">Logout</a> --}}
                <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
        
                <!-- Dropdown for Logout -->
                <div class="logout-dropdown">
                    <i class="fa-solid fa-user-pen"><a href="{{ URL::to('/profile-customer/'.$customerID) }}"> Thông tin tài khoản</a></i> <br>
                    <i class="fa-solid fa-right-from-bracket"><a href="{{ URL::to('/customer-logout') }}"> Đăng xuất</a></i> 
                    <!-- Add more items as needed -->
                </div>
            @else
                <a href="{{ URL::to('/customer-login') }}" class="register-btn"> Đăng nhập</a>
                <i class="fa-solid fa-bars" onclick="togglebtn()"></i>
            @endif
        </div>
    </nav>
    
    <div class="container">
        <h2 class="sub-title" id="tour">Các tour tìm được</h2>
        <div id="carousel-stories">
            {{-- <button id="prev-stories" class="stories-button"><i class="fas fa-chevron-left"></i></button> --}}
            <div class="stories">
                @foreach($all_tourdetail as $key => $tourdetail)
                    @foreach($search_tour as $key => $tour )
                        @if($tourdetail->tour_id == $tour->tour_id && $tourdetail->tour_show==0)
                        <div>
                            <a class="tour-detail" href="{{ URL::to('/tour-detail/'.$tourdetail->tourdetail_id) }}">
                            <img src="public/uploads/tour/{{ $tour -> tour_avt }}">
                            {{-- <p>Popular European countries with a budget of just $10,000</p> --}}
                            <div class="title-frame">
                                <h3 class="name">
                                @foreach($city as $key => $ci)
                                    @if($ci->province_id == $tour->tour_city)
                                        {{ $ci->province_name }}
                                    @endif
                                @endforeach
                                </h3>
                                <h3 class="name">
                                    @php $firstPlace = true; @endphp
                                    @foreach($all_destination_detail as $key => $des_dtl)
                                        @foreach($all_place as $key => $pl)
                                            @if(($pl->place_id == $des_dtl->place_id) && ($des_dtl->destination_id == $tour->tour_destination))
                                                @if($firstPlace)
                                                    {{ $pl->place_name }}
                                                    @php $firstPlace = false; @endphp
                                                @else
                                                    - {{ $pl->place_name }}
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                </h3>
                                <div class="title-time">Thời gian khởi hành:
                                    {{ \Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y') }}
                                </div>
                                <div class="title-time">
                                    @php 
                                        $bookedSeats = 0; 
                                    @endphp
                                    Số chỗ còn lại:
                                        @foreach($all_order as $order)
                                            @if($order->tourdetail_id == $tourdetail->tourdetail_id)
                                                @php 
                                                    $bookedSeats=$bookedSeats + $order->order_number_of_seats; 
                                                @endphp
                                            @endif
                                        @endforeach
                                        @php 
                                            $remainingSeats = $tourdetail->number_of_seats - $bookedSeats; 
                                            echo $remainingSeats;
                                        @endphp
                                </div>
                                <h3 class="price_tour"><i class="fa-solid fa-money-check-dollar"></i> {{ number_format($tour -> tour_price,0,',','.') }}đ</h3>
                                
                                <div class="order_now1">
                                    <a style="text-decoration: none; color: inherit;" href="{{ URL::to('/order/'.$tourdetail->tourdetail_id) }}"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</a>
                                </div>
                            </div>
                            </a>
                        </div>

                        @endif
                    @endforeach
                @endforeach
            </div>
            {{-- <button id="next-stories" class="stories-button"><i class="fas fa-chevron-right"></i></button> --}}
        </div>

        {{-- <a href="{{ URL::to('/tour-detail') }}" class="start-btn">Start making money</a> --}}

        <div class="about-msg">
            <h2>About</h2>
            @foreach($all_infor as $key => $inf)
            <div class="colum-container-footer">
                <div class="colum1-footer">
                    <p><img src="public/uploads/logo/{{ $inf->information_logo }}" height="100" width="300" style="border-radius: 10px"></p>
                    <p>Công ty du lịch {{ $inf->information_name }}</p>
                    <p>Địa chỉ: {{ $inf->information_address }}</p>
                    <p>Email: {{ $inf->information_email }}</p>
                    <p>Điện thoại: {{ $inf->information_phone }}</p>
                    <p>Thông tin công ty: {!! $inf->information_describe !!}</p>
                </div>
            
                <div class="colum2-footer">
                    {!! $inf->information_location !!}
                </div>
            </div>
            @endforeach
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
    chat-icon="{{asset('../public/frontend/images/chat-icon.png') }}"
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
            url: '{{ URL::to('/search-suggestions') }}',
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
</html>