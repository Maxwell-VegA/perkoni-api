<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImgController extends Controller
{
    public function store(Request $request) {
        $validate = $this->validate($request, [
            'image' => 'image|required|max:1999'
        ]);
        
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $request->file('image')->storeAs('public/product_images/temp', $filenameToStore);
        
        
        return response($filenameToStore, 201);
        // return response($request, 200);
    }
}