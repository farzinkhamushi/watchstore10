<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    private static $default_path = 'admin/products/';

    protected $fillable=[
        'title',
        'title_en',
        'slug',
        'price',
        'review',
        'count',
        'image',
        'guaranty',
        'discount',
        'description',
        'is_special',
        'special_expiration',
        'status',
        'category_id',
        'brand_id',
        //'color_id',
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class,'color_product');
    }

    public function properties(){
        return $this->belongsToMany(Property::class,'product_property');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



    public static function saveImage($file){
        if($file){
            $name = time().'.'. $file->getClientOriginalExtension();
            Storage::disk('local')->put( self::$default_path . $name,file_get_contents($file));
            return $name;
        }
        else{
            return '';
        }
    }


    public static function deleteImage($imagename){
        if($imagename){
            Storage::disk('local')->delete( self::$default_path .$imagename);
            return 'removed from storage successfull';
        }
        else{
            return 'nothing exists to be removed';
        }
    }

}
