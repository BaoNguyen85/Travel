@extends('tourguide_layout')
@section('tourguide_content')
    <div class="head-title">
        <h3>CẬP NHẬT LÝ DO</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_tourguide_reason as $key => $tg_rs)
    
    <form method="post" action="{{ URL::to('/update-schedule-reason/'.$tg_rs->tourguide_schedule_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Sự cố</label>
            <input value="{{ $tg_rs->tourguide_schedule_reason }}" autocomplete="off" name="tourguide_schedule_reason" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
        
    </form>
    <div class="back-page">
        <a href="{{URL::to ('/tourguide-schedule/'.$tg_rs->tourguide_schedule_tour) }}">
            <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
    </div>
    @endforeach
@endsection