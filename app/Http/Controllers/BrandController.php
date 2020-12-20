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

    public function update($id, Request $request) {
        
        $this->validate($request, [
            'name' => 'required',
            // 'description' => 'nullable',
            // 'custom_link' => 'nullable',
            // 'facebook' => 'nullable',
            // 'instagram' => 'nullable',
            'freeShipping' => 'nullable|numeric',
            'shippingPartners' => 'nullable|array',
            'image' => 'image|nullable|max:1999',
        ]);
        
        $brand = Brand::find($id);
        // return response($brand);
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->facebook = $request->facebook;
        $brand->instagram = $request->instagram;
        $brand->shippingPartners = $request->shippingPartners;
        $brand->freeShipping = $request->freeShipping;
        $brand->custom_link = $request->custom_link;
        if ($request->image) {
        // Might want to add something here to delete the previous image
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('image')->storeAs('public/logos', $filenameToStore);
        
            $brand->logo = $filenameToStore;
        }
        $brand->save();

        return response('success', 201);
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'name' => 'required',
            // 'description' => 'nullable',
            // 'custom_link' => 'nullable',
            // 'facebook' => 'nullable',
            // 'instagram' => 'nullable',
            'freeShipping' => 'nullable|numeric',
            'shippingPartners' => 'nullable|array',
            'image' => 'image|required|max:1999',
        ]);

        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $request->file('image')->storeAs('public/logos', $filenameToStore);

        $brand = Brand::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'custom_link' => $request->custom_link,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'freeShipping' => $request->freeShipping,
            'shippingPartners' => $request->shippingPartners,
            'logo' => $filenameToStore,
        ]);

        return response($brand, 201);

    }
}