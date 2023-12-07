@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THỐNG KÊ</h3>
    </div>
    <div>
        <form autocomplete="off">
            @csrf
            <div class="statistical">
                Từ ngày: <input class="statistical-input" type="text" id="datepicker" >&nbsp;&nbsp; Đến ngày: <input class="statistical-input" type="text" id="datepicker2">
                
                &nbsp;&nbsp;<input class="statistical-button" type="button" id="btn-dashboard-filter" value="Lọc kết quả">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Lọc theo: 
                    <select class="dashboard-filter" id="dashboardFilter">
                        <option>--Chọn--</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>&nbsp;&nbsp;
                
            </div>
        </form>
        <div class="colum-access">
            <div class="colum-access1">
                <label style="font-size: 17px">Hướng Dẫn Viên</label>
                @php
                    $tourguideTotal = 0;
                @endphp
                @foreach($all_tourguide as $key => $tourguide)
                    @php
                    $tourguideTotal++;
                    @endphp
                @endforeach
                <h1 style="padding-top: 6%">{{ $tourguideTotal }} &nbsp;<i class="fa-solid fa-user-tie"></i></h1>
            </div>
            <div class="colum-access2">
                <label style="font-size: 17px">Đơn Hàng</label>
                @php
                    $orderTotal = 0;
                @endphp
                @foreach($all_order as $key => $order)
                    @php
                    $orderTotal++;
                    @endphp
                @endforeach
                <h1 style="padding-top: 6%">{{ $orderTotal }} &nbsp;<i class="fa-solid fa-cart-shopping"></i></h1>
            </div>
            <div class="colum-access3">
                <label style="font-size: 17px">Khách Hàng</label>
                @php
                    $customerTotal = 0;
                @endphp
                @foreach($all_customer as $key => $customer)
                    @php
                    $customerTotal++;
                    @endphp
                @endforeach
                <h1 style="padding-top: 6%">{{ $customerTotal }} &nbsp;<i class="fa-solid fa-users"></i></h1>
            </div>
        </div>
        <div >
            <div id="myfirstchart" style="height: 400px;"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Chọn giá trị mặc định
            $('#dashboardFilter').val('365ngayqua');

            // Gọi hàm khi trang được tải lại
            chart30daysorder();
        });
    </script>
@endsection