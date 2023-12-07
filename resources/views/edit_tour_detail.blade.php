@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT CHI TIẾT TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_tourdetail as $key => $edt_tourdetail)
    <form method="post" action="{{ URL::to('/update-tour-detail/'.$edt_tourdetail->tourdetail_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên tour</label>
            <select name="tourdetail_tour" required>
                <option value="">--Chọn tour--</option>
                @foreach($all_tour as $key => $tour)
                    @if($edt_tourdetail->tour_id == $tour->tour_id)
                    <option selected value="{{ $tour->tour_id }}">
                        {{ $tour->tour_name }}
                    </option>
                    @else
                    <option value="{{ $tour->tour_id }}">
                            {{ $tour->tour_name }}
                    </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Thời gian bắt đầu</label>
            <input value="{{ $edt_tourdetail->date_start }}" name="tourdetail_start" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Thời gian kết thúc</label>
            <input value="{{ $edt_tourdetail->date_end }}" name="tourdetail_end" minlength="2" type="datetime-local" required>
        </div>
        <div class="input-content">
            <label for="">Số lượng chỗ</label>
            <input value="{{ $edt_tourdetail->number_of_seats }}" name="number_of_seats" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="tour_show">
                <option value="1">Ẩn</option>
                <option value="0">Hiển thị</option>
            </select>
        </div>
        <div class="input-content">
            <input value="{{ $edt_tourdetail->tour_success }}" name="tour_success" type="hidden" value="0">
        </div>
        <div class="input-content">
            <label for="">Hướng dẫn viên đảm nhận</label>
            <select name="tourdetail_tourguide" required>
                <option value="">--Chọn hướng dẫn viên--</option>
                @foreach($all_tourguide as $key => $tourguide)
                    @if($edt_tourdetail->tourguide_id == $tourguide->tourguide_id)
                    <option selected value="{{ $tourguide->tourguide_id }}">
                            {{ $tourguide->tourguide_name }}
                    </option>
                    @else
                    <option value="{{ $tourguide->tourguide_id }}">
                        {{ $tourguide->tourguide_name }}
                    </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
@endsection