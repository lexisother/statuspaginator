<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'url',
        'data'
    ];

    protected $casts = [
        'data' => AsArrayObject::class
    ];
}
