@extends('layouts.website')
@section('content')

<div class="smart_container">
  <div class="myaccount_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-10 m-auto">
            <div class="row">
              <div class="col-md-3">
                <div class="left_menu">
                 @include('user.menu',['actionName'=>\Request::route()->getName()])  
                </div> 
              </div>
              <div class="col-md-9">
                <div class="account_box_wrapper">
                  <h4>{{__('Personal Details')}}</h4>
                  <div class="account_box">
                  	 <form class="edit-profile" id="edit-profile" method="POST" action="{{route('editprofile')}}" enctype="multipart/form-data">
                            @csrf
                    <div class="account_box_item"> 
                    <div class="user_info">
                      
                      <div class="user_info_pic">
                        <img class="previewHolder" src="{{App\Helper::userimg(Auth::user()->profile_picture)}}" width="130">
                        <input class="uploadfile" type="file" id="profilepic" name="profile_picture">
                        <i class="fas fa-camera camera_upload"></i>  
                      </div>

                      <div class="user_info_txt">
                        <h5>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                        <h6>{{Auth::user()->email}}</h6>
                      </div>

                    </div>
                    </div>


                    <div class="account_box_item">
                        <h5>{{__('Personal Details')}}</h5>
                        <div class="personal_details_sec">
                          <div class="formbox">

                              <div class="formlist">
                                <div class="form-group">
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{Auth::user()->first_name}}" placeholder="First Name">	
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{Auth::user()->last_name}}" placeholder="Last Name">
	                                @error('last_name')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                                @enderror
                                </div>
                              </div>
                              <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{Auth::user()->email}}" readonly="readonly" placeholder="Email Address">
                                 @error('email')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                              @enderror
                              </div>
                              
                              <div class="form-group">
                                <input class="form-control @error('phone') is-invalid @enderror" type="tel" name="phone" id="phone" name="phone" readonly="readonly" value="{{Auth::user()->phone}}" placeholder="Phone Number">
                                 @error('phone')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                              @enderror
                              </div>
                        
                              
                              <div class="row mt-5">
                                <div class="col-md-8 m-auto">
                                  <button type="submit" class="btn btn-dark btn-block">{{__('Save')}}</button>
                                </div>
                              </div>
                           
                          </div>
                        </div>
                    </div>
                     </form>
                  </div>

                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<script>

 $().ready(function() {
            $("#edit-profile").validate({
                rules: {
                    first_name: "required",
                },
                messages: {
                    first_name: "First Name is required",
                }
            });
});

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
@endsection