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
                          ->select('id')
                          ->where('user_id', $user_id)
                          ->where('is_finished', false)
                          ->latest()
                          ->first();
                          
        return response()->json($last_cart);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'is_finished' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->toJson()], 400);
        }

        $data = $validator->validated();

        $cart = $this->cart->create($data);

        return response()->json($cart, 201);
    }
}
