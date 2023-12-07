@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH TOUR</h3>
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
            <th style="width: 15%;">Tỉnh thành</th>
            <th style="width: 20%;">Điểm đến</th>
            <th style="width: 20%;">Lịch trình</th>
            <th style="width: 15%;">Giá</th>
            <th style="width: 5%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_tour as $key => $tour)
        <tr>
            <td style="text-align: center;">{{ $tour -> tour_name }}</td>
            <td style="text-align: center;"><img src="public/uploads/tour/{{ $tour -> tour_avt }}" height="150" width="100" style="border-radius: 10px"></td>
            <td style="text-align: center;">
                @foreach($all_province as $key => $pr)
                @if($pr->province_id == $tour->tour_city)
                {{ $pr->province_name }}
                @endif
                @endforeach
            </td>
            <td style="text-align: center;">
                @php $firstPlace = true; @endphp
                {{-- @foreach($all_destination as $key => $des) --}}
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
                {{-- @endforeach --}}
            </td>
            <td style="text-align: center;">
                @foreach($all_scheduledetail as $key => $sh_dt)
                    @foreach($all_schedule as $key => $sh)
                    @if($sh_dt->schedule_id == $sh->schedule_id && $sh_dt->scheduledetail_id == $tour->tour_schedule)
                    {{ $sh->schedule_name }}
                    @endif
                    @endforeach
                @endforeach
            </td>
            <td style="text-align: center;">{{ number_format($tour -> tour_price,0,',','.') }}đ</td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-tour/'.$tour->tour_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-tour/'.$tour->tour_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection