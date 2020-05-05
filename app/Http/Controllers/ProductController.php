<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $product= Product::paginate(10);
    return ProductResource::collection($product);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name' => 'required',
            'description'=>'required',
            'regular_price'=>'required'
            
        ]);
        return ProductResource::collection(Product::create($request->all())) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  Product::findOrFail($id);
        // return ProductResource::collection($id);
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
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return Product::destroy($id);
    }

    /**
     * Search For a Name
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
       return ProductResource::collection(Product::where('name', 'like', '%'.$name.'%')->get()) 
        // return ProductResource::collection($product);
;
    //    return ProductResource::collection($produc);
    }

    public function searchByPriceRange($min_price, $max_price)
    {
       return ProductResource::collection(Product::whereBetween('price', [$min_price, $max_price])->get());

    }
}