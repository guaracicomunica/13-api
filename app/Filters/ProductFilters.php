<?php
namespace App\Filters;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductFilters extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function name($term) {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }

    public function priceMin($term) {
        return $this->builder->where('price', '>=', $term);
    }

    public function priceMax($term) {
        return $this->builder->where('price', '<=', $term);
    }

    public function brandId($term) {
        return $this->builder->where('brand_id', $term);
    }

    public function sizeId($term) {
        return $this->builder->whereHas('sizes', function ($query) use ($term) {
            return $query->where('sizes.id', $term);
        });
    }
}
