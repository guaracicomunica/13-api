<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Binarcode\LaravelDeveloper\Models\ExceptionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(
            'auth:api',
            ['except' => ['index']]
        );
    }

    public function index(){
        try {
            $brands = Brand::all();
            return response()->json($brands);
        } catch (\Throwable $e) {

            ExceptionLog::makeFromException($e)->save();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
