<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductSizeController extends Controller
{
    /**
     * Create a new ProductSizeController instance.
     *
     * @return void
     */
    public function __construct(ProductSize $products_sizes)
    {
        $this->products_sizes = $products_sizes;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listProductSizes($product_id)
    {
        $sizes = $this->products_sizes
                      ->join('sizes', 'products_sizes.size_id', '=', 'sizes.id')
                      ->select('sizes.name as sizes')
                      ->where('products_sizes.product_id', $product_id)
                      ->pluck('sizes');
        
        return response()->json($sizes);
    }
}