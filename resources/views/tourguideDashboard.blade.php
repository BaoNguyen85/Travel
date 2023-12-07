@extends('tourguide_layout')
@section('tourguide_content')
    <div class="head-title">
        <h3>THỐNG KÊ</h3>
    </div>
    <div class="colum-access">
        <div class="colum-access1">
            <label style="font-size: 17px">Tổng đơn hàng</label>
            @php
                $tourTotal = 0;
            @endphp
            @foreach($all_tourdetail as $key => $tourdetail)
                @if($tourguideID == $tourdetail->tourguide_id)
                    @php
                    $tourTotal++;
                    @endphp
                @endif
            @endforeach
            <h1 style="padding-top: 6%">{{ $tourTotal }} &nbsp;<i class="fa-solid fa-cart-shopping"></i></h1>
        </div>
        <div class="colum-access2">
            <label style="font-size: 17px">Chưa hoàn thành</label>
            @php
                $tournotsuccessTotal = 0;
            @endphp
            @foreach($all_tourdetail as $key => $tourdetail)
                @if($tourguideID == $tourdetail->tourguide_id && $tourdetail->tour_success==0)
                    @php
                    $tournotsuccessTotal++;
                    @endphp
                @endif
            @endforeach
            <h1 style="padding-top: 6%">{{ $tournotsuccessTotal }} &nbsp;<i class="fa-solid fa-xmark"></i></h1>
        </div>
        <div class="colum-access3">
            <label style="font-size: 17px">Đã hoàn thành</label>
            @php
                $toursuccessTotal = 0;
            @endphp
            @foreach($all_tourdetail as $key => $tourdetail)
                @if($tourguideID == $tourdetail->tourguide_id && $tourdetail->tour_success==1)
                    @php
                    $toursuccessTotal++;
                    @endphp
                @endif
            @endforeach
            <h1 style="padding-top: 6%">{{ $toursuccessTotal }} &nbsp;<i class="fa-solid fa-check"></i></h1>
        </div>
    </div>
@endsection