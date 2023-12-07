<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'place_id', 'destination_id'
    ];
    protected $primaryKey = 'destinationdetail_id';
    protected $table = 'tbl_destinationdetail';
}
