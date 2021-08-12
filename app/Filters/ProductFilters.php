<?php
namespace App\Filters;
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
        if ($term != 0) {
            return $this->builder->where('brand_id', $term);
        }
        return $this->builder->get();
    }

    public function sizeId($term) {
        if ($term != 0) {
            return $this->builder->whereHas('sizes', function ($query) use ($term) {
                return $query->where('sizes.id', $term);
            });
        }
        return $this->builder->get();
    }

    public function categoryId($term) {
        if ($term != 0) {
            return $this->builder->whereHas('categories', function ($query) use ($term) {
                return $query->whereIn('categories.id', explode(",", $term));
            });
        }
        return $this->builder->get();
    }

    public function stars($term) {
        if ($term != 0) {
            return $this->builder->where('stars', $term);
        }
        return $this->builder->get();
    }

    public function materialId($term) {
        if ($term != 0) {
            return $this->builder->where('material_id', $term);
        }
        return $this->builder->get();
    }

    public function colorId($term) {
        if ($term != 0) {
            return $this->builder->whereIn('color_id', explode(",", $term));
        }
        return $this->builder->get();
    }
}
