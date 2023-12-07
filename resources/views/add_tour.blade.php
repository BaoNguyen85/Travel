@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-tour') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên Tour</label>
            <input name="tour_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Loại tour</label>
            <select name="tour_tourtype" required>
                <option value="">--Chọn loại tour--</option>
                @foreach($all_tourtype as $key => $tt)
                <option value="{{ $tt->tourtype_id }}">
                        {{ $tt->tourtype_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Thành phố</label>
            <select name="tour_city" required>
                <option value="">--Chọn thành phố--</option>
                @foreach($all_province as $key => $pr)
                <option value="{{ $pr->province_id }}">
                        {{ $pr->province_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Điểm đến</label>
            <select name="tour_destination" required>
                <option value="">--Chọn điểm đến--</option>
                @foreach($all_destination as $key => $des)
                <option value="{{ $des->destination_id }}">
                        {{ $des->destination_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Ảnh đại diện</label>
            <input name="tour_avt" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input name="tour_image" type="file" required>
        </div>
        <div class="input-content">
            <label for="">Giá tour</label>
            <input name="tour_price" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Lịch trình</label>
            <select name="tour_schedule" required>
                <option value="">--Chọn lịch trình--</option>
                @foreach($all_scheduledetail as $key => $schdl)
                <option value="{{ $schdl->scheduledetail_id }}">
                    @foreach($all_schedule as $key => $sch)
                    @if($sch->schedule_id == $schdl->schedule_id)
                        {{ $sch->schedule_name }}
                    @endif
                    @endforeach
                </option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Điểm nổi bật</label>
            <textarea class="form-control " rows="10" id="ckeditor1" name="tour_outstanding" required></textarea>
        </div>
        <div class="input-content">
            <label for="">Nơi khởi hành</label>
            <input name="tour_departure" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Vị trí khởi hành</label>
            <input name="tour_start_location" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Thời tiết</label>
            <input name="tour_weather" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Phương tiện di chuyển</label>
            <input name="tour_vehicle" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection