@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM LỊCH TRÌNH</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-schedule') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên lịch trình</label>
            <input name="schedule_name" minlength="2" type="text" required>
        </div>
        {{-- <div class="input-content">
            <label for="">Điạ điểm</label>
            <select name="schedule_place">
                <option value="">--Chọn địa điểm--</option>
                @foreach ($schedule_place as $key => $spl)
                    <option value="{{ $spl->place_id }}">{{ $spl->place_name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection