@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH ĐƠN HÀNG</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
{{-- <form action="{{ URL('export-csv')}}" method="POST">
    @csrf
    <input type="submit" value="Export CSV" name="export_csv" class="export-csv">
</form> --}}
<table>
    <thead>
        <tr>
            <th style="width: 5%;">STT</th>
            <th style="width: 10%;">Mã đơn</th>
            <th style="width: 15%;">Khách hàng</th>
            <th style="width: 15%;">Tour</th>
            <th style="width: 5%;">Số chỗ</th>
            <th style="width: 10%;">Duyệt</th>
            <th style="width: 10%;">Trạng thái tour</th>
            <th style="width: 13%;">Thanh toán</th>
            <th style="width: 12%;">Tổng</th>
            <th style="width: 5%;">Xử lý</th>
        </tr>
    </thead>
    @php
        $i = 0;
    @endphp
    <tbody>
        @foreach ($all_order as $key => $order)
        <tr>
            @php
                $i++;
            @endphp
                
            <td style="text-align: center;">{{ $i }}</td>
            <td style="text-align: center;">{{ $order->order_code }}</td>
            <td style="text-align: center;">
                @foreach($all_customer as $key => $cus)
                    @if($order->customer_id == $cus->customer_id)
                        {{ $cus->customer_name }}
                    @endif
                @endforeach
                
            </td>
            <td style="text-align: center;">
                {{-- @foreach($all_tourdetail as $key => $tourdetail) --}}
                    @foreach($all_tour as $key => $tour)
                        @if($order->tour_id == $tour->tour_id)
                            {{ $tour->tour_name }}
                        @endif
                    @endforeach
                {{-- @endforeach --}}
            </td>
            <td style="text-align: center;">{{ $order -> order_number_of_seats }}</td>
            <td style="text-align: center;">
                @if($order -> order_status==1)
                <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px">Đã duyệt</div>
                @elseif($order -> order_status==0)
                <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px">Chưa duyệt</div>
                @else
                <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px">Đã hủy</div>
                @endif
            </td>
            <td style="text-align: center;">
                @foreach($all_tourdetail as $key => $tourdetail)
                @if($order->tourdetail_id == $tourdetail->tourdetail_id)
                    @if($tourdetail->tour_success==1)
                    <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px">Hoàn thành</div>
                    @elseif($tourdetail->tour_success==0)
                    <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px">Tour mới</div>
                    @else
                    <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px">Đã hủy</div>
                    @endif
                @endif
                @endforeach
            </td>
            <td style="text-align: center;">
                @if($order -> order_payment_status==0)
                <div style="background-color:rgb(7, 106, 205);color: rgb(255, 255, 255);border-radius:15px">Chưa thanh toán</div>
                @else
                <div style="background-color:green;color: rgb(255, 255, 255);border-radius:15px">Đã thanh toán</div>
                @endif
            </td>
            <td style="text-align: center;">{{ number_format($order -> order_total,0,',','.') }}đ</td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-order/'.$order->order_id) }}" class="btn-edit">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                {{-- <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-order/'.$order->order_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection