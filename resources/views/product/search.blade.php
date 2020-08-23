@extends('layouts.website')
@section('content')
<style type="text/css">
  .countdown_timer li {
    float: left;
    margin-left:5px;
    padding: 5px;
    list-style: none; 
  }
</style>
<div class="smart_container">
  <div class="cart_wrapper">
     <div class="container">
        <div class="row">
          <div class="col-md-12">
     @if($products->isNotEmpty())
      @foreach($products as $key=> $product)
        <div class="product_box_list">
            <div class="product_left">
              <div class="product_box productbox_left">
                <div class="product_img">
                  <img src="{{App\Helper::catImg($product->image)}}"> 
                </div>
                <div class="product_text">
                  <h3>Buy a</h3>
                  <h5>{{$product->name}}</h5>
                   <?php  
                        $string = $product->description;
                        if (strlen($string) > 75) {     
                            $stringCut = substr($string, 0, 75);
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.route('product.view',$product->slug).'" class="read_lst">Read More</a>'; 
                        }
                        ?>
                      {!! $string !!}
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
              <div class="progress_curcle mx-auto" data-value='{{$product->sold_count}}'>
                <span class="progress-left">
                  <span class="progress-bar border-primary"></span>
                </span>
                <span class="progress-right">
                  <span class="progress-bar border-primary"></span>
                </span>
                <div class="progress-value rounded-circle d-flex align-items-center justify-content-center">
                  <div class="prgress_text">
                    <div class="prgress_text_inn">
                      <p><span>{{$product->sold_count}}</span> SOLD</p>
                      <span class="divider_curcle"></span>
                      <p>OUT OF <span>{{$product->stock}}</span></p> 
                    </div>
                  </div>
                </div>
              </div>
              <p class="product_quote">Product price per unit
                Including all taxes</p>
                <form action="{{route('addToCart')}}" method="POST"> 
                  @csrf  
                     <div class="add_product_count">
                      <button type="button" class="button hollow circle" data-qty="minus" data-id="{{$product->id}}" data-field="qty"><i class="fas fa-minus" aria-hidden="true"></i>
                      </button>
                      <input class="input-group-field" type="number" name="qty" id="qty_{{$product->id}}" min="1" max="{{$product->stock}}" value="1">
                      <button type="button" class="button hollow circle" data-qty="plus" data-id="{{$product->id}}" data-stock="{{$product->stock}}" data-field="qty"><i class="fas fa-plus" aria-hidden="true"></i>
                      </button>
                    </div>
                    <input type="hidden" name="product_id" value="{{$product->id}}"> 
					<div class="radiocheck">
                      @if($product->product_voucher->isNotEmpty())
                      @foreach($product->product_voucher as $vkey=> $voucher)
                         <div class="radio">
                            <label><input type="radio" name="voucher_brand_id" value="{{$voucher->voucher_brand->id}}" @if($vkey==0) checked @endif> {{$voucher->voucher_brand->name}}</label> 
                         </div>
                      @endforeach
                      @endif 
					  </div>
                    <button type="submit" class="addtocart" id="{{$product->id}}">{{__('ADD TO CART')}}</button>
                  
                </form>  
      

            </div>
            
          </div>
              @endforeach
          @endif
           </div>
        </div>
        </div>
    </div>
 </div>
<script>

   // function repeat_time(ids,countDown){
    //   const second = 1000,
    //   minute = second * 60,
    //   hour = minute * 60,
    //   day = hour * 24;
      
    //   $ids = ids;
    //   setInterval(function() {

    //     $( ".total_rupak" ).each(function( index ) {
    //       $this = $(this);
    //       $ids = $this.data('ids');
    //       let countDown = new Date($("#date"+$ids).val()).getTime();
    //       repeat_time($ids,countDown);

    //       let now = new Date().getTime(),   
    //           distance = countDown - now;
    //       document.getElementById('days'+$ids).innerText = Math.floor(distance / (day)),
    //         document.getElementById('hours'+$ids).innerText = Math.floor((distance % (day)) / (hour)),
    //         document.getElementById('minutes'+$ids).innerText = Math.floor((distance % (hour)) / (minute)),
    //         document.getElementById('seconds'+$ids).innerText = Math.floor((distance % (minute)) / second);
    //     });
        
    //   }, second)
    // }

   // repeat_time();

    jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-qty="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        stock = $(this).data('stock');
        currentId = $(this).data('id');
        // Get its current value
        var currentVal = parseInt($('#qty_'+currentId).val());
        // If is not undefined
        if (!isNaN(currentVal)) { 
            // Increment
            if(currentVal >= stock){
              console.log(currentVal,stock);
               $('#qty_'+currentId).val(currentVal);
            }else{
                $('#qty_'+currentId).val(currentVal + 1);
            }
          
        } else {
            // Otherwise put a 0 there
            $('#qty_'+currentId).val(1);
        }
    });
    // This button will decrement the value till 0
    $('[data-qty="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field'); 
        stock = $(this).data('stock');
        currentId = $(this).data('id');
        // Get its current value
        var currentVal = parseInt($('#qty_'+currentId).val()); 
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
           $('#qty_'+currentId).val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('#qty_'+currentId).val(1);
        }
    });
});


</script>
@endsection