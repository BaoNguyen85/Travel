@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT ĐIỂM ĐẾN</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_destination as $ey => $editdes)
    <form method="post" action="{{ URL::to('/update-destination/'.$editdes->destination_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên điểm đến</label>
            <input value="{{ $editdes->destination_name }}" autocomplete="off" name="destination_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
@endsection