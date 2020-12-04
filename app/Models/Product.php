<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'title',
        'isPublic',
        'isConfirmed',
        'toBeDeleted',
        'mainCategory',
        'subcategory',
        'description',
        'is_new',
        'base_price',
        'sale_price',
        'on_sale',
        'operatorIsMultiply',
        'types',
        'sizes',
        'taggs',
        'gender',
        'images',

    ];
}