<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory, Notifiable;
    use HasRoles;

    private static $default_path = 'admin/users/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'photo',
        'phone',
        'status',
        'is_admin',
        'user_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public static function saveImage($file){
        if($file){
            $name = time().'.'. $file->getClientOriginalExtension();
            //$img = $file->getRealPath();
            Storage::disk('local')->put('admin/users/'.$name,file_get_contents($file));

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


            //Storage::disk('local')->put('admin/users/small/'.$name,(string) $smallImage->encode(new PngEncoder(90)));
            //Storage::disk('local')->put('admin/users/big/'.$name, (string) $bigImage->encode(new PngEncoder(90)));

            return $name;
        }
        else{
            return '';
        }
    }



    public static function deleteImage($image_name){
        if($image_name){
            Storage::disk('local')->delete( self::$default_path .$image_name);
            return 'removed from storage successfull';
        }else{
            return 'nothing exists to be removed';
        }
    }




    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
