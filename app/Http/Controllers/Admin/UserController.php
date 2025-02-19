<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $title = "لیست کاربران";
        return view('admin.user.list',compact('title'));
    }

    public function create(){
        $title = "ایجاد کاربر";
        return view('admin.user.create',compact('title'));
    }

    public function store(CreateUserRequest $request){
        //storing the image
        $image = User::saveImage($request->image);
        //creating the row in database
        User::query()->create([
            'name' => $request -> input('name') ,
            'email'  => $request -> input('email'),
            'mobile' => $request -> input('mobile'),
            'password' => Hash::make($request -> input('password')),
            'photo' => $image
        ]);
        return redirect()->route('users.index')->with('message','کاربر جدید با موفقیت ثبت شد ');
    }

    public function show(string $id){/**/}

    public function edit(string $id){
        $title = "ویرایش کاربر";
        $user = User::query()->find($id);
        return view('admin.user.edit',compact('user','title'));
    }

    public function update(EditUserRequest $request, string $id){
        $user = User::query()->find($id);
        //first save the old image somewhere
        $old_image = $user->photo;
        //saving new image
        $image = User::saveImage($request->image);
        //updating database
        $user->update([
            'name' => ( $request->input('name') ? $request->input('name') : $user->name),
            'email' => ( $request->input('email') ? $request->input('email') : $user->email),
            'mobile' => ( $request->input('mobile') ? $request->input('mobile') : $user->mobile),
            'password' => ( $request->input('password') ? Hash::make($request->input('password')) : $user->password),
            'photo' => ( isset($request->image) ? $image : $old_image )
        ]);
        //if you didn't choose anything the previous image shouldn't be removed
        if($request->image){
            //deleting old image
            User::deleteImage($old_image);
        }
        //redirecting to the route
        return redirect()->route('users.index')->with('message','کاربر با موفقیت ویرایش شد');
    }


    public function createUserRoles($id){
        $user = User::query()->find($id);
        $roles = Role::query()->get();
        return view('admin.user.user_roles',compact('user','roles'));
    }

    public function storeUserRoles(Request $request , $id){
        $user = User::query()->find($id);
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('message','نقش های کاربر با موفقیت ویرایش شد');
    }


    public function destroy(string $id){/**/}

}
