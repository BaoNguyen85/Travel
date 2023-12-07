<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\TourType;
use App\Models\Schedule;
use App\Models\Destination;
use App\Models\DestinationDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class DestinationDetailController extends Controller
{
    public function new_destination_detail(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        return view('add_destinationdetail', compact('adminName','adminID','all_place','all_destination'));
    }
    public function all_destination_detail(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        return view('all_destinationdetail',compact('adminName','adminID','all_place','all_destination','all_destination_detail'));
    }
    public function add_destination_detail(Request $request){
        $data = array();
        $data['place_id'] = $request->destination_detail_place;
        $data['destination_id'] = $request->destination_detail_destination;
        DB::table('tbl_destinationdetail')->insert($data);
        Session::put('message','Thêm chi tiết điểm đến thành công');
        return Redirect::to('new-destination-detail');
    }
    public function edit_destination_detail($destinationdetail_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $edit_destination_detail = DB::table('tbl_destinationdetail')->where('destinationdetail_id',$destinationdetail_id)->get();
        return view('edit_destinationdetail',compact('adminName','adminID','all_place','all_province','all_schedule','all_destination','edit_destination_detail'));
    }
    public function update_destination_detail(Request $request,$destinationdetail_id){
        $data = array();
        $data['place_id'] = $request->destination_detail_place;
        $data['destination_id'] = $request->destination_detail_destination;
        DB::table('tbl_destinationdetail')->where('destinationdetail_id',$destinationdetail_id)->update($data);
        Session::put('message','Cập nhật chi tiết điểm đến thành công!');
        return Redirect::to('all-destination-detail');
    }
    public function delete_destination_detail($destinationdetail_id){
        DB::table('tbl_destinationdetail')->where('destinationdetail_id',$destinationdetail_id)->delete();
        Session::put('message','Xóa điểm đến thành công');
        return Redirect::to('all-destination-detail');
    }
}
