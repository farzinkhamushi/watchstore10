<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    
    public static function saveImage($file){
        if($file){
            $name = time().'.'. $file->getClientOriginalExtension();
            Storage::disk('local')->put('admin/products/'.$name,file_get_contents($file));
            return $name;
        }
        else{
            return '';
        }
    }

    public static function deleteImage($img){
        if($img){
            Storage::disk('local')->delete('admin/products/'.$img);
            return $img;
        }
        else{
            return '';
        }
    }

}