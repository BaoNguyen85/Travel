@extends('tourguide_layout')
@section('tourguide_content')
    <div class="head-title">
        <h3>LỊCH TRÌNH</h3>
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
            <th style="width: 10%;">Thứ tự</th>
            <th style="width: 25%;">Điểm đến</th>
            <th style="width: 10%;">Đánh dấu</th>
            <th style="width: 20%;">Sự cố</th>
            <th style="width: 20%;">Trạng thái</th>
            <th style="width: 15%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i=1;
        @endphp
        {{-- @foreach($all_order as $key => $order) --}}
            @foreach($edit_tourguide_tour as $key => $edt_tgt)
                @foreach ($all_destination_detail as $key => $des_dtl)
                    @foreach($all_place as $key => $pl)
                        @foreach($all_tour as $key => $tour)
                        @if($pl->place_id == $des_dtl->place_id && $tour->tour_destination == $des_dtl->destination_id && $edt_tgt->tour_id == $tour->tour_id)
                        <tr>
                            <td style="text-align: center;">
                                {{ $i++ }}
                            </td>
                            <td style="text-align: center;"> 
                                    {{ $pl -> place_name }}
                            </td>
                            <td style="text-align: center;">
                                
                                <form class="check-form" method="post" action="{{ URL::to('/add-tourguide-schedule') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                    <input type="hidden" name="tourguide_schedule_tour" value="{{ $edt_tgt->tourdetail_id }}">
                                    <input type="hidden" name="tourguide_schedule_place" value="{{ $pl->place_id }}">
                                    <input type="hidden" name="tourguide_schedule_status" value="0" >
                                    <input type="hidden" name="tourguide_schedule_reason" value="Thêm thông tin">
                                    <input type="hidden" name="checkbox_status" value="0">
                                    <input class="confirm" type="checkbox" value="Hoàn thành" onchange="submitForm(this)">
                                    {{-- @foreach($all_tourguide_schedule as $key => $ts)
                                    @if($ts->checkbox_status==0)
                                    <input class="confirm" type="checkbox" checked>
                                    @elseif($ts->checkbox_status===NULL)
                                    <input class="confirm" type="checkbox" value="Hoàn thành" onchange="submitForm(this)">
                                    @endif
                                    @endforeach --}}
                                </form>
                            </td>
                            <td style="text-align: center;">
                                
                                    @foreach($all_tourguide_schedule as $key => $tg_sch)
                                        @if($edt_tgt->tourdetail_id == $tg_sch->tourguide_schedule_tour && $tg_sch->tourguide_schedule_place == $des_dtl->place_id)
                                        {{ $tg_sch -> tourguide_schedule_reason }}
                                        <a style="float: right" href="{{ URL::to('/edit-schedule-reason/'.$tg_sch->tourguide_schedule_id) }}" class="btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                        @endif
                                    @endforeach
                
                            </td>
                            <td style="text-align: center;">
                                @if(count($all_tourguide_schedule) > 0)
                                    <?php $found = false; ?>
                                    
                                        @foreach($all_tourguide_schedule as $key => $tg_sch)
                                            @if($edt_tgt->tourdetail_id == $tg_sch->tourguide_schedule_tour && $tg_sch->tourguide_schedule_place == $des_dtl->place_id && $tg_sch->tourguide_schedule_status == 1)
                                            <div style="color: green">Đã xử lý</div>
                                                <?php $found = true; break; ?>
                                            @endif
                                        @endforeach

                                    @if(!$found)
                                    <div style="color: rgb(206, 12, 12)">Chưa xử lý</div>
                                    @endif
                                @else
                                <div style="color: rgb(206, 12, 12)">Chưa xử lý</div>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                {{-- @foreach($all_tour as $key => $tour) --}}
                                    @foreach($all_tourguide_schedule as $key => $all_tg_sch)
                                        <form method="post" action="{{ URL::to('/update-schedule-status/'.$all_tg_sch->tourguide_schedule_id) }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            
                                                @if($pl->place_id == $des_dtl->place_id && $all_tg_sch->tourguide_schedule_place == $des_dtl->place_id && $edt_tgt->tourdetail_id == $all_tg_sch->tourguide_schedule_tour)
                                                <input type="hidden" name="tourguide_schedule_tour" value="{{ $edt_tgt->tourdetail_id }}">
                                                <input type="hidden" name="tourguide_schedule_place" value="{{ $pl->place_id }}">
                                                <input type="hidden" name="tourguide_schedule_status" value="1" >
                                                <input type="hidden" name="tourguide_schedule_reason" value="Không">
                                                <input class="confirm" type="submit" value="Hoàn thành">
                                                @endif

                                        </form>
                                        <form method="post" action="{{ URL::to('/update-schedule-status/'.$all_tg_sch->tourguide_schedule_id) }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @foreach($edit_tourguide_tour as $key => $edt_tgt)
                                            @if($pl->place_id == $des_dtl->place_id && $all_tg_sch->tourguide_schedule_place == $des_dtl->place_id && $edt_tgt->tourdetail_id == $all_tg_sch->tourguide_schedule_tour)
                                                    <input type="hidden" name="tourguide_schedule_tour" value="{{ $edt_tgt->tour_id }}">
                                                    <input type="hidden" name="tourguide_schedule_place" value="{{ $pl->place_id }}">
                                                    <input type="hidden" name="tourguide_schedule_status" value="1" >
                                                    <input type="hidden" name="tourguide_schedule_reason" value="Sự cố">
                                                    <input style="background-color: rgb(195, 58, 58); margin-top:3%" class="confirm" type="submit" value="Hủy">
                                                    @endif
                                            @endforeach    
                                        </form>
                                    @endforeach
                                {{-- @endforeach --}}
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        {{-- @endforeach --}}
    </tbody>
