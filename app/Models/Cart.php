<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_finished'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts_products', 'cart_id', 'product_id');
    }

    public function products_sizes()
    {
        return $this->belongsToMany(ProductSize::class, 'carts_products', 'cart_id', 'product_size_id');
    }
}
