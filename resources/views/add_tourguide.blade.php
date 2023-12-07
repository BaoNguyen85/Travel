@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM HƯỚNG DẪN VIÊN</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-tourguide') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên hướng dẫn viên</label>
            <input name="tourguide_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Ngày sinh</label>
            <input name="tourguide_birth" type="date" required>
        </div>
        <div class="input-content">
            <label for="">Giới tính</label>
            <select name="tourguide_sex">
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
            </select>
        </div>
        <div class="input-content">
            <label for="">Email</label>
            <input name="tourguide_email" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Điện thoại</label>
            <input name="tourguide_phone" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Địa chỉ</label>
            <input name="tourguide_address" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Mật khẩu</label>
            <input name="tourguide_password" type="password" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection