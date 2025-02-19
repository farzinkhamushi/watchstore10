<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "لیست اسلایدر ها";
        return view('admin.slider.list',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ایجاد اسلایدر";
        return view('admin.slider.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $image = Slider::saveImage($request->image);
        Slider::query()->create([
            'title'=>$request->input('title'),
            'url'=>$request->input('url'),
            'image'=> $image
        ]);
        return redirect()->route('sliders.index')->with('message','اسلایدر با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "ویرایش اسلایدر";
        $slider = Slider::query()->find($id);
        $sliders = Slider::query()->pluck('title','id');
        return view('admin.slider.edit',compact('slider','sliders','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::query()->find($id);
        $old_image = $slider->photo;
        //saving new image
        $image = Slider::saveImage($request->image);
        //updating database
        $slider->update([
            'title' => ($request->input('title') ? $request->input('title') : $slider->title),
            'image' => (isset($request->image) ? $image : $old_image),
        ]);
        //if you didn't choose anything the previous image shouldn't be removed
        if($request->image){
            //deleting old image
            Slider::deleteImage($old_image);
        }
        //redirecting to the route
        return redirect()->route('sliders.index')->with('message','اسلایدر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
