@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM ĐỊA DANH</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-place') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên địa điểm</label>
            <input autocomplete="off" name="place_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input name="place_image" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea rows="10" name="place_describe" id="ckeditor1" placeholder="Mô tả địa điểm..." required></textarea>
        </div>
        <div class="input-content">
            <label for="">Tỉnh thành</label>
            <select name="place_city" required>
                <option value="">--Chọn tỉnh thành phố--</option>
                @foreach ($place_province as $key => $pl_pr)
                    <option value="{{ $pl_pr->province_id }}">{{ $pl_pr->province_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="place_status">
                <option value="1">Ẩn</option>
                <option value="0">Hiển thị</option>
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection