<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tour_id', 'tourguide_id', 'number_of_seats', 'date_start', 'date_end', 'tour_show', 'tour_success'
    ];
    protected $primaryKey = 'tourdetail_id';
    protected $table = 'tbl_tourdetail';
}
