<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                         ->join('products', 'carts_products.product_id', '=', 'products.id')
                         ->select('carts_products.id', 'carts_products.quantity', 'carts_products.product_id', 'carts_products.product_size_id', 'products.price')
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
                              ->join('products', 'carts_products.product_id', '=', 'products.id')
                              ->join('colors', 'products.color_id', '=', 'colors.id')
                              ->leftJoin('products_sizes', 'carts_products.product_size_id', '=', 'products_sizes.id')
                              ->leftJoin('sizes', 'products_sizes.size_id', '=', 'sizes.id')
                              ->select('carts_products.id', 'carts_products.product_id', 'carts_products.quantity', 'sizes.id as size_id', 'products.price as unit_price', 'products.name as title', 'products.description', 'colors.hex_code as hex_code_color', 'colors.name as color')
                              ->where('carts_products.cart_id', $cart_id)
                              ->get();
                          
        return response()->json($products_info);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'product_size_id' => 'nullable|numeric',
            'quantity' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->toJson()], 400);
        }

        $data = $validator->validated();

        $cart_product = $this->cart_products->create($data);

        return response()->json($cart_product, 201);
    }

    /**
     * Update the product quantity in storage.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProductSize(Request $request, $id)
    {
        $affected = $this->cart_products
                         ->where('id', $id)
                         ->update(['product_size_id' => $request->input('product_size')]);

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
