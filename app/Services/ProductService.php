<?php

namespace App\Services;
use App\Repositories\ProductRepository;

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

    public function getTrend()
    {
        return $this->productRepository->getTrend();
    }
}
