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
use App\Models\Order;
use App\Models\Customer;
use App\Models\TourDetail;
use App\Models\TourGuideSchedule;
use App\Models\Tourist;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class TourGuideScheduleController extends Controller
{
    public function tourguide_new_tour(){
        $tourguideName = Session::get('tourguide_name');
        $tourguideID = Session::get('tourguide_id');
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_order = Order::orderby('order_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('tourguide_newtour', ['tourguideName' => $tourguideName])->with(compact('tourguideID','all_province','all_place','all_destination',
        'all_destination_detail','all_tourdetail','all_customer','all_order','all_tour','all_tourtype','all_tourguide','all_schedule','all_scheduledetail'));
    }
    public function tourguide_schedule($tourdetail_id){
        $tourguideName = Session::get('tourguide_name');
        $tourguideID = Session::get('tourguide_id');
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_tourist = Tourist::orderby('tourist_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $all_order = Order::orderby('order_id','ASC')->get();
        $all_tourguide_schedule = TourGuideSchedule::orderby('tourguide_schedule_id','ASC')->get();
        $edit_tourguide_tour = DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->get();
        return view('tourguide_schedule', compact('tourguideName','tourguideID','all_scheduledetail','all_schedule','all_tourtype','all_tourguide','all_tourist',
        'all_tourdetail','all_tour','all_destination','all_customer','all_order','all_destination_detail','all_place','all_province','edit_tourguide_tour','all_tourguide_schedule'));
    }
    public function add_tourguide_schedule(Request $request){
        $data = array();
        $data['tourguide_schedule_place'] = $request->tourguide_schedule_place;
        $data['tourguide_schedule_status'] = $request->tourguide_schedule_status;
        $data['tourguide_schedule_reason'] = $request->tourguide_schedule_reason;
        $data['tourguide_schedule_tour'] = $request->tourguide_schedule_tour;
        $data['checkbox_status'] = $request->checkbox_status;
        DB::table('tbl_tourguide_schedule')->insert($data);
        Session::put('message','Cập nhật thành công');
        return redirect()->back();
    }
    public function update_schedule_status(Request $request, $tourguide_schedule_id){
        $data = $request->all();
        $tourguide_schedule = TourGuideSchedule::find($tourguide_schedule_id);
        $tourguide_schedule->tourguide_schedule_status = $data['tourguide_schedule_status'];
        $tourguide_schedule->tourguide_schedule_reason = $data['tourguide_schedule_reason'];
        $tourguide_schedule->save();
        Session::put('message','Cập nhật thành công!');
        return redirect()->back();
    }
    public function edit_schedule_reason($tourguide_schedule_id){
        $tourguideName = Session::get('tourguide_name');
        $tourguideID = Session::get('tourguide_id');
        $edit_tourguide_reason = DB::table('tbl_tourguide_schedule')->where('tourguide_schedule_id',$tourguide_schedule_id)->get();
        return view('edit_tourguidereason',compact('tourguideName','tourguideID','edit_tourguide_reason'));
    }
    public function update_schedule_reason(Request $request, $tourguide_schedule_id){
        $data = $request->all();
        $tourguide_schedule = TourGuideSchedule::find($tourguide_schedule_id);
        $tourguide_schedule->tourguide_schedule_reason = $data['tourguide_schedule_reason'];
        $tourguide_schedule->save();
        Session::put('message','Cập nhật sự cố thành công!');
        return redirect()->back();
    }

}
