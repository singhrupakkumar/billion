<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyA9Eae9mmycq4_u4TcWCctl6jk1MR9yfQE&libraries=places"></script>

		<!-- ---------FontAwesome CSS Link--------- -->
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<!-- --------Bootstrap CSS Link-------------- -->
		<link rel="stylesheet" type="text/css" href="{{asset('css/website/bootstrap.min.css')}}">
		<!-- -----Main Stylesheet link---- -->		
		<link rel="stylesheet" type="text/css" href="{{asset('css/website/style.css')}}">  
		<title>Billionaire</title>
	
		<link rel="shortcut icon" href="{{url('/')}}/images/logo.png" type="image/x-icon" sizes="16x16">

		<link rel="stylesheet" href="{{asset('fonts/ionicons.css')}}"> 
        <link rel="stylesheet" href="{{asset('css/website/owl.carousel.min.css')}}"> 

        <script src="https://kit.fontawesome.com/09f3a7d784.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="{{asset('js/website/jquery.min.js')}}"></script> 
		<style>
		.accept-error, .error{
			color:red;
		}
		span.fa.fa-star.checked {
    color: #ccc500;
		}
		</style> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/css/intlTelInput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<script>
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

var BaseUrl = '{{url('/')}}';

</script>
  <script type="text/javascript" src="{{asset('js/cart.js')}}"></script>  
	</head>
	<body>
	@include('notification')

      @component('common.header')
      @endcomponent 

      @yield('content')  

      @component('common.footer')
      @endcomponent 
       <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('js/website/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/website/owl.carousel.min.js')}}"></script> 

	

    <script>
      $(function() {
        $(".progress_curcle").each(function() {
          var value = $(this).attr('data-value');
          var left = $(this).find('.progress-left .progress-bar');
          var right = $(this).find('.progress-right .progress-bar');

          if (value > 0) {
            if (value <= 50) {
              right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
            } else {
              right.css('transform', 'rotate(180deg)')
              left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
            }
          }

        })

        function percentageToDegrees(percentage) {

          return percentage / 100 * 360

        }

        });
    </script>
    <script>
      $('.product_list').owlCarousel({
    loop:true,
    margin:20,
    dots:false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
    </script>
	
	<script>
      $('.product_list2').owlCarousel({
    loop:true,
    margin:20,
    dots:false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:1 
        }
    }
})
    </script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
	</body> 
</html>