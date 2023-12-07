@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>TÀI KHOẢN</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
    @foreach($admin_infor as $key => $inf)
    <div class="infor">
        <h2 style="text-align: center">THÔNG TIN TÀI KHOẢN</h2>
        <h2 style="text-align: left; font-size:35px"><i class="fa-solid fa-user"></i></h2>
        <div class="infor-content">
            <b>Họ tên : </b>&nbsp;{{ $inf -> admin_name }}
        </div>
        <div class="infor-content">
            <b>Ngày sinh : </b>&nbsp;{{ $inf -> admin_birth }}
        </div>
        <div class="infor-content">
            <b>Email : </b>&nbsp;{{ $inf -> admin_email }}
        </div>
        <div class="infor-content">
            <b>Số điện thoại : </b>&nbsp;{{ $inf -> admin_phone }}
        </div>
        <div class="infor-content">
            <b>Địa chỉ : </b>&nbsp;{{ $inf -> admin_address }}
        </div>
    </div>
    @endforeach
<div>
    <a href="{{ URL::to('/edit-admin/'.$inf->admin_id) }}" class="btn-set-infor-admin">Chỉnh sửa</a>
</div>
@endsection