<!DOCTYPE html>
<html>
<head>
    <title>Tour Detail</title><meta charset="utf-8">
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
    @foreach($tour_detail as $key => $tour_dt)
        @foreach($all_tour as $key => $tour)
        @if($tour_dt->tour_id == $tour->tour_id)
        <div class="house-details">
            <div class="house-title">
                <h1>
                    Tour: 
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
                </h1>
                <div class="row">
                    <div>
                        {{-- <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i> --}}
                        {{-- <span>245 Reviews</span> --}}
                        {{-- <span>Loại tour</span> --}}
                    </div>
                    <div>
                        {{-- <p>Thành phố</p> --}}
                    </div>
                </div>
            </div>
            <div class="gallery">
                    <div class="image-show"><img src="../public/uploads/tour/{{ $tour -> tour_image }}"></div>
                    {{-- <div><img src="images/r1.jpg" alt=""></div>
                    <div><img src="images/r1.jpg" alt=""></div>
                    <div><img src="images/r1.jpg" alt=""></div>
                    <div><img src="images/r1.jpg" alt=""></div> --}}
            </div>
            <div class="small-details">
                <h2>
                    @foreach($city as $key => $ct)
                        @if($tour->tour_city == $ct->province_id)
                        Tỉnh thành: {{ $ct->province_name }}
                        @endif
                    @endforeach
                </h2>
                {{-- <p>2 guest &nbsp;&nbsp; 2 beds &nbsp;&nbsp; 1 bathroom </p> --}}
                <h4 style="font-size: 25px"><i style="color: #ff5361;" class="fa-solid fa-money-check-dollar"></i> {{ number_format($tour -> tour_price,0,',','.') }}đ</h4>
            </div>
            <hr class="line">
            <div class="check-form">
                <div>
                    <label>
                    Thời gian bắt đầu: 
                    {{ \Carbon\Carbon::parse($tour_dt->date_start)->format('H:i d/m/Y') }}
                    </label>
                </div>
                <div>
                    <label>
                    Thời gian kết thúc:
                    {{ \Carbon\Carbon::parse($tour_dt->date_end)->format('H:i d/m/Y') }}
                    </label>
                </div>
                <div class="guest-field">
                    <label>
                        @php 
                            $bookedSeats = 0; 
                        @endphp
                        Số chỗ còn lại:
                            @foreach($all_order as $order)
                                @if($order->tourdetail_id == $tour_dt->tourdetail_id)
                                    @php 
                                        $bookedSeats=$bookedSeats + $order->order_number_of_seats; 
                                    @endphp
                                @endif
                            @endforeach
                            @php 
                                $remainingSeats = $tour_dt->number_of_seats - $bookedSeats; 
                                echo $remainingSeats;
                            @endphp
                    </label>
                </div>
                <div class="order_now">
                    <a style="text-decoration: none; color: inherit;" href="{{ URL::to('/order/'.$tour_dt->tourdetail_id) }}"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</a>
                </div>
                
            </div>
            <table style="width:100%; margin-bottom:-5%">
                <tr>
                    <td style="width:30%">
                        <label><i class="fa-solid fa-calendar-days"></i> Lịch trình</label>
                        @foreach($all_scheduledetail as $key => $schd)
                            @if($tour->tour_schedule == $schd->scheduledetail_id)
                            {!! $schd->scheduledetail_content !!}
                            @endif
                        @endforeach
                    </td>
                    <td style="width:70%">
                        {!! $tour->tour_weather !!}
                    </td>
                </tr>
            </table>
            <hr class="line">
            <h3>Điểm nổi bật</h3>
            <p class="home-desc">{!! $tour->tour_outstanding !!}</p>
            <hr class="line">    
            <div class="map">
                <h3>Bản đồ vị trí khởi hành</h3>
                {!! $tour->tour_start_location !!}
                <b>
                    {{ $tour->tour_departure }}
                </b>
                {{-- <p>It's like a homw away from home.</p> --}}
            </div>
            
            <hr class="line">
            <form id="commentForm" method="post" action="{{ URL::to('/add-comment') }}" enctype="multipart/form-data" onsubmit="onSubmitForm(event)">
                {{ csrf_field() }}
                <div class="comment-customer">
                    <input type="hidden" name="tour_id" value="{{ $tour_dt->tour_id }}">
                    <input type="hidden" name="customer_id" id="customer_id" value="{{ $customerID }}">
                    <h2 style="padding-bottom:1%">Đánh giá</h2>
                    <textarea name="comment_content" id="" cols="100" rows="10" required></textarea>
                </div>
                <div class="comment-button"><button type="submit">Đăng tải</button></div>
            </form>

            <br>
            
            <div class="list-comment">
                <h1>Nội dung đánh giá</h1>
                @foreach($all_comment as $key => $cmt)
                    @foreach($customer as $key => $cus)
                        @foreach($all_tour as $key => $tour)
                            @if($cus->customer_id == $cmt->customer_id && $cmt->tour_id == $tour_dt->tour_id && $tour_dt->tour_id == $tour->tour_id)
                            <div class="customer-cus">
                                <h2><i class="fa-regular fa-user"></i> {{ $cus->customer_name }}</h2>
                                <p><i class="fa-regular fa-envelope"></i> : {{ $cus->customer_mail }}</p>
                                <p>{{ $cmt->comment_content }}</p>
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    @endforeach
    
    <div class="container">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function onSubmitForm(event) {
            // Ngăn chặn việc gửi form mặc định
            event.preventDefault();
    
            // Kiểm tra nếu customerID không tồn tại (chưa đăng nhập)
            if (!document.getElementById('customer_id').value) {
                // Hiển thị thông báo SweetAlert2
                Swal.fire({
                    title: 'Bạn chưa đăng nhập!',
                    text: 'Vui lòng đăng nhập để thực hiện đánh giá.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            } else {
                // Nếu đã đăng nhập, thực hiện các xử lý đặt hàng ở đây
                // ...
    
                // Hiển thị thông báo SweetAlert2
                Swal.fire({
                    title: 'Đăng tải thành công!',
                    text: 'Cảm ơn bạn đã đánh giá!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Nếu người dùng nhấp vào nút "OK" trong alert, hãy gửi form
                    if (result.isConfirmed) {
                        document.getElementById('commentForm').submit();
                    }
                });
            }
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