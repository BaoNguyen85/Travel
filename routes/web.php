<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourDetailController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\TourGuideScheduleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourTypeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleDetailController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\DestinationDetailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\TouristController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/house', function () {
    return view('house');
});
Route::get('/listing', function () {
    return view('listing');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/tour-detail/{tourdetail_id}', [HomeController::class, 'tour_detail']);
Route::post('/search-tour', [HomeController::class, 'search']);
Route::get('/tourtype-detail/{tourtype_id}', [HomeController::class, 'tourtype_detail']);
Route::get('/trending-place/{place_id}', [HomeController::class, 'trending_place']);
Route::get('/order/{tourdetail_id}', [HomeController::class, 'order']);
Route::get('/search-suggestions', [HomeController::class, 'getSearchSuggestions']);

//Admin
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/admin-login', [AdminController::class, 'admin_login']);
Route::get('/admin-register', [AdminController::class, 'admin_register']);
Route::post('/ad-login', [AdminController::class, 'adminLogin']);
Route::post('/ad-register', [AdminController::class, 'adminRegister']);
Route::get('/admin-logout', [AdminController::class, 'adminLogout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin-infor/{admin_id}', [AdminController::class, 'admin_infor']);
Route::get('/edit-admin/{admin_id}', [AdminController::class, 'edit_admin']);
Route::post('/update-admin/{admin_id}', [AdminController::class, 'update_admin']);
Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);
Route::post('/dashboard-filter', [AdminController::class, 'dashboard_filter']);


//Login google
Route::get('/admin-login-google', [AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);

//TourGuide
Route::get('/tourguideDashboard', [TourGuideController::class, 'show_tourguideDashboard']);
Route::get('/tourguide-login', [TourGuideController::class, 'tourguide_login']);
Route::post('/tg-login', [TourGuideController::class, 'tourguideLogin']);
Route::post('/tourguide-dashboard', [TourGuideController::class, 'tourguideDashboard']);
Route::get('/tourguide-logout', [TourGuideController::class, 'tourguideLogout']);
Route::get('/tourguide-infor/{tourguide_id}', [TourGuideController::class, 'tourguide_infor']);
Route::get('/tourguide-infor-edit/{tourguide_id}', [TourGuideController::class, 'tourguide_infor_edit']);
Route::post('/update-tourguide-infor/{tourguide_id}', [TourGuideController::class, 'update_tourguide_infor']);
Route::get('/all-tourguide', [TourGuideController::class, 'all_tourguide']);
Route::get('/new-tourguide', [TourGuideController::class, 'new_tourguide']);
Route::post('/add-tourguide', [TourGuideController::class, 'add_tourguide']);
Route::get('/edit-tourguide/{tourguide_id}', [TourGuideController::class, 'edit_tourguide']);
Route::get('/delete-tourguide/{tourguide_id}', [TourGuideController::class, 'delete_tourguide']);
Route::post('/update-tourguide/{tourguide_id}', [TourGuideController::class, 'update_tourguide']);

//TourGuide Schedule
Route::get('/tourguide-new-tour', [TourGuideScheduleController::class, 'tourguide_new_tour']);
Route::get('/tourguide-schedule/{tour_id}', [TourGuideScheduleController::class, 'tourguide_schedule']);
Route::post('/add-tourguide-schedule', [TourGuideScheduleController::class, 'add_tourguide_schedule']);
Route::get('/edit-schedule-reason/{tourguide_schedule_id}', [TourGuideScheduleController::class, 'edit_schedule_reason']);
Route::post('/update-schedule-reason/{tourguide_schedule_id}', [TourGuideScheduleController::class, 'update_schedule_reason']);
Route::post('/update-schedule-status/{tourguide_schedule_id}', [TourGuideScheduleController::class, 'update_schedule_status']);


//Customer
Route::get('/customer-register', [CustomerController::class, 'customer_register']);
Route::post('/cus-register', [CustomerController::class, 'customerRegister']);
Route::get('/customer-login', [CustomerController::class, 'customer_login']);
Route::get('/customer-logout', [CustomerController::class, 'customerLogout']);
Route::post('/customer-dashboard', [CustomerController::class, 'customer_dashboard']);
Route::get('/index', [CustomerController::class, 'show_index']);
Route::get('/all-customer', [CustomerController::class, 'all_customer']);
Route::get('/profile-customer/{customer_id}', [CustomerController::class, 'profile_customer']);
Route::post('/update-profile-customer/{customer_id}', [CustomerController::class, 'update_profile_customer']);
Route::get('/edit-profile-customer/{customer_id}', [CustomerController::class, 'edit_profile_customer']);
Route::get('/delete-customer/{customer_id}', [CustomerController::class, 'delete_customer']);
Route::post('/update-order-customer/{order_id}', [CustomerController::class, 'update_order_customer']);


Route::get('/login-customer-google', [CustomerController::class, 'login_customer_google']);
Route::get('/customers/google/callback', [CustomerController::class, 'callback_customer_google']);


//Tourist
Route::get('/tourist-tour/{tourdetail_id}', [TouristController::class, 'tourist_tour']);
Route::post('/add-tourist', [TouristController::class, 'add_tourist']);


//Tour
Route::get('/new-tour', [TourController::class, 'new_tour']);
Route::post('/add-tour', [TourController::class, 'add_tour']);
Route::get('/all-tour', [TourController::class, 'all_tour']);
Route::get('/edit-tour/{tour_id}', [TourController::class, 'edit_tour']);
Route::post('/update-tour/{tour_id}', [TourController::class, 'update_tour']);
Route::get('/delete-tour/{tour_id}', [TourController::class, 'delete_tour']);

//Tour Detail
Route::get('/new-tour-detail', [TourDetailController::class, 'new_tour_detail']);
Route::post('/add-tour-detail', [TourDetailController::class, 'add_tour_detail']);
Route::get('/all-tour-detail', [TourDetailController::class, 'all_tour_detail']);
Route::get('/edit-tour-detail/{tourdetail_id}', [TourDetailController::class, 'edit_tour_detail']);
Route::post('/update-tour-detail/{tourdetail_id}', [TourDetailController::class, 'update_tour_detail']);
Route::get('/delete-tour-detail/{tourdetail_id}', [TourDetailController::class, 'delete_tour_detail']);
Route::get('/unactive-tour/{tourdetail_id}', [TourDetailController::class, 'unactive_tour']);
Route::get('/active-tour/{tourdetail_id}', [TourDetailController::class, 'active_tour']);
Route::post('/update-tour-status/{tourdetail_id}', [TourDetailController::class, 'update_tour_status']);

//Tour Type
Route::get('/new-tour-type', [TourTypeController::class, 'new_tour_type']);
Route::post('/add-tour-type', [TourTypeController::class, 'add_tour_type']);
Route::get('/all-tour-type', [TourTypeController::class, 'all_tour_type']);
Route::get('/edit-tour-type/{tourtype_id}', [TourTypeController::class, 'edit_tour_type']);
Route::get('/delete-tour-type/{tourtype_id}', [TourTypeController::class, 'delete_tour_type']);
Route::post('/update-tour-type/{tourtype_id}', [TourTypeController::class, 'update_tour_type']);
Route::get('/unactive-tour-type/{tourtype_id}', [TourTypeController::class, 'unactive_tour_type']);
Route::get('/active-tour-type/{tourtype_id}', [TourTypeController::class, 'active_tour_type']);

//Place
Route::get('/new-place', [PlaceController::class, 'delivery']);
Route::get('/all-place', [PlaceController::class, 'all_place']);
Route::post('/add-place', [PlaceController::class, 'add_place']);
Route::get('/edit-place/{place_id}', [PlaceController::class, 'edit_place']);
Route::get('/delete-place/{place_id}', [PlaceController::class, 'delete_place']);
Route::post('/update-place/{place_id}', [PlaceController::class, 'update_place']);
Route::get('/unactive-place/{place_id}', [PlaceController::class, 'unactive_place']);
Route::get('/active-place/{place_id}', [PlaceController::class, 'active_place']);

//Schedule
Route::get('/new-schedule', [ScheduleController::class, 'new_schedule']);
Route::post('/add-schedule', [ScheduleController::class, 'add_schedule']);
Route::get('/all-schedule', [ScheduleController::class, 'all_schedule']);
Route::get('/edit-schedule/{schedule_id}', [ScheduleController::class, 'edit_schedule']);
Route::post('/update-schedule/{schedule_id}', [ScheduleController::class, 'update_schedule']);
Route::get('/delete-schedule/{schedule_id}', [ScheduleController::class, 'delete_schedule']);

//Schedule Detail
Route::get('/new-schedule-detail', [ScheduleDetailController::class, 'new_scheduledetail']);
Route::post('/add-schedule-detail', [ScheduleDetailController::class, 'add_scheduledetail']);
Route::get('/all-schedule-detail', [ScheduleDetailController::class, 'all_scheduledetail']);
Route::get('/edit-schedule-detail/{scheduledetail_id}', [ScheduleDetailController::class, 'edit_scheduledetail']);
Route::post('/update-schedule-detail/{scheduledetail}', [ScheduleDetailController::class, 'update_scheduledetail']);
Route::get('/delete-schedule-detail/{scheduledetail_id}', [ScheduleDetailController::class, 'delete_scheduledetail']);

//Destination
Route::get('/new-destination', [DestinationController::class, 'new_destination']);
Route::post('/add-destination', [DestinationController::class, 'add_destination']);
Route::get('/edit-destination/{destination_id}', [DestinationController::class, 'edit_destination']);
Route::post('/update-destination/{destination_id}', [DestinationController::class, 'update_destination']);
Route::get('/all-destination', [DestinationController::class, 'all_destination']);
Route::get('/delete-destination/{destination_id}', [DestinationController::class, 'delete_destination']);

//Destination Detail
Route::get('/new-destination-detail', [DestinationDetailController::class, 'new_destination_detail']);
Route::post('/add-destination-detail', [DestinationDetailController::class, 'add_destination_detail']);
Route::get('/edit-destination-detail/{destinationdetail_id}', [DestinationDetailController::class, 'edit_destination_detail']);
Route::post('/update-destination-detail/{destinationdetail_id}', [DestinationDetailController::class, 'update_destination_detail']);
Route::get('/all-destination-detail', [DestinationDetailController::class, 'all_destination_detail']);
Route::get('/delete-destination-detail/{destinationdetail_id}', [DestinationDetailController::class, 'delete_destination_detail']);
//Order
Route::post('/add-order', [OrderController::class, 'add_order']);
Route::get('/all-order', [OrderController::class, 'all_order']);
Route::get('/edit-order/{order_id}', [OrderController::class, 'edit_order']);
Route::get('/delete-order/{order_id}', [OrderController::class, 'delete_order']);
Route::post('/confirm-order/{order_id}', [OrderController::class, 'update_order']);
Route::post('/confirm-ordered', [OrderController::class, 'confirm_order']);
Route::get('/success', [OrderController::class, 'success']);
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);


Route::post('/momo-payment', [OrderController::class, 'momo_payment']);
Route::post('/vnpay-payment', [OrderController::class, 'vnpay_payment']);
Route::post('/export-csv', [OrderController::class, 'export_csv']);


//Comment
Route::post('/add-comment', [CommentController::class, 'add_comment']);
Route::get('/all-comment', [CommentController::class, 'all_comment']);


//Information
Route::get('/information-infor/{information_id}', [InformationController::class, 'information_infor']);
Route::get('/edit-information/{information_id}', [InformationController::class, 'edit_information']);
Route::post('/update-information/{information_id}', [InformationController::class, 'update_information']);

//Coupon
Route::get('/new-coupon', [CouponController::class, 'new_coupon']);
Route::post('/add-coupon', [CouponController::class, 'add_coupon']);
Route::get('/all-coupon', [CouponController::class, 'all_coupon']);
Route::get('/edit-coupon/{coupon_id}', [CouponController::class, 'edit_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);
Route::post('/update-coupon/{coupon_id}', [CouponController::class, 'update_coupon']);
