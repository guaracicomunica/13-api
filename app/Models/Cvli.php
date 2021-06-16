<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cvli extends Model
{
    use HasFactory;

    protected $table = 'cvlis';

    protected $fillable = [
      'cvli_type_id',
      'latitude',
      'user_id',
      'longitude',
      'title',
      'description'
    ];
}
