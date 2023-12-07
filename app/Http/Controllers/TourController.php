<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\Tour;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\TourGuide;
use App\Models\TourType;
use App\Models\Time;
use App\Models\Destination;
use App\Models\DestinationDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class TourController extends Controller
{
    public function new_tour(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('add_tour', compact('adminName','adminID','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_destination','all_destination_detail','all_place','all_province'));
    }
    public function all_tour(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','DESC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('all_tour',compact('adminName','adminID','all_tour','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_destination','all_destination_detail','all_place','all_province'));
    }
    public function add_tour(Request $request){
        $data = array();
        $data['tour_name'] = $request->tour_name;
        $data['tour_destination'] = $request->tour_destination;
        $data['tour_price'] = $request->tour_price;
        $data['tour_city'] = $request->tour_city;
        $data['tour_schedule'] = $request->tour_schedule;
        $data['tour_weather'] = $request->tour_weather;
        $data['tour_outstanding'] = $request->tour_outstanding;
        $data['tour_departure'] = $request->tour_departure;
        $data['tour_start_location'] = $request->tour_start_location;
        $data['tour_vehicle'] = $request->tour_vehicle;
        $data['tourtype_id'] = $request->tour_tourtype;
        $get_image = $request-> file('tour_image');
        $get_avt = $request-> file('tour_avt');
        if($get_image && $get_avt){
            $get_name_image = $get_image->getClientOriginalName();
            $get_name_avt = $get_avt->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $name_avt = current(explode('.',$get_name_avt));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $new_avt = $name_avt.rand(0,99).'.'.$get_avt->getClientOriginalExtension();
            $get_image->move('public/uploads/tour',$new_image);
            $get_avt->move('public/uploads/tour',$new_avt);
            $data['tour_image'] = $new_image;
            $data['tour_avt'] = $new_avt;
            DB::table('tbl_tour')->insert($data);
            Session::put('message','Thêm tour thành công');
            return Redirect::to('new-tour');
        }
        else{
            Session::put('message','Vui lòng thêm hình ảnh!');
            return Redirect::to('new-tour');
        }
        $data['tour_image'] = '';
        $data['tour_avt'] = '';
        DB::table('tbl_tour')->insert($data);
        Session::put('message','Thêm tour thành công');
        return Redirect::to('new-tour');
    }
    public function edit_tour($tour_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $edit_tour = DB::table('tbl_tour')->where('tour_id',$tour_id)->get();
        return view('edit_tour', compact('adminName','adminID','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'edit_tour','all_destination','all_destination_detail','all_place','all_province'));
    }

    public function update_tour(Request $request, $tour_id){
        $data = array();
        $tour = Tour::find($tour_id);
        $data['tour_name'] = $request->tour_name;
        $data['tour_destination'] = $request->tour_destination;
        $data['tour_price'] = $request->tour_price;
        $data['tour_city'] = $request->tour_city;
        $data['tour_schedule'] = $request->tour_schedule;
        $data['tour_weather'] = $request->tour_weather;
        $data['tour_outstanding'] = $request->tour_outstanding;
        $data['tour_departure'] = $request->tour_departure;
        $data['tour_start_location'] = $request->tour_start_location;
        $data['tour_vehicle'] = $request->tour_vehicle;
        $data['tourtype_id'] = $request->tour_tourtype;
        $get_image = $request->file('tour_image');
        if($get_image){
            $tour_image_old = $tour->tour_image;
            $path = 'public/uploads/tour/'.$tour_image_old;
            unlink($path);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/tour',$new_image);
            $data['tour_image'] = $new_image;
            // DB::table('tbl_place')->where('place_id',$place_id)->update($data);
            // Session::put('message','Cập nhật sản phẩm thành công');
            // return Redirect::to('all-place');
        }
        $get_avt = $request->file('tour_avt');
        if($get_avt){
            $tour_avt_old = $tour->tour_avt;
            $path1 = 'public/uploads/tour/'.$tour_avt_old;
            unlink($path1);

            $get_name_avt = $get_avt->getClientOriginalName();
            $name_avt = current(explode('.',$get_name_avt));
            $new_avt = $name_avt.rand(0,99).'.'.$get_avt->getClientOriginalExtension();
            $get_avt->move('public/uploads/tour',$new_avt);
            $data['tour_avt'] = $new_avt;
            // DB::table('tbl_place')->where('place_id',$place_id)->update($data);
            // Session::put('message','Cập nhật sản phẩm thành công');
            // return Redirect::to('all-place');
        }
        DB::table('tbl_tour')->where('tour_id',$tour_id)->update($data);
        Session::put('message','Cập nhật tour thành công');
        return Redirect::to('all-tour');
    }
    public function delete_tour($tour_id){
        DB::table('tbl_tour')->where('tour_id',$tour_id)->delete();
        Session::put('message','Xóa tour thành công');
        return Redirect::to('all-tour');
    }
    public function unactive_tour($tour_id){
        DB::table('tbl_tour')->where('tour_id',$tour_id)->update(['tour_show'=>1]);
        Session::put('message','Đã ẩn tour!');
        return Redirect::to('all-tour');
    }
    public function active_tour($tour_id){
        DB::table('tbl_tour')->where('tour_id',$tour_id)->update(['tour_show'=>0]);
        Session::put('message','Đã kích hoạt tour!');
        return Redirect::to('all-tour');
    }
}
