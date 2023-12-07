@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CHI TIẾT ĐƠN HÀNG</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_order as $key => $od)
    <form id="orderconfirmForm" method="post" action="{{URL::to ('/confirm-order/'.$od->order_id) }}" enctype="multipart/form-data" onsubmit="onSubmitForm(event)">
        {{ csrf_field() }}
        <div class="order-order">
            <h1>Đơn Hàng</h1>
            <div class="order-content">
                <label for=""><b>Mã đơn hàng: </b>{{ $od->order_code }}</label>
            </div>
            <div class="order-content">
                <label for=""><b> Ngày đặt hàng: </b>{{ \Carbon\Carbon::parse($od->order_time)->format('H:i d/m/Y') }}</label>
            </div>
            <div class="order-content">
                <div class="colum-order">
                    <div class="colum-order1">
                        <label for=""><b>Khách hàng: </b>
                            @foreach($all_customer as $key => $cus)
                                @if($cus->customer_id == $od->customer_id)
                                {{ $cus->customer_name }}
                                @endif
                            @endforeach
                        </label>
                    </div>
                    <div class="colum-order2">
                        <label for=""><b>Email: </b>
                            @foreach($all_customer as $key => $cus)
                                @if($cus->customer_id == $od->customer_id)
                                {{ $cus->customer_mail }}
                                @endif
                            @endforeach
                        </label>
                    </div>
                </div>
                
            </div>
            <div class="order-content">
                <div class="colum-order">
                    <div class="colum-order1">
                        <label for=""><b>Địa chỉ: </b>
                            @foreach($all_customer as $key => $cus)
                                @if($cus->customer_id == $od->customer_id)
                                {{ $cus->customer_address }}
                                @endif
                            @endforeach
                        </label>
                    </div>
                    <div class="colum-order2">
                        <label for=""><b>Số điện thoại: </b>
                            @foreach($all_customer as $key => $cus)
                                @if($cus->customer_id == $od->customer_id)
                                {{ $cus->customer_phone }}
                                @endif
                            @endforeach
                        </label>
                    </div>
                </div>
            </div>
            <div class="order-content">
                <label for=""><b>Tour đã đặt: </b>
                    @foreach($all_tour as $key => $tour)
                        @if($tour->tour_id == $od->tour_id)
                        {{ $tour->tour_name }}
                        @endif
                    @endforeach
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Các điểm đến của tour: </b>
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
                </label>
            </div>
            <div class="order-content">
                <div class="colum-order">
                    <div class="colum-order1">
                    <label for=""><b>Thời gian bắt đầu: </b>
                        @foreach($all_tourdetail as $key => $tourdetail)
                            @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                            {{ \Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y') }}
                            @endif
                        @endforeach
                    </label>
                    </div>
                    <div class="colum-order2">
                    <label for=""><b>Thời gian kết thúc: </b>
                        @foreach($all_tourdetail as $key => $tourdetail)
                            @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                            {{ \Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y') }}
                            @endif
                        @endforeach
                    </label>
                    </div>
                </div>
            </div>
            <div class="order-content">
                <label for=""><b>Số chỗ: </b>
                    {{-- @foreach($all_tour as $key => $tour) --}}
                        {{-- @if($tour->tour_id == $od->tour_id) --}}
                        {{-- {{ $tour->tour_number_of_seats }} --}}
                        {{ $od->order_number_of_seats }}
                        {{-- @endif --}}
                    {{-- @endforeach --}}
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Danh sách khách hàng tham gia: </b><br>
                    @foreach($all_tour as $key => $tour)
                        @if($tour->tour_id == $od->tour_id)
                        <pre>{!! $od->order_list_customer !!}</pre>
                        @endif
                    @endforeach
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Giá: </b>
                    @foreach($all_tour as $key => $tour)
                        @if($tour->tour_id == $od->tour_id)
                        {{ number_format($tour -> tour_price,0,',','.') }}đ
                        @endif
                    @endforeach
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Mã giảm giá áp dụng: </b>
                    @php
                        $couponApplied = false;
                    @endphp
                    @foreach($all_tour as $key => $tour)
                        @if($tour->tour_id == $od->tour_id)
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
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Mức giảm: </b>
                    @php
                        $couponApplied = false;
                    @endphp
                    @foreach($all_tourdetail as $key => $tourdetail)
                        @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                            {{-- @foreach($all_coupon as $key => $coupon)
                                @if($od->coupon_id == $coupon->coupon_id)
                                {{ number_format($od -> order_discount,0,',','.') }}đ
                                @php
                                    $couponApplied = true;
                                @endphp
                                @break
                                @endif
                            @endforeach --}}
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
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Phương thức thanh toán: </b>
                    @foreach($all_tourdetail as $key => $tourdetail)
                        @if($tourdetail->tourdetail_id == $od->tourdetail_id)
                            @if($od->order_payment == 0)
                            Thanh toán tiền mặt
                            @elseif($od->order_payment == 1)
                            Thanh toán qua ví điện tử
                            @endif
                        @endif
                    @endforeach
                </label>
            </div>
            <div class="order-content">
                <label for=""><b>Trạng thái thanh toán: </b>
                    @foreach($all_tour as $key => $tour)
                        @if($tour->tour_id == $od->tour_id)
                            @if($od->order_payment_status == 0)
                            Chưa thanh toán
                            @else
                            Đã thanh toán
                            @endif
                        @endif
                    @endforeach
                </label>
            </div>
            <div style="text-align: right" class="order-content">
                <label for=""><b>Tổng: </b>
                    @foreach($all_tour as $key => $tour)
                        @if($tour->tour_id == $od->tour_id)
                        {{ number_format($od -> order_total,0,',','.') }}đ
                        @endif
                    @endforeach
                </label>
            </div>
        </div>
        <div class="input-content">
            <label for="">Trạng thái thanh toán</label>
            <select name="order_payment_status">
                @if($od->order_payment_status == 0)
                <option selected value="0">Chưa thanh toán</option>
                <option value="1">Thanh toán</option>
                @else
                <option value="0">Chưa thanh toán</option>
                <option selected value="1">Đã thanh toán</option>
                @endif
            </select>
        </div>
        <div class="input-content">
            <label for="">Trạng thái xử lý</label>
            <select name="order_status">
                @if($od->order_status == 0)
                <option selected value="0">Chưa duyệt</option>
                <option value="1">Duyệt</option>
                <option value="2">Hủy</option>
                @elseif($od->order_status == 1)
                <option value="0">Chưa duyệt</option>
                <option selected value="1">Đã duyệt</option>
                <option value="2">Hủy</option>
                @else
                <option value="0">Chưa duyệt</option>
                <option value="1">Duyệt</option>
                <option selected  value="2">Hủy</option>
                @endif
            </select>
        </div>
        <div class="input-content">
            <a style="text-decoration: none; color:black" href="{{ URL::to('/print-order/'.$od->order_code) }}"><i class="fa-solid fa-file-pdf"></i> In đơn hàng</a>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function onSubmitForm(event) {
        // Ngăn chặn việc gửi form mặc định
        event.preventDefault();

        // Thực hiện các xử lý đặt hàng ở đây
        // ...

        // Hiển thị thông báo SweetAlert2
        Swal.fire({
            title: 'Xử lý đơn hàng thành công!',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            // Nếu người dùng nhấp vào nút "OK" trong alert, hãy gửi form
            if (result.isConfirmed) {
                document.getElementById('orderconfirmForm').submit();
            }
        });
    }
</script>
@endsection