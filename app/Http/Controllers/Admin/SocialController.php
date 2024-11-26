<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use File;use Validator;
class SocialController extends Controller
{
    public function index(){
        $title          = "Social";
        $getDatas       =  Social::get();

        return view('admin.social.index',[
            'title'     => $title,
            'getDatas'  => $getDatas
        ]);
    }
    public function getForm(Request $request){

        $data      = Social::find($request->id);
        $title     = $data ? $data->title : 'Social create';
        return view('admin.social.form',[
            'title'  => $title,
            'data'  => $data
        ]);;
    }
    public function save(Request $request){
        ini_set('memory_limit','-1');
        $validator = Validator::make($request->all(), [
            'icon'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            notify()->error('Image Size invalied');
            return redirect()->back();
        }
        $icon   			= $request->file('icon');
        $attributes         = [];
        $imageAttributes    = [];

        if($icon){
            $photo 	        = rand().$icon->getClientOriginalName();
            $destination 	= 'uploads/Social';
            $icon->move(public_path($destination), $photo);

            $icon 	        = $destination.'/'.$photo;
            $imageAttributes     = [ 
                'icon'    => $icon,
            ];
        }
        $attributes         = [
            'title'         => strip_tags($request->title),
            'link'          => strip_tags($request->link),
            'placement'     => strip_tags($request->placement)
        ];
        $data = array_merge($attributes, $imageAttributes);

        try {
            if($request->id){
                $submit         =  Social::find($request->id);

                if($icon){
                    $image_path = public_path($submit->icon);
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $update = $submit->update($data);
                notify()->success('Data Successfully Updated !');
            }else{
                $submit      =  Social::create($data);
                notify()->success('Data Successfully Created  !');
            }
            return redirect()->back();
        }catch (\Illuminate\Database\QueryException $ex) {
            notify()->error('problem To Submit Data');
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
        return $data;
    }
    public function delete(Request $request){
        $data           =  Social::find($request->id);
        if($data && $data->icon){
            $image_path = public_path($data->icon);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $del            = $data->delete();
        notify()->success('Data Successfully Deleted  !');
        return redirect()->back();
    }
}
