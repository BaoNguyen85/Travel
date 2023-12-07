<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'scheduledetail_content', 'schedule_id'
    ];
    protected $primaryKey = 'scheduledetail_id';
    protected $table = 'tbl_scheduledetail';
}
