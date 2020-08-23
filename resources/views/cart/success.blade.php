@extends('layouts.website')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/cart.css')}}"> 
<div class="frm_sgnup">
    <div class="container">
        <div class="row">
            <div class="sgnup_heading">
                <h4>Order Confirmed</h4>  
            </div> 
            <div class="frm_sgncvr">
                <div class="img_cnfm">
                    <img src="https://earthvendors.com/images/website/thku_pic.png">   
                    <span class="ordr_pro">Thank You for Your Order!</span> 
                    <span class="ordr_pro">Transaction Id: {{$paymentinfo['tx']}}</span>  
                </div>
                <span class="smry_stng">Summary</span>
      
                @if($order->orderItem->isNotEmpty()) 
                @foreach($order->orderItem as $item)   
                <div class="ordr_quey">
                    <div class="col-sm-6">
                        <div class="lft_smmry">
                            <h3>{{$item->qty}}*{{$item->product_name}}</h3>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rght_smry">
                            <h3>{{$order->currency}} {{$item->price}}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
                 @endif


                <div class="ordr_quey">
                    <div class="col-sm-6">
                        <div class="lft_smmry">
                            <h3>Sub Total</h3>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rght_smry">
                            <h3>{{$order->currency}} {{$order->subtotal}}</h3>
                        </div>
                    </div>
                </div>

          

                <div class="ordr_quey">
                    <div class="col-sm-6">
                        <div class="lft_smmry">
                            <h3>Total</h3>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rght_smry">  
                            <h3>{{$order->currency}} {{$order->total}}</h3>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
  @endsection