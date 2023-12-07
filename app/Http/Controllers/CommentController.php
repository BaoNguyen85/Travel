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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class CommentController extends Controller
{
    public function add_comment(Request $request){
        $data = array();
        $data['comment_content'] = $request->comment_content;
        $data['tour_id'] = $request->tour_id;
        $data['customer_id'] = $request->customer_id;
        DB::table('tbl_comment')->insert($data);
        return redirect()->back();
    }
}
