<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;use Validator;
use App\Models\SiteSetting;
class SettingsController extends Controller
{
    // Site Settings
    public function Site(){
        $title = "Site Settings";
        
        return View('admin.settings.site',compact('title'));
    }
    public function SiteSave(Request $request){
        $validator = Validator::make($request->all(), [
            'logo_header'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_footer'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            notify()->error('Image Size invalied');
            return redirect()->back();
        }
        $logoHeaderAttributes   = [];
        $logoFooterAttributes   = [];
        $iconAttributes         = [];
        $attributes             = [];
        $logo_header   			= $request->file('logo_header');
        $logo_footer   			= $request->file('logo_footer');
        $icon   			    = $request->file('icon');
        if($logo_header){
            $photo 	        = rand().$logo_header->getClientOriginalName();
            $destination 	= 'uploads/site/logo';
            $logo_header->move($destination, $photo);

            $logo 	        = $destination.'/'.$photo;
            
            $logoHeaderAttributes = [ 
                'logo_header' => $logo,
            ];
        }
        if($logo_footer){
            $photo 	        = rand().$logo_footer->getClientOriginalName();
            $destination 	= 'uploads/site/logo';
            $logo_footer->move($destination, $photo);

            $logo 	        = $destination.'/'.$photo;
            
            $logoFooterAttributes = [ 
                'logo_footer' => $logo,
            ];
        }
        if($icon){
            $photo 	        = rand().$request->file('icon')->getClientOriginalName();
            $destination 	= 'uploads/site/icon';
            $request->file('icon')->move($destination, $photo);

            $icon 	        = $destination.'/'.$photo;
            $iconAttributes = [ 
                'icon'      => $icon,
            ];
        }

        $attributes = [
            'site_title'    => strip_tags(preg_replace('/[^A-Za-z0-9\-" "]/', '', $request->site_title)),
            'video'         => $request->video,
            'phone'         => strip_tags(preg_replace('/[^A-Za-z0-9\-" "]/', '', $request->phone)),
            'email'         => $request->email,
            'address'       => $request->address,
            'no_employee'   => $request->no_employee,
            'no_companies'  => $request->no_companies,
            'no_customers'  => $request->no_customers,
        ];

        $data = array_merge($logoHeaderAttributes,$logoFooterAttributes,$iconAttributes, $attributes);
        
        try {
            if(SiteSetting()){
                
                $submit         =  SiteSetting::find(SiteSetting()->id);
                if($logo_header){
                    $image_path = public_path($submit->logo_header);

                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                if($logo_footer){
                    $image_path = public_path($submit->logo_footer);

                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                if($icon){
                    $icon_path 	= public_path($submit->icon);

                    if(File::exists($icon_path)) {
                        File::delete($icon_path);
                    }
                }
                $update = $submit->update($data);
                notify()->success('Site Settings Successfully Updated !');
            }else{
                $submit      =  SiteSetting::create($data);
                notify()->success('Site Settings Successfully created !');
            }
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            notify()->error('problem To Submit Data');
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
        return $attributes;
    }
}   
