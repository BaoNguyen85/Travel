<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class PlaceController extends Controller
{
    public function new_place(){
        return view('add_place');
    }

    public function all_place(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_place = Place::with('province')->orderby('place_id','DESC')->get();
        return view('all_place')->with(compact('all_place'))->with(compact('adminName'))->with(compact('adminID'));
    }


    public function delivery(Request $request){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $place_province = Province::orderby('province_id','ASC')->get();
        return view('add_place')->with(compact('place_province'))->with(compact('adminName'))->with(compact('adminID'));
    }

    public function add_place(Request $request){
        $data = array();
        $data['place_name'] = $request->place_name;
        $data['province_id'] = $request->place_city;
        $data['place_describe'] = $request->place_describe;
        $data['place_status'] = $request->place_status;

        $get_image = $request-> file('place_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/place',$new_image);
            $data['place_image'] = $new_image;
            DB::table('tbl_place')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('new-place');
        }else{
            Session::put('message','Vui lòng thêm hình ảnh!');
            return Redirect::to('new-place');
        }
        $data['place_image'] = '';

        DB::table('tbl_place')->insert($data);
        Session::put('message','Thêm địa điểm thành công');
        return Redirect::to('new-place');
    }

    public function edit_place($place_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $place_province = Province::orderby('province_id','ASC')->get();
        $edit_place = DB::table('tbl_place')->where('place_id',$place_id)->get();
        return view('edit_place',compact('adminName','adminID','place_province','edit_place'));
    }

    public function update_place(Request $request, $place_id){
        $data = array();
        $data['place_name'] = $request->place_name;
        $data['province_id'] = $request->place_city;
        $data['place_describe'] = $request->place_describe;
        $data['place_status'] = $request->place_status;
        $get_image = $request->file('place_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/place',$new_image);
            $data['place_image'] = $new_image;
            // DB::table('tbl_place')->where('place_id',$place_id)->update($data);
            // Session::put('message','Cập nhật sản phẩm thành công');
            // return Redirect::to('all-place');
        }
        DB::table('tbl_place')->where('place_id',$place_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-place');
    }
    public function delete_place($place_id){
        DB::table('tbl_place')->where('place_id',$place_id)->delete();
        Session::put('message','Xóa địa điểm thành công');
        return Redirect::to('all-place');
    }

    public function unactive_place($place_id){
        DB::table('tbl_place')->where('place_id',$place_id)->update(['place_status'=>1]);
        Session::put('message','Đã ẩn địa điểm!');
        return Redirect::to('all-place');
    }
    public function active_place($place_id){
        DB::table('tbl_place')->where('place_id',$place_id)->update(['place_status'=>0]);
        Session::put('message','Kích hoạt địa điểm thành công!');
        return Redirect::to('all-place');
    }
}
