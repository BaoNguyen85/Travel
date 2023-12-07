<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_id', 'customer_id', 'tour_id', 'coupon_id', 'tourdetail_id', 'order_time', 'order_code', 'order_list_customer', 'order_total', 'order_number_of_seats', 'order_payment', 'order_payment_status', 'order_discount', 'order_status'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';
}

