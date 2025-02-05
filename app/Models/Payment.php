<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    // Define the fillable attributes to prevent mass assignment vulnerabilities
    protected $fillable = [
        'user_id',
        'card_name',
        'card_number',
        'card_expiry',
        'card_cvv',
    ];
}
