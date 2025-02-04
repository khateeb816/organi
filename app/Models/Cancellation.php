<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reason',
        'order_id',
        'user_id',
    ];
}
