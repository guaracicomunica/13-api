<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    protected $cart_products;

    public function __construct(CartProduct $cart_products)
    {
        $this->cart_products = $cart_products;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listProductsByCart($cart_id)
    {
        $products = $this->cart_products
                         ->join('products_sizes', 'carts_products.product_id', '=', 'products_sizes.id')
                         ->join('products', 'products_sizes.product_id', '=', 'products.id')
                         ->select('carts_products.id', 'carts_products.quantity', 'carts_products.product_id as size_id', 'products.price')
                         ->where('carts_products.cart_id', $cart_id)
                         ->get();
                          
        return response()->json($products);
    }
}
