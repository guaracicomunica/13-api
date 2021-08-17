<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductService {

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function applyFilters($filters)
    {
        return $this->productRepository->getAll($filters);
    }

    public function get($id)
    {
        return $this->productRepository->get($id);
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();

            $product = $this->productRepository->store($data);

            $file = $data['file'];

            $folder = "public/products/{$product->id}";

            $fileName = "file.{$file->extension()}";

            $file->storeAs($folder, $fileName);

            $url = url(Storage::url("${folder}/${fileName}"));

            DB::commit();

            return $product;
        } catch (Exception $ex)
        {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getTrend($filters)
    {
        return $this->productRepository->getTrend($filters);
    }

    public function getLatest($filters)
    {
        return $this->productRepository->getLatest($filters);
    }

    public function getLowestPrice($filters)
    {
        return $this->productRepository->getLowestPrice($filters);
    }

    public function getHighestPrice($filters)
    {
        return $this->productRepository->getHighestPrice($filters);
    }
}
