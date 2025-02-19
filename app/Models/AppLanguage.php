<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AppLanguage extends Model
{
    use HasFactory;
    private static $default_path = 'admin/app-languages/';

    protected $fillable=[
        'language',
        'flag',
    ];

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

}
