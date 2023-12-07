@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH HƯỚNG DẪN VIÊN</h3>
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
            <th style="width: 20%;">Tên hướng dẫn viên</th>
            <th style="width: 10%;">Ngày sinh</th>
            <th style="width: 20%;">Email</th>
            <th style="width: 15%;">Điện thoại</th>
            <th style="width: 20%;">Địa chỉ</th>
            <th style="width: 15%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_tourguide as $key => $tg)
        <tr>
            <td style="text-align: center;">{{ $tg -> tourguide_name }}</td>
            <td style="text-align: center;">{{ \Carbon\Carbon::parse($tg->tourguide_birth)->format('d/m/Y') }}</td>
            <td style="text-align: center;">{{ $tg -> tourguide_email }}</td>
            <td style="text-align: center;">{{ $tg -> tourguide_phone }}</td>

            <td style="text-align: center;"><span>
                {!! $tg -> tourguide_address !!}
            </span></td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-tourguide/'.$tg->tourguide_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{ URL::to ('/delete-tourguide/'.$tg->tourguide_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection