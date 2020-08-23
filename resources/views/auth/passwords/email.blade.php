@extends('layouts.website')

@section('content')


<div class="smart_container">
  <div class="myaccount_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-6 m-auto">

                <div class="account_box_wrapper">
                  <h4 style="text-align: center;">{{__('Forgot Password')}}</h4>
                  <div class="account_box">
                    
                    <div class="account_box_item">
                        <div class="personal_details_sec">
                          <div class="formbox">
                            <form method="POST" id="forgot-form" action="{{ route('password.email') }}"> 
                             @csrf 
                              <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>

                              <div class="row mt-5">
                                <div class="col-md-8 m-auto">
                                  <button type="submit" class="btn btn-dark btn-block">{{__('Submit')}}</button>
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
            $("#forgot-form").validate({
                rules: {
                    email: {
                        required: true,
                        email:true
                    }
                } 
            });
        });
</script>
@endsection