@extends('tourguide_layout')
@section('tourguide_content')
<div class="head-title">
    <h3>DANH SÁCH TOUR MỚI</h3>
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
            <th style="width: 15%;">Tên tour</th>
            <th style="width: 10%;">Hình ảnh</th>
            <th style="width: 25%;">Điểm đến</th>
            <th style="width: 20%;">Thời gian</th>
            <th style="width: 10%;">Số chỗ</th>
            <th style="width: 13%;">Trạng thái</th>
            <th style="width: 7%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_tourdetail as $key => $tourdetail)
        @foreach ($all_tour as $key => $tour)
        @if($tourguideID == $tourdetail->tourguide_id && $tourdetail->tour_id == $tour->tour_id)
        <tr>
            <td style="text-align: center;">{{ $tour -> tour_name }}</td>
            <td style="text-align: center;"><img src="public/uploads/tour/{{ $tour -> tour_avt }}" height="150" width="100" style="border-radius: 10px"></td>
            <td style="text-align: center;">
                @php $firstPlace = true; @endphp
                @foreach($all_destination_detail as $key => $des_dtl)
                    @foreach($all_place as $key => $pl)
                        @if(($pl->place_id == $des_dtl->place_id) && ($des_dtl->destination_id == $tour->tour_destination))
                            @if($firstPlace)
                                {{ $pl->place_name }}
                                @php $firstPlace = false; @endphp
                            @else
                                - {{ $pl->place_name }}
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </td>
            <td style="text-align: center;">
                {{ \Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y') }}  <br> {{ \Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y') }}
            </td>
            <td style="text-align: center;">{{ $tourdetail -> number_of_seats }}</td>
            <td style="text-align: center;">
                @if($tourdetail->tour_success==1)
                <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px">Hoàn thành</div>
                @elseif($tourdetail->tour_success==0)
                <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px">Tour mới</div>
                @else
                <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px">Đã hủy</div>
                @endif              
            </td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/tourist-tour/'.$tourdetail->tourdetail_id) }}" class="btn-edit" style="color: rgb(16, 97, 189);">
                    <i class="fa-solid fa-users-viewfinder"></i></a> <br><br>

                <a href="{{URL::to ('/tourguide-schedule/'.$tourdetail->tourdetail_id) }}" class="btn-edit">
                    <i class="fa-solid fa-calendar-days"></i></a>
            </td>
        </tr>
        @endif
        @endforeach
        @endforeach
    </tbody>
</table>
@endsection