<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'brand_id',
        'title',
        'isPublic',
        'isConfirmed',
        'toBeDeleted',
        'mainCategory',
        'subcategory',
        'description',
        'longDescription',
        'is_new',
        'base_price',
        'sale_price',
        'on_sale',
        'operatorIsMultiply',
        'variationsName',
        'typesName',
        'subtypesName',
        'variations',
        'types',
        'sizes',
        'taggs',
        'gender',
        'images',
        'related',
        'weight',
        'shipping',
        'address',

    ];

    // public function user() {

    //     return $this->belongsTo(User::class);

    // }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }



}