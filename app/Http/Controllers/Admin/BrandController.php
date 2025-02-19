<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\EditBrandRequest;
use App\Models\Brand;


class BrandController extends Controller
{

    public function index(){
        $title = "لیست برند ها";
        return view('admin.brand.list',compact('title'));
    }

    public function create()
    {
        $title = "ایجاد برند";
        $brands = Brand::query()->pluck('title','id');
        return view('admin.brand.create',compact('title','brands'));
    }

    public function store(CreateBrandRequest $request){
        $image = Brand::saveImage($request->image);
        Brand::query()->create([
            'title'=>$request->input('title'),
            'image'=> $image
        ]);
        return redirect()->route('brands.index')->with('message','برند با موفقیت ایجاد شد');
    }

    public function edit(string $id){
        $title = "ویرایش برند";
        $brand = Brand::query()->find($id);
        $brands = Brand::query()->pluck('title','id');
        return view('admin.brand.edit',compact('brand','brands','title'));
    }

    public function update(EditBrandRequest $request, string $id)
    {
        $brand = Brand::query()->find($id);
        $old_image = $brand->image;
        $brand->update([
            'title' => ($request->input('title') ? $request->input('title') : $brand->title),
            'image' => (isset($request->image) ? Brand::saveImage($request->image) : $old_image),
        ]);
        if($request->image){
            Brand::deleteImage($old_image);
        }
        return redirect()->route('brands.index')->with('message','برند با موفقیت ویرایش شد');
    }

    public function destroy(string $id){
        //
    }

    public function show(string $id){
        //
    }

}
