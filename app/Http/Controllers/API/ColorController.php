<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Create a new ColorController instance.
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
            $colors = Color::all();
            return response()->json($colors);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
