<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "لیست رنگ ها";
        return view('admin.color.list',compact('title',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ایجاد رنگ";
        $colors = Color::query()->pluck('title','id');
        return view('admin.color.create',compact('title','colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        Color::query()->create([
            'title'=>$request->input('title'),
            'code'=>$request->input('code')
        ]);
        return redirect()->route('colors.index')->with('message','رنگ با موفقیت ایجاد شد');
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
        $title = "ویرایش رنگ";
        $color = Color::query()->find($id);
        $colors = Color::query()->pluck('title','id');
        return view('admin.color.edit',compact('color','colors','title',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $color = Color::query()->find($id);
        $color->update([
            'title' => ($request->input('title') ? $request->input('title') : $color->title),
            'code' => ($request->input('code') ? $request->input('code') : $color->code),
            //'code' => (isset($request->file) ? Color::saveImage($request->file) : $color->code),
        ]);
        return redirect()->route('colors.index')->with('message','رنگ با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
