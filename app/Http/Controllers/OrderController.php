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
use App\Models\DestinationDetail;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\TourDetail;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
session_start();

class OrderController extends Controller
{
    public function add_order(Request $request){
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['tour_id'] = $request->tour_id;
        $data['tourdetail_id'] = $request->tourdetail_id;
        $data['coupon_id'] = $request->coupon_id;
        $data['order_code'] = $request->order_code;
        $data['order_list_customer'] = $request->order_list_customer;
        $data['order_total'] = (float)$request->order_total;
        $data['order_discount'] = (float)$request->order_discount;
        $data['order_number_of_seats'] = $request->order_number_of_seats;
        $data['order_payment'] = $request->order_payment;
        // $data['order_payment_status'] = $request->order_payment_status;
        $data['order_payment_status'] = $data['order_payment'] == 1 ? 1 : 0;
        $data['order_status'] = $request->order_status;
        $data['order_time'] = now('Asia/Ho_Chi_Minh');

        $customer = DB::table('tbl_customers')->where('customer_id', $data['customer_id'])->first();
        $customerName = $customer->customer_name;
        $customerMail = $customer->customer_mail;
        $customerPhone = $customer->customer_phone;
        $customerAddress = $customer->customer_address;

        $tour = DB::table('tbl_tour')->where('tour_id', $data['tour_id'])->first();
        // $tourID = $tour->tour_id;
        $tourName = $tour->tour_name;

        $coupon = DB::table('tbl_coupon')->where('coupon_id', $data['coupon_id'])->first();
        if ($coupon && isset($coupon->coupon_id)) {
            $couponCode = $coupon->coupon_code;
        } else {
            $couponCode = 0;
        }


        $tourdetail = DB::table('tbl_tourdetail')->where('tourdetail_id', $data['tourdetail_id'])->first();
        $timeStart = $tourdetail->date_start;
        $timeEnd = $tourdetail->date_end;
        $tourGuideID = $tourdetail->tourguide_id;

        $tourguide = DB::table('tbl_tourguide')->where('tourguide_id', $tourGuideID)->first();
        $tourGuideName = $tourguide->tourguide_name;
        $tourGuidePhone = $tourguide->tourguide_phone;


        $orderInfo = [
            'customer_name' => $customerName,
            'customer_mail' => $customerMail,
            'customer_phone' => $customerPhone,
            'customer_address' => $customerAddress,
            'customer_address' => $customerAddress,
            'tour_name' => $tourName,
            'tour_guide_name' => $tourGuideName,
            'tour_guide_phone' => $tourGuidePhone,
            'time_start' => $timeStart,
            'time_end' => $timeEnd,
            'coupon_code' => $couponCode,
            'order_code' => $data['order_code'],
            'order_list_customer' => $data['order_list_customer'],
            'order_total' => $data['order_total'],
            'order_discount' => $data['order_discount'],
            'order_number_of_seats' => $data['order_number_of_seats'],
            'order_payment' => $data['order_payment'],
            'order_payment_status' => $data['order_payment_status'],
        ];
    
        // Gửi email xác nhận
        $this->sendConfirmationEmail($orderInfo);
        DB::table('tbl_order')->insert($data);

        $orderDate = now('Asia/Ho_Chi_Minh')->toDateString();
        $orderTotal = (float)$request->order_total;
        $orderSeats = $request->order_number_of_seats;

        // Kiểm tra xem đã có thông tin thống kê cho ngày đó chưa
        $statisticalRecord = DB::table('tbl_statistical')->where('order_date', $orderDate)->first();

        if ($statisticalRecord) {
            // Nếu đã có, cập nhật thông tin
            DB::table('tbl_statistical')
                ->where('order_date', $orderDate)
                ->update([
                    'sales' => DB::raw('sales + ' . $orderTotal),
                    'quantity' => DB::raw('quantity + ' . $orderSeats),
                    'total_order' => DB::raw('total_order + 1'),
                ]);
        } else {
            // Nếu chưa có, thêm mới bản ghi
            DB::table('tbl_statistical')->insert([
                'order_date' => $orderDate,
                'sales' => $orderTotal,
                'quantity' => $orderSeats,
                'total_order' => 1,
            ]);
        }

        if ($data['coupon_id']) {
            // Kiểm tra xem coupon có tồn tại trong bảng tbl_coupon hay không
            $existingCoupon = DB::table('tbl_coupon')->where('coupon_id', $data['coupon_id'])->first();
        
            if ($existingCoupon && $existingCoupon->coupon_quantity > 0) {
                // Đảm bảo rằng coupon_quantity không trở thành số âm
                $newQuantity = max(0, $existingCoupon->coupon_quantity - 1);
                // Cập nhật coupon_quantity trong bảng tbl_coupon
                DB::table('tbl_coupon')
                    ->where('coupon_id', $data['coupon_id'])
                    ->update(['coupon_quantity' => $newQuantity]);
                    // ->update(['coupon_quantity' => DB::raw('coupon_quantity - 1')]);
            }
        }

        return Redirect::to('index');
    }
    public function update_order(Request $request, $order_id){
        $data = array();
        $data['order_status'] = $request->order_status;
        $data['order_payment_status'] = $request->order_payment_status;
        DB::table('tbl_order')->where('order_id',$order_id)->update($data);
        return Redirect::to('all-order');
    }
    public function all_order(){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_coupon = Coupon::orderby('coupon_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $all_order = Order::orderby('order_id','ASC')->get();
        return view('all_order',compact('adminName','adminID','all_tour','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_tourdetail','all_destination','all_coupon','all_customer','all_destination_detail','all_place','all_province','all_order'));
    }
    public function edit_order($order_id){
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_coupon = Coupon::orderby('coupon_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        $edit_order = DB::table('tbl_order')->where('order_id',$order_id)->get();
        return view('order_detail',compact('adminName','adminID','all_tour','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_tourdetail','all_destination','all_coupon','all_customer','all_destination_detail','all_place','all_province','edit_order'));
    }
    public function confirm_order(Request $request){
        $data = $request->all();
        $customerName = $data['customer_name'];
        // Lấy thông tin đơn hàng
        $orderInfo = [
            'customer_name' => $customerName,
        ];
    
        // Gửi email xác nhận
        $this->sendConfirmationEmail($orderInfo);
    }
    private function sendConfirmationEmail($orderInfo){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Đơn hàng xác nhận ngày".' '.$now; 
        $customer = Customer::find(Session::get('customer_id'));
        $email = $customer->customer_mail;
    
        // Gửi email
        Mail::send('mail_order', ['orderInfo' => $orderInfo], function($message) use ($title_mail, $email){
            $message->to($email)->subject($title_mail);
            $message->from($email, $title_mail);
        });
    }
    public function delete_order($order_id){
        DB::table('tbl_order')->where('order_id',$order_id)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return Redirect::to('all-order');
    }
    function execPostRequest($url, $data){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function vnpay_payment(Request $request){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/travel/public/success";
        $vnp_TmnCode = "TONH6YWK"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "YHNLRBTDFLQDPHGHWWBSMAYNXDQLUUHF"; //Secret key
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_TxnRef = rand(1,10000); //Mã giao dịch thanh toán tham chiếu của merchant
        // $vnp_Amount = 1000; // Số tiền thanh toán
        $orderTotal  = $request->input('order_total');
        if (is_numeric($orderTotal)) {
            $vnp_Amount = $orderTotal * 100;
        } else {
            // Xử lý khi order_total không phải là số
            // Ví dụ: Đặt giá trị mặc định hoặc thông báo lỗi
            $vnp_Amount = 0; // hoặc thông báo lỗi
        }
        // dd($request->all());
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = 'NCB'; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            // "vnp_OrderInfo" => "Thanh toan GD:" + $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }
    public function momo_payment(Request $request){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        // $amount = "10000";
        $amount  = $request->input('order_total');
        
        // dd($amount);
        $orderId = time() . "";
        $redirectUrl = "http://localhost/travel/public/success";
        $ipnUrl = "http://localhost/travel/public/success";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        //Just a example, please check more in there

        // return redirect()->to($jsonResult['payUrl']);
        if (isset($jsonResult['payUrl'])) {
            return redirect()->to($jsonResult['payUrl']);
        } else {
            return response()->json(['message' => 'Chua co gia tri thanh toan nao!'], 200);
        }
        // header('Location: ' . $jsonResult['payUrl']);
    }
    public function success(){
        return view('success');
    }
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order = Order::where('order_code',$checkout_code)->get();
        $adminName = Session::get('admin_name');
        $adminID = Session::get('admin_id');
        $all_coupon = Coupon::orderby('coupon_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_customer = Customer::orderby('customer_id','ASC')->get();
        $all_province = Province::orderby('province_id','ASC')->get();
        $all_place = Place::orderby('place_id','ASC')->get();
        $all_destination = Destination::orderby('destination_id','ASC')->get();
        $all_destination_detail = DestinationDetail::orderby('destinationdetail_id','ASC')->get();
        $all_tour = Tour::orderby('tour_id','ASC')->get();
        $all_tourdetail = TourDetail::orderby('tourdetail_id','ASC')->get();
        $all_tourtype = TourType::orderby('tourtype_id','ASC')->get();
        $all_tourguide = TourGuide::orderby('tourguide_id','ASC')->get();
        $all_schedule = Schedule::orderby('schedule_id','ASC')->get();
        $all_scheduledetail = ScheduleDetail::orderby('scheduledetail_id','ASC')->get();
        return view('print_order',compact('adminName','adminID','all_tour','all_scheduledetail','all_schedule','all_tourtype','all_tourguide',
        'all_tourdetail','all_destination','all_coupon','all_customer','all_destination_detail','all_place','all_province','order'));
    }
    public function export_csv(){

    }
}
