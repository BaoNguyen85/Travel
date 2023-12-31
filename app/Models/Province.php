<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'province_name', 'province_code'
    ];
    protected $primaryKey = 'province_id';
    protected $table = 'province';

}
