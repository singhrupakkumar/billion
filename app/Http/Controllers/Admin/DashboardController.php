<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth,URL;
use App\Config;   
use App\User; 
use App\Category;  
use App\Order; 

class DashboardController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);
    }

    public function index()
    {
        $totalUser = User::where('type','customer')->count();
        $latestBooking = Order::where(['status'=>1])->orderBy('id','DESC')->limit(10)->get();
        $newCount = Order::where(['status'=>1])->count();          
        return view('admin.dashboard',compact('totalUser','latestBooking','newCount'));             
    }      


    public function config(Request $request){ 
        if($request->isMethod('post')){
            foreach($request->all() as $key => $value){
                if($request->hasFile($key)){
                    Config::updateAll($key, $value, 'file');
                }else{
                    Config::updateAll($key, $value, 'text');
                }
            }
            return redirect(route('admin.config'))->with('success', 'A settings has been saved successfully.');
        }
        return view('admin.common.config');
    }
    
    
  
}
