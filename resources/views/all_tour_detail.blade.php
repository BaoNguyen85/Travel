@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH CHI TIẾT TOUR</h3>
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
            <th style="width: 20%;">Tên tour</th>
            <th style="width: 10%;">Hình ảnh</th>
            <th style="width: 20%;">Thời gian</th>
            <th style="width: 5%;">Số chỗ</th>
            <th style="width: 15%;">Hướng dẫn viên</th>
            <th style="width: 15%;">Trạng thái</th>
            <th style="width: 15%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_tourdetail as $key => $tourdetail)
        <tr>
            <td style="text-align: center;">
                @foreach($all_tour as $key => $tour)
                    @if($tour->tour_id == $tourdetail->tour_id)
                    {{ $tour->tour_name }}
                    @endif
                @endforeach
            </td>
            <td style="text-align: center;">
                @foreach($all_tour as $key => $tour)
                    @if($tour->tour_id == $tourdetail->tour_id)
                    <img src="public/uploads/tour/{{ $tour -> tour_avt }}" height="150" width="100" style="border-radius: 10px">
                    @endif
                @endforeach
            </td>
            <td style="text-align: center;">
                {{ \Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y') }}  <br> {{ \Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y') }}
            </td>
            <td style="text-align: center;">
                {{ $tourdetail->number_of_seats }}
            </td>
            <td style="text-align: center;">
                @foreach($all_tourguide as $key => $tourguide)
                    @if($tourguide->tourguide_id == $tourdetail->tourguide_id)
                    {{ $tourguide->tourguide_name }}
                    @endif
                @endforeach
            </td>
            <td style="text-align: center;">
                @if($tourdetail->tour_success==1)
                <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px;margin: 0 20%">Hoàn thành</div>
                @elseif($tourdetail->tour_success==0)
                <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px;margin: 0 20%">Tour mới</div>
                @else
                <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px;margin: 0 20%">Đã hủy</div>
                @endif
            </td>
            <td style="text-align: center;">
                <?php
                if($tourdetail->tour_show==0){
                ?>
                <a class="show" href="{{URL::to('/unactive-tour/'.$tourdetail->tourdetail_id)}}"><span style="color: green"><i class="fa-solid fa-eye"></i></span></a>
                <?php
                }else{
                ?>
                <a class="hidden" href="{{URL::to('/active-tour/'.$tourdetail->tourdetail_id)}}"><span style="color: red"><i class="fa-solid fa-eye-slash"></i></span></a>
                <?php
                }
                ?>
                <a href="{{URL::to ('/edit-tour-detail/'.$tourdetail->tourdetail_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-tour-detail/'.$tourdetail->tourdetail_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection