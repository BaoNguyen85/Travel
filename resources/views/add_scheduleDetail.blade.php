@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>THÊM LỊCH TRÌNH CHI TIẾT</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <form method="post" action="{{ URL::to('/add-schedule-detail') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Lịch trình</label>
            <select name="schedule_name" required>
                <option value="">--Chọn lịch trình--</option>
                @foreach ($all_schedule as $key => $sch)
                    <option value="{{ $sch->schedule_id }}">{{ $sch->schedule_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Mô tả lịch trình</label>
            <textarea rows="10" name="scheduledetail_content" id="ckeditor1" placeholder="Liệt kê các địa điểm du lịch của lịch trình..." required></textarea>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
@endsection