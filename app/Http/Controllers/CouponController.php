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
use App\Models\Coupon;
use App\Models\DestinationDetail;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class CouponController extends Controller
{
    public function new_coupon(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        return view('add_coupon', compact('adminName','adminID'));
    }
    public function add_coupon(Request $request){
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_total = $data['coupon_total'];
        $coupon->coupon_quantity = $data['coupon_quantity'];
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->save();
        return redirect('/new-coupon')->with('message','Thêm mã giảm giá thành công');
    }
    public function all_coupon(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_coupon = Coupon::orderby('coupon_id','ASC')->get();
        return view('all_coupon',compact('adminName','adminID','all_coupon'));
    }
    public function edit_coupon($coupon_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $edit_coupon = DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->get();
        return view('edit_coupon',compact('adminName','adminID','edit_coupon'));
    }
    public function update_coupon(Request $request, $coupon_id){
        $data = $request->all();
        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_total = $data['coupon_total'];
        $coupon->coupon_quantity = $data['coupon_quantity'];
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->save();
        Session::put('message','Cập nhật mã giảm giá thành công!');
        return Redirect::to('all-coupon');
    }
    public function delete_coupon($coupon_id){
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('all-coupon');
    }
}
