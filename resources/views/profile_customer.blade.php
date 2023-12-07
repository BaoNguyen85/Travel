<!DOCTYPE html>
<html>
<head>
    <title>Profile</title><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset ('/../resources/css/index.css') }}" rel='stylesheet' type='text/css' />
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="{{asset('../public/frontend/images/logo1.png') }}" type="image/x-icon">
    <style>
        #search-suggestions {
            position: absolute;
            width: 30%;
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
    @foreach($profile_customer as $key => $pro)
    <div class="colum-profile">
        <div class="colum1-profile">
            <div class="profile-customer">
                <h2>THÔNG TIN CÁ NHÂN</h2>
                <h2 style="text-align: left; margin-left:5%; font-size:30px"><i class="fa-solid fa-user"></i></h2>
                <p><b>Họ tên :</b> {{ $pro->customer_name }}</p>
                <p><b>Ngày sinh :</b> {{ \Carbon\Carbon::parse($pro->customer_birth)->format('d/m/Y') }}</p>
                <p><b>Email :</b> {{ $pro->customer_mail }}</p>
                <p><b>Số điện thoại :</b> {{ $pro->customer_phone }}</p>
                <p><b>Địa chỉ :</b> {{ $pro->customer_address }}</p>
                <p></p>
                <a style="padding: 1% 1%" href="{{ URL::to ('/edit-profile-customer/'.$customerID) }}">Chỉnh sửa</a>
            </div>
        </div>
        <div class="colum2-profile">
            <div class="profile-history">
                <h2>LỊCH SỬ ĐƠN HÀNG</h2>
                @foreach($all_order as $key => $order)
                
                    @if($order->customer_id == $customerID)
                    <div class="history-frame">
                    <p style="display: inline-block;"><b>Trạng thái:</b>
                        @if($order -> order_status==1)
                        <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px;display: inline-block;padding:0.5%">Đã duyệt</div>
                        @elseif($order -> order_status==0)
                        <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px;display: inline-block;padding:0.5%">Chờ duyệt</div>
                        @else
                        <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px;display: inline-block;padding:0.5%">Đã hủy</div>
                        @endif
                    </p>
                    <p><b>Đơn hàng:</b> {{ $order->order_code }}</p>
                    <p><b>Tour: </b>
                        @foreach($all_tour as $key => $tour)
                            @if($order->tour_id == $tour->tour_id)
                            {{ $tour->tour_name }}
                            @endif
                        @endforeach
                    </p>
                    <p><b>Số chỗ:</b> {{ $order->order_number_of_seats }}</p>
                    @foreach($all_tourdetail as $key => $tourdetail)
                        @if($order->tourdetail_id == $tourdetail->tourdetail_id)
                        <p><b>Ngày bắt đầu :</b> 
                        {{ \Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y') }}
                        </p>
                        <p><b>Ngày kết thúc :</b> 
                        {{ \Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y') }}
                        </p>
                        @endif
                    @endforeach
                    @foreach($all_coupon as $key => $coupon)
                        @foreach($all_tourdetail as $key => $tourdetail)
                            @if($order->tourdetail_id == $tourdetail->tourdetail_id && $order->coupon_id == $coupon->coupon_id)
                            <p><b>Mã áp dụng :</b> {{ $coupon->coupon_code }}</p>
                            <p><b>Tổng giảm :</b>
                                @php
                                $couponApplied = false;
                                @endphp
                                @foreach($all_tourdetail as $key => $tourdetail)
                                    @if($tourdetail->tourdetail_id == $order->tourdetail_id)
                                            @if($order->coupon_id == $coupon->coupon_id && $coupon->coupon_type==1)
                                            {{ number_format($order -> order_discount,0,',','.') }}đ
                                            @elseif($order->coupon_id == $coupon->coupon_id && $coupon->coupon_type==0)
                                            {{ $order -> order_discount}}%
                                            @endif
                                    @endif
                                @endforeach
                                @if (!$couponApplied && $order->coupon_id == NULL)
                                    0đ
                                @endif
                            </p>
                            @endif
                        @endforeach
                    @endforeach
                    <p><b>Phương thức thanh toán:</b> 
                        @if($order->order_payment==0)
                        Thanh toán tại quầy giao dịch
                        @else
                        Thanh toán qua VNPAY
                        @endif
                    </p>
                    <p><b>Trạng thái thanh toán:</b> 
                        @if($order->order_payment_status==0)
                        Chưa thanh toán
                        @else
                        Đã thanh toán
                        @endif
                    </p>
                    <p style="text-align: right"><b>Tổng thanh toán:</b> {{ number_format($order -> order_total,0,',','.') }}đ</p>
                    <form method="post" action="{{ URL::to('/update-order-customer/'.$order->order_id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if($order->order_status==1 || $order->order_status==2)
                            <input style="background-color: rgb(239, 136, 136);border:1px solid rgb(239, 136, 136);" class="customer_cancel" type="submit" value="Hủy đơn" disabled>
                        @else
                            <input class="customer_cancel" type="submit" value="Hủy đơn">
                            <input name="order_status" type="hidden" value="2">
                        @endif
                    </form>
                    </div>
                            
                    
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
    @endforeach
</body>
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
</html>