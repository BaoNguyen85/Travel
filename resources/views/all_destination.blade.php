@extends('admin_layout')
@section('admin_content')
<div class="head-title">
    <h3>DANH SÁCH ĐIỂM ĐẾN</h3>
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
            <th style="width: 20%;">STT</th>
            <th style="width: 60%;">Tên điểm đến</th>
            <th style="width: 20%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
        ?>
        @foreach ($all_destination as $key => $des)
        <tr>
            <td style="text-align: center;">
                {{ $i++ }}
            </td>
            <td style="text-align: center;">
                {{ $des -> destination_name }}
            </td>
            <td style="text-align: center;">
                <a href="{{URL::to ('/edit-destination/'.$des->destination_id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to ('/delete-destination/'.$des->destination_id) }}" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection