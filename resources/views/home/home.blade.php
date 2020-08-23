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
      <div class="banner">
        <div class="container">

          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @if($campaign->isNotEmpty())
              @foreach($campaign as $key=> $list)
              <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="@if($key ==0) active @endif"></li>

              @endforeach
              @endif 
            </ol>
            <div class="carousel-inner">

            @if($campaign->isNotEmpty())
            @foreach($campaign as $key=> $list)
              <div class="carousel-item @if($key+1 ==1) active @endif">
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-5">
                    <div class="banner-text">
                      <h2>{{ __('Buy a') }}</h2> 
                      <h3>{{$list->name}}</h3>
                       <?php  
                        $string = $list->description;
                        if (strlen($string) > 120) {     
                            $stringCut = substr($string, 0, 120);
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.route('product.view',$list->slug).'" class="read_lst">Read More</a>'; 
                        }
                        ?>
                      {!! $string !!}
                        <form action="{{route('addToCart')}}" method="POST"> 
                          @csrf  
                           <input class="input-group-field" type="hidden" name="qty" min="1" max="{{$list->stock}}" value="1">
                            <input type="hidden" name="product_id" value="{{$list->id}}">
                              @if($list->product_voucher->isNotEmpty())
                              @foreach($list->product_voucher as $vkey=> $voucher)
                                 <div class="radio">
                                    <label><input type="radio" name="voucher_brand_id" value="{{$voucher->voucher_brand->id}}" @if($vkey==0) checked @endif> {{$voucher->voucher_brand->name}}</label> 
                                 </div>
                              @endforeach
                              @endif 
                            <button type="submit" class="byenow" id="byenow_{{$list->id}}">{{ __('Buy Now') }}</button>
                          
                        </form>  
                    </div>
                  </div> 
                  <div class="col-12 col-md-6 col-lg-7">
                    <div class="banner_image">
                      <img src="{{App\Helper::catImg($list->image)}}" alt="{{$list->name}}">
                    </div>
                  </div> 
                </div>
              </div>
            @endforeach
            @endif  
            </div>

          </div>

        </div>
        <div class="banner_bottom">
          <img src="{{url('/')}}/images/trangle.svg">
        </div>
      </div>


      <div class="product_section" id="campaign-section">
        <div class="container">

            <div class="tabsection">
            <nav>
              <div class="nav nav-pills" id="nav-tab" role="tablist">

                 <a class="nav-item nav-link @if(Request('Rcampaign')==null) active @endif" id="nav-allCampaign-tab" data-toggle="tab" href="#nav-allCampaign" role="tab" aria-controls="nav-allCampaign" aria-selected="true">
                  All Campaign
                 </a>
                 @if(\App\Category::get()->isNotEmpty())
                  @foreach(\App\Category::get() as $ke=> $list)
                <a class="nav-item nav-link @if(Request('Rcampaign')==$list->slug) active @endif" id="nav-{{$list->slug}}-tab" data-toggle="tab" href="#nav-{{$list->slug}}" role="tab" aria-controls="nav-{{$list->slug}}" aria-selected="true">
                  {{$list->name}}
                </a>
                @endforeach
                @endif
          
              </div>
            </nav>
          </div>

          <div class="tab-content" id="nav-tabContent">
            <!--Start All Campion-->
            <div class="tab-pane fade @if(Request('Rcampaign')==null) show active @endif" id="nav-allCampaign" role="tabpanel" aria-labelledby="nav-allCampaign-tab">
           @if($campaign->isNotEmpty())
            @foreach($campaign as $key=> $list)
          <div class="product_box_list">
            <div class="product_left">
              <div class="product_box productbox_left">
                <a href="{{route('product.view',$list->slug)}}"> 
                <div class="product_img">
                 <img src="{{App\Helper::catImg($list->image)}}">
                </div>
                </a>
                <div class="product_text">
                  <h3>Buy a</h3>
                  <h5>{{$list->name}}</h5>
                  <?php  
                    $string = $list->description;
                    if (strlen($string) > 75) {     
                        $stringCut = substr($string, 0, 75);
                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.route('product.view',$list->slug).'" class="read_lst">Read More</a>'; 
                    }
                    ?>
                 {!! $string !!}
                  <h4>{{$list->currency}} {{$list->price}}</h4> 
                </div>
              </div>
              <div class="product_box">
                 <a href="{{route('product.view',$list->slug)}}">
                <div class="product_img">
                  <img src="{{url('/')}}/images/voucher.jpg" alt="Voucher"> 
                </div>
                </a>
                <div class="product_text">
                     <?php  
                    $string = $list->coupon_description;
                    if (strlen($string) > 75) {     
                        $stringCut = substr($string, 0, 75);
                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.route('product.view',$list->slug).'" class="read_lst">Read More</a>'; 
                    }
                    ?>
                
                  <p> {!! $string !!}</p>
                 
                   <a href="{{route('product.view',$list->slug)}}">Learn more about prize</a>
                </div>
              </div>
               
            </div>
            <div class="product_text_right">
			<div class="product_text_right_top">
              <div class="progress_curcle mx-auto" data-value='{{$list->sold_count}}'>
             
                <span class="progress-left">
                  <span class="progress-bar border-primary"></span>
                </span>
                <span class="progress-right">
                  <span class="progress-bar border-primary"></span>
                </span>
                <div class="progress-value rounded-circle d-flex align-items-center justify-content-center">
                  <div class="prgress_text">
                    <div class="prgress_text_inn">
                      <p><span>{{$list->sold_count}}</span> SOLD</p>
                      <span class="divider_curcle"></span>
                      <p>OUT OF <span>{{$list->stock}}</span></p> 
                    </div>
                  </div>
                </div>
                    
              </div>
              <div class="winnerImg">
                 <img src="{{App\Helper::winnerImg($list->prize_image)}}">
              </div>
			  </div>
              <p class="product_quote">Product price per unit
                Including all taxes</p>
                <form action="{{route('addToCart')}}" method="POST"> 
                  @csrf  
                    <div class="add_product_count">
                      <button type="button" class="button hollow circle" data-qty="minus" data-id="{{$list->id}}" data-field="qty"><i class="fas fa-minus" aria-hidden="true"></i>
                      </button>
                      <input class="input-group-field" type="number" name="qty" id="qty_{{$list->id}}" min="1" max="{{$list->stock}}" value="1">
                      <button type="button" class="button hollow circle" data-qty="plus" data-id="{{$list->id}}" data-stock="{{$list->stock}}" data-field="qty"><i class="fas fa-plus" aria-hidden="true"></i>
                      </button>
                    </div>
                    <input type="hidden" name="product_id" value="{{$list->id}}">
					<div class="radiocheck">
                        @if($list->product_voucher->isNotEmpty())
                              @foreach($list->product_voucher as $vkey=> $voucher)
                                 <div class="radio">
                                    <label><input type="radio" name="voucher_brand_id" value="{{$voucher->voucher_brand->id}}" @if($vkey==0) checked @endif> {{$voucher->voucher_brand->name}}</label> 
                                 </div>
                              @endforeach
                              @endif 
					</div>
                    <button type="submit" class="addtocart" id="addtocart_{{$list->id}}">{{__('ADD TO CART')}}</button>
                  
                </form>  
      

            </div>
            
          </div>

          @endforeach
          @endif

         </div>
         <!--End All Campion-->
          @if($category->isNotEmpty())
          @foreach($category as $key1=> $catlist)
               
          <div class="tab-pane fade @if(Request('Rcampaign')==$catlist->slug) show active @endif" id="nav-{{$catlist->slug}}" role="tabpanel" aria-labelledby="nav-{{$catlist->slug}}-tab">
           @if($catlist->products->isNotEmpty())
            @foreach($catlist->products as $key=> $list)
          <div class="product_box_list">
            <div class="product_left">
              <div class="product_box">
                <a href="{{route('product.view',$list->slug)}}">
                <div class="product_img">
                <img src="{{App\Helper::catImg($list->image)}}">
                </div>
                 </a>
                <div class="product_text">
                  <h3>Buy a</h3>
                  <h5>{{$list->name}}</h5>
                 <?php  
                    $string = $list->description;
                    if (strlen($string) > 75) {     
                        $stringCut = substr($string, 0, 75); 
                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.route('product.view',$list->slug).'" class="read_lst">Read More</a>'; 
                    }
                    ?>
                 {!! $string !!}
                  <h4>{{$list->currency}} {{$list->price}}</h4> 
                </div>
              </div>
              <div class="product_box">
                <a href="{{route('product.view',$list->slug)}}"> 
                <div class="product_img">
                  <img src="{{url('/')}}/images/voucher.jpg" alt="Voucher"> 
                </div>
                </a>
                <div class="product_text">
                     <?php  
                    $string = $list->coupon_description;
                    if (strlen($string) > 75) {     
                        $stringCut = substr($string, 0, 75);
                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.route('product.view',$list->slug).'" class="read_lst">Read More</a>'; 
                    }
                    ?>
                
                  <p> {!! $string !!}</p> 
                </div>
              </div>
      
            </div>
            <div class="product_text_right">
              <div class="progress_curcle mx-auto" data-value='{{$list->sold_count}}'>
                    
                <span class="progress-left">
                  <span class="progress-bar border-primary"></span>
                </span>
                <span class="progress-right">
                  <span class="progress-bar border-primary"></span>
                </span>
                <div class="progress-value rounded-circle d-flex align-items-center justify-content-center">
                  <div class="prgress_text">
                    <div class="prgress_text_inn">
                      <p><span>{{$list->sold_count}}</span> SOLD</p>
                      <span class="divider_curcle"></span>
                      <p>OUT OF <span>{{$list->stock}}</span></p> 
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="winnerImg">
                 <img style="border-radius: 50%; 
    height: 150px;
    width: 150px;" src="{{App\Helper::winnerImg($list->prize_image)}}">
              </div>
              <p class="product_quote">Product price per unit
                Including all taxes</p>
                <form action="{{route('addToCart')}}" method="POST"> 
                  @csrf  
                    <div class="add_product_count">
                      <button type="button" class="button hollow circle" data-qty="minus" data-id="{{$list->id}}" data-field="qty"><i class="fas fa-minus" aria-hidden="true"></i>
                      </button>
                      <input class="input-group-field" type="number" id="qty_{{$list->id}}" name="qty" min="1" max="{{$list->stock}}" value="1">
                      <button type="button" class="button hollow circle" data-qty="plus" data-id="{{$list->id}}" data-stock="{{$list->stock}}" data-field="qty"><i class="fas fa-plus" aria-hidden="true"></i>
                      </button>
                    </div>
                    <input type="hidden" name="product_id" value="{{$list->id}}">
                        @if($list->product_voucher->isNotEmpty())
                              @foreach($list->product_voucher as $vkey=> $voucher)
                                 <div class="radio">
                                    <label><input type="radio" name="voucher_brand_id" value="{{$voucher->voucher_brand->id}}" @if($vkey==0) checked @endif> {{$voucher->voucher_brand->name}}</label> 
                                 </div>
                              @endforeach
                              @endif 
                    <button type="submit" class="addtocart" id="{{$list->id}}">ADD TO CART</button>
                  
                </form>  
      

            </div>
            
          </div>

          @endforeach
          @endif

         </div>
          @endforeach
          @endif
    
      </div>


        </div>
      </div>


      <div class="product_sec" id="product-section">
        <div class="container">

          <h4>Product</h4>

          <div class="owl-carousel product_list owl-theme">

            @if($product->isNotEmpty())
            @foreach($product as $list)
            <div class="item" onclick="productModal('{{$list->id}}')"> 
              <div  class="pro_box">
                <span class="proimg"><img src="{{$list->image}}"></span>
                <h4>{{__('Get a chance to win coupon')}}</h4>
                 <?php  
                    $string = $list->name;
                    if (strlen($string) > 20) {     
                        $stringCut = substr($string, 0, 20);
                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                    }
                    ?>
                <p>{{$string}}</p>
              </div>
            </div>
            @endforeach
            @endif
           
            
            
          </div>
        </div>
      </div>
	  
	  
	  <!-- Product modal -->

