<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppLanguage;
use Illuminate\Http\Request;

class AppLanguageController extends Controller
{
    private $mother_rout = 'app-languages' ;
    private $mother_view = 'admin.app-language' ;

    private $index_rout = '.index';
    private $index_view = '.list';
    //private $create_rout = '.create';
    private $create_view = '.create';
    //private $update_rout = '.update';
    private $update_view = '.edit';

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $title = "زبان ها";
        $v = $this->mother_view . $this->index_view ;
        return view($v,compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "ایجاد زبان";
        $app_languages = AppLanguage::query()->pluck('language','id');
        $v =  $this->mother_view . $this->create_view;
        return view($v,compact('title','app_languages'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flag = AppLanguage::saveImage($request->flag);
        AppLanguage::query()->create([
            'language'=>$request->input('language'),
            'flag'=> $flag
        ]);
        $r = $this->mother_rout . $this->index_rout;
        return redirect()->route($r)->with('message','برند با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "ویرایش زبان";
        $app_language = AppLanguage::query()->find($id);
        $app_languages = AppLanguage::query()->pluck('language','id');
        $v = $this->mother_view . $this->update_view ;
        return view($v,compact('app_language','app_languages','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $app_language = AppLanguage::query()->find($id);
        //dd($request->input('language'));
        $old_image = $app_language->flag;
        $app_language->update([
            'language' => ($request->input('language') ? $request->input('language') : $app_language->language),
            'flag' => (isset($request->flag) ? AppLanguage::saveImage($request->flag) : $old_image),
        ]);
        $r = $this->mother_rout . $this->index_rout ;
        return redirect()->route($r)->with('message','برند با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
