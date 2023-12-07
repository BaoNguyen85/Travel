<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'tour_id', 'comment_content'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';
}
