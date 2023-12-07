@extends('tourguide_layout')
@section('tourguide_content')
    <div class="head-title">
        <h3>DANH SÁCH DU KHÁCH</h3>
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
                <th style="width: 5%;">Thứ tự</th>
                <th style="width: 10%;">Tên khách hàng</th>
                <th style="width: 10%;">Số điện thoại</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 5%;">Số chỗ</th>
                <th style="width: 15%;">Danh sách</th>
                {{-- <th style="width: 25%;">Ghi chú</th> --}}
                <th style="width: 35%;">Xử lý</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            
            @foreach ($edit_tourist as $key => $tourist)
                @foreach($all_order as $key => $order)
                    @foreach($all_customer as $key => $cus)
                    @php
                        $hasTouristData = false;
                    @endphp
                    @if($tourist->tourdetail_id == $order->tourdetail_id && $order->customer_id == $cus->customer_id &&  $order->order_status==1)    
                    <tr>
                        <td style="text-align: center;">
                            {{ $i++ }}
                        </td>
                        <td style="text-align: center;"> 
                            {{ $cus -> customer_name }}
                            
                        </td>
                        <td style="text-align: center;">
                            {{ $cus -> customer_phone }}
                            
                        </td>
                        <td style="text-align: center;">
                            {{ $cus -> customer_mail }}
                            
                        </td>
                        <td style="text-align: center;">
                            {{ $order -> order_number_of_seats }}
                        </td>
                        <td>
                            <pre>{{ $order -> order_list_customer }}</pre>
                        </td>
                        {{-- <td style="text-align: center;">
                            <input type="text" id="external_note_input">
                        </td> --}}
                        
                        <td style="text-align: center;">
                            <form class="touristForm" method="post" action="{{ URL::to('/add-tourist') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @foreach($all_tourist as $key => $alltourist)
                                @if($order->customer_id == $alltourist->tourist_customer_id && $order->tourdetail_id == $alltourist->tourdetail_id)
                                    @php
                                    $hasTouristData = true;
                                    @endphp
                                @endif
                            @endforeach
                            <input type="hidden" value="{{ $order -> tourdetail_id }}" name="tourdetail_id">
                            <input type="hidden" value="{{ $cus -> customer_id }}" name="tourist_customer_id">
                            <input type="hidden" value="{{ $cus -> customer_name }}" name="tourist_name">
                            <input type="hidden" value="{{ $cus -> customer_phone }}" name="tourist_phone">
                            <input type="hidden" value="{{ $cus -> customer_mail }}" name="tourist_email">
                            
                            
                            {{-- <input type="hidden" name="tourist_note" id="tourist_note_hidden"> --}}
                            @if($hasTouristData)
                                Đã điểm danh
                                @foreach($all_tourist as $key => $alltourist)
                                    @if($order->customer_id == $alltourist->tourist_customer_id && $order->tourdetail_id == $alltourist->tourdetail_id)
                                        <p style="float: left;padding:1%">Ghi chú: {{ $alltourist->tourist_note }}</p>
                                    @endif
                                @endforeach
                                
                            @else
                                <p style="float: left;padding:1%">Ghi chú&nbsp;&nbsp;</p><input style="float: left;border:none;padding:1%" type="text" name="tourist_note" value="Không" required>
                                <input name="tourist_status" type="radio" value="1" onclick="submitForm(this)"> Đủ &nbsp;&nbsp;
                                <input name="tourist_status" type="radio" value="0" onclick="submitForm(this)"> Vắng
                            @endif
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                @endforeach   
            @endforeach 
        </tbody>
    </table>


<div class="back-pages">
    <a href="{{ URL::to('/tourguide-new-tour') }}">
        <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
</div>
<script>
    function submitForm(radio) {
        radio.closest('.touristForm').submit();
    }
</script>
<script>
    document.getElementById('external_note_input').addEventListener('input', function(event) {
        document.getElementById('tourist_note_hidden').value = event.target.value;
    });
</script>
@endsection