<!DOCTYPE html>
<html>
<head>
    <title>Tour Type</title><meta charset="utf-8">
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
        <div class="list-container">
            <div class="left-col">
                <div class="sidebar">
                    <h3 style="background-color: #2e9cca;padding: 5% 0;text-align:center;color:white">Danh sách loại tour</h3>
                    @foreach($all_tour_type as $key => $tourtype)
                    <div class="filter">
                        <a href="{{ URL::to('/tourtype-detail/'.$tourtype->tourtype_id) }}"><p>{{ $tourtype->tourtype_name }}</p></a>
                    </div>
                    @endforeach
                    {{-- <h3>Giá</h3> --}}
                    {{-- <div class="filter">
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
                    </div> --}}
                </div>
            </div>
            <div class="right-col">
                {{-- <p>200+ Options</p> --}}
                
                @foreach($tourtype_detail as $key => $tourtype_dt)
                <h1>{{ $tourtype_dt->tourtype_name }}</h1>
                <p>{!! $tourtype_dt->tourtype_describe !!}<br></p>
                    @foreach($all_tourdetail as $key => $tourdetail)
                        @foreach($all_tour as $key => $tour)
                        @if($tourtype_dt->tourtype_id == $tour->tourtype_id && $tour->tour_id == $tourdetail->tour_id)
                        <div class="house">
                            
                            <div class="house-img">
                                <a href="{{ URL::to('/tour-detail/'.$tourdetail->tourdetail_id) }}">
                                <img src="../public/uploads/tour/{{ $tour->tour_avt }}">
                                </a>
                            </div>
                            
                            <div class="house-info">
                                <a style="text-decoration: none" href="{{ URL::to('/tour-detail/'.$tourdetail->tourdetail_id) }}">
                                <h3>{{ $tour->tour_name }}</h3>
                                </a>
                                <p><i class="fa-solid fa-location-dot"></i><b> Các điểm đến:</b> 
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
                                </p>
                                <p><i class="fa-solid fa-chair"></i> 
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
                                </p>
                                <p><i class="fa-solid fa-clock"></i> Thời gian diễn ra:
                                        <p>Từ: {{ \Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y') }}</p>
                                        <p>Đến: {{ \Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y') }}</p>
                                </p>
                                {{-- <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i> --}}
                                <div class="house-price">
                                    @foreach($city as $key => $ct)
                                        @if($ct->province_id == $tour->tour_city)
                                        <p><i class="fa-solid fa-map-pin"></i> 
                                            {{ $ct->province_name }}
                                        </p>
                                        @endif
                                    @endforeach
                                    <h4><i class="fa-solid fa-money-check-dollar"></i> {{ number_format($tour -> tour_price,0,',','.') }}đ</h4>
                                    {{-- <h4>$ 100 <span>/ day</span></h4> --}}
                                    <div class="order_now2">
                                        <a style="text-decoration: none; color: inherit;" href="{{ URL::to('/order/'.$tourdetail->tourdetail_id) }}"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</a>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        @endif
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- <div class="pagination">
            <img src="../public/frontend/images">
            <span class="current">1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>5</span>
            <span>&middot; &middot; &middot; &middot;</span>
            <span>20</span>
            <img src="../public/frontend/images" class="right-arrow">
        </div> --}}

        <div class="about-msg">
            <h2>About</h2>
            @foreach($all_infor as $key => $inf)
            <div class="colum-container-footer">
                <div class="colum1-footer">
                    <p><img src="../public/uploads/logo/{{ $inf->information_logo }}" height="100" width="300" style="border-radius: 10px"></p>
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