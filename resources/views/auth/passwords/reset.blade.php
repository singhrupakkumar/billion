@extends('layouts.website')

@section('content')


<div class="smart_container">
  <div class="myaccount_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-6 m-auto">

                <div class="account_box_wrapper">
                  <h4 style="text-align: center;">{{ __('Reset Password') }}</h4>
                  <div class="account_box">
                    
                    <div class="account_box_item">
                        <div class="personal_details_sec">
                          <div class="formbox">
                             <form method="POST" id="reset-form" action="{{ route('password.update') }}">
                              @csrf 
                              <input type="hidden" name="token" value="{{ $token }}">   
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email" autofocus> 

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                   <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('New Password') }}" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                   
                                </div>
                                <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                               
                                </div>

                              <div class="row mt-5">
                                <div class="col-md-8 m-auto">
                                  <button type="submit" class="btn btn-dark btn-block">{{ __('Change Password') }}</button>
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

<script>
        $().ready(function() {
            $("#reset-form").validate({
                rules: {
                    password: "required",
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: "New Password is required",
                    password_confirmation: {
                        required: "Confirm Password is required",
                        equalTo: "New Password and Confirm password should be same"
                    }
                } 
            });
        });
</script>


@endsection