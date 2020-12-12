<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductsResource;

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

        // The issue is that I don't have access to variables inside of that that function
        
        $subcategory = $request->subcategory;
        $gender = $request->gender;
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
                return $query->where('gender', '=', $gender);})
            ->orderBy('on_sale', 'desc')
            ->paginate(12);
                
            // ->where($matchesTag)
            // ->inRandomOrder()
                
                
                
        return new ProductsResource($products);

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
            'types'         => 'nullable|array',
            'sizes'         => 'nullable|array',
            'taggs'         => 'nullable|array',
            'gender'        => 'nullable|string|max:255',
            'images'        => 'nullable|array',
            'related'       => 'nullable|array',
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
            
            // I guess I'll have to create a new array in which the information of the old one has been processed.
            // how about thumbnail generation?
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
            'longDescription'=>$request->description,
            'is_new'        => $request->is_new,
            'base_price'    => $request->base_price,
            'sale_price'    => $request->sale_price,
            'on_sale'       => $request->on_sale,
            'operatorIsMultiply' => $request->operatorIsMultiply,
            'types'         => json_encode($request->types),
            'sizes'         => json_encode($request->sizes),
            'taggs'         => json_encode($request->taggs),
            'gender'        => $request->gender,
            'images'        => json_encode($newImageArray),
            'related'       => json_encode($request->related),
        ]);

        return response(scandir('./storage'), 201);
        return response(getcwd(), 201);
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