<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'total_items',
        'image',
        'color',
        'size',
        'catagory_id',
        'brand_id',
    ];

    public function catagory()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
