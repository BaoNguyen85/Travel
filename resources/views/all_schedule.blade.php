@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH LỊCH TRÌNH</h3>
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
            <th style="width: 80%;">Tên lịch trình</th>
            {{-- <th style="width: 20%;">Tỉnh thành</th> --}}
            {{-- <th style="width: 47%;">Chi tiết</th> --}}
            <th style="width: 20%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_schedule as $key => $sch)
        <tr>
            <td style="text-align: center;">{{ $sch -> schedule_name }}</td>
            {{-- <td style="text-align: center;">{{ $sch -> schedule_place }}</td> --}}
            {{-- <td style="max-width: 200px;max-height: 100px;overflow: auto;">
            <span style="display: block;width: 100%;max-height: 400px;overflow-y: auto;">
                {!! $sch -> schedule_details !!}
            </span></td> --}}
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-schedule/'.$sch->schedule_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-schedule/'.$sch->schedule_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection