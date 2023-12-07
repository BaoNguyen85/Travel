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
use App\Models\Customer;
use App\Models\Destination;
use App\Models\DestinationDetail;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\TourDetail;
use App\Models\Tourist;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class TouristController extends Controller
{
    public function tourist_tour($tourdetail_id){
        $tourguideName = Session::get('tourguide_name');
        $tourguideID = Session::get('tourguide_id');
        $all_coupon = Coupon::orderby('coupon_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $all_order = Order::orderby('order_id','ASC')->get();
        $all_tourist = Tourist::orderby('tourist_id','ASC')->get();
        $edit_tourist = DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->get();
        return view('tourist_tour',compact('tourguideName','tourguideID','all_tour','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_tourdetail','all_destination','all_coupon','all_customer','all_tourist','all_destination_detail','all_place','all_province','all_order','edit_tourist'));
    }
    public function add_tourist(Request $request){
        $data = array();
        $data['tourist_customer_id'] = $request->tourist_customer_id;
        $data['tourdetail_id'] = $request->tourdetail_id;
        $data['tourist_name'] = $request->tourist_name;
        $data['tourist_email'] = $request->tourist_email;
        $data['tourist_phone'] = $request->tourist_phone;
        $data['tourist_status'] = $request->tourist_status;
        $data['tourist_note'] = $request->tourist_note;
        DB::table('tbl_tourist')->insert($data);
        return Redirect()->back();
    }
}
