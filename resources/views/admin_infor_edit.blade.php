@extends('admin_layout')
@section('admin_content')
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
@foreach($edit_admin as $key => $edit)
<form method="post" action="{{URL::to ('/update-admin/'.$edit->admin_id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
{{-- <table class="table-infor">
    <thead>
            
            <tr>
                <th style="width: 30%;"><i class="icon ph-bold ph-identification-card"></i> Họ tên:</th>
                <th style="width: 70%;background-color:white"><input name="admin_name" class="input-admin" value="{{ $edit -> admin_name }}" type="text"></th>
                <th></th>
            </tr>
            <tr>
                <th style="width: 30%;"><i class="icon ph-bold ph-calender"></i> Ngày sinh:</th>
                <th style="width: 70%;background-color:white"><input name="admin_birth" class="input-admin" value="{{ $edit -> admin_birth }}" type="date"></th>
                <th></th>
            </tr>
            <tr>
                <th style="width: 30%;"><i class="icon ph-bold ph-envelope"></i> Email:</th>
                <th style="width: 70%;background-color:white"><input name="admin_email" class="input-admin" value="{{ $edit -> admin_email }}" type="text"></th>
                <th></th>
            </tr>
            <tr>
                <th style="width: 30%;"><i class="icon ph-bold ph-phone"></i> Điện thoại:</th>
                <th style="width: 70%;background-color:white"><input name="admin_phone" class="input-admin" value="{{ $edit -> admin_phone }}" type="text"></th>
                <th></th>
            </tr>
            <tr>
                <th style="width: 30%;"><i class="icon ph-bold ph-navigation-arrow"></i> Địa chỉ:</th>
                <th style="width: 70%;background-color:white"><input name="admin_address" class="input-admin" value="{{ $edit -> admin_address }}" type="text"></th>
                <th></th>
            </tr>
            <tr>
                <th style="width: 30%;"><i class="icon ph-bold ph-password"></i> Mật khẩu:</th>
                <th style="width: 70%;background-color:white"><input name="admin_password" class="input-admin" value="{{ $edit -> admin_password }}" type="password"></th>
                <th></th>
            </tr>
    </thead>
</table>  --}}
<div class="infor">
    <h2 style="text-align: left; font-size:35px"><i class="fa-solid fa-user"></i></h2>
    <div class="infor-content">
        <b>Họ tên : </b>&nbsp;<input name="admin_name" class="input-infor" value="{{ $edit -> admin_name }}" type="text">
    </div>
    <div class="infor-content">
        <b>Ngày sinh : </b>&nbsp;<input name="admin_birth" class="input-infor" value="{{ $edit -> admin_birth }}" type="date">
    </div>
    <div class="infor-content">
        <b>Email : </b>&nbsp;<input name="admin_email" class="input-infor" value="{{ $edit -> admin_email }}" type="text">
    </div>
    <div class="infor-content">
        <b>Số điện thoại : </b>&nbsp;<input name="admin_phone" class="input-infor" value="{{ $edit -> admin_phone }}" type="text">
    </div>
    <div class="infor-content">
        <b>Địa chỉ : </b>&nbsp;<input name="admin_address" class="input-infor" value="{{ $edit -> admin_address }}" type="text">
    </div>
    <div class="infor-content">
        <b>Mật khẩu : </b>&nbsp;<input name="admin_password" class="input-infor" value="{{ $edit -> admin_password }}" type="password">
    </div>
</div>
<div>
    <input class="btn-set-infor-admin" type="submit" value="Cập nhật">
</div>
</form>
@endforeach

@endsection