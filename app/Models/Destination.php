<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'destination_name'
    ];
    protected $primaryKey = 'destination_id';
    protected $table = 'tbl_destination';

}
