<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'schedule_name', 'place_id'
    ];
    protected $primaryKey = 'schedule_id';
    protected $table = 'tbl_schedule';

    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }

}
