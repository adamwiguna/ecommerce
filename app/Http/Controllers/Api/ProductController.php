<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function productsInCategory($id)
    {
        // return $id;
         // Find Products
        $ids = [];
        
        $categories = (Category::with('subCategories.subCategories')->find($id));
        $ids = (collect($categories->subCategories)->pluck('id')->all());

        foreach ($categories->subCategories as $subCategory ) {
            // dd($subCategory);
            $ids = array_merge($ids, collect($subCategory->subCategories)->pluck('id')->all());
        }
        
        $ids[] = $id;
        $products = Product::whereHas('categories', function ($query) use ($ids){
            $query->whereIn('id', $ids);
        })->paginate();
        
        return ProductResource::collection($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
