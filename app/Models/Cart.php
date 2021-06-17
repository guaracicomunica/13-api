<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'cart_id', 'product_id');
    }
}
