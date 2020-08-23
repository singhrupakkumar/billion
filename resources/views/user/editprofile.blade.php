@extends('layouts.website')



@section('content')



<section class="register">

<div class="container">

	<div class="row">

		<div class="col-lg-10 col-md-10 col-sm-12 col-12 m-auto">

			<div class="register-content text-center">

				<img src="images/register-bg.png">

				<h5 class="mb-4">Edit Profile</h5>

		

				<div class="row mt-4">

					<div class="col-lg-8 col-md-8 col-sm-10 col-12 m-auto">

					<form class="edit-profile" method="POST" action="{{route('editprofile')}}" enctype="multipart/form-data">

                                            @csrf

							<div class="profile-pic">

								<span class="img-client">

									<img class="previewHolder" src="{{App\Helper::userimg(Auth::user()->profile_picture)}}">

								</span>

								

								<span class="cam-icn">

								<input type="file" id="profilepic" name="profile_picture">

									<i class="fa fa-camera cam-icon" aria-hidden="true"></i>

								</span>

							</div>

							<div class="form-group">

							<input type="text" class="form-control" id="first_name" name="first_name" value="{{Auth::user()->first_name}}" placeholder="Enter Your First Name">

							</div>

							<div class="form-group">

							<input type="text" class="form-control" id="last_name" name="last_name" value="{{Auth::user()->last_name}}" placeholder="Enter Your Last Name">

							</div>

							<div class="form-group">

								<input class="form-control" type="tel" name="telephone" id="phone" name="phone" value="{{Auth::user()->phone}}" placeholder="Number">

							</div>

							<div class="form-group">

							<input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" placeholder="Enter your Email Address">



							</div>

							<div class="form-group">

								<input class="form-control" type="text" name="country" id="country" value="{{Auth::user()->country}}" placeholder="Country">

							</div>

							<div class="form-group">

								<input class="form-control" type="text" name="city" id="city" value="{{Auth::user()->city}}"  placeholder="Enter your City">

							</div>

							<div class="form-group">

								<input class="form-control" type="text" name="zip" id="zip" value="{{Auth::user()->zip}}" placeholder="Enter Postal Code">

							</div>

							<div class="bttns edit-bttns">

								<button type="submit" class="btn btn-primary read-more-btn">Save Changes</button>

								<a href="{{route('changepassword')}}">Change password</a>

							</div>

						</form>

						

					</div>

				</div>

				<div class="forgot-bttns">

					<a class="addCard-btn" href="{{route('cardList')}}">Add Card</a>

					<a class="manage-btn" href="{{route('manageAddress')}}?tab=home">Manage Address</a>

				</div>

			</div>

		</div>

	</div>

</div>

</section>

<script>

function readURL(input) {

  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {

      $('.previewHolder').attr('src', e.target.result);

    }

    reader.readAsDataURL(input.files[0]);

  }

}

$("#profilepic").change(function() {

  readURL(this);

});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/intlTelInput.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/utils.js"></script> 

<script type="text/javascript">



var input = document.querySelector("#phone");

window.intlTelInput(input, {

  nationalMode: false,

  defaultCountry: "us",    

  preferredCountries: ["us"],

  hiddenInput: "phone",

  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/utils.js" // just for formatting/placeholders etc

});

</script> 

    @endsection