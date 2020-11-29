<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

            'user_id',
            'confirmed',
            'title',
            'base_price',
            'category',
            'description',
            'materials',
            'sizes',
            'taggs',
            'created_at',
            'updated_at',

    ];
}
