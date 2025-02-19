<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id','id')->
            withDefault(['title' => '-------']);
    }

    public function child()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }

    public static function saveImage($file){
        if($file){
            $name = time().'.'. $file->getClientOriginalExtension();

            //$img = $file->getRealPath();
            Storage::disk('local')->put('admin/categories/'.$name,file_get_contents($file));

            /*
            $smallImage = Image::make($file->getRealPath());
            $bigImage = Image::make($file->getRealPath());
            $smallImage->resize( 256, 256, function ($constraint){
                $constraint->aspectRatio();
            });



            // create an image manager instance with favored driver
            $manager = new ImageManager(new Driver());
            // and you are ready to go ...
            $bigImage = $manager->read($file->getRealPath());
            $smallImage = $manager->read($file->getRealPath())->resize(256, 256);
            */


            //Storage::disk('local')->put('admin/categories/small/'.$name,(string) $smallImage->encode(new PngEncoder(90)));
            //Storage::disk('local')->put('admin/categories/big/'.$name, (string) $bigImage->encode(new PngEncoder(90)));

            return $name;
        }
        else{
            return '';
        }
    }

    public static function deleteImage($img){
        if($img){
            Storage::disk('local')->delete('admin/categories/'.$img);
            return $img;
        }
        else{
            return '';
        }
    }

    public static function getCategories()
    {
        $categories = self::query()->get();
        return CategoryResource::collection($categories);
    }
}
