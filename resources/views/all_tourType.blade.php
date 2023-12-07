@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH LOẠI TOUR</h3>
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
            <th style="width: 15%;">Tên loại tour</th>
            <th style="width: 15%;">Hình ảnh</th>
            <th style="width: 50%;">Mô tả</th>
            <th style="width: 7%;">Hiển thị</th>
            <th style="width: 13%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_tour_type as $key => $tourtype)
        <tr>
            <td style="text-align: center;">{{ $tourtype -> tourtype_name }}</td>
            <td style="text-align: center;"><img src="public/uploads/tourtype/{{ $tourtype -> tourtype_image }}" height="100" width="200" style="border-radius: 10px"></td>
            <td><span>
                {!! $tourtype -> tourtype_describe !!}
            </span></td>
            <td style="text-align: center;"><span>
                <?php
                if($tourtype -> tourtype_status==0){
                ?>
                <a class="show" href="{{URL::to('/unactive-tour-type/'.$tourtype->tourtype_id)}}"><span style="color: green"><i class="fa-solid fa-eye"></i></span></a>
                <?php
                }else{
                ?>
                <a class="hidden" href="{{URL::to('/active-tour-type/'.$tourtype->tourtype_id)}}"><span style="color: red"><i class="fa-solid fa-eye-slash"></i></span></a>
                <?php
                }
                ?>
            </span></td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-tour-type/'.$tourtype->tourtype_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-tour-type/'.$tourtype->tourtype_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection