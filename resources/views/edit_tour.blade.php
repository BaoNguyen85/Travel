@extends('admin_layout')
@section('admin_content')
    <div class="head-title">
        <h3>CẬP NHẬT TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    @foreach($edit_tour as $key => $edt_t)
    <form method="post" action="{{ URL::to('/update-tour/'.$edt_t->tour_id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-content">
            <label for="">Tên Tour</label>
            <input value="{{ $edt_t->tour_name }}" name="tour_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Loại tour</label>
            <select name="tour_tourtype" required>
                <option value="">--Chọn loại tour--</option>
                @foreach($all_tourtype as $key => $tt)
                @if($tt->tourtype_id == $edt_t->tourtype_id)
                <option selected value="{{ $tt->tourtype_id }}">
                        {{ $tt->tourtype_name }}
                </option>
                @else
                <option value="{{ $tt->tourtype_id }}">
                    {{ $tt->tourtype_name }}
                </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Thành phố</label>
            <select name="tour_city" required>
                <option value="">--Chọn thành phố--</option>
                @foreach($all_province as $key => $pr)
                @if($pr->province_id == $edt_t->tour_city)
                <option selected value="{{ $pr->province_id }}">
                        {{ $pr->province_name }}
                </option>
                @else
                <option value="{{ $pr->province_id }}">
                    {{ $pr->province_name }}
                </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Điểm đến</label>
            <select name="tour_destination" required>
                <option value="">--Chọn điểm đến--</option>
                @foreach($all_destination as $key => $des)
                @if($des->destination_id == $edt_t->tour_destination)
                <option selected value="{{ $des->destination_id }}">
                        {{ $des->destination_name }}
                </option>
                @else
                <option value="{{ $des->destination_id }}">
                    {{ $des->destination_name }}
                </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="input-content">
            <label for="">Ảnh đại diện</label>
            <input value="{{ $edt_t->tour_avt }}" name="tour_avt" type="file" required>
            <img id="previewImage" src="{{ URL::to('public/uploads/tour/'.$edt_t->tour_avt) }}" height="200" width="100" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input value="{{ $edt_t->tour_image }}" name="tour_image" type="file" required>
            <img id="previewImage1" src="{{ URL::to('public/uploads/tour/'.$edt_t->tour_image) }}" height="200" width="500" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Giá tour</label>
            <input value="{{ $edt_t->tour_price }}" name="tour_price" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Lịch trình</label>
            <select name="tour_schedule" required>
                <option value="">--Chọn lịch trình--</option>
                @foreach($all_scheduledetail as $key => $schdl)
                @if($schdl->scheduledetail_id == $edt_t->tour_schedule)
                <option selected value="{{ $schdl->scheduledetail_id }}">
                    @foreach($all_schedule as $key => $sch)
                    @if($sch->schedule_id == $schdl->schedule_id)
                        {{ $sch->schedule_name }}
                    @endif
                    @endforeach
                </option>
                @else
                <option value="{{ $schdl->scheduledetail_id }}">
                    @foreach($all_schedule as $key => $sch)
                    @if($sch->schedule_id == $schdl->schedule_id)
                        {{ $sch->schedule_name }}
                    @endif
                    @endforeach
                </option>
                @endif
                @endforeach
            </select>
        </div>
        {{-- <div class="input-content">
            <label for="">Hướng dẫn viên đảm nhận</label>
            <select name="tour_tourguide">
                <option value="">--Chọn hướng dẫn viên--</option>
                @foreach($all_tourguide as $key => $tg)
                @if($tg->tourguide_id == $edt_t->tourguide_id)
                <option selected value="{{ $tg->tourguide_id }}">
                        {{ $tg->tourguide_name }}
                </option>
                @else
                <option value="{{ $tg->tourguide_id }}">
                    {{ $tg->tourguide_name }}
                </option>
                @endif
                @endforeach
            </select>
        </div> --}}
        <div class="input-content">
            <label for="">Điểm nổi bật</label>
            <textarea class="form-control " rows="10" id="ckeditor1" name="tour_outstanding" required>{{ $edt_t->tour_outstanding  }}</textarea>
        </div>
        <div class="input-content">
            <label for="">Nơi khởi hành</label>
            <input value="{{ $edt_t->tour_departure }}" name="tour_departure" type="text" required>
        </div>
        <div class="input-content">
            <label for="">vị trí khởi hành</label>
            <input value="{{ $edt_t->tour_start_location }}" name="tour_start_location" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Thời tiết</label>
            <input value="{{ $edt_t->tour_weather }}" name="tour_weather" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Phương tiện di chuyển</label>
            <input value="{{ $edt_t->tour_vehicle }}" name="tour_vehicle" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    @endforeach
    <script>
        document.getElementById('tour_image').addEventListener('change', function(event) {
            var previewImage = document.getElementById('previewImage');
            var file = event.target.files[0];
            
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Hiển thị hình ảnh đã chọn
                };
                
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        document.getElementById('tour_avt').addEventListener('change', function(event) {
            var previewImage1 = document.getElementById('previewImage1');
            var file = event.target.files[0];
            
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage1.src = e.target.result;
                    previewImage1.style.display = 'block'; // Hiển thị hình ảnh đã chọn
                };
                
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection