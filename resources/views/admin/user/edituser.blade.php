@extends('layouts.admin')

@section('content')



    <section class="content-header">

        <h1>

    {{__('User')}}

    <small></small>

    </h1>

        <ol class="breadcrumb">

            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>

            <li class="active">{{__('Edit User')}}</li>

        </ol>

    </section>



    <section class="content">

        <div class="row">

            <div class="col-xs-8">

                <div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title">{{__('Edit User')}}</h3> 

                    </div>

                    <!-- /.box-header -->

                    <!-- form start -->

                    <form role="form" method="POST" id="edit-form" action="{{route('admin.edituser',$userdata->id)}}" enctype="multipart/form-data">

                        @csrf

                        <div class="box-body">

                            <div class="form-group">

                          

                                <div class="form-group">

                                    <label for="exampleInputEmail1">{{__('First Name')}}</label>

                                    <div class="input text">

                                        <input type="text" name="first_name" placeholder="First Name" value="{{$userdata->first_name}}"  class="form-control  @error('first_name') is-invalid @enderror"  id="first_name" required>

                                        @error('first_name')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                        @enderror 

                                    </div>

                                </div>

                                    <div class="form-group">

                                    <label for="exampleInputEmail1">{{__('Last Name')}}</label>

                                    <div class="input text">

                                        <input type="text" name="last_name" placeholder="Last Name" value="{{$userdata->last_name}}"  class="form-control"  id="last_name">

                                    </div>

                                </div>



                    

                                <div class="form-group">

                                    <label for="exampleInputPassword1">{{__('Email')}}</label>

                                    <div class="input email required">

                                    <input type="email" name="email" placeholder="Email Address" value="{{$userdata->email}}" class="form-control  @error('email') is-invalid @enderror"  id="email" required>

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

                                        <input type="tel" name="phone" class="form-control" value="{{$userdata->phone}}" autocomplete="off" maxlength="12" required="required" id="phone">

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

                                              <option value="{{ $list->name }}" @if(!empty($userdata->country) && $list->name == $userdata->country) selected @endif>{{ $list->name }}</option>

                                              @endforeach

                                              @php

												} 

											  @endphp	      

										    </select>

                                </div>



                                <!-- <div class="form-group">

                                    <label for="exampleInputEmail1">{{__('About Me')}}</label>

                                    <div class="input file">

                                        <textarea name="about_me" id="about_me" class="form-control textarea">{!! $userdata->about_me !!}</textarea>

                                     </div>  

                                 </div> -->

                          



                                <div class="form-group">

                                    <label for="exampleInputEmail1">{{__('Image')}}</label>

                                    <div class="input file">

                                        <input type="file" name="profile_picture" id="profilePic" class="form-control">

                                     </div>  

                                 </div>

                                 <img src="{{App\Helper::userimg($userdata->profile_picture)}}" class="previewHolder" style="width: 135px;"/>

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

            $("#edit-form").validate({

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

                },

                messages: {

                    name: "Please enter your full name",

                    email: "Please enter a valid email address",

                    phone: "Please enter valid phone number",

                

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



        $("#profilePic").change(function() {

        readURL(this);

        });

    </script>

@endsection

