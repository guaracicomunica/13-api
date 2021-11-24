<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = 'carts_products';

    protected $fillable = [
        'product_id',
        'product_size_id',
        'cart_id',
        'quantity'
    ];
}
