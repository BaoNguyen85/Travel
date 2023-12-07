<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'coupon_name', 'coupon_code', 'coupon_total', 'coupon_quantity', 'coupon_type' 
    ];
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';
}
