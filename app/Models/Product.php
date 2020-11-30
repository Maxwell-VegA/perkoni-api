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
        'mainCategory',
        'subcategory',
        'description',
        'is_new',
        'base_price',
        'sale_price',
        'on_sale',
        'types',
        'operator',
        'sizes',
        'taggs',
        'gender',

    ];
}
