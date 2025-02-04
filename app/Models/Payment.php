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
        'order_id',
        'card_name',
        'card_number',
        'card_expiry',
        'card_cvv',
    ];

    // You can optionally add a relationship to the Order model
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
