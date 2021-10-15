<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lastCart($user_id)
    {
        $last_cart = $this->cart
                          ->where('user_id', $user_id)
                          ->where('is_finished', false)
                          ->latest()
                          ->first();
                          
        return response()->json($last_cart);
    }
}
