<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index(Request $request) 
    {
        $cart = $request->user()->itemsInCart;
        return response ($cart);
    }
    
    public function store(Request $request)
    {
        // $this->validate($request, []);

        $cartItem = CartItem::create([
            'user_id' => $request->user()->id,
            // How to deal with anon customers who don't have an id?
            // Vuex probably
            'product_id' => $request->productId,
            'title' => $request->title,
            'price' => $request->price,
            'selected_gender' => $request->selectedGender,
            'selected_variation' => $request->selectedVariation,
            'selected_type' => $request->selectedType,
            'selected_subtype' => $request->selectedSubtype,
            'selected_size' => $request->selectedSize,
            'quantity' => $request->quantity,
            'key' => $request->key,
        ]);

        return response($cartItem, 201);

    }
}
