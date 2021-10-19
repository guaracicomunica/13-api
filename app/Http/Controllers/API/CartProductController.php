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

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listProductInformationByCart($cart_id)
    {
        $products_info = $this->cart_products
                              ->join('products_sizes', 'carts_products.product_id', '=', 'products_sizes.id')
                              ->join('sizes', 'products_sizes.size_id', '=', 'sizes.id')
                              ->join('products', 'products_sizes.product_id', '=', 'products.id')
                              ->join('colors', 'products.color_id', '=', 'colors.id')
                              ->select('carts_products.id', 'carts_products.quantity', 'carts_products.product_id as size_id', 'products.price as unit_price', 'products.name as title', 'products.description', 'colors.hex_code as hex_code_color', 'colors.name as color', 'sizes.name as size')
                              ->where('carts_products.cart_id', $cart_id)
                              ->get();
                          
        return response()->json($products_info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProductQuantity(Request $request, $id)
    {
        $affected = $this->cart_products
                         ->where('id', $id)
                         ->update(['quantity' => $request->input('quantity')]);

        return response(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProductInCart($id)
    {
        $affected = $this->cart_products->where('id', $id)->delete();

        return response($affected, 201);
    }
}
