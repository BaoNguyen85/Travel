@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT THÔNG TIN WEBSITE</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($all_information as $key => $infor)
    <form method="post" action="{{ URL::to('/update-information/'.$infor->information_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên công ty</label>
            <input value="{{ $infor->information_name }}" autocomplete="off" name="information_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Logo</label>
            <input value="{{ $infor->information_logo }}" name="information_logo" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Địa chỉ</label>
            <input value="{{ $infor->information_address }}" name="information_address" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Email</label>
            <input value="{{ $infor->information_email }}" name="information_email" type="email" required>
        </div>
        <div class="input-content">
            <label for="">Số điện thoại</label>
            <input value="{{ $infor->information_phone }}" name="information_phone" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea rows="10" name="information_describe" id="ckeditor1" placeholder="Mô tả thông tin..." required>{{ $infor->information_describe }}</textarea>
        </div>
        <div class="input-content">
            <label for="">Bản đồ</label>
            <textarea rows="10" name="information_location" required>{{ $infor->information_location }}</textarea>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
@endsection