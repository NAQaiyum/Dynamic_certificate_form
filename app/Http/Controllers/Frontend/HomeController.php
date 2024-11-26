<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\Models\Invoice;


class HomeController extends Controller
{
    public function index(){
        return View('frontend.home.index');
    }

    public function save(Request $request){
        ini_set('memory_limit','-1');
        $validator = Validator::make($request->all(), [
            'certificate'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'serialno' => 'required'
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first());
            return redirect()->back();
        }
        $signature_1   			= $request->file('signature_1');
        $signature_2   			= $request->file('signature_2');
        $attributes         = [];
        $signature_1Attributes    = [];
        $signature_2Attributes    = [];

        if($signature_1){
            $photo 	        = rand().$signature_1->getClientOriginalName();
            $destination 	= 'uploads/invoice';
            $signature_1->move(public_path($destination), $photo);

            $signature_1 	        = $destination.'/'.$photo;
            $signature_1Attributes     = [
                'signature_1'    => $signature_1,
            ];
        }

        if($signature_2){
            $photo 	        = rand().$signature_2->getClientOriginalName();
            $destination 	= 'uploads/invoice';
            $signature_2->move(public_path($destination), $photo);

            $signature_2 	        = $destination.'/'.$photo;
            $signature_2Attributes     = [
                'signature_2'    => $signature_2,
            ];
        }

        $attributes         = [
            'ex_name'                   => strip_tags($request->ex_name),
            'ex_address'                => strip_tags($request->ex_address),
            'con_name'                  => strip_tags($request->con_name),
            'con_full_address'          => strip_tags($request->con_full_address),
            'con_country'               => strip_tags($request->con_country),
            'dep_date'                  => $request->dep_date,
            'vessels_name'              => strip_tags($request->vessels_name),
            'port_of_discharge'         => strip_tags($request->port_of_discharge),
            'country_destination'       => strip_tags($request->country_destination),
            'country_origin'            => strip_tags($request->country_origin),
            'certificate_origin_no'     => strip_tags($request->certificate_origin_no),
            'name'                      => strip_tags($request->name),
            'designation'               => strip_tags($request->designation),
            'date_1'                    => $request->date_1,
            'h_s_code'                  => strip_tags($request->h_s_code),
            'quantity_unit'             => strip_tags($request->quantity_unit),
            'date_2'                    => $request->date_2,
            'serialno'                  => strip_tags($request->serialno),
            'marksno'                   => strip_tags($request->marksno),
            'package'                   => strip_tags($request->package)
        ];

        $data = array_merge($attributes, $signature_1Attributes, $signature_2Attributes);

        try {
            $submit      =  Invoice::create($data);
            return redirect()->route('frontend::invoice.details',[ 'serialno'=>$submit->serialno] );
        }catch (\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();

            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
        return $data;
    }
    public function details(Request $request){
        //return $request;
        $getData = Invoice :: where('serialno',$request->serialno)->first();
        // $getData = Invoice :: where('serialno',$request->serialno)->first();
        return View('frontend.home.details',compact('getData'));
    }
    public function print(Request $request){
        // return $request;
        $getData = Invoice :: where('serialno',$request->serialno)->first();
        $headers = array(
              'Content-Type: application/pdf',
            );
        if($getData->certificate){
        //     return response()->download(public_path($getData->certificate), $getData->serialno.'.jpg', $headers);
        // }else{
            return View('frontend.home.print-final',compact('getData'));
        }

    }
    // public function details(Request $request){
    //     return $request;
    //     $getData = Invoice :: where('id',$request->certificate_origin_no)->first();
    //     return View('frontend.home.details',compact('getData'));
    // }

}
