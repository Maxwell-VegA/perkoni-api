<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }
    
    public function indexAPI()
    {
        $products = Product::paginate(3);
        return new ProductResource($products);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        // $this->validate($request, [
        //     'title' => 'required|string|max:255',
        //     'mainCategory'  => 'required|string|max:255',
        //     'subcategory'   => 'required|string|max:255',
        //     'description'   => 'required|string|max:65,535',
        //     'new'           => 'required|boolean',
        //     // 'base_price'    => 'required|integer',
        //     // 'sale_price'    => 'required|integer',
        //     'on_sale'       => 'required|boolean',
        //     'types'         => 'required|array',
        //     'operator'      => 'required|boolean',
        //     'sizes'         => 'required|array',
        //     'taggs'         => 'required|array',
        //     'gender'        => 'nullable|string|max:255',
        // ]);

        // $data = $request->validate([
        //     // 'user_id' => auth()->id()
        //     'title' => 'required|string'
        
        // ]);
        
        // auth()->user()->posts()->create([]);

        $product = Product::create([
            // 'user_id' => $request->user_id,
            'user_id' => $request->user_id,
            'title' => $request->title,
            'mainCategory' => $request->mainCategory,
            'subcategory' => $request->subcategory,
            'description' => $request->description,
            'is_new' => $request->is_new,
            // 'is_new' => true,
            'base_price' => $request->base_price,
            'sale_price' => $request->sale_price,
            'on_sale' => $request->on_sale,
            // 'on_sale' => true,
            'types' => json_encode($request->types),
            'operator' => $request->operator,
            // 'operator' => true,
            'sizes' => json_encode($request->sizes),
            'taggs' => $request->taggs,
            // 'taggs' => '[ "rudens", " novembris", " latvija" ]',
            'taggs' => json_encode($request->taggs),
            'gender' => $request->gender,
        ]);

        // $data->user()->products()->create([
        //     'confirmed' => true,
        //     'title' => $request->title,
        //     'base_price' => 86,
        //     'category' => 'uncategorised',
        //     'description' => 'description',
        //     'description' => 'asdasdasd',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'materials' => json_encode(['color' => 'red']),
        //     'sizes' => json_encode(['small', 'medium', 'large']),
        //     'taggs' => json_encode(['tag1', 'tag2', 'tag3']),

        // ]);
        // dd($product);
        return response($product, 201);

        // $parsed = json_decode($request->data);
        // dd($request);
        

            
        // $products = Product::paginate(3);
        // return new ProductResource($products);

        // dd();
        

        
        // $rules = [
        //     // 'data' => 'required|string|max:255',
        //     'title' => 'required|string|max:255',
        //     // 'mainCategory'  => 'required|string|max:255',
        //     // 'subcategory'   => 'required|string|max:255',
        //     // 'description'   => 'required|string|max:65,535',
        //     // 'new'           => 'required|boolean',
        //     // // 'base_price'    => 'required|integer',
        //     // // 'sale_price'    => 'required|integer',
        //     // 'on_sale'       => 'required|boolean',
        //     // 'types'         => 'required|array',
        //     // 'operator'      => 'required|boolean',
        //     // 'sizes'         => 'required|array',
        //     // 'gender'        => 'nullable|string|max:255',
        // ];
        
        // $this->validate($request, $rules);

        // return redirect()->route('home');
        // Validator::make($request->all(), $rules);

        // if ($validator->passes()) {
        //     // dd('success');
        //     return 'hellow';
        // }
        // else {
        //     return 'hellow';
        //     // dd('failed');
        // }


        // dd($request);

        


        // return view('products.index');
        // include a success message

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
        // return view('products.show', [
        //     'product' => productJSON()
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