<div class="modal fade bd-example-modal-md" id="pModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header modal_head">
	  
		<a class="navbar-brand" href="{{url('/')}}">
            <img src="{{url('/')}}/images/logo.png">
        </a>
	  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div  class="pro_box pro_box_modal">
          <span class="proimg"><img id="modal_product_img" src="{{$list->image}}"></span>
          <h4 id="modal_product_name">{{$list->name}}</h4>
          
          <p id="modal_product_desc">{{$list->name}}</p>
        </div>

    </div>
  </div>
</div>

<!-- Product modal end -->

	  
	  

      <div class="get_app">
        <div class="white_trangle">
          <img src="{{url('/')}}/images/white_trangle.svg">
        </div>
        <div class="container">
          <div class="col-lg-6 m-auto">
            <h2>Get the App</h2>
            <h4>For the ultimate shopping experience download our app.</h4>
            <div class="appdownload">
              <a href="javascript:void(0);" onclick="appAlert()"><img src="{{url('/')}}/images/android.png"></a>
              <a href="javascript:void(0);" onclick="appAlert()"><img src="{{url('/')}}/images/ios.png"></a>
            </div>
          </div>
        </div>
      </div>

<script>

  function productModal(id) {
       $.ajax({
                type: 'GET',
                url: '{{url("/")}}/product/ajaxData/' + id,
                success: function (data) {
                    console.log(data);
                    $('#modal_product_name').text(data.data.name);
                    $('#modal_product_img').attr('src',data.data.image);
                    $('#modal_product_desc').html(data.data.description); 
                    $('#pModal').modal('show');

                }
       });
  }


	function appAlert(){
	   Swal.fire(' ','Stay tuned we are launching very soon','info');
	}
  
   //  function repeat_time(ids,countDown){
   //    const second = 1000,
   //    minute = second * 60,
   //    hour = minute * 60,
   //    day = hour * 24;
      
   //    $ids = ids;
   //    setInterval(function() {

   //      $( ".total_rupak" ).each(function( index ) {
   //        $this = $(this);
   //        $ids = $this.data('ids');
   //        let countDown = new Date($("#date"+$ids).val()).getTime();
   //        repeat_time($ids,countDown);

   //        let now = new Date().getTime(),   
   //            distance = countDown - now;
   //        document.getElementById('days'+$ids).innerText = Math.floor(distance / (day)),
   //          document.getElementById('hours'+$ids).innerText = Math.floor((distance % (day)) / (hour)),
   //          document.getElementById('minutes'+$ids).innerText = Math.floor((distance % (hour)) / (minute)),
   //          document.getElementById('seconds'+$ids).innerText = Math.floor((distance % (minute)) / second);
   //      });
        
   //    }, second)
   //  }

   //  repeat_time();

   //  function repeat_timeAll(ids,countDown){
   //    const second = 1000,
   //    minute = second * 60,
   //    hour = minute * 60,
   //    day = hour * 24;
      
   //    $ids = ids;
   //    setInterval(function() {

   //      $( ".Alltotal_rupak" ).each(function( index ) {
   //        $this = $(this);
   //        $ids = $this.data('ids');
   //        let countDown = new Date($("#Alldate"+$ids).val()).getTime();
   //        repeat_time($ids,countDown);

   //        let now = new Date().getTime(),   
   //            distance = countDown - now;
   //        document.getElementById('Alldays'+$ids).innerText = Math.floor(distance / (day)),
   //          document.getElementById('Allhours'+$ids).innerText = Math.floor((distance % (day)) / (hour)),
   //          document.getElementById('Allminutes'+$ids).innerText = Math.floor((distance % (hour)) / (minute)),
   //          document.getElementById('Allseconds'+$ids).innerText = Math.floor((distance % (minute)) / second);
   //      });
        
   //    }, second)
   //  }
   // repeat_timeAll();


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