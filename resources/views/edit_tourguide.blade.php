@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT HƯỚNG DẪN VIÊN</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_tourguide as $key => $edit_tg)
    <form method="post" action="{{ URL::to('/update-tourguide/'.$edit_tg->tourguide_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên hướng dẫn viên</label>
            <input value="{{ $edit_tg->tourguide_name }}" name="tourguide_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Ngày sinh</label>
            <input value="{{ $edit_tg->tourguide_birth }}" name="tourguide_birth" type="date" required>
        </div>
        <div class="input-content">
            <label for="">Giới tính</label>
            <select name="tourguide_sex">
                @if($edit_tg->tourguide_sex == 1)
                <option selected value="1">Nam</option>
                <option value="0">Nữ</option>
                @else
                <option value="1">Nam</option>
                <option selected value="0">Nữ</option>
                @endif
            </select>
        </div>
        <div class="input-content">
            <label for="">Email</label>
            <input value="{{ $edit_tg->tourguide_email }}" name="tourguide_email" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Điện thoại</label>
            <input value="{{ $edit_tg->tourguide_phone }}" name="tourguide_phone" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Địa chỉ</label>
            <input value="{{ $edit_tg->tourguide_address }}" name="tourguide_address" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Mật khẩu</label>
            <input value="{{ $edit_tg->tourguide_password }}" name="tourguide_password" type="password" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
@endsection