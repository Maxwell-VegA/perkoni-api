<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index(Request $request) {
        $cart = $request->user()->itemsInCart;
        // $cart = CartItem::findOrFail($id);
        return response ($cart);
    }
    
    public function store(Request $request)
    {
        // $this->validate($request, []);

        $cartItem = CartItem::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->productId,
            'title' => $request->title,
            'price' => $request->price,
            'selected_type' => $request->selectedType,
            'selected_subtype' => $request->selectedSubtype,
            'selected_size' => $request->selectedSize,
            'quantity' => $request->quantity,
        ]);

        return response($cartItem, 201);

    }
}
