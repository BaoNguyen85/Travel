@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH CHUỖI ĐIỂM ĐẾN</h3>
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
            <th style="width: 40%;">Tên điểm đến</th>
            <th style="width: 40%;">Chuỗi điểm đến</th>
            <th style="width: 20%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_destination_detail as $key => $des_dtl)
        <tr>
            <td style="text-align: center;">
                @foreach($all_destination as $key => $des)
                @if($des->destination_id == $des_dtl->destination_id)
                {{ $des -> destination_name }}
                @endif
                @endforeach
            </td>
            <td style="text-align: center;">
                @foreach($all_place as $key => $pl)
                @if($pl->place_id == $des_dtl->place_id)
                {{ $pl -> place_name }}
                @endif
                @endforeach
            </td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-destination-detail/'.$des_dtl->destinationdetail_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-destination-detail/'.$des_dtl->destinationdetail_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection