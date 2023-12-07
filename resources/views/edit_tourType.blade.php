@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT LOẠI TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_tour_type as $key => $tourtype)
    <form method="post" action="{{ URL::to('/update-tour-type/'.$tourtype->tourtype_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên loại tour</label>
            <input value="{{ $tourtype->tourtype_name }}" autocomplete="off" name="tourtype_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input value="{{ $tourtype->tourtype_image }}" name="tourtype_image" type="file" required>
            <img id="previewImage" src="{{ URL::to('public/uploads/tourtype/'.$tourtype->tourtype_image) }}" height="200" width="300" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea id="ckeditor1" rows="10" name="tourtype_describe" required>{{ $tourtype->tourtype_describe }}</textarea>
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
    @endforeach
    <script>
        document.getElementById('tourtype_image').addEventListener('change', function(event) {
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