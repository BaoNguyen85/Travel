<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\TourType;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class ScheduleController extends Controller
{
    public function new_schedule(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $schedule_place = Place::orderby('place_id','ASC')->get();
        return view('add_schedule', compact('adminName','adminID','schedule_place'));
    }
    public function add_schedule(Request $request){
        $data = array();
        $data['schedule_name'] = $request->schedule_name;
        // $data['place_id'] = $request->schedule_place;

        DB::table('tbl_schedule')->insert($data);
        return redirect('/new-schedule')->with('message','Thêm lịch trình thành công');
    }
    public function all_schedule(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        return view('all_schedule',compact('adminName','adminID','all_schedule'));
    }
    public function edit_schedule($schedule_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $edit_schedule = DB::table('tbl_schedule')->where('schedule_id',$schedule_id)->get();
        return view('edit_schedule',compact('adminName','adminID','edit_schedule'));
    }
    public function update_schedule(Request $request, $schedule_id){
        $data = $request->all();
        $schedule = Schedule::find($schedule_id);
        $schedule->schedule_name = $data['schedule_name'];
        $schedule->save();
        Session::put('message','Cập nhật lịch trình thành công!');
        return Redirect::to('all-schedule');
    }
    public function delete_schedule($schedule_id){
        DB::table('tbl_schedule')->where('schedule_id',$schedule_id)->delete();
        Session::put('message','Xóa lịch trình thành công');
        return Redirect::to('all-schedule');
    }
}
