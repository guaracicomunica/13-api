<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'user_id',
        'status_id',
        'amount',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class);
    }
}
