<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tour_name', 'tour_destination', 'tourtype_id', 'tour_city', 'tour_avt', 'tour_image', 'tour_price', 'tour_schedule', 'tour_outstanding', 'tour_departure', 'tour_start_location', 'tour_vehicle', 'tour_weather'
    ];
    protected $primaryKey = 'tour_id';
    protected $table = 'tbl_tour';

}
