@extends('layouts.website')



@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/css/intlTelInput.css">

<div class="smart_container">
      <div class="register_sec">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 m-auto">
              <div class="register_inner">
                <nav class="registertabs">
                  <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link" id="login-box-tab"  href="{{route('login')}}" role="tab" aria-controls="login-box" aria-selected="false">Login</a>
                    <a class="nav-item nav-link active" id="signup-box-tab" href="{{route('register')}}" role="tab" aria-controls="signup-box" aria-selected="true">Register</a>
                  </div>
                </nav>
                <div class="tab-content registertabs_content" id="nav-tabContent">
                  <div class="tab-pane fade show" id="login-box" role="tabpanel" aria-labelledby="login-box-tab">
                    <div class="formbox p-md-5">
                     <form method="POST" action="{{ route('login') }}">
                        <div class="form-group">
                         
                              <input id="email" type="email" placeholder="Email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" aria-describedby="emailHelp" autofocus>

                                @error('email')

                                  <span class="invalid-feedback" role="alert">

                                    <strong>{{ $message }}</strong>

                                  </span>

                                @enderror
                        </div>
                        <div class="form-group">
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                        @error('password')

                          <span class="invalid-feedback" role="alert">

                            <strong>{{ $message }}</strong>   

                          </span>

                        @enderror
                        </div>
                        <div class="rememberme">
                        <div class="custom-control custom-checkbox mr-sm-2">
                          <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label class="custom-control-label" for="customControlAutosizing">{{ __('Remember Me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Forgot Password') }} ?</a>
                        @endif
                        </div>
                        <div class="row mt-5">
                          <div class="col-md-8 m-auto">
                            <button type="submit" class="btn btn-dark btn-block">Login</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="tab-pane show active" id="signup-box" role="tabpanel" aria-labelledby="signup-box-tab">
                    <div class="formbox p-md-5">
                      <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="formlist">
                          <div class="form-group">
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                            @error('first_name')

                                <span class="invalid-feedback" role="alert">

                                    <strong>{{ $message }}</strong>

                                </span>

                            @enderror
                          </div>
                          <div class="form-group">
                           <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>



                            @error('last_name')

                                <span class="invalid-feedback" role="alert">

                                    <strong>{{ $message }}</strong>

                                </span>

                            @enderror 
                          </div>
                        </div>
                        <div class="form-group">
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">



                        @error('email')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                        @enderror
                        </div>
                        <div class="form-group">
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">



                        @error('password')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                        @enderror
                        </div>
                        <div class="form-group">
                         <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                        </div>

         
                          <div class="form-group">
                             <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required autocomplete="phone">

                            @error('phone')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                            @enderror
                          </div>
               

                        <div class="form-group">
                          <input class="form-control" type="text" name="referral_by" placeholder="Invitation Code">
                        </div>

                        <div class="rememberme">
                        <div class="custom-control custom-checkbox mr-sm-2">
                          <input type="checkbox" class="custom-control-input" name="accept" value="accept" id="accept">
                           @error('accept')
                                <span class="accept-error" role="alert"> 
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror

                          <label class="custom-control-label" for="accept">{{ __('By signing up you agree to our') }} <a href="{{ url('/') }}/pages/termofuse" target="_blank">{{ __('User Agreement,') }}</a> <a href="{{ url('/') }}/pages/privacypolicy" target="_blank"> {{ __('Privacy Policy') }} </a>and 
                            Draw <a href="{{ url('/') }}/pages/termofuse" target="_blank">{{ __('Terms & Conditions') }}</a></label>
                        </div>
                        </div>
                        <div class="row mt-5">
                          <div class="col-md-8 m-auto">
                            <button type="submit" class="btn btn-dark btn-block">Register now</button>
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

