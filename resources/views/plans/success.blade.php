@extends('layouts.website')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/cart.css')}}"> 
<div class="frm_sgnup">
    <div class="container">
        <div class="row">
            <div class="sgnup_heading">
                <h4>Subscription Confirmed</h4>  
            </div> 
            <div class="frm_sgncvr">
                <div class="img_cnfm">
                    <img src="https://earthvendors.com/images/website/thku_pic.png">   
                    <span class="ordr_pro">Thank You for Your Perchase!</span> 
                    <span class="ordr_pro">Transaction Id: {{$paymentinfo['tx']}}</span>  
                </div>
              
            </div>
        </div>
    </div>
</div>
  @endsection