<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_sizes', 'size_id', 'product_id');
    }
}
