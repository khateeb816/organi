<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'products', 'subtotal', 'discount', 'total', 'status'];

    protected $casts = [
        'products' => 'array', // JSON ko array me convert karega
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relationship with Payment (Ek order ka ek payment hoga)
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }

}
