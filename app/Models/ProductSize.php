<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'products_sizes';

    protected $fillable = [
        'product_id',
        'size_id'
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'carts_products', 'product_size_id', 'cart_id');
    }
}
