@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH KHÁCH HÀNG</h3>
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
            <th style="width: 20%;">Tên khách hàng</th>
            <th style="width: 15%;">Ngày sinh</th>
            <th style="width: 22%;">Email</th>
            <th style="width: 15%;">Điện thoại</th>
            <th style="width: 20%;">Địa chỉ</th>
            <th style="width: 8%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_customer as $key => $cus)
        <tr>
            <td style="text-align: center;">{{ $cus -> customer_name }}</td>
            <td style="text-align: center;">{{ $cus -> customer_birth }}</td>
            <td style="text-align: center;">{{ $cus -> customer_mail }}</td>
            <td style="text-align: center;">{{ $cus -> customer_phone }}</td>

            <td style="text-align: center;"><span>
                {!! $cus -> customer_address !!}
            </span></td>
            <td style="text-align: center;">
                {{-- <a href="" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a> --}}
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-customer/'.$cus->customer_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection