@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM LOẠI TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-tour-type') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên loại tour</label>
            <input autocomplete="off" name="tourtype_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input name="tourtype_image" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea id="ckeditor1" rows="10" name="tourtype_describe" required></textarea>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="tourtype_status">
                <option value="1">Ẩn</option>
                <option value="0">Hiển thị</option>
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection