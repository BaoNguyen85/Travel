@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT MÃ GIẢM GIÁ</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_coupon as $key => $edit_cou)
    <form method="post" action="{{ URL::to('/update-coupon/'.$edit_cou->coupon_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên mã giãm giá</label>
            <input value="{{ $edit_cou->coupon_name }}" name="coupon_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Code</label>
            <input value="{{ $edit_cou->coupon_code }}" name="coupon_code" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Loại mã giãm giá</label>
            <select name="coupon_type" required>
                @if($edit_cou->coupon_type == 0)
                <option selected value="0">Giảm theo %</option>
                <option value="1">Giảm theo mệnh giá tiền</option>
                @else
                <option value="0">Giảm theo %</option>
                <option selected value="1">Giảm theo mệnh giá tiền</option>
                @endif
            </select>
        </div>
        <div class="input-content">
            <label for="">Mức giảm</label>
            <input value="{{ $edit_cou->coupon_total }}" name="coupon_total" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Số lượng mã</label>
            <input value="{{ $edit_cou->coupon_quantity }}" name="coupon_quantity" type="number" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
@endsection