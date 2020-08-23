@extends('layouts.website')
@section('content')
<div class="smart_container">
  <div class="cart_wrapper">
  	 @include('flash-message')  
      <div class="container">
        <div class="row" id="added_items">
		<div class="cartsec">
        	<img src="{{url('/')}}/img/ajax-loader.gif" class="loader">
		</div>
        </div>
      </div> 
  </div>
</div>   
@endsection  
