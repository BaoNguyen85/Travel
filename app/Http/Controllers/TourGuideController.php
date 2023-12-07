<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
use App\Models\TourDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class TourGuideController extends Controller
{
    public function new_tourguide(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        return view('add_tourguide',compact('adminName','adminID'));
    }
    public function tourguide_login(){
        return view('tourguideLogin');
    }

    public function all_tourguide(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        return view('all_tourguide',compact('adminName','adminID','all_tourguide'));
    }
    public function tourguideDashboard(Request $request){
        $tourguide_email = $request->tourguide_email;
        $tourguide_password = md5($request->tourguide_password);
        $result = DB::table('tbl_tourguide')->where('tourguide_email',$tourguide_email)->where('tourguide_password',$tourguide_password)->first();
        if($result){
            Session::put('tourguide_name',$result->tourguide_name);
            Session::put('tourguide_id',$result->tourguide_id);
            return Redirect::to('/tourguideDashboard');
        }else{
            Session::put('message','Mật khẩu hoặc mail chưa đúng!');
            return Redirect::to('tourguide-login');
        }
    }
    public function tourguideLogin(){
        $tourguide_id = Session::get('tourguide_id');
        if(!$tourguide_id){
            return Redirect::to('tourguide-login')->send();
        }else{
            return Redirect::to('tourguideDashboard');
        }
    }
    public function show_tourguideDashboard(){
        $this->tourguideLogin();
        $tourguideName = Session::get('tourguide_name');
        $tourguideID = Session::get('tourguide_id');
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_order = Order::orderby('order_id','ASC')->get();
        return view('tourguideDashboard', ['tourguideName' => $tourguideName])->with(compact('tourguideID','all_customer','all_order','all_tourdetail'));
    }
    public function tourguideLogout(){
        $this->tourguideLogin();
        Session::put('tourguide_name',null);
        Session::put('tourguide_id',null);
        return Redirect::to('/tourguide-login');
    }
    public function tourguide_infor($tourguide_id){
        $tourguideName = Session::get('tourguide_name');
        $tourguideID = Session::get('tourguide_id');
        $tourguide_infor = DB::table('tbl_tourguide')->where('tourguide_id',$tourguideID)->get();
        return view('tourguide_infor', compact('tourguide_infor', 'tourguideName', 'tourguideID'));
    }
    public function tourguide_infor_edit($tourguide_id){
        $tourguideName = Session::get('tourguide_name');
        $tourguideID = Session::get('tourguide_id');
        $edit_tourguide_infor = DB::table('tbl_tourguide')->where('tourguide_id',$tourguideID)->get();
        return view('tourguide_infor_edit', compact('edit_tourguide_infor', 'tourguideName', 'tourguideID'));
    }
    public function update_tourguide_infor(Request $request, $tourguide_id){
        $data = $request->all();
        $tourguide = TourGuide::find($tourguide_id);
        $tourguide->tourguide_name = $data['tourguide_name'];
        $tourguide->tourguide_phone = $data['tourguide_phone'];
        $tourguide->tourguide_email = $data['tourguide_email'];
        $tourguide->tourguide_address = $data['tourguide_address'];
        $tourguide->tourguide_sex = $data['tourguide_sex'];
        $tourguide->tourguide_birth = $data['tourguide_birth'];
        $tourguide->tourguide_password = md5($data['tourguide_password']);
        // $admin->admin_sex = $data['admin_sex'];
        $tourguide->save();
        Session::put('message','Cập nhật tài khoản thành công!');
        return Redirect::to('/tourguide-infor/'.$tourguide_id);
    }
    public function add_tourguide(Request $request){
        // $this->validation($request);
        $data = $request->all();

        $tourguide = new TourGuide();
        $tourguide->tourguide_name = $data['tourguide_name'];
        $tourguide->tourguide_phone = $data['tourguide_phone'];
        $tourguide->tourguide_email = $data['tourguide_email'];
        $tourguide->tourguide_address = $data['tourguide_address'];
        $tourguide->tourguide_sex = $data['tourguide_sex'];
        $tourguide->tourguide_birth = $data['tourguide_birth'];
        $tourguide->tourguide_password = md5($data['tourguide_password']);
        $tourguide->save();
        return redirect('/new-tourguide')->with('message','Thêm hướng dẫn viên thành công');

    }
    public function edit_tourguide($tourguide_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $edit_tourguide = DB::table('tbl_tourguide')->where('tourguide_id',$tourguide_id)->get();
        return view('edit_tourguide',compact('adminName','adminID','edit_tourguide'));
    }

    public function update_tourguide(Request $request, $tourguide_id){
        $data = $request->all();
        $tourguide = TourGuide::find($tourguide_id);
        $tourguide->tourguide_name = $data['tourguide_name'];
        $tourguide->tourguide_phone = $data['tourguide_phone'];
        $tourguide->tourguide_email = $data['tourguide_email'];
        $tourguide->tourguide_address = $data['tourguide_address'];
        $tourguide->tourguide_sex = $data['tourguide_sex'];
        $tourguide->tourguide_birth = $data['tourguide_birth'];
        $tourguide->tourguide_password = md5($data['tourguide_password']);
        $tourguide->save();
        Session::put('message','Cập nhật tài khoản hướng dẫn viên thành công!');
        return Redirect::to('all-tourguide');
    }
    public function delete_tourguide($tourguide_id){
        DB::table('tbl_tourguide')->where('tourguide_id',$tourguide_id)->delete();
        Session::put('message','Xóa tài khoản hướng dẫn viên thành công');
        return Redirect::to('all-tourguide');
    }
}
