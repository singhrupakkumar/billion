@extends('layouts.website')
@section('content')
<?php 
 if(isset($shippingaddress['first_name'])){
     $first_name = $shippingaddress['first_name'];
 }elseif(isset($user->first_name)){
     $first_name = $user->first_name;          
 }

 if(isset($shippingaddress['last_name'])){
     $last_name = $shippingaddress['last_name'];
 }elseif(isset($user->last_name)){
     $last_name = $user->last_name;          
 }
 
  if(isset($shippingaddress['email'])){
     $email = $shippingaddress['email'];
 }elseif(isset($user->email)){    
     $email = $user->email;         
 }
 
  if(isset($shippingaddress['phone'])){
     $phone = $shippingaddress['phone'];
 }elseif(isset($user->phone)){
     $phone = $user->phone;         
 }

  if(isset($shippingaddress['address'])){
     $address = $shippingaddress['address'];
 }else{
     $address = null;           
 }
 
   if(isset($shippingaddress['city'])){
     $city = $shippingaddress['city']; 
 }else{
     $city =null;             
 }
 
 if(isset($shippingaddress['state'])){
     $state = $shippingaddress['state']; 
 }else{
     $state = null;           
 }
 
  if(isset($shippingaddress['zip'])){
     $zip = $shippingaddress['zip']; 
 }else{
     $zip = null;                
 }
?>

<style>
    .countinue{ display: none; }
</style> 

<div class="smart_container">

<div class="chk_section"> 
	<div class="container">
		<div class="chk_hder">
				<div class="col-sm-12">
					<div class="sign-flash">
					@include('flash-message') 
					</div>    
			   </div>  
			<h3>Checkout</h3>
		</div>   

<div class="row">				

<div class="col-md-8">

	<div class="panel-group accordion_checkout" id="accordion"  role="tablist" aria-multiselectable="true">
  <!-----tab1--------> 
    <div class="panel panel-default checkout">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion"  href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <h4><span>1</span>Order Details</h4>
         <div class="chng_rgn">Change</div>
        </a>
      </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
        
        <div class="table_chot"> 

        
            <?php if(!empty($cart['items'])){ 
                    foreach($cart['items'] as $item){
                        
                        
                    ?>
          <div class="cart_item_list">
              <div class="cartitem_add">
                <div class="cart_box">
                  <div class="cartproduct">
                    <img src="{{App\Helper::catImg($item->image)}}">
                  </div>
                  <div class="cartproduct_text">
                    <p>Product</p>
                    <h5>{{$item->name}}</h5>
                    <h4>{{$cart['cartInfo']['currency']}} {{$item->price}}</h4>
                  </div>
                </div>
                <div class="cart_box">
                  <div class="cartproduct">
                    <img src="{{App\Helper::catImg($item->product->prize_image)}}">
                  </div>
                  <div class="cartproduct_text">
                    <p>Prize</p>
                    <h4>{{$cart['cartInfo']['currency']}} {{$item->product->prize_amount}}</h4>
                  </div>
                </div>
              </div> 
              <div class="cartprice_item">
                <div class="cartprice">
                  <h4><span>Sub Total</span>{{$cart['cartInfo']['currency']}} {{$item->price*$item->qty}}</h4>
                </div>
                <div class="cart_qty">
                  
                </div>
              </div>
            </div>
             <?php } } ?>

        </div>
        </div>
      </div>
    </div>
