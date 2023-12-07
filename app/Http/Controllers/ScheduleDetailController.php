<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\TourType;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class ScheduleDetailController extends Controller
{
    public function new_scheduledetail(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        return view('add_scheduleDetail', compact('adminName','adminID','all_schedule'));
    }
    public function add_scheduledetail(Request $request){
        $data = array();
        $data['scheduledetail_content'] = $request->scheduledetail_content;
        $data['schedule_id'] = $request->schedule_name;
        DB::table('tbl_scheduledetail')->insert($data);
        return redirect('/new-schedule-detail')->with('message','Thêm chi tiết lịch trình thành công');
    }
    public function all_scheduledetail(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('all_scheduleDetail',compact('adminName','adminID','all_scheduledetail','all_schedule'));
    }
    public function edit_scheduledetail($scheduledetail_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $edit_scheduledetail = DB::table('tbl_scheduledetail')->where('scheduledetail_id',$scheduledetail_id)->get();
        return view('edit_scheduleDetail',compact('adminName','adminID','edit_scheduledetail','all_schedule'));
    }
    public function update_scheduledetail(Request $request, $scheduledetail_id){
        $data = $request->all();
        $scheduledetail = ScheduleDetail::find($scheduledetail_id);
        $scheduledetail->scheduledetail_content = $data['scheduledetail_content'];
        $data['scheduledetail_id'] = $request->scheduledetail_name;
        $scheduledetail->save();
        Session::put('message','Cập nhật lịch trình chi tiết thành công!');
        return Redirect::to('all-schedule-detail');
    }
    public function delete_scheduledetail($scheduledetail_id){
        DB::table('tbl_scheduledetail')->where('scheduledetail_id',$scheduledetail_id)->delete();
        Session::put('message','Xóa lịch trình chi tiết thành công');
        return Redirect::to('all-schedule-detail');
    }
}
