<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Place;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Social;
use App\Models\Statistical;
use App\Models\Information;
use App\Models\Order;
use App\Models\TourGuide;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

session_start();

class AdminController extends Controller
{
    // public function login_auth(){
    //     return view('register');
    // }
    public function admin_login(){
        return view('adminLogin');
    }
    public function admin_register(){
        return view('adminRegister');
    }    
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc mail chưa đúng!');
            return Redirect::to('admin-login');
        }
    }
    // public function AuthLogin(){
    //     if(Session::get('login_normal')){
    //         $admin_id = Session::get('admin_id');
    //         if(!$admin_id){
    //             return Redirect::to('admin-login');
    //         }else{
    //             return Redirect::to('dashboard');
    //         }
    //     }else{
    //         $admin_id = Auth::id();
    //         if(!$admin_id){
    //             return Redirect::to('admin-login');
    //         }else{
    //             return Redirect::to('dashboard');
    //         }
    //     }
        
    // }
    public function adminRegister(Request $request){
        // $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_birth = $data['admin_birth'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_address = $data['admin_address'];
        $admin->admin_sex = $data['admin_sex'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return redirect('/admin-register')->with('message','Đăng ký thành công');

    }
    public function update_admin(Request $request, $admin_id){
        $data = $request->all();
        $admin = Admin::find($admin_id);
        $admin->admin_name = $data['admin_name'];
        $admin->admin_birth = $data['admin_birth'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_address = $data['admin_address'];
        $admin->admin_password = md5($data['admin_password']);
        // $admin->admin_sex = $data['admin_sex'];
        // $get_image = $request-> file('admin_avt');
        // if($get_image){
        //     $get_name_image = $get_image->getClientOriginalName();//lấy tên của hình ảnh
        //     $name_image = current(explode('.',$get_name_image));
        //     $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        //     $get_image->move('public/uploads/admin',$new_image);

        //     $admin->admin_avt = $new_image;
        // }
        $admin->save();
        Session::put('message','Cập nhật tài khoản thành công!');
        return Redirect::to('/admin-infor/'.$admin_id);
    }
    public function adminLogin(){
        $admin_id = Session::get('admin_id');
        if(!$admin_id){
            return Redirect::to('admin-login')->send();
        }else{
            return Redirect::to('dashboard');
        }
    }
    public function show_dashboard(){
        $this->adminLogin();
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_order = Order::orderby('order_id','ASC')->get();
        return view('dashboard', ['adminName' => $adminName])->with(compact('adminID','all_order','all_tourguide','all_customer'));
    }
    public function adminLogout(){
        $this->adminLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin-login');
    }
    public function admin_infor($admin_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $admin_infor = DB::table('tbl_admin')->where('admin_id',$adminID)->get();
        return view('admin_infor', compact('admin_infor', 'adminName', 'adminID'));
    }
    public function edit_admin($admin_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $edit_admin = DB::table('tbl_admin')->where('admin_id',$adminID)->get();
        return view('admin_infor_edit', compact('edit_admin', 'adminName', 'adminID'));
    }

    public function findOrCreateCustomer($users, $provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }else{
            $admin_new = new Social([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $admin = Admin::where('admin_email', $users->email)->first();
            if(!$admin){
                $admin = Admin::create([
                    'admin_name' => $users->name,
                    'admin_avt' => '',
                    'admin_email' => $users->email,
                    'admin_password' => '',
                    'admin_birth' => '',
                    'admin_address' => '',
                    'admin_sex' => '',
                    'admin_phone' => ''

                ]);
            }
            $admin_new->customer()->associate($admin);
            $admin_new->save();
            return $admin_new;
        }
    }
    public function login_google(){
        config(['services.google.redirect' => env('GOOGLE_URL')]);
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        config(['services.google.redirect' => env('GOOGLE_URL')]);
        $user = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateCustomer($user,'google');
        if($authUser){
            $account_name = Admin::where('admin_id',$authUser->user)->first();
            Session::put('admin_id',$account_name->admin_id);
            Session::put('admin_name',$account_name->admin_name);
        
        }else{
            $account_name = Admin::where('admin_id',$authUser->user)->first();
            Session::put('admin_id',$account_name->admin_id);
            Session::put('admin_name',$account_name->admin_name);
        }
        return redirect('/dashboard')->with('message','Đăng nhập bằng tài khoản google <span style="color:red>'.$account_name->admin_email.'</span>  thành công');
    }
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                // 'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    // public function order_date(Request $request){
    //     $order_date = $_GET['date'];
    //     $order = Order::where('order_date',$order_date)->orderBy('created_at','DESC')->get();
    //     return view('admin.order_date')->with(compact('order'));
    // }
    public function dashboard_filter(Request $request){
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value']=='7ngay'){
            $get = Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                // 'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data); 
    }
}