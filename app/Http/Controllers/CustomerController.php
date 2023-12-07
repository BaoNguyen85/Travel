<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
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
use App\Models\Information;
use App\Models\SocialCustomers;
use App\Models\TourDetail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    public function customer_register(){
        return view('customerRegister');
    } 
    public function customer_login(){
        return view('customerLogin');
    } 
    public function all_customer(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        return view('all_customer')->with(compact('all_customer'))->with(compact('adminName'))->with(compact('adminID'));
    }
    public function customerRegister(Request $request){
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_birth = $data['customer_birth'];
        $customer->customer_mail = $data['customer_mail'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_address = $data['customer_address'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->save();
        return redirect('/customer-login')->with('message','Đăng ký thành công');
    }
    public function customer_dashboard(Request $request){
        $customer_mail = $request->customer_mail;
        $customer_password = md5($request->customer_password);
        $result = DB::table('tbl_customers')->where('customer_mail',$customer_mail)->where('customer_password',$customer_password)->first();
        if($result){
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/index');
        }else{
            Session::put('message','Mật khẩu hoặc mail chưa đúng!');
            return Redirect::to('customer-login');
        }
    }
    public function customerLogin(){
        $customer_id = Session::get('customer_id');
        // if(!$customer_id){
        //     return Redirect::to('customer-login')->send();
        // }else{
        //     return Redirect::to('/index');
        // }
        if(!$customer_id){
        return Redirect::to('/index');}
    }
    public function show_index(Request $request){
        $this->customerLogin();
        $keyword = $request->input('keyword');
        $suggestions = DB::table('tbl_tour')->where('tour_name', 'like', '%' . $keyword . '%')->pluck('tour_name')->toArray();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $all_place = Place::orderby('place_id','DESC')->get();
        $all_infor = Information::orderby('information_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'DESC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','DESC')->get();
        $city = Province::orderby('province_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $all_tour_type = TourType::orderby('tourtype_id', 'ASC')->get();
        $customerName = Session::get('customer_name');
        $customerID = Session::get('customer_id');
        return view('index',compact('all_tour_type','customerID','customerName','all_place','all_tour','city','all_infor','all_tourdetail','all_destination',
        'all_destination_detail','all_schedule','all_scheduledetail','all_order','suggestions'));
    }
    public function profile_customer($customer_id){
        $customerName = Session::get('customer_name');
        $customerID = Session::get('customer_id');
        $all_coupon = Coupon::orderby('coupon_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id', 'ASC')->get();
        $all_order = Order::orderby('order_id', 'ASC')->get();
        $profile_customer = DB::table('tbl_customers')->where('customer_id',$customer_id)->get();
        return view('profile_customer',compact('customerName','customerID','profile_customer','all_order','all_tour','all_tourdetail','all_coupon'));
    }
    public function edit_profile_customer($customer_id){
        $customerName = Session::get('customer_name');
        $customerID = Session::get('customer_id');
        $edit_profile_customer = DB::table('tbl_customers')->where('customer_id',$customer_id)->get();
        return view('edit_profile_customer',compact('customerName','customerID','edit_profile_customer'));
    }
    public function update_profile_customer(Request $request, $customer_id){
        $data = $request->all();
        $customer = Customer::find($customer_id);
        $customer->customer_name = $data['customer_name'];
        $customer->customer_birth = $data['customer_birth'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_address = $data['customer_address'];
        $customer->save();
        return Redirect::to('/profile-customer/'.$customer_id);
    }
    public function customerLogout(){
        $this->customerLogin();
        Session::put('customer_name',null);
        Session::put('customer_id',null);
        return Redirect::to('/');
    }
    public function findOrCreateCustomer($users, $provider){
        $authUser = SocialCustomers::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }else{
            $customer_new = new SocialCustomers([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $customer = Customer::where('customer_mail', $users->email)->first();
            if(!$customer){
                $customer = Customer::create([
                    'customer_name' => $users->name,
                    // 'customer_picture' => $users->avatar,
                    'customer_birth' => now()->parse('2000-01-01')->toDateString(),
                    'customer_mail' => $users->email,
                    'customer_phone' => '',
                    'customer_address' => '',
                    'customer_password' => ''
                    
                ]);
            }
            $customer_new->customer()->associate($customer);
            $customer_new->save();
            return $customer_new;
        }
    }
    public function login_customer_google(){
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    }
    public function callback_customer_google(){
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        $user = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateCustomer($user,'google');
        if($authUser){
            $account_name = Customer::where('customer_id',$authUser->user)->first();
            Session::put('customer_id',$account_name->customer_id);
            Session::put('customer_name',$account_name->customer_name);
        
        }else{
            $account_name = Customer::where('customer_id',$authUser->user)->first();
            Session::put('customer_id',$account_name->customer_id);
            Session::put('customer_name',$account_name->customer_name);
        }
        return redirect('/index')->with('message','Đăng nhập bằng tài khoản google <span style="color:red>'.$account_name->customer_mail.'</span>  thành công');
    }
    public function delete_customer($customer_id){
        DB::table('tbl_customers')->where('customer_id',$customer_id)->delete();
        Session::put('message','Xóa khách hàng thành công');
        return Redirect::to('all-customer');
    }
    public function update_order_customer(Request $request, $order_id){
        $data = $request->all();
        $order = Order::find($order_id);
        $order->order_status = $data['order_status'];
        $order->save();
        Session::put('message','Cập nhật thành công!');
        return redirect()->back();
    }
}
