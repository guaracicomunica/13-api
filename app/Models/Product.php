<?php

namespace App\Models;

use App\Filters\Filterable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Filterable;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'brand_id',
        'material_id',
        'stars',
        'color_id',
        'product_type_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories', 'product_id', 'category_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'products_sizes', 'product_id', 'size_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class);
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }

    public function color()
    {
        return $this->hasOne(Color::class);
    }

    public function productType()
    {
        return $this->hasOne(ProductType::class);
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }
}
