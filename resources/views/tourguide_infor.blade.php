@extends('tourguide_layout')
@section('tourguide_content')
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
@foreach($tourguide_infor as $key => $inf)
    <div class="infor">
        <h2 style="text-align: center">THÔNG TIN TÀI KHOẢN</h2>
        <h2 style="text-align: left; font-size:35px"><i class="fa-solid fa-user"></i></h2>
        <div class="infor-content">
            <b> Họ tên : </b>&nbsp;{{ $inf -> tourguide_name }}
        </div>
        <div class="infor-content">
            <b> Ngày sinh : </b>&nbsp;{{ $inf -> tourguide_birth }}
        </div>
        <div class="infor-content">
            <b> Giới tính : </b>&nbsp;
            @if($inf -> tourguide_sex == 1)
            Nam
            @else
            Nữ
            @endif
        </div>
        <div class="infor-content">
            <b> Email : </b>&nbsp;{{ $inf -> tourguide_email }}
        </div>
        <div class="infor-content">
            <b> Số điện thoại : </b>&nbsp;{{ $inf -> tourguide_phone }}
        </div>
        <div class="infor-content">
            <b> Địa chỉ : </b>&nbsp;{{ $inf -> tourguide_address }}
        </div>
    </div>
@endforeach
<div>
    <a href="{{ URL::to('/tourguide-infor-edit/'.$tourguideID) }}" class="btn-set-infor-admin">Chỉnh sửa</a>
</div>
@endsection