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
}