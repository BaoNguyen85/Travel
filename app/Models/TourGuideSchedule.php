<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuideSchedule extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tourguide_schedule_place', 'tourguide_schedule_status', 'tourguide_schedule_tour', 'checkbox_status'
    ];
    protected $primaryKey = 'tourguide_schedule_id';
    protected $table = 'tbl_tourguide_schedule';
}
