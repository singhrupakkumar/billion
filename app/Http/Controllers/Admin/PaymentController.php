<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Auth;
use App\User;
use App\PaymentHistory;
use App\PaymentRequest;
use App\Helper;
use URL;  
use Log;

class PaymentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);  
    }
    
    
     public function index()
    {
        try {  
        $payments = PaymentHistory::with(['user','booking'])->get(); 
        } catch (\Exception $e) {
            Log::error('Log payment in', array('error' => $e));
            throw $e;
        }    

        return view('admin.payment.list',compact('payments'));   
    }
    
      public function paymentRequest()
    {
        try {  
         $request = PaymentRequest::with('vendor')->orderBy('id','DESC')->get();                 
        } catch (\Exception $e) {
            Log::error('Log paymentRequest in', array('error' => $e));
            throw $e;
        }      

        return view('admin.payment.requestlist',compact('request'));   
    }
     
      public function requestDetails($id)
    {
        try {  
            $id = Helper::decodeNum($id);
            $requestDetails = PaymentRequest::with('vendor.wallet','bank')->where('id',$id)->first();
           
        } catch (\Exception $e) {        
            Log::error('Log requestDetails in', array('error' => $e));
            throw $e;
        }    
            
        return view('admin.payment.requestDetails',compact('requestDetails'));   
    } 
    
       public function redeemUpdate($id)
    {
        try {  
            
            $requestDetails = PaymentRequest::with('vendor.wallet','bank')->where('id',$id)->first();
           
        } catch (\Exception $e) {        
            Log::error('Log redeemUpdate in', array('error' => $e));
            throw $e;
        }      
    }
}
