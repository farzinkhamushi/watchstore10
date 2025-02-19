<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function index()
    {
        $title = "لیست دسته بندی ها";
        //$categories = Category::all(); // یا می‌توانید از روش‌های دیگر مثل paginate استفاده کنید
        $categories = Category::paginate(10); // برای نمایش 10 دسته‌بندی در هر صفحه
        return view('admin.category.list', compact('title', 'categories'));
    }

    public function create()
    {
        $title = "ایجاد دسته بندی";
        $categories = Category::query()->pluck('title','id');
        return view('admin.category.create',compact('title','categories'));
    }

    public function store(Request $request)
    {
        $image = Category::saveImage($request->image);
        Category::query()->create([
            'title'=>$request->input('title'),
            'parent_id'=>$request->input('parent_id'),
            'image'=> $image
        ]);
        return redirect()->route('category.index')->with('message','دسته بندی با موفقیت ایجاد شد');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $title = "ویرایش دسته بندی";
        $category = Category::query()->find($id);
        $categories = Category::query()->pluck('title','id');
        return view('admin.category.edit',compact('category','categories','title'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::query()->find($id);
        //first save the old image somewhere
        $old_image = $category->image;
        //saving new image
        $image = Category::saveImage($request->image);
        //updating database
        $category->update([
            'title' => ($request->input('title') ? $request->input('title') : $category->title),
            'image' => (isset($request->image) ? $image : $category->image),
            'parent_id' => ($request->input('parent_id') ? $request->input('parent_id') : $category->parent_id),
        ]);
        //if you didn't choose anything the previous image shouldn't be removed
        if ($request->image) {
            Category::deleteImage($old_image);
        }
        //redirecting to the route
        return redirect()->route('category.index')->with('message',' دسته بندی با موفقیت ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }
}
