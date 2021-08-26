<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'auth:api',
            ['except' => ['index']]
        );
    }

    public function index(){
        try {
            $product_types = ProductType::all();
            return response()->json($product_types);
        } catch (\Throwable $e) {
            ExceptionLog::makeFromException($e)->save();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
