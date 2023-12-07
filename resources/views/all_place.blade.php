@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH ĐỊA DANH</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
<table>
    <thead>
        <tr>
            <th style="width: 15%;">Tên địa điểm</th>
            <th style="width: 10%;">Tỉnh thành</th>
            <th style="width: 15%;">Hình ảnh</th>
            <th style="width: 40%;">Mô tả</th>
            <th style="width: 10%;">Hiển thị</th>
            <th style="width: 10%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_place as $key => $pl)
        <tr>
            <td style="text-align: center;">{{ $pl -> place_name }}</td>
            <td style="text-align: center;">{{ $pl ->province->province_name }}</td>
            <td style="text-align: center;"><img src="public/uploads/place/{{ $pl -> place_image }}" height="200" width="100" style="border-radius: 10px"></td>
            <td><span>
                {!! $pl -> place_describe !!}
            </span></td>
            <td style="text-align: center;"><span>
                <?php
                if($pl -> place_status==0){
                ?>
                <a class="show" href="{{URL::to('/unactive-place/'.$pl->place_id)}}"><span style="color: green"><i class="fa-solid fa-eye"></i></span></a>
                <?php
                }else{
                ?>
                <a class="hidden" href="{{URL::to('/active-place/'.$pl->place_id)}}"><span style="color: red"><i class="fa-solid fa-eye-slash"></i></span></a>
                <?php
                }
                ?>
            </span></td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-place/'.$pl->place_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-place/'.$pl->place_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection