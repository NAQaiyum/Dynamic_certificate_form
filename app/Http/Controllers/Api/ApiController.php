<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\sliderResource;
use App\Http\Resources\companyResource;
use App\Http\Resources\teamResource;
use App\Http\Resources\teamMessageResource;
use App\Http\Resources\newsResource;
use App\Http\Resources\aboutResource;
use App\Http\Resources\whyIfadResource;
use App\Http\Resources\jobResource;
use App\Http\Resources\settingsResource;
use App\Http\Resources\socialResource;
use Session;
use App\Models\Slider;use App\Models\AboutUs;use App\Models\Company;use App\Models\NewsEvent;
use App\Models\Team;use App\Models\TeamMessage;use App\Models\Message;use App\Models\WhyIfad;
use App\Models\IfadJob;use App\Models\ApplyJob;use App\Models\SiteSetting;use App\Models\Social;
class ApiController extends Controller
{
    public function home(){
        $slidersMain       = Slider::where('slider_type',1)->orderBy('placement', 'ASC')->get();
        $slidersSecon      = Slider::where('slider_type',2)->orderBy('placement', 'ASC')->get();
        $companies         = Company::where('show_home',1)->orderBy('placement', 'ASC')->get();
        $companyLogos      = Company::select('logo','logo_placement')
            ->where('show_home',1)
            ->where('show_logo',1)
            ->orderBy('logo_placement', 'ASC')
            ->get();
        $teamMessages      = TeamMessage::where('show_home',1)->orderBy('placement', 'ASC')->get();
        $getNews           = NewsEvent::where('tag',1)->orderBy('placement', 'ASC')->get();
        $getSocial         = NewsEvent::where('tag',2)->orderBy('placement', 'ASC')->get();

        try {
            
            return response([
                'message'       => 'successfully data recieve',
                'slidersMain'   => sliderResource::collection($slidersMain),
                'slidersSecon'  => sliderResource::collection($slidersSecon),
                'companies'     => companyResource::collection($companies),
                'companyLogos'  => companyResource::collection($companyLogos),
                'teamMessages'  => teamMessageResource::collection($teamMessages),
                'getNews'       => newsResource::collection($getNews),
                'getSocial'     => newsResource::collection($getSocial),
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'   => 'something went wrong',
                 'data'      => $ex
            ],404);
        }
    }
    public function about(){
        $aboutus = AboutUs::latest()->first();
        try {
            
            return response([
                'message'   => 'successfully data recieve',
                'aboutus'   => new aboutResource($aboutus)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'  => 'something went wrong',
                 'aboutus'  => ''
            ],404);
        }
    }
    public function management(Request $request){
        if($request->id){
            $team = Team::find($request->id);
        }else{
            $team = Team::get();
        }
        
        try {
            
            return response([
                'message'    => 'successfully data recieve',
                'team'       => $request->id ? new teamResource($team) :  teamResource::collection($team)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'   => 'something went wrong',
                 'team'      => null
            ],404);
        }
    }
    public function company(Request $request){
        if($request->slug){
            $datas = Company::where('slug',$request->slug)->first();
        }else{
            $datas = Company::get();
        }
        try {
            return response([
                'message'    => 'successfully data recieve',
                'companies'  => $request->slug ? new companyResource($datas) : companyResource::collection($datas)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'   => 'something went wrong',
                 'companies' => null
            ],404);
        }
    }
    public function news(Request $request){
        if($request->slug){
            $datas = NewsEvent::where('slug',$request->slug)->first();
        }else{
            $datas = NewsEvent::orderBy('placement', 'ASC')->get();
        }
        try {
            return response([
                'message'   => 'successfully data recieve',
                'datas'     => $request->slug ? new newsResource($datas) : newsResource::collection($datas)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'  => 'something went wrong',
                 'datas'    => null
            ],404);
        }
    }
    public function career(Request $request){
        if($request->slug){
            $datas = WhyIfad::where('slug',$request->slug)->first();
        }else{
            $datas = WhyIfad::orderBy('placement', 'ASC')->get();
        }
        try {
            return response([
                'message'   => 'successfully data recieve',
                'datas'     => $request->slug ? new whyIfadResource($datas) : whyIfadResource::collection($datas)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'  => 'something went wrong',
                 'datas'    => null
            ],404);
        }
    }
    public function job(Request $request){
        if($request->slug){
            $datas = IfadJob::where('slug',$request->slug)->first();
        }else{
            $datas = IfadJob::orderBy('placement', 'ASC')->get();
        }
        try {
            return response([
                'message'   => 'successfully data recieve',
                'datas'     => $request->slug ? new jobResource($datas) : jobResource::collection($datas)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'  => 'something went wrong',
                 'datas'    => null
            ],404);
        }
    }
    public function contact(Request $request){
        if($request->slug){
            $datas = Company::where('slug',$request->slug)->first();
        }else{
            $datas = Company::orderBy('placement', 'ASC')->first();
        }
        
        try {
            return response([
                'message'       => 'successfully data recieve',
                'company'     => new companyResource($datas)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'      => 'something went wrong',
                 'company'    => null
            ],404);
        }
    }
    public function messageSend(Request $request){
        ini_set('memory_limit','-1');
        // return $request;
        $image   			= $request->file('image');
        $attributes         = [];
        
        $attributes         = [
            'name'          => strip_tags($request->name),
            'company_id'    => strip_tags($request->company_id),
            'email'         => strip_tags($request->email),
            'phone'         => strip_tags($request->phone),
            'message'       => strip_tags($request->message)
        ];
        $data = array_merge($attributes);

        try {
            $submit      =  Message::create($data);
            return response([
                'message'   => 'successfully data send',
                'datas'     => $submit
            ],200);
        }catch (\Illuminate\Database\QueryException $ex) {
            return response([
                'message'   => 'successfully data send',
                'datas'     => $ex->getMessage()
            ],200);
        }
        return $data;
    }
    public function applyJob(Request $request){
        ini_set('memory_limit','-1');
        // return $request;
        $cv   			 = $request->file('cv');
        $attributes      = [];
        $cvAttributes    = [];
        if($cv){
            $cv = str_replace('data:image/png;base64,', '', $cv);
            $cv = str_replace('data:image/jpg;base64,', '', $cv);
            $cv = str_replace('data:image/jpeg;base64,', '', $cv);
            $cv = str_replace(' ', '+', $cv);
            $cvName = 'uploads/equipment/'.\Str::random(9).'.'.'pdf';
            \Storage::disk('public')->put($cvName, base64_decode($cv));

            $cvAttributes = ['cv' => $cvName];
            
        }
        $attributes         = [
            'job_id'        => strip_tags($request->job_id),
            'company_id'    => strip_tags($request->company_id),
            'email'         => strip_tags($request->email),
            'session_id'    => Session::getId(),
            'phone'         => strip_tags($request->phone)
        ];
        $data = array_merge($attributes,$imageAttributes);

        try {
            $submit      =  ApplyJob::create($data);
            return response([
                'message'   => 'successfully data send',
                'datas'     => $submit
            ],200);
        }catch (\Illuminate\Database\QueryException $ex) {
            return response([
                'message'   => 'successfully data send',
                'datas'     => $ex->getMessage()
            ],200);
        }
        return $data;
    }

    // Settings

    public function settings(Request $request){
        $datas = SiteSetting::first();
        try {
            return response([
                'message'   => 'successfully data recieve',
                'datas'     => new settingsResource($datas)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'  => 'something went wrong',
                 'datas'    => null
            ],404);
        }
    }
    public function social(Request $request){
        $datas = Social::orderBy('placement','ASC')->get();
        try {
            return response([
                'message'   => 'successfully data recieve',
                'datas'     => socialResource::collection($datas)
            ],200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response([
                 'message'  => 'something went wrong',
                 'datas'    => null
            ],404);
        }
    }
}
