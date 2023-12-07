<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'place_name', 'province_id', 'place_describe', 'place_image', 'place_status'
    ];
    protected $primaryKey = 'place_id';
    protected $table = 'tbl_place';

    public function province(){
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
    public function schedule(){
        return $this->hasMany('App\Models\Schedule');
    }
}
