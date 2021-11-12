<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Binarcode\LaravelDeveloper\Models\ExceptionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Create a new MaterialController instance.
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
            $materials = Material::all();
            return response()->json($materials);
        } catch (\Throwable $e) {
            ExceptionLog::makeFromException($e)->save();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
