<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tourguide_email','tourguide_password','tourguide_name','tourguide_phone','tourguide_address', 'tourguide_sex', 'tourguide_birth'
    ];
    protected $primaryKey = 'tourguide_id';
    protected $table = 'tbl_tourguide';
}
