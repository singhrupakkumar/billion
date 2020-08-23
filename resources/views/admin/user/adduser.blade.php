@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('User')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Add User')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Add User')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="user-form" method="POST" action="{{route('admin.adduser')}}" enctype="multipart/form-data">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                          
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Full Name')}}</label>
                                    <div class="input text">
                                        <input type="text" name="name" placeholder="Full Name" class="form-control  @error('name') is-invalid @enderror"  id="name" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror 
                                    </div>
                                </div>

                      
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('Email')}}</label>
                                    <div class="input email required">
                                    <input type="email" name="email" placeholder="Email Address" class="form-control  @error('email') is-invalid @enderror"  id="email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Phone')}}</label>
                                    <div class="input tel required">
                                        <input type="tel" name="phone" class="form-control" autocomplete="off" maxlength="12" required="required" id="phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Country')}}</label>
                                    <select class="form-control" name="country" id="exampleFormControlSelect1">
										      <option value="">{{ __('Select Country') }}</option> 
                                              @php 
                                                $result = App\Country::countrieslist();
                                                if($result->isNotEmpty()){
                                              @endphp
                                              @foreach($result as $list)
                                              <option value="{{ $list->name }}">{{ $list->name }}</option>
                                              @endforeach
                                              @php
												} 
											  @endphp	      
										    </select>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Password')}}</label>
                                    <div class="input password">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Confirm Password')}}</label>
                                    <div class="input password">
                                    <input id="password_confirmation" type="password" class="form-control" placeholder="Confirm your Password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div> -->  

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Image')}}</label>
                                    <div class="input file">
                                        <input type="file" name="image" id="profile_picture" class="form-control">
                                     </div>  
                                 </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button class="btn btn-success" type="submit">{{__('Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $().ready(function() {
            $("#user-form").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        //digits: true
                    },

                    password: "required",
                    password_confirmation: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: "Please enter your full name",
                    email: "Please enter a valid email address",
                    phone: "Please enter valid phone number",
                    password: "Password is required",
                    password_confirmation: {
                        equalTo: "Password and confirm password should be same"
                    }
                }
            });
        });
    </script>
@endsection
