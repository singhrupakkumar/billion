@extends('layouts.website')
@section('content')

<div class="smart_container">
  <div class="contact_wrapper">
    <div class="contact_map">
        @if(\App\Config::get_field('map')) {!! \App\Config::get_field('map') !!}  @endif
    </div> 
      <div class="container">
        
        <div class="contactbox">
          <h3>{{ __('Contact Us') }}</h3>    
        <div class="row">
          
          <div class="col-md-6">
            <div class="contactform">
              <p class="mb-4">{{ __('Please fill in the form below and a dedicated member of 
                our team will be in touch within 24 hrs') }}</p>    
                <form action="{{route('contact')}}" method="POST" id="contact">
                                @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                         <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="{{__('First Name')}}" required>
                        @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="{{__('Last Name')}}" /> 
                        @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                     <input type="email" class="form-control" id="contactemail" name="email" value="{{ old('email') }}" placeholder="{{__('Email Address')}}" required>
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="{{__('Message')}}" required>{{ old('message') }}</textarea> 
                    @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                     @enderror
                  </div>

                  <div class="w-100 text-center">
                    <button type="submit" class="btn btn-dark pl-5 pr-5 m-auto">{{ __('Send Message') }}</button>
                  </div>

                </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="contact_info">
              <div class="contact_infosec">
              
              <h4>{{ __('Billonaire Headquarters') }}</h4>
              
              <ul>
                <li>
                  <span><img src="../images/home.svg"></span>
                  @if(\App\Config::get_field('address')) {{ \App\Config::get_field('address') }}  @endif
                </li>

                <li>
                  <span><img src="../images/call.svg"></span>
                  <div class="contact_infobox">
                    <p>{{ __('Call us now') }}</p>
                    <h4>@if(\App\Config::get_field('phone')) {{ \App\Config::get_field('phone') }} @else {{ env('ADMIN_PHONE') }} @endif</h4>
                  </div>
                </li>

                <li>
                  <span><img src="../images/email.svg"></span>
                  <div class="contact_infobox">
                    <p>{{ __('Write us an email') }}</p>
                    <h4>@if(\App\Config::get_field('email')) {{ \App\Config::get_field('email') }} @else {{ env('ADMIN_EMAIL') }} @endif</h4>
                  </div>
                </li>
              </ul>
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
            $("#contact-form").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    subject: "required",
                    message: "required",
                } 
            });
        });
</script>
@endsection