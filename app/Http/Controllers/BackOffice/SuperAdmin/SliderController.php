<?php

namespace App\Http\Controllers\BackOffice\SuperAdmin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();

        return view('back-office.super-admin.slider.index', [
            'sliders' => $sliders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-office.super-admin.slider.create');
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
            'title' => 'required|min:3|max:30',
            'description' => 'required|min:3|max:30',
            'button_text' => 'nullable|min:3|max:30',
            'button_url' => 'nullable|min:3|max:200',
            'image' => 'required|mimes:jpeg,bmp,png,jpg|max:2048',
        ]);

        $slider = Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
        ]);

        if ($request->has('image')) {
            $ext = strtolower($request->image->getClientOriginalExtension());
            $image_name = 'slider_'.$slider->id.'_'.str_replace(' ', '_', $slider->title).'_'.time();
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/images/slider/';
            $image_url = '/'.$upload_path.$image_full_name;
            $request->image->move($upload_path, $image_full_name);
    
            $slider->image()->create([
                'url' => $image_url,
            ]);
        }

        return redirect()->route('back-office.super-admin.slider.index')->with('success-message', 'Success Adding New Slide');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('back-office.super-admin.slider.edit', [
            'edit_slider' => $slider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|min:3|max:30',
            'description' => 'required|min:3|max:30',
            'button_text' => 'nullable|min:3|max:30',
            'button_url' => 'nullable|min:3|max:200',
            'image' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',
        ]);

        $slider->update([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
        ]);

        if ($request->has('image')) {
            $ext = strtolower($request->image->getClientOriginalExtension());
            $image_name = $slider->id.'_'.str_replace(' ', '_', $slider->title).'_'.time();
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/images/slider/';
            $image_url = '/'.$upload_path.$image_full_name;
            $request->image->move($upload_path, $image_full_name);

            
            File::delete(public_path( $slider->image->url));
            $slider->image()->delete();
    
            $slider->image()->create([
                'url' => $image_url,
            ]);
        }

        return redirect()->route('back-office.super-admin.slider.index')->with('success-message', 'Slide Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        File::delete(public_path( $slider->image->url));
        $slider->delete();
        $slider->image()->delete();
        return redirect()->back()->with('success-message', 'Success delete');
    }
}
