<?php

namespace App\Models;

use App\Http\Resources\BrandResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory;
    private static $default_path = 'admin/brands/';

    protected $fillable =[
        'title',
        'image'
    ];


    public static function saveImage($file){
        if($file){
            $name = time().'.'. $file->getClientOriginalExtension();
            Storage::disk('local')->put('admin/brands/'.$name,file_get_contents($file));
            return $name;
        }
        else{
            return '';
        }

    }


    public static function deleteImage($img){
        if($img){
            Storage::disk('local')->delete(self::$default_path.$img);
            return 'removed from storage successfull';
        }
        else{
            return 'nothing exists to be removed';
        }

    }


    public static function getBrands()
    {
        $brands = self::query()->get();
        return BrandResource::collection($brands);
    }

}
