<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{

    protected $table = 'products_files';

    protected $fillable = [
        'product_id',
        'path'
    ];
}