<!-----tab2-------->
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
		  <h4><span>2</span>Shipping Address</h4>
          <div class="chng_rgn">Change</div>
        </a>
      </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
         <div class="ship_frm">
            <form id="checkout-form" method="post"> 
              @csrf
			  
			<div class="row">
			  <div class="col-12 col-md-6">
                <div class="form-group nm_lese">
                  <label for="name">First Name</label>  
                  <input type="text" class="form-control" id="first_name" value="<?php if(isset($first_name)){ echo $first_name; } ?>" placeholder="First Name" name="first_name" required>
                </div>
			  </div>
			  <div class="col-12 col-md-6">
                <div class="form-group nm_lese">
                  <label for="name">Last Name</label>  
                  <input type="text" class="form-control" id="last_name" value="<?php if(isset($last_name)){ echo $last_name; } ?>" placeholder="Last Name" name="last_name">
                </div> 
			  </div>
			</div>

                <div class="form-group nm_lese">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" id="email" value="<?php if(isset($email)){ echo $email; } ?>" placeholder="Email Address" name="email" required>
                </div>

                 <div class="form-group nm_lese less_mrgn">
                  <label for="phone">Phone Number</label>
                  <input type="text" class="form-control" id="phone" value="<?php if(isset($phone)){ echo $phone; } ?>" placeholder="Phone Number" name="phone" required>
                </div>

                 <div class="form-group"> 
                  <label for="address">Street or P.O. Box</label>
                  <input type="text" class="form-control" id="address" value="<?php if(isset($address)){ echo $address; } ?>" placeholder="Street" name="address" required>
                </div>
				<div class="row">
				<div class="col-12 col-md-4">
                 <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" value="<?php if(isset($city)){ echo $city; } ?>" placeholder="City" name="city" required>
                </div>
				</div>
					<div class="col-12 col-md-4">
					 <div class="form-group stret_lese">
					  <label for="state">State</label> 
					  <input type="text" class="form-control" id="state" value="<?php if(isset($state)){ echo $state; } ?>" placeholder="State" name="state"> 
					</div>
					</div>
				<div class="col-12 col-md-4">

                 <div class="form-group stret_lese less_mrgn">
                  <label for="zip">Zip Code</label>
                  <input type="number" class="form-control" id="zip" value="<?php if(isset($zip)){ echo $zip; } ?>" placeholder="Zip Code" name="zip">
                </div> 
				</div>
				</div>
                 <div class="form-group stret_lese less_mrgn">
                     <p class="mymessage"></p>       
                </div> 
                <button type="submit" class="btn btn-success scss_cntn">Save</button> 
                  
            </form>

         	</div>     
        </div>
      </div>
    </div>



 
  </div>

</div>
<div class="col-md-4">
<div class="sticky-top" style="top:120px;">
	<div class="cart_item">
	  <ul>
		<li>Total Products <span>{{$cart['cartInfo']['quantity']}}</span></li>
		<li>Total Items <span>{{$cart['cartInfo']['order_item_count']}}</span></li> 
	  </ul>
	  <p>You will earn 141i-Points from this purchase</p>
	  <div class="grand_total">
		<div class="grandtotal_left">
		  <h4>Grand Total</h4>
		  <p>Prices inclusive of VAT</p>
		</div>
		<h5>{{$cart['cartInfo']['currency']}} {{$cart['cartInfo']['total']}}</h5>
	  </div>
    <form action="{{route('payment')}}" method="post">
      @csrf
         <button type="submit" class="btn btn-success btn-block mt-3"><i class="fab fa-cc-paypal"></i> Select Payment Method</button> 
    </form>    
	 
	</div>
</div>
</div>

</div>

  

        	
    	</div>
	</div>  
	</div>
<script>   
    
$().ready(function() {
	var valid = $("#checkout-form").validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				
			},
			state: {
				required: true
			},
			address: "required",
			city: {
				required: true
			},
			state: "required", 
			zip: {
				required: true,
				number: true
			}
		},
		messages: {
			name: "Please enter your name",
			email: "Please enter a valid email address",
			phone: "Please enter valid phone number",
			city: "Please enter your city",
			state: "Please enter state",
			zip: "Please enter zipcode" 
		}
	});
        

   jQuery("#saveaddress").click(function(event) {
       
       if(valid.form()){
          jQuery.ajax({
                    url: '',  
                    data: jQuery('#checkout-form').serialize(),
                    type: 'POST',
                    dataType: "json",
                    success: function (msg) {  
                        if (msg.status === true) 
                        {
                           jQuery(".mymessage").html('<div class="alert alert-success">'+msg.msg+'</div>'); 
                           setTimeout(function(){  window.location.reload(); }, 1000);   
                        }
                        else
                        { 
                            event.preventDefault();
                            jQuery(".mymessage").html('<div class="alert alert-success">'+msg.msg+'</div>');
                        } 
                    }
                });
        }else{
          event.preventDefault();    
        }         
  event.preventDefault();    
});
   
        
});
</script>
 <script> 
	$(document).ready(function() {
            


  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.in').collapse('hide');
  }
     
});
	</script>
	
	
	
  @endsection