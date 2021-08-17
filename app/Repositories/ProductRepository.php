<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository {

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
        return Product::create($data);
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
