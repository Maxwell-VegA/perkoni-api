<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = $request->user()->brands;
        return ($brands);
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'custom_link' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'freeShipping' => 'nullable|numeric',
            'shippingPartners' => 'nullable|array',
            'image' => 'image|required|max:1999',
        ]);

        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $request->file('image')->storeAs('public/logos', $filenameToStore);

            // if id is set in the request then instead of creating a brand a brand with that id will be replaced

        $brand = Brand::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'custom_link' => $request->custom_link,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'freeShipping' => $request->freeShipping,
            'shippingPartners' => $request->shippingPartners,
            'logo' => $filenameToStore,
            // 'logo' => 'storage/logos/' . $filenameToStore,
        ]);

        return response($brand, 201);

    }
}