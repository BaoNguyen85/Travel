@extends('tourguide_layout')
@section('tourguide_content')
<div class="head-title">
    <h3>CẬP NHẬT THÔNG TIN TÀI KHOẢN</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
@foreach($edit_tourguide_infor as $key => $editTGInfor)
<form method="post" action="{{URL::to ('/update-tourguide-infor/'.$editTGInfor->tourguide_id) }}" enctype="multipart/form-data">
{{ csrf_field() }}    
<div class="infor">
    <h2 style="text-align: left; font-size:35px"><i class="fa-solid fa-user"></i></h2>
    <div class="infor-content">
        <b>Họ tên  : </b>&nbsp;<input name="tourguide_name" class="input-infor" value="{{ $editTGInfor -> tourguide_name }}" type="text">
    </div>
    <div class="infor-content">
        <b>Ngày sinh : </b>&nbsp;<input name="tourguide_birth" class="input-infor" value="{{ $editTGInfor -> tourguide_birth }}" type="date">
    </div>
    <div class="infor-content">
        <b>Giới tính : </b>&nbsp;
        <select name="tourguide_sex">
            <option value="1">Nam</option>
            <option value="0">Nữ</option>
        </select>
    </div>
    <div class="infor-content">
        <b>Email : </b>&nbsp;<input name="tourguide_email" class="input-infor" value="{{ $editTGInfor -> tourguide_email }}" type="text">
    </div>
    <div class="infor-content">
        <b>Số điện thoại : </b>&nbsp;<input name="tourguide_phone" class="input-infor" value="{{ $editTGInfor -> tourguide_phone }}" type="text">
    </div>
    <div class="infor-content">
        <b>Địa chỉ : </b>&nbsp;<input name="tourguide_address" class="input-infor" value="{{ $editTGInfor -> tourguide_address }}" type="text">
    </div>
    <div class="infor-content">
        <b>Mật khẩu : </b>&nbsp;<input name="tourguide_password" class="input-infor" value="{{ $editTGInfor -> tourguide_password }}" type="password">
    </div>
</div>
<input class="btn-set-infor-admin" type="submit" value="Cập nhật">
</form>
@endforeach
@endsection