<?php

namespace App\Http\Controllers\BackOffice\SuperAdmin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull('category_id')->with('subCategories.subCategories')->get();
        // dd($categories);

        return view('back-office.super-admin.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('back-office.super-admin.category.create', [
            'categories' => $categories,
        ]);
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
            'name' => 'required|min:3|max:30',
            // 'image' => 'mimes:jpeg,bmp,png,jpg|max:2048',
        ]);

        $category = Category::create([
            'category_id' => $request->category_id??null,
            'name' => $request->name,
        ]);

        if ($request->has('image')) {
            $ext = strtolower($request->image->getClientOriginalExtension());
            $image_name = $category->id.'_'.str_replace(' ', '_', $category->name).'_'.time();
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/images/category/';
            $image_url = '/'.$upload_path.$image_full_name;
            $request->image->move($upload_path, $image_full_name);
    
            $category->image()->create([
                'url' => $image_url,
            ]);
        }




        return redirect()->route('back-office.super-admin.category.index')->with('message-success', 'Success Adding New Category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::select('id', 'name')->get();
        return view('back-office.super-admin.category.edit', [
            'edit_category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:3|max:50'
        ]);

        $category->update([
            'name' => $request->name,
            'category_id' => $request->category_id??null,
        ]);

        if ($request->has('image')) {
            $ext = strtolower($request->image->getClientOriginalExtension());
            $image_name = $category->id.'_'.str_replace(' ', '_', $category->name).'_'.time();
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/images/';
            $image_url = '/'.$upload_path.$image_full_name;
            $request->image->move($upload_path, $image_full_name);

            
            File::delete(public_path( $category->image->url));
            $category->image()->delete();
    
            $category->image()->create([
                'url' => $image_url,
            ]);
        }

        return redirect()->route('back-office.super-admin.category.index')->with('message-success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        File::delete(public_path( $category->image->url));
        $category->delete();
        $category->image()->delete();
        return redirect()->back()->with('message-success', 'Success delete');
    }
}
