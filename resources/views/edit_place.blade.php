@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT ĐỊA DANH</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_place as $key => $pl)
    <form method="post" action="{{URL::to ('/update-place/'.$pl->place_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên địa điểm</label>
            <input value="{{ $pl->place_name }}" autocomplete="off" name="place_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input value="{{ $pl->place_image }}" name="place_image" type="file" required>
            <img id="previewImage" src="{{ URL::to('public/uploads/place/'.$pl->place_image) }}" height="200" width="200" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea class="form-control " rows="10" id="ckeditor1" name="place_describe" required>{{ $pl->place_describe }}</textarea>
        </div>
        <div class="input-content">
            <label for="">Tỉnh thành</label>
            <select name="place_city" required>
                @foreach ($place_province as $key => $pl_pr)
                    @if($pl_pr->province_id == $pl->province_id)
                    <option selected value="{{ $pl_pr->province_id }}">{{ $pl_pr->province_name }}</option>
                    @else
                    <option value="{{ $pl_pr->province_id }}">{{ $pl_pr->province_name }}</option>
                    @endif
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
    @endforeach
    <script>
        document.getElementById('place_image').addEventListener('change', function(event) {
            var previewImage = document.getElementById('previewImage');
            var file = event.target.files[0];
            
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Hiển thị hình ảnh đã chọn
                };
                
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection