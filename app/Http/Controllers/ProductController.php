<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductsResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->category === 'Jaunumi') {
            $category = ['is_new', '=', 1] ;
        }
        elseif ($request->category === 'Akcijas') {
            $category = ['on_sale', '=', 1] ;
        }
        else {
            $category = ['mainCategory', '=', $request->category];
        }
        // $products = Product::paginate(6);
        $products = DB::table('products')->where($category[0], $category[1], $category[2])->paginate(12);
        return new ProductsResource($products);
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

        // $this->middleware('auth');

        $this->validate($request, [
            'title'         => 'required|string|max:255',
            'isPublic'      => 'required|boolean',
            'isConfirmed'   => 'nullable|boolean',
            'mainCategory'  => 'required|string|max:50',
            'subcategory'   => 'required|string|max:50',
            'description'   => 'required|string|max:65535',
            'is_new'        => 'required|boolean',
            'base_price'    => 'required|numeric',
            'sale_price'    => 'required|numeric',
            'on_sale'       => 'required|boolean',
            'operatorIsMultiply' => 'required|boolean',
            'types'         => 'required|array',
            'sizes'         => 'required|array',
            'taggs'         => 'required|array',
            'gender'        => 'nullable|string|max:255',
            'images'        => 'nullable|array'
        ],[
            'title.required' => 'This is a custom error message for the title required error.'
        ]);

        
        $product = Product::create([
            // 'user_id'       => $request->user_id,
            // 'user_id'       => auth()->id(),
            // auth()->user()->products()->create([]);
            'brand_id'      => $request->brand_id,
            'title'         => $request->title,
            'isPublic'      => $request->isPublic,
            'isConfirmed'   => $request->isConfirmed,
            'mainCategory'  => $request->mainCategory,
            'subcategory'   => $request->subcategory,
            'description'   => $request->description,
            'is_new'        => $request->is_new,
            // 'is_new' => true,
            'base_price'    => $request->base_price,
            'sale_price'    => $request->sale_price,
            // 'on_sale' => true,
            'on_sale'       => $request->on_sale,
            'operatorIsMultiply' => $request->operatorIsMultiply,
            'types'         => json_encode($request->types),
            'sizes'         => json_encode($request->sizes),
            'taggs'         => json_encode($request->taggs),
            'gender'        => $request->gender,
            'images'        => json_encode($request->images),
        ]);

        return response($product, 201);

        // return view('products.index.id');
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
        // perhaps I should format the types and sizes arrays in php instead of js 
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