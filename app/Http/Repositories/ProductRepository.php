<?php

namespace App\Http\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository
{
    public static function get6AmazingProducts()
    {
        $products = Product::query()->where('is_special',true)
        ->orderBy('discount','DESC')->take(6)->get();
        return ProductResource::collection($products);
    }

    public static function get6MostSellerProducts()
    {
        $products = Product::query()
            ->orderBy('sold','DESC')->take(6)->get();
        return ProductResource::collection($products);
    }

    public static function getMostSellerProducts()
    {
        $products = Product::query()
            ->orderBy('sold','DESC')->paginate(12); //take(6)->get();   or  paginate(6);
        return ProductResource::collection($products);
    }

    public static function getMostViewedProducts()
    {
        $products = Product::query()
            ->orderBy('review','DESC')->paginate(12); //take(6)->get();   or  paginate(6);
        return ProductResource::collection($products);
    }

    public static function get6NewestProducts()
    {
        $products = Product::query()
            ->orderBy('created_at','DESC')->take(6)->get();
        return ProductResource::collection($products);
    }

    public static function getNewestProducts()
    {
        $products = Product::query()
            ->orderBy('created_at','DESC')->paginate(12);
        return ProductResource::collection($products);
    }


    public static function get6CheapestProducts()
    {
        $products = Product::query()
            ->orderBy('price','ASC')->take(6)->get();
        return ProductResource::collection($products);
    }


    public static function getCheapestProducts()
    {
        $products = Product::query()
            ->orderBy('price','ASC')->paginate(12);
        return ProductResource::collection($products);
    }

    public static function get6MostExpensiveProducts()
    {
        $products = Product::query()
            ->orderBy('price','DESC')->take(6)->get();
        return ProductResource::collection($products);
    }


    public static function getMostExpensiveProducts()
    {
        $products = Product::query()
            ->orderBy('price','DESC')->paginate(12);
        return ProductResource::collection($products);
    }

    public static function getProductsByCategory($id)
    {
        $products = Product::query()->where('category_id',$id)->paginate(12);// ->take(6)->get()
        return ProductResource::collection($products);
    }

    public static function getProductsByBrand($id)
    {
        $products = Product::query()->where('brand_id',$id)->paginate(12);
        return ProductResource::collection($products);
    }


    public static function getSearchedProduct($searched)
    {
        $products = Product::query()->
        where('title','like','%'.$searched.'%')->
        orWhere('title_en','like','%'.$searched.'%')->
        orWhere('description','like','%'.$searched.'%')
            ->paginate(12);
        return ProductResource::collection($products);
    }


}
