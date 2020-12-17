<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductsResource;
use App\Http\Resources\ProductsCollection;

class Image
{
    public $fileName;
    public $title;
    public $description;
}

class ProductController extends Controller
{
    public function index(Request $request)
    {

        if ($request->category === 'Jaunumi') {
            $category = ['is_new', '=', 1];
        }
        elseif ($request->category === 'Akcijas') {
            $category = ['on_sale', '=', 1];
        }
        else {
            $category = ['mainCategory', '=', $request->category];
        }

        $gender = $request->gender;
        
        if ($gender === "Vīriešiem") {
            $gender = 'rie';
        }
        elseif ($gender === "Sievietēm") {
            $gender = 'Sieviet';
        }
        elseif ($gender === "Bērniem") {
            $gender = 'rniem';
        }

        // The issue is that I don't have access to variables inside of that that function
        
        $subcategory = $request->subcategory;
        $taggs = ['December', 'Easter', 'Spring'];



        $matchesTag = function ($query) {
            $query->where('taggs', 'like', '%'.'December'.'%')
                ->orWhere('taggs', 'like', '%'.'Easter'.'%')
                ->orWhere('taggs', 'like', '%'.'Spring'.'%');
        };

        $products = DB::table('products')
            ->where('isPublic', '=', 1)
            ->where('isConfirmed', '=', 1)
            ->where($category[0], $category[1], $category[2])
            ->when($subcategory, function($query, $subcategory) {
                return $query->where('subcategory', '=', $subcategory);})
            ->when($gender, function($query, $gender) {
                return $query->where('gender', 'like', '%'.$gender.'%');})
            ->orderBy('on_sale', 'desc')
            ->paginate(12);

            // get only certain collumns
                
            // ->where($matchesTag)
            // ->inRandomOrder()
                
                
                
            return ProductsResource::collection($products);
            return ProductsCollection::collection($products);
            return ProductsResource::collection($products);

    }
    
    public function related(Request $request)
    {

        $products = $request->user()->products;
        return ($products);


        // $related = DB::table('products')->where('brand_id', '=', '3');
            // ->where('isPublic', '=', 1)
            // ->where('isConfirmed', '=', 1)
            // // ->where('brand_id', '=', 3)
            // ->orderBy('updated_at');

        // what I need is for those products of a matching brand id to go first
        // then they should be followed by products of different brands but same vendor
        // finally should follow all the other products
        // this should be sorted by latest updated

    }
    
    public function store(Request $request)
    {

        // $this->middleware('auth');

        $this->validate($request, [
            // brandid required
            'title'         => 'required|string|max:255',
            'isPublic'      => 'required|boolean',
            'isConfirmed'   => 'nullable|boolean',
            'toBeDeleted'   => 'nullable|boolean',
            'mainCategory'  => 'required|string|max:50',
            'subcategory'   => 'required|string|max:50',
            'description'   => 'required|string|max:255',
            'longDescription'=>'nullable|string|max:65535',
            'is_new'        => 'required|boolean',
            'base_price'    => 'required|numeric',
            'sale_price'    => 'nullable|numeric',
            'on_sale'       => 'required|boolean',
            'operatorIsMultiply' => 'required|boolean',
            'variationsName'=> 'nullable|string',
            'typesName'     => 'nullable|string',
            'subtypesName'  => 'nullable|string',
            'variations'    => 'nullable|array',
            'types'         => 'nullable|array',
            'sizes'         => 'nullable|array',
            'taggs'         => 'nullable|array',
            'gender'        => 'nullable|array',
            'images'        => 'nullable|array',
            'related'       => 'nullable|array',
            'weight'        => 'required|numeric',
            'shipping'      => 'required|array',
            'address'       => 'nullable|string',
            'targets'       => 'nullable|array',
        ],[
            'title.required' => 'This is a custom error message for the title required error.'
        ]);

        $images = $request->images;
        $newImageArray = [];

        foreach($images as $image) {
            $newFileName = 'storage/product_images/' . $request->brand_id . '-' . $image['fileName'];
            copy('./storage/product_images/temp/' . $image['fileName'], './' . $newFileName);
            // unlink('./storage/product_images/temp/' . $image['fileName']);
            
            $newImage = new Image();
            $newImage->fileName = $newFileName;
            $newImage->title = $image['title'];
            $newImage->description = $image['description'];

            array_push($newImageArray, $newImage);
            
        //     // how about thumbnail generation?
        }
        
        $product = Product::create([
            'brand_id'      => $request->brand_id,
            'title'         => $request->title,
            'isPublic'      => $request->isPublic,
            'isConfirmed'   => $request->isConfirmed,
            'toBeDeleted'   => $request->isConfirmed,
            'mainCategory'  => $request->mainCategory,
            'subcategory'   => $request->subcategory,
            'description'   => $request->description,
            'longDescription'=>$request->longDescription,
            'is_new'        => $request->is_new,
            'base_price'    => $request->base_price,
            'sale_price'    => $request->sale_price,
            'on_sale'       => $request->on_sale,
            'operatorIsMultiply' => $request->operatorIsMultiply,
            'variationsName'=> $request->variationsName,
            'typesName'     => $request->typesName,
            'subtypesName'  => $request->subtypesName,
            'variations'    => json_encode($request->variations),
            'types'         => json_encode($request->types),
            'sizes'         => json_encode($request->sizes),
            'taggs'         => json_encode($request->taggs),
            'gender'        => json_encode($request->gender),
            'images'        => json_encode($newImageArray),
            'related'       => json_encode($request->related),
            'weight'        => $request->weight,
            'shipping'      => json_encode($request->shipping),
            'address'       => $request->address,
            'targets'       => json_encode($request->targets),
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