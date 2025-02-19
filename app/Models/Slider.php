<?php

namespace App\Models;

use App\Http\Resources\SliderResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'url',
        'image'
    ];


    public static function saveImage($file){
        if($file){
            $name = time().'.'. $file->getClientOriginalExtension();

            //$img = $file->getRealPath();
            Storage::disk('local')->put('admin/sliders/'.$name,file_get_contents($file));

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
            Storage::disk('local')->delete('admin/sliders/'.$img);
            return 'removed from storage successfull';
        }
        else{
            return 'nothing exists to be removed';
        }
    }


    public static function getSliders()
    {
        $sliders = self::query()->get();
        return SliderResource::collection($sliders);
    }
}
