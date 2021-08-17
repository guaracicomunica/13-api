<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll($filters)
    {
        return $this->product->filter($filters);
    }

    public function get($id)
    {
        return $this->product->findOrFail($id);
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();

            $product = $this->product->create($data);

            $file = $data['file'];

            $folder = "public/products/{$product->id}";

            $fileName = "file.{$file->extension()}";

            $file->storeAs($folder, $fileName);

            $url = url(Storage::url("${folder}/${fileName}"));

            DB::commit();

            return [
                'name' => $product->name,
                'price' => $product->price,
                'file' => $url
            ];
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getTrend($filters)
    {
        return $this->product->orderBy('stars', 'desc')->filter($filters);
    }

    public function getLatest($filters)
    {
        return $this->product->latest()->filter($filters);
    }

    public function getLowestPrice($filters)
    {
        return $this->product->orderBy('price', 'asc')->filter($filters);
    }

    public function getHighestPrice($filters)
    {
        return $this->product->orderBy('price', 'desc')->filter($filters);
    }
}