</table>
@foreach ($edit_tourguide_tour as $key => $edt_tgt)
@if($tourguideID == $edt_tgt->tourguide_id)
<form method="post" action="{{ URL::to('/update-tour-status/'.$edt_tgt->tourdetail_id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    @foreach($all_tourdetail as $key => $tourdetail)
        @if($edt_tgt->tourdetail_id == $tourdetail->tourdetail_id)
            <input type="hidden" name="tour_success" value="1" >
            <input class="finish" type="submit" value="Xong">
        @endif
    @endforeach    
</form>
<form method="post" action="{{ URL::to('/update-tour-status/'.$edt_tgt->tourdetail_id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    @foreach($all_tourdetail as $key => $tourdetail)
        @if($edt_tgt->tourdetail_id == $tourdetail->tourdetail_id)
            <input type="hidden" name="tour_success" value="2" >
            <input style="background-color: rgb(195, 58, 58);" class="finish" type="submit" value="Hủy tour">
        @endif
    @endforeach    
</form>
@endif
@endforeach
<div class="back-pages">
    <a href="{{ URL::to('/tourguide-new-tour') }}">
        <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
</div>
<div class="content-schedule">
    <h3 style="padding-bottom: 1%">Chi tiết lịch trình</h3>
    @foreach($edit_tourguide_tour as $key => $edt_tgt)
        @foreach($all_scheduledetail as $key => $sch_dtl)
            @foreach($all_tour as $key => $tour)
                @if($tour->tour_schedule == $sch_dtl->scheduledetail_id && $edt_tgt->tour_id == $tour->tour_id)
                {!! $sch_dtl->scheduledetail_content !!}
                @endif
            @endforeach
        @endforeach
    @endforeach
</div>
{{-- <script>
    function submitForm(radio) {
        radio.closest('.check-form').submit();
    }
</script> --}}
<script>
    function submitForm(radio) {
        radio.closest('.check-form').submit();
    }
</script>
@endsection