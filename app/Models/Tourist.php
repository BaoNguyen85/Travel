<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tourdetail_id' , 'tourist_customer_id', 'tourist_name', 'tourist_email', 'tourist_note', 'tourist_phone', 'tourist_status'
    ];
    protected $primaryKey = 'tourist_id';
    protected $table = 'tbl_tourist';
}
