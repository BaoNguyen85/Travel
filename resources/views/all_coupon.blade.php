@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH MÃ GIẢM GIÁ</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
<table>
    <thead>
        <tr>
            <th style="width: 20%;">Tên mã giảm giá</th>
            <th style="width: 20%;">Code</th>
            <th style="width: 20%;">Loại giảm giá</th>
            <th style="width: 15%;">Tổng giảm</th>
            <th style="width: 15%;">Số lượng</th>
            <th style="width: 10%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_coupon as $key => $cou)
        <tr>
            <td style="text-align: center;">{{ $cou->coupon_name }}</td>
            <td style="text-align: center;">{{ $cou->coupon_code }}</td>
            <td style="text-align: center;">
                @if($cou->coupon_type==0)
                Giảm theo %
                @else
                Giảm theo mệnh giá tiền
                @endif
            </td>
            <td style="text-align: center;">
                @if($cou->coupon_type==0)
                {{ $cou->coupon_total }}%
                @else
                {{ $cou->coupon_total }}đ
                @endif
                
            </td>
            <td style="text-align: center;">{{ $cou->coupon_quantity }}</td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-coupon/'.$cou->coupon_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-coupon/'.$cou->coupon_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection