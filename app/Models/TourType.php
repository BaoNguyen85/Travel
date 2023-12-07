<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourType extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tourtype_name', 'tourtype_image', 'tourtype_describe', 'tourtype_status'
    ];
    protected $primaryKey = 'tourtype_id';
    protected $table = 'tbl_tourtype';
}
