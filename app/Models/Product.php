<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'total_items', 'image', 'color', 'size', 'category_id',
    ];

    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }
}

