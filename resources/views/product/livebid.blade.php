@extends('layouts.website')
@section('content')
<div class="smart_container">
  <div class="full-view-productvid">
            <iframe src="http://tokbox.com/embed/embed/ot-embed.js?embedId=c06007a7-20db-45b1-922a-fe13f7e2d94c&room=DEFAULT_ROOM&iframe=true" width="800px" height="640px" scrolling="auto" allow="microphone; camera" ></iframe>
        <div class="product_box_list">
            <div class="product_left">

              <div class="product_box productbox_left">
                <div class="product_img">
                  <img src="{{App\Helper::catImg($product->image)}}"> 
                </div>
                <div class="product_text">
                  <h3>Buy a</h3>
                  <h5>{{$product->name}}</h5>
                 {!! $product->description !!}
                  <h4>{{$product->currency}} {{$product->price}}</h4> 
                </div>
              </div>
              <div class="product_box">
                <div class="product_img">
                  <img src="{{url('/')}}/images/voucher.jpg" alt="Voucher"> 
                </div>
                <div class="product_text">
                   <p>{!! $product->coupon_description !!}</p>
 
                </div>
              </div>
      
            </div>
            <div class="product_text_right">
       
                <form action="{{route('bidNow')}}" method="POST">  
				<div class="bidnow">
                  @csrf  
                    <input type="number" name="bid_amount" class="form-control" min="1" placeholder="Bid Amount" required="required">
                    <textarea name="description" rows="3" placeholder="Write something..." required="required"></textarea>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button type="submit" class="addtocart" id="{{$product->id}}">{{__('Bid Now')}}</button>
                  </div>
                </form>  
      

            </div>
            
          </div>

         
    </div>
 </div>

@endsection