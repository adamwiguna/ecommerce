<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function productsInCategory($id)
    {
        $ids = [];
        
        $categories = (Category::with('subCategories.subCategories')->find($id));
        $ids = (collect($categories->subCategories)->pluck('id')->all());

        foreach ($categories->subCategories as $subCategory ) {
            $ids = array_merge($ids, collect($subCategory->subCategories)->pluck('id')->all());
        }
        
        $ids[] = $id;
        $products = Product::whereHas('categories', function ($query) use ($ids){
            $query->whereIn('id', $ids);
        })->paginate();
    
        return (new ProductCollection($products))->additional(['meta' => [
            'message' => 'Success, this is all Product in Category: ',
            'category_id' => $categories->id,
            'category_name' => $categories->name,
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::whereNull('product_id')->latest()->paginate(2);

        return (new ProductCollection($products))->additional(['meta' => [
            'message' => 'This is All Product',
        ]]);

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
        // return $product;
        return new ProductResource($product);
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
