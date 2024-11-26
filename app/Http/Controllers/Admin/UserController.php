<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;
use Auth;use Carbon\Carbon;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $title      = "User";
        $getDatas   = User::where('role','!=','Super Admin')->latest()->get();
        
        return View('admin.user.index',compact('getDatas','title'));
    }
    public function getForm(Request $request){

        $data      = User::find($request->id);
        $title     = $data ? $data->name : 'User create';
        return view('admin.user.form',[
            'title' => $title,
            'data'  => $data
        ]);
    }
    public function getPassForm(Request $request){

        $data      = User::find($request->id);
        $title     = $data ? $data->name : 'User create';
        return view('admin.user.changePassword',[
            'title' => $title,
            'data'  => $data
        ]);;
    }
    
    public function save(Request $request){
        ini_set('memory_limit','-1');
        // return $request;
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        if ($validator->fails()) {
            notify()->error('Image Size invalied');
            return redirect()->back();
        }

        $image   			= $request->file('image');
        $attributes         = [];
        $imageAttributes    = [];
        $passAttributes     = [];
        if($image){
            $photo 	        = rand().$image->getClientOriginalName();
            $destination 	= 'uploads/user';
            $image->move(public_path($destination), $photo);

            $image 	        = $destination.'/'.$photo;
            $imageAttributes     = [ 
                'image'    => $image,
            ];
        }
        if(!$request->id && $request->password){
            $passAttributes = [
                'password'  =>  bcrypt($request->password)
            ];
        }
        $attributes = [
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'phone'     =>  $request->phone,
            'role'      =>  $request->role
        ];
        $data = array_merge($attributes, $imageAttributes,$passAttributes);

        try {
            if($request->id){
                $submit      =  User::find($request->id);

                if($image){
                    $image_path = public_path($submit->image);
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $update = $submit->update($data);
                notify()->success('Data Successfully Updated !');
            }else{
                $submit      =  User::create($data);
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
    public function passSave(Request $request){
        ini_set('memory_limit','-1');
        
        $passAttributes     = [];
        $passAttributes = [
                'password'  =>  bcrypt($request->password)
            ];
        $data = array_merge($passAttributes);

        try {
            if($request->id){
                $submit =  User::find($request->id);
                $update = $submit->update($data);
                notify()->success('Data Successfully Updated !');
            }else{
                notify()->error('User Invalid');
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
        $data   =  User::find($request->id);
        if($data && $data->image){
            $image_path = public_path($data->image);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $del     = $data->delete();
        notify()->success('Data Successfully Deleted  !');
        return redirect()->back();
    }
    // Profile
    public function Profile(){
        $id             = Auth::user()->id;
        $employee       = Auth::user();
        $title          = "";
        $getDepartment  = [];
        $getOffice      = [];
        $getDesignation = [];
        
        $employeeSalary = [];
        $getLeave       = [];
        $getKpi         = [];
        $getNotification    = [];
        return View('admin.profile.view',compact('title','employee','getDepartment','getOffice','getDesignation','employeeSalary','getLeave','getKpi','getNotification'));
    }
    public function ProfileEdit(){
        $id             = Auth::user()->id;
        $employee       = Auth::user();
        $title          = "";
        $getDepartment  = [];
        $getOffice      = [];
        $getDesignation = [];
    
        return View('admin.profile.edit',compact('title','employee','getDepartment','getOffice','getDesignation'));
    }
    public function ProfileUpdate(Request $request){
        $imageAttributes    = [];
        $attributes         = [];
        $image   			= $request->file('image');
        if($image){
            $photo 	        = rand().$request->file('image')->getClientOriginalName();
            $destination 	= 'uploads/user/'.Auth::user()->id;
            $request->file('image')->move($destination, $photo);

            $image 	        = $destination.'/'.$photo;
            
            $imageAttributes = [ 
                'image'      => $image,
            ];
        }
        $attributes = [
            'name'      => strip_tags(preg_replace('/[^A-Za-z0-9\-" "]/', '', $request->name)),
            'email'     => $request->email,
            'phone'     => $request->phone,
        ];

        $data = array_merge($imageAttributes,$attributes);
        
        try {
            if(Auth::user()){
                
                $submit         =  User::find(Auth::user()->id);
                if($image){
                    $image_path = public_path($submit->image);

                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $update = $submit->update($data);
                notify()->success('profile Successfully Updated !');
            }else{
                // $submit      =  SiteSetting::create($data);
                // notify()->success('Site Settings Successfully created !');
            }
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            notify()->error('problem To Submit Data');
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
        return $attributes;
    }
    public function Notification(){
        $id                 = Auth::user()->id;
        $getNotification    = Notification::where('notifiable_id',$id)->get();
    
        return View('admin.profile.notification',compact('getNotification'));
    }
    public function logout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
