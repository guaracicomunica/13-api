<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExceptionLogs extends Model
{
    use HasFactory;

    protected $table = 'exception_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'tags',
        'payload',
        'exception',
        'previous',
        'file',
        'line',
        'code',
        'created_by',
    ];

}
