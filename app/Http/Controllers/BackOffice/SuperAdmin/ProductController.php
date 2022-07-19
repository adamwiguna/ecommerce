<?php

namespace App\Http\Controllers\BackOffice\SuperAdmin;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office.super-admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-office.super-admin.product.create');
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
            'name' => 'required|min:3|max:100',
            'category' => 'required',
            'minimum_order' => 'required',
            'size.*' => 'required',
            'price.*' => 'required',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'minimum_order' => $request->minimum_order,
        ]);

        if (count($request->size) == 1) {
            $product->update([
                'size' => $request->size[0],
                'price' => $request->price[0],
            ]);
        } else
        if (count($request->size) > 1) {
            foreach ($request->size as $index => $value) {
                $product->sizes()->create([
                    'name' => $product->name.' Size: '.$request->size[$index],
                    'size' => $request->size[$index],
                    'price' => $request->price[$index],
                ]);
            }
        }

        $product->categories()->attach($request->category);

        return redirect()->route('back-office.super-admin.product.manage-image', ['product' => $product])->with('success-message', 'Success Add New Product');
    }

    public function manageImage(Product $product)
    {
        return view('back-office.super-admin.product.manage-image', [
            'product' => $product,
        ]);
    }

    public function storeImage(Product $product, Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,bmp,png,jpg|max:2048',
        ]);

        if ($request->has('image')) {
            $ext = strtolower($request->image->getClientOriginalExtension());
            $image_name = $product->id.'_'.str_replace(' ', '_', $product->name).'_'.time();
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/images/product/';
            $image_url = '/'.$upload_path.$image_full_name;
            $request->image->move($upload_path, $image_full_name);
    
            $product->images()->create([
                'url' => $image_url,
            ]);
        }


        return redirect()->back()->with('success-message', 'Success Store Image');

    }

    public function deleteImage(Image $image)
    {
        File::delete(public_path( $image->url));
        $image->delete();
        return redirect()->back()->with('success-message', 'Success Delete Image');
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('back-office.super-admin.product.edit', [
            'product' => $product,
        ]);
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
        // dd($request->category);
        $request->validate([
            'name' => 'required|min:3|max:100',
            'minimum_order' => 'required',
            'category' => 'required',
            'size.*' => 'required',
            'price.*' => 'required',
        ]);


        if (count($request->size) == 1) {
            $product->sizes()->delete();
            $product->update([
                'name' => $request->name,
                'minimum_order' => $request->minimum_order,
                'size' => $request->size[0],
                'price' => $request->price[0],
            ]);
        } else
        if (count($request->size) > 1) {
            $product->sizes()->delete();
            $product->update([
                'name' => $request->name,
                'minimum_order' => $request->minimum_order,
                'size' => null,
                'price' => null,
            ]);

            foreach ($request->size as $index => $value) {
                $product->sizes()->create([
                    'name' => $product->name.' Size: '.$request->size[$index],
                    'size' => $request->size[$index],
                    'price' => $request->price[$index],
                ]);
            }
        }
        
        $product->categories()->detach();
        $product->categories()->attach($request->category);

        return redirect()->route('back-office.super-admin.product.index')->with('success-message', 'Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success-message', 'Success deleting Data');
    }
}
