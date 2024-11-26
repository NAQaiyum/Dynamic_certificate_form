<?php

use App\Models\SiteSetting as Setting;
use App\Models\NewsType;use App\Models\NewsCategory;
use App\Models\Category;

if (!function_exists('SiteSetting')) {
    function SiteSetting()
    {
        $site = null;
        return $site ? $site : $site = null;
    }
}
if (!function_exists('SocialSetting')) {
    function SocialSetting()
    {
        $site = Social::orderBy('placement','ASC')->get();
        return $site ? $site : $site = null;
    }
}
if (!function_exists('Target')) {
    function Target()
    {
        return [
            'customers'    => 2,
            'employee'     => 2000,
            'company'      => 10
        ];
    }
}
if (!function_exists('getCompanies')) {
    function getCompanies($data = null){
        if($data == 'main_menue'){
            $datas = Company::where('show_main_menue', 1)->get();
            return $datas ? $datas : $datas = [];
        }else if($data == 'footer_menue'){
            $datas = Company::where('show_footer_menue', 1)->get();
            return $datas ? $datas : $datas = [];
        }else{
            $datas = Company::get();
            return $datas ? $datas : $datas = [];
        }
        
        
    }
}
// Front

if (!function_exists('NewsType')) {
    function NewsType($id,$order)
    {   
        $order  = $order ? $order : 'DESC';
        $data   = NewsType::orderBy('id', $order);
        if($id){
            $data = $data->where('type_id',$id);
        }
        $data = $data->get();
        return $data ? $data : $data = [];
    }
}
if (!function_exists('CatNews')) {
    function CatNews($id,$order)
    {   
        $order  = $order ? $order : 'DESC';
        $data   = NewsCategory::orderBy('id', $order);
        if($id){
            $data = $data->where('cat_id',$id);
        }
        $data = $data->paginate(12);
        return $data ? $data : $data = [];
    }
}
if (!function_exists('Category')) {
    function Category($id = null,$order = 'DESC')
    {   
        $order  = $order ? $order : 'DESC';
        $data   = Category::orderBy('placement', $order);
        if($id){
            $data = $data->where('id',$id);
        }
        $data = $data->get();
        return $data ? $data : $data = [];
    }
}