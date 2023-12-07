@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM CHUỖI ĐIỂM ĐẾN</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-destination-detail') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Điểm đến</label>
            <select name="destination_detail_destination" required>
                <option value="">--Chọn tên điểm đến--</option>
                @foreach ($all_destination as $key => $des)
                    <option value="{{ $des->destination_id }}">{{ $des->destination_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Tỉnh thành</label>
            <select name="destination_detail_place" required>
                <option value="">--Địa điểm--</option>
                @foreach ($all_place as $key => $pl)
                    <option value="{{ $pl->place_id }}">{{ $pl->place_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection