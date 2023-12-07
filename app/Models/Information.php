<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'information_name', 'information_logo', 'information_address', 'information_email', 'information_phone', 'information_describe', 'information_location'
    ];
    protected $primaryKey = 'information_id';
    protected $table = 'tbl_information';
}
