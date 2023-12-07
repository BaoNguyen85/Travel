<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\TourType;
use App\Models\Information;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class InformationController extends Controller
{
    public function edit_information($information_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_information = Information::where('information_id',$information_id)->get();
        return view('edit_information', compact('adminName','adminID','all_information'));
    }
    public function information_infor($information_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_information = Information::where('information_id',$information_id)->get();
        return view('information_website',compact('adminName','adminID','all_information'));
    }
    public function update_information(Request $request, $information_id){
        $data = $request->all();
        $information = Information::find($information_id);
        $information->information_name = $data['information_name'];
        $information->information_address = $data['information_address'];
        $information->information_email = $data['information_email'];
        $information->information_phone = $data['information_phone'];
        $information->information_describe = $data['information_describe'];
        $information->information_location = $data['information_location'];
        $get_image = $request-> file('information_logo');
        if($get_image){
            //xoa anh cu
            // $information_logo_old = $information->information_logo;
            // $path = 'public/uploads/logo/'.$information_logo_old;
            // unlink($path);
            //cap nhat anh moi
            $get_name_image = $get_image->getClientOriginalName();//lấy tên của hình ảnh
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/logo',$new_image);

            $information->information_logo = $new_image;
        }
        $information->save();
        Session::put('message','Cập nhật thông tin thành công!');
        return Redirect::to('/information-infor/1');
    }
}
