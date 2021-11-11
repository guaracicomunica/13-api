<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Filters\ProductFilters;
use Illuminate\Support\Facades\Validator;
use Binarcode\LaravelDeveloper\Models\ExceptionLog;

class ProductController extends Controller
{
    /**
     * @var productRepository
     */
    protected $productRepository;

    /**
     * ProductController Constructor
     *
     * @param productRepository
     *
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filters\ProductFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductFilters $filters)
    {
        try{
            $products = $this->productRepository->getAll($filters)->paginate($request->per_page);
            return response()->json($products);
        }catch (\Throwable $e) {
            ExceptionLog::makeFromException($e)->save();
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filters\ProductFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function trend(Request $request, ProductFilters $filters)
    {
        $products = $this->productRepository->getTrend($filters)->paginate($request->per_page);
        return response()->json($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filters\ProductFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function latest(Request $request, ProductFilters $filters)
    {
        $products = $this->productRepository->getLatest($filters)->paginate($request->per_page);
        return response()->json($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filters\ProductFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function lowestPrice(Request $request, ProductFilters $filters)
    {
        $products = $this->productRepository->getLowestPrice($filters)->paginate($request->per_page);
        return response()->json($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filters\ProductFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function highestPrice(Request $request, ProductFilters $filters)
    {
        $products = $this->productRepository->getHighestPrice($filters)->paginate($request->per_page);
        return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100|unique:products',
            'description' => 'required|string|between:20,200',
            'price' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'material_id' => 'required|numeric',
            'stars' => 'required|numeric',
            'color_id' => 'required|numeric',
            'product_type_id' => 'required|numeric',
            'file' => 'required|image|mimes:jpeg,png,jpg,svg,gif'
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()->toJson()], 400);
        }

        $data = $validator->validated();

        $product = $this->productRepository->store($data);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->get($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
