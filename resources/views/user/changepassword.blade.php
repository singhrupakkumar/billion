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
                  <h4>{{__('Change Password')}}</h4>
                  <div class="account_box">
                    
                    <div class="account_box_item">
                        <div class="personal_details_sec">
                          <div class="formbox">
                            <form class="edit-profile" id="changepassword-form" method="POST" action="{{ route('changepassword') }}">
                            @csrf
                              <div class="form-group">
                                <input type="password" class="form-control @error('oldpassword') is-invalid @enderror" id="oldpassword" name="oldpassword" required placeholder="Existing Password">

											@error('oldpassword')

											<span class="invalid-feedback" role="alert">

												<strong>{{ $message }}</strong>

											</span>

											@enderror 
                              </div>
                              <div class="form-group">
                                	<input type="password" class="form-control @error('newpassword') is-invalid @enderror" id="newpassword" name="newpassword" required placeholder="New Password">

                                                @error('newpassword')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>{{ $message }}</strong>

                                                </span>

                                                @enderror
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" id="confirmpassword" name="confirmpassword" required placeholder="Confirm Password">

                                                @error('confirmpassword')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>{{ $message }}</strong>

                                                </span>

                                                @enderror
                              </div>
                        
                              
                              <div class="row mt-5">
                                <div class="col-md-8 m-auto">
                                  <button type="submit" class="btn btn-dark btn-block">Change Password</button>
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
      </div>
  </div>
</div>

<script>
        $().ready(function() {
            $("#changepassword-form").validate({
                rules: {
                    oldpassword: "required",
                    newpassword: "required",
                    confirmpassword: {
                    	required: true,
                        equalTo: "#newpassword"
                    }
                },
                messages: {
                    oldpassword: "Old Password is required",
                    newpassword: "New Password is required",
                    confirmpassword: {
                    	required: "Confirm Password is required",
                        equalTo: "New Password and Confirm password should be same"
                    }
                }
            });
        });
    </script>

@endsection