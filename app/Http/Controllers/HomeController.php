<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\TourType;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\DestinationDetail;
use App\Models\Customer;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Time;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\TourDetail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keyword . '%')->pluck('tour_name')->toArray();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $all_place = Place::orderby('place_id','DESC')->get();
        $all_infor = Information::orderby('information_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'DESC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id', 'DESC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $city = Province::orderby('province_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        return view('index',compact('all_tourdetail','all_tour_type','all_place','all_tour','city','all_infor','all_destination','all_destination_detail','all_order','suggestions'));
    }
    public function tour_detail($tourdetail_id, Request $request){
        $keyword = $request->input('keyword');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keyword . '%')->pluck('tour_name')->toArray();
        $customerID = Session::get('customer_id');
        $customerName = Session::get('customer_name');
        $customer = Customer::orderby('customer_id','ASC')->get();
        $all_comment = Comment::orderby('comment_id', 'ASC')->get();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_infor = Information::orderby('information_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id', 'ASC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $city = Province::orderby('province_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $tour_detail = DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->get();
        return view('tour_detail',compact('customer','all_comment','customerID','customerName','all_tour_type','all_place','all_tour','city','all_infor','all_destination','all_destination_detail','tour_detail','all_tourdetail',
        'all_schedule','all_scheduledetail','all_order','suggestions'));
    }
    public function tourtype_detail($tourtype_id, Request $request){
        $keyword = $request->input('keyword');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keyword . '%')->pluck('tour_name')->toArray();
        $customerID = Session::get('customer_id');
        $customerName = Session::get('customer_name');
        $customer = Customer::orderby('customer_id','ASC')->get();
        $all_comment = Comment::orderby('comment_id', 'ASC')->get();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_infor = Information::orderby('information_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'ASC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $city = Province::orderby('province_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $tourtype_detail = DB::table('tbl_tourtype')->where('tourtype_id',$tourtype_id)->get();
        return view('tourtype_detail',compact('customer','all_comment','customerID','customerName','all_tour_type','all_place','all_tour','city','all_infor','all_destination','all_destination_detail','tourtype_detail',
        'all_tourdetail','all_schedule','all_scheduledetail','all_order','suggestions'));
    }
    public function trending_place($place_id, Request $request){
        $keyword = $request->input('keyword');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keyword . '%')->pluck('tour_name')->toArray();
        $customerID = Session::get('customer_id');
        $customerName = Session::get('customer_name');
        $customer = Customer::orderby('customer_id','ASC')->get();
        $all_comment = Comment::orderby('comment_id', 'ASC')->get();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_infor = Information::orderby('information_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'ASC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $city = Province::orderby('province_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $trending_place = DB::table('tbl_place')->where('place_id',$place_id)->get();
        return view('trending_place',compact('customer','all_comment','customerID','customerName','all_tour_type','all_place','all_tour','city','all_infor','all_destination','all_destination_detail','trending_place',
        'all_tourdetail','all_schedule','all_scheduledetail','all_order','suggestions'));
    }
    public function getSearchSuggestions(Request $request){
        $keywords = $request->input('keywords');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keywords . '%')->pluck('tour_name')->toArray();
        
        return response()->json($suggestions);
    }
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keyword . '%')->pluck('tour_name')->toArray();
        $customerID = Session::get('customer_id');
        $customerName = Session::get('customer_name');
        $customer = Customer::orderby('customer_id','ASC')->get();
        $keywords = $request->keywords_submit;
        // $search_tour = DB::table('tbl_tour')->join('province', 'tbl_tour.tour_city', '=', 'province.province_id')->where('tbl_tour.tour_name','like','%'.$keywords.'%')->orWhere('province.province_name', 'like', '%' . $keywords . '%')->get();
        $search_tour = DB::table('tbl_tour')->join('province', 'tbl_tour.tour_city', '=', 'province.province_id')->where('tbl_tour.tour_name','like','%'.$keywords.'%')
        ->orWhere('province.province_name', 'like', '%' . $keywords . '%')->get();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $all_comment = Comment::orderby('comment_id', 'ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $all_infor = Information::orderby('information_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $city = Province::orderby('province_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('search',compact('customer','all_comment','customerID','customerName','all_tour_type','all_place','all_tour','city','all_infor','all_destination','all_destination_detail',
        'all_tourdetail','all_schedule','all_scheduledetail','search_tour','all_order','suggestions'));
    }
    public function order($tourdetail_id, Request $request){
        $keyword = $request->input('keyword');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keyword . '%')->pluck('tour_name')->toArray();
        $customerID = Session::get('customer_id');
        $customerName = Session::get('customer_name');
        $customer = Customer::orderby('customer_id','ASC')->get();
        $all_coupon = Coupon::orderby('coupon_id', 'ASC')->get();
        $all_comment = Comment::orderby('comment_id', 'ASC')->get();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_infor = Information::orderby('information_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'ASC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $city = Province::orderby('province_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $tour_detail = DB::table('tbl_tourdetail')->where('tourdetail_id',$tourdetail_id)->get();
        if($customerID){
            return view('order_customer',compact('all_coupon','all_comment','customer','customerID','customerName','all_tour_type','all_place','all_tour','city','all_infor','all_destination','all_destination_detail','tour_detail',
            'all_schedule','all_scheduledetail','all_order','suggestions'));
        }else{
            return view('customerLogin',compact('all_coupon','all_comment','customer','customerID','customerName','all_tour_type','all_place','all_tour','city','all_infor','all_destination','all_destination_detail','tour_detail',
            'all_schedule','all_scheduledetail','all_order','suggestions'));
        }
    }
    public function show_tour_home(Request $request ,$tour_id){
        $tour = DB::table('tbl_tour')->orderBy('tour_id','desc')->get();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'giam_dan'){
                $tour = DB::table('tbl_tour')->where('tour_id',$tour_id)->orderBy('tour_price','DESC')->get();
                
            }elseif($sort_by == 'tang_dan'){
                $tour = DB::table('tbl_tour')->where('tour_id',$tour_id)->orderBy('tour_price','ASC')->get();
            }
        }


        return redirect()->back()->with('tour',$tour);
    }
}
