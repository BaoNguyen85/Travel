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

class DestinationController extends Controller
{
    public function new_destination(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        return view('add_destination', compact('adminName','adminID'));
    }
    public function add_destination(Request $request){
        $data = $request->all();
        $destination = new Destination();
        $destination->destination_name = $data['destination_name'];
        $destination->save();
        return redirect('/new-destination')->with('message','Thêm điểm đến thành công');
    }
    public function all_destination(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        return view('all_destination',compact('adminName','adminID','all_destination'));
    }
    public function edit_destination($destination_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $edit_destination = DB::table('tbl_destination')->where('destination_id',$destination_id)->get();
        return view('edit_destination',compact('adminName','adminID','edit_destination'));
    }
    public function update_destination(Request $request, $destination_id){
        $data = $request->all();
        $destination = Destination::find($destination_id);
        $destination->destination_name = $data['destination_name'];
        $destination->save();
        Session::put('message','Cập nhật điểm đến thành công!');
        return Redirect::to('all-destination');
    }
    public function delete_destination($destination_id){
        DB::table('tbl_destination')->where('destination_id',$destination_id)->delete();
        Session::put('message','Xóa điểm đến thành công');
        return Redirect::to('all-destination');
    }
}
