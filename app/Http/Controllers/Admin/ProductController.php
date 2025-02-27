<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\PropertyGroup;
use Hekmatinasser\Verta\Facades\Verta;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "لیست محصولات";
        return view('admin.product.list',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ایجاد محصول جدید";
        $categories = Category::query()->pluck('title','id');
        $brands = Brand::query()->pluck('title','id');
        $colors = Color::query()->pluck('title','id');
        return view('admin.product.create',compact('title','categories','brands','colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $image = Product::saveImage($request->image);
        $product = Product::query()->create([
            'title'=>$request->input('title'),
            'title_en'=>$request->input('title_en'),
            'slug'=>Helper::make_slug($request->input('title')),
            'price'=>$request->input('price'),
            'count'=>$request->input('count'),
            'image'=>$image,
            'guaranty'=>$request->input('guaranty'),
            'discount'=> ( $request->input('discount') === 0 ) ,
            'description'=>$request->input('description'),
            'is_special'=>$request->input('is_special') === 'on',
            'special_expiration'=>( $request->input('special_expiration') !==null ? Verta::parse($request->input('special_expiration'))->datetime() : now()),
            //'status'=>$request->input('status'),
            'category_id'=>$request->input('category_id'),
            'brand_id'=>$request->input('brand_id'),
            //'color_id'=>'1'
        ]);
        $colors = $request->input('colors');
        $product->colors()->attach($colors);

        return redirect()->route('products.index')->with('message','محصول با موفقیت ایجاد شد');
    }

    public function edit(string $id)
    {
        $title = "ویرایش محصول";
        $product = Product::query()->find($id);
        $categories = Category::query()->pluck('title','id');
        $brands = Brand::query()->pluck('title','id');
        $colors = Color::query()->pluck('title','id');
        return view('admin.product.edit',compact('product','categories','brands','colors','title'));
    }

    public function update(ProductRequest $request, string $id)
    {
        $product = Product::query()->find($id);
        $old_image = $product->image;
        $image = Product::saveImage($request->image);
        $product->update([
            'title' => ($request->input('title') ? $request->input('title') : $product->title),
            'image' => (isset($request->image) ? $image : $old_image),
        ]);

        if($request->image){
            Product::deleteImage($old_image);
        }

        $colors = $request->input('colors');
        $product->colors()->sync($colors);

        return redirect()->route('products.index')->with('message','محصول با موفقیت ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

    public function addProperties($id){
        $product = Product::query()->find($id);
        $property_groups = PropertyGroup::query()->get();
        return view('admin.product.create_property',compact('property_groups','product'));
    }

    public function storeProperties(Request $request,$id){

        $product = Product::query()->find($id);
        $product->properties()->sync($request->properties);

        return redirect()->route('products.index')->with('message','ویژگی ها با موفقیت اضافه شدند');
    }

}
