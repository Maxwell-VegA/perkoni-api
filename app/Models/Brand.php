<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'custom_link',
        'facebook',
        'instagram',
        'freeShipping',
        'shippingPartners',
        'logo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}