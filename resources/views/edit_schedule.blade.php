@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT LỊCH TRÌNH</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_schedule as $key => $editsch)
    <form method="post" action="{{ URL::to('/update-schedule/'.$editsch->schedule_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên lịch trình</label>
            <input value="{{ $editsch->schedule_name }}" autocomplete="off" name="schedule_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
@endsection