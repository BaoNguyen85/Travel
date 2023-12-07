<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            font-family:DejaVu Sans;
            font-size: 15px;
        }
        h1{
            text-align: center;
            font-size: 20px;
        }
        h2{
            font-size: 20px;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1>ĐƠN HÀNG</h1>
    @foreach($order as $key => $od)
        <div>
            <p><b>Mã đơn hàng:</b>  {{ $od->order_code }}
            </p>
            <h2>Thông tin khách hàng</h2>
            <p><b>Họ tên:</b> 
                @foreach($all_customer as $key => $cus)
                @if($od->customer_id == $cus->customer_id)
                {{ $cus->customer_name }}
                @endif
                @endforeach
            </p>
            <p><b>Email:</b> 
                @foreach($all_customer as $key => $cus)
                @if($od->customer_id == $cus->customer_id)
                {{ $cus->customer_mail }}
                @endif
                @endforeach
            </p>
            <p><b>Số điện thoại:</b> 
                @foreach($all_customer as $key => $cus)
                @if($od->customer_id == $cus->customer_id)
                {{ $cus->customer_phone }}
                @endif
                @endforeach
            </p>
            <p><b>Địa chỉ:</b> 
                @foreach($all_customer as $key => $cus)
                @if($od->customer_id == $cus->customer_id)
                {{ $cus->customer_address }}
                @endif
                @endforeach
            </p>
            <h2>Thông tin đơn hàng</h2>
            <p><b>Tên tour:</b> 
                @foreach($all_tour as $key => $tour)
                @if($od->tour_id == $tour->tour_id)
                {{ $tour->tour_name }}
                @endif
                @endforeach
            </p>
            <p><b>Các điểm đến:</b> 
                @php $firstPlace = true; @endphp
                @foreach($all_tour as $key => $tour)
                @if($od->tour_id == $tour->tour_id)
                    @foreach($all_destination_detail as $key => $des_dtl)
                        @foreach($all_place as $key => $pl)
                        @if(($od->tour_id == $tour->tour_id) && ($pl->place_id == $des_dtl->place_id) && ($des_dtl->destination_id == $tour->tour_destination))
                            @if($firstPlace)
                                {{ $pl->place_name }}
                                @php $firstPlace = false; @endphp
                            @else
                                - {{ $pl->place_name }}
                            @endif
                        @endif
                        @endforeach
                    @endforeach
                @endif
                @endforeach
            </p>
            <p><b>Thời gian bắt đầu:</b> 
                @foreach($all_tourdetail as $key => $tourdetail)
                    @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                    {{ \Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y') }}
                    @endif
                @endforeach
            </p>
            <p><b>Thời gian kết thúc:</b> 
                @foreach($all_tourdetail as $key => $tourdetail)
                    @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                    {{ \Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y') }}
                    @endif
                @endforeach
            </p>
            <p><b>Số chỗ:</b> 
                {{ $od->order_number_of_seats }}
            </p>
            <p><b>Danh sách khách hàng tham gia:</b><br>
                @foreach($all_tourdetail as $key => $tourdetail)
                    @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                    <pre>{!! $od->order_list_customer !!}</pre>
                    @endif
                @endforeach
            </p>
            <p><b>Giá tour:</b> 
                @foreach($all_tour as $key => $tour)
                    @if($tour->tour_id == $od->tour_id)
                    {{ number_format($tour -> tour_price,0,',','.') }}đ
                    @endif
                @endforeach
            </p>
            <p><b>Mã giảm giá áp dụng:</b> 
                @php
                    $couponApplied = false;
                @endphp
                @foreach($all_tourdetail as $key => $tourdetail)
                    @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                        @foreach($all_coupon as $key => $coupon)
                            @if($od->coupon_id == $coupon->coupon_id)
                            {{ $coupon->coupon_code }}
                            @php
                                $couponApplied = true;
                            @endphp
                            @break
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if (!$couponApplied && $od->coupon_id == NULL)
                    Không
                @endif
            </p>
            <p><b>Đã giảm:</b> 
                @php
                    $couponApplied = false;
                @endphp
                @foreach($all_tourdetail as $key => $tourdetail)
                    @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                        @foreach($all_coupon as $key => $coupon)
                            @if($od->coupon_id == $coupon->coupon_id && $coupon->coupon_type==1)
                            {{ number_format($od -> order_discount,0,',','.') }}đ
                            @elseif($od->coupon_id == $coupon->coupon_id && $coupon->coupon_type==0)
                            {{ $od -> order_discount}}%
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if (!$couponApplied && $od->coupon_id == NULL)
                    0đ
                @endif
            </p>
            <p><b>Phương thức thanh toán:</b> 
                @foreach($all_tour as $key => $tour)
                    @if($tour->tour_id == $od->tour_id)
                        @if($od->order_payment == 0)
                        Thanh toán tiền mặt
                        @else
                        Thanh toán qua ví điện tử
                        @endif
                    @endif
                @endforeach
            </p>
            <p><b>Trạng thái thanh toán:</b> 
                @foreach($all_tour as $key => $tour)
                    @if($tour->tour_id == $od->tour_id)
                        @if($od->order_payment_status == 0)
                        Chưa thanh toán
                        @else
                        Đã thanh toán
                        @endif
                    @endif
                @endforeach
            </p>
            <p style="float: right"><b>Tổng:</b> 
                @foreach($all_tour as $key => $tour)
                    @if($tour->tour_id == $od->tour_id)
                    {{ number_format($od -> order_total,0,',','.') }}đ
                    @endif
                @endforeach
            </p>
            
        </div>
        <br><br><br>
        <div>
            <span style="padding-left: 5%;font-size:22px;font-weight:bold">Người nhận</span><span style="padding-left: 35%;font-size:22px;font-weight:bold">Người lập hóa đơn</span><br>
            <i style="padding-left: 5%;">(Ký, ghi rõ họ tên)</i><i style="padding-left: 40%;">(Ký, ghi rõ họ tên)</i>
        </div>
    @endforeach
</body>
</html>