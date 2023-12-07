@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH LỊCH TRÌNH CHI TIẾT</h3>
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
            <th style="width: 45%;">Tên lịch trình chi tiết</th>
            <th style="width: 45%;">Mô tả</th>
            {{-- <th style="width: 47%;">Chi tiết</th> --}}
            <th style="width: 10%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_scheduledetail as $key => $schd)
        <tr>
            <td style="text-align: center;">
                @foreach($all_schedule as $key => $sch)
                    @if($sch->schedule_id == $schd->schedule_id)
                    {{ $sch->schedule_name }}
                    @endif
                @endforeach
            </td>
            <td style="text-align: left;">{!! $schd -> scheduledetail_content !!}</td>
            {{-- <td style="max-width: 200px;max-height: 100px;overflow: auto;">
            <span style="display: block;width: 100%;max-height: 400px;overflow-y: auto;">
                {!! $sch -> schedule_details !!}
            </span></td> --}}
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-schedule-detail/'.$schd->scheduledetail_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-schedule-detail/'.$schd->scheduledetail_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection