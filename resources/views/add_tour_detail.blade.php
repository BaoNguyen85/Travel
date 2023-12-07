@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM CHI TIẾT TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-tour-detail') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên tour</label>
            <select name="tourdetail_tour">
                <option value="">--Chọn tour--</option>
                @foreach($all_tour as $key => $tour)
                <option value="{{ $tour->tour_id }}">
                        {{ $tour->tour_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Thời gian bắt đầu</label>
            <input name="tourdetail_start" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Thời gian kết thúc</label>
            <input name="tourdetail_end" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Số lượng chỗ</label>
            <input name="number_of_seats" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="tour_show">
                <option value="1">Ẩn</option>
                <option value="0">Hiển thị</option>
            </select>
        </div>
        <div class="input-content">
            <input name="tour_success" type="hidden" value="0">
        </div>
        <div class="input-content">
            <label for="">Hướng dẫn viên đảm nhận</label>
            <select name="tourdetail_tourguide" required>
                <option value="">--Chọn hướng dẫn viên--</option>
                @foreach($all_tourguide as $key => $tourguide)
                <option value="{{ $tourguide->tourguide_id }}">
                        {{ $tourguide->tourguide_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection