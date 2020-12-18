<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'title',
        'price',
        'selected_gender',
        'selected_variation',
        'selected_type',
        'selected_subtype',
        'selected_size',
        'thumnnail',
        'quantity',
        'key',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
