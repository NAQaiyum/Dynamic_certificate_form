<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use File;use Validator;
class InvoiceController extends Controller
{
    public function index(){
        $title          = "Invoice";
        $getDatas       =  Invoice::get();

        return view('admin.invoice.index',[
            'title'     => $title,
            'getDatas'  => $getDatas
        ]);
    }
    public function getForm(Request $request){

        $data      = Invoice::find($request->id);
        $title     = $data ? $data->title : 'Invoice create';
        return view('admin.invoice.form',[
            'title' => $title,
            'data'  => $data
        ]);;
    }
    public function save(Request $request){
        ini_set('memory_limit','-1');
        $validator = Validator::make($request->all(), [
            'certificate'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('Image Size invalied');
            return redirect()->back();
        }
        $certificate   		= $request->file('certificate');
        $attributes         = [];
        $imageAttributes    = [];

        if($certificate){
            $photo 	        = rand().$certificate->getClientOriginalName();
            $destination 	= 'uploads/invoice';
            $certificate->move(public_path($destination), $photo);

            $certificate 	     = $destination.'/'.$photo;
            $imageAttributes     = [
                'certificate'    => $certificate,
            ];
        }
        $attributes         = [
            'certificate_origin_no' => $request->certificate_origin_no
            ];
        $data = array_merge($attributes, $imageAttributes);

        try {
            if($request->id){
                $submit         =  Invoice::find($request->id);

                if($certificate){
                    $image_path = public_path($submit->certificate);
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $update = $submit->update($data);
                notify()->success('Data Successfully Updated !');
            }else{
                $submit      =  Invoice::create($data);
                notify()->success('Data Successfully added !');
            }
            return redirect()->back();
        }catch (\Illuminate\Database\QueryException $ex) {
            notify()->error($ex->getMessage());
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
        return $data;
    }
    public function delete(Request $request){
        $data           =  Invoice::find($request->id);
        if($data && $data->certificate){
            $image_path = public_path($data->certificate);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $del            = $data->delete();
        notify()->success('Data Successfully Deleted  !');
        return redirect()->back();
    }
}
