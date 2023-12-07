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
use App\Models\TourDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class TourDetailController extends Controller
{
    public function new_tour_detail(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('add_tour_detail', compact('adminName','adminID','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_tour','all_destination','all_destination_detail','all_place','all_province'));
    }
    public function add_tour_detail(Request $request){
        $data = array();
        $data['tour_id'] = $request->tourdetail_tour;
        $data['date_start'] = $request->tourdetail_start;
        $data['date_end'] = $request->tourdetail_end;
        $data['tourguide_id'] = $request->tourdetail_tourguide;
        $data['number_of_seats'] = $request->number_of_seats;
        $data['tour_show'] = $request->tour_show;
        $data['tour_success'] = $request->tour_success;
        DB::table('tbl_tourdetail')->insert($data);
        Session::put('message','Thêm chi tiết tour thành công');
        return Redirect::to('new-tour-detail');
    }
    public function all_tour_detail(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','DESC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('all_tour_detail',compact('adminName','adminID','all_tour','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_tourdetail','all_destination','all_destination_detail','all_place','all_province'));
    }
    public function edit_tour_detail($tourdetail_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $edit_tourdetail = DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->get();
        return view('edit_tour_detail', compact('adminName','adminID','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_tour','edit_tourdetail','all_destination','all_destination_detail','all_place','all_province'));
    }

    public function update_tour_detail(Request $request, $tourdetail_id){
        $data = $request->all();
        $tourdetail = TourDetail::find($tourdetail_id);
        $tourdetail->tour_id = $data['tourdetail_tour'];
        $tourdetail->date_start = $data['tourdetail_start'];
        $tourdetail->date_end = $data['tourdetail_end'];
        $tourdetail->tourguide_id = $data['tourdetail_tourguide'];
        $tourdetail->number_of_seats = $data['number_of_seats'];
        $tourdetail->tour_show = $data['tour_show'];
        $tourdetail->tour_success = $data['tour_success'];
        $tourdetail->save();
        Session::put('message','Cập nhật chi tiết tour thành công');
        return Redirect::to('all-tour-detail');
    }
    public function update_tour_status(Request $request, $tourdetail_id){
        $data = $request->all();
        $tourdetail = TourDetail::find($tourdetail_id);
        $tourdetail->tour_success = $data['tour_success'];
        $tourdetail->save();
        Session::put('message','Cập nhật thành công!');
        return redirect()->back();
    }
    public function delete_tour_detail($tourdetail_id){
        DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->delete();
        Session::put('message','Xóa chi tiết tour thành công');
        return Redirect::to('all-tour-detail');
    }
    public function unactive_tour($tourdetail_id){
        DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->update(['tour_show'=>1]);
        Session::put('message','Đã ẩn tour!');
        return Redirect::to('all-tour-detail');
    }
    public function active_tour($tourdetail_id){
        DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->update(['tour_show'=>0]);
        Session::put('message','Đã kích hoạt tour!');
        return Redirect::to('all-tour-detail');
    }
}
