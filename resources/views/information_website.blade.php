@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÔNG TIN WEBSITE</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($all_information as $key => $infor)
        {{ csrf_field() }}
        <div class="colum-container">
            <div class="colum1">
                <div class="input-content">
                    <label style="font-weight: bold" for="">Tên công ty: </label>
                    <label>{{ $infor->information_name }}</label>
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Logo</label><br>
                    <img src="../public/uploads/logo/{{ $infor->information_logo }}" height="100" width="200" style="border-radius: 10px;padding-top:5%">
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Địa chỉ: </label>
                    <label>{{ $infor->information_address }}</label>
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Email: </label>
                    <label>{{ $infor->information_email }}</label>
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Số điện thoại: </label>
                    <label>{{ $infor->information_phone }}</label>
                </div>  
                <div class="input-content">
                    <label style="font-weight: bold" for="">Mô tả: </label>
                    <label>{!! $infor->information_describe !!}</label>
                </div>
                
                <div>
                    <a href="{{ URL::to('/edit-information/1') }}" class="btn-set-infor">Chỉnh sửa</a>
                </div>
            </div>
        
            <div class="colum2">
                <div class="input-content" style="margin-left:-2%">
                    <label style="font-weight: bold" for="">Bản đồ</label><br>
                    {!! $infor->information_location !!}
                </div>
            </div>
        </div>
        
    @endforeach
@endsection