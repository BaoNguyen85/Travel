<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\TourType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class TourTypeController extends Controller
{
    public function new_tour_type(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        return view('add_tourType')->with(compact('adminName'))->with(compact('adminID'));
    }

    public function add_tour_type(Request $request){
        $data = $request->all();

        $get_image = $request-> file('tourtype_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/tourtype',$new_image);
            $data['tourtype_image'] = $new_image;
            
            $tourtype = new TourType();
            $tourtype->tourtype_name = $data['tourtype_name'];
            $tourtype->tourtype_describe = $data['tourtype_describe'];
            $tourtype->tourtype_image = $data['tourtype_image'];
            $tourtype->tourtype_status = $data['tourtype_status'];
            $tourtype->save();
            
            Session::put('message','Thêm loại tour thành công!');
            return Redirect::to('new-tour-type');
        }else{
            Session::put('message','Vui lòng thêm hình ảnh!');
            return Redirect::to('new-tour-type');
        }
    }

    public function all_tour_type(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_tour_type = TourType::orderby('tourtype_id','DESC')->get();
        return view('all_tourType')->with(compact('all_tour_type'))->with(compact('adminName'))->with(compact('adminID'));
    }

    public function edit_tour_type($tourtype_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $edit_tour_type = DB::table('tbl_tourtype')->where('tourtype_id',$tourtype_id)->get();
        return view('edit_tourType')->with(compact('edit_tour_type'))->with(compact('adminName'))->with(compact('adminID'));
    }

    public function update_tour_type(Request $request, $tourtype_id){
        $data = $request->all();
        $tourtype = TourType::find($tourtype_id);
        $tourtype->tourtype_name = $data['tourtype_name'];
        $tourtype->tourtype_describe = $data['tourtype_describe'];
        $tourtype->tourtype_status = $data['tourtype_status'];
        $get_image = $request-> file('tourtype_image');
        if($get_image){
            //xoa anh cu
            $tourtype_image_old = $tourtype->tourtype_image;
            $path = 'public/uploads/tourtype/'.$tourtype_image_old;
            unlink($path);
            //cap nhat anh moi
            $get_name_image = $get_image->getClientOriginalName();//lấy tên của hình ảnh
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/tourtype',$new_image);

            $tourtype->tourtype_image = $new_image;
        }
        $tourtype->save();
        Session::put('message','Cập nhật loại tour thành công!');
        return Redirect::to('all-tour-type');
    }

    public function delete_tour_type($tourtype_id){
        DB::table('tbl_tourtype')->where('tourtype_id',$tourtype_id)->delete();
        Session::put('message','Xóa loại tour thành công');
        return Redirect::to('all-tour-type');
    }

    public function unactive_tour_type($tourtype_id){
        DB::table('tbl_tourtype')->where('tourtype_id',$tourtype_id)->update(['tourtype_status'=>1]);
        Session::put('message','Đã ẩn loại tour!');
        return Redirect::to('all-tour-type');
    }
    public function active_tour_type($tourtype_id){
        DB::table('tbl_tourtype')->where('tourtype_id',$tourtype_id)->update(['tourtype_status'=>0]);
        Session::put('message','Kích hoạt loại tour thành công!');
        return Redirect::to('all-tour-type');
    }

}
