<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
class DashboardController extends Controller
{
    public function index(){
        $title      = "Dashboard";
        $getDatas   = Invoice::get();

        return View('admin.invoice.index',compact('title','getDatas'));
    }


}
