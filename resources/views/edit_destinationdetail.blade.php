@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT CHUỖI ĐIỂM ĐẾN</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_destination_detail as $ey => $editdes)
    <form method="post" action="{{ URL::to('/update-destination-detail/'.$editdes->destinationdetail_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Điểm đến</label>
            <select name="destination_detail_destination" required>
                @foreach ($all_destination as $key => $des)
                    @if($editdes->destination_id == $des->destination_id)
                        <option selected value="{{ $des->destination_id }}">{{ $des->destination_name }}</option>
                    @else
                        <option value="{{ $des->destination_id }}">{{ $des->destination_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Tỉnh thành</label>
            <select name="destination_detail_place" required>
                @foreach ($all_place as $key => $pl)
                    @if($editdes->place_id == $pl->place_id)
                        <option selected value="{{ $pl->place_id }}">{{ $pl->place_name }}</option>
                    @else
                    <option value="{{ $pl->place_id }}">{{ $pl->place_name }}</option>
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