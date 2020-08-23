@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Change Password')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Change Password')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Change Password')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" id="changepassword" action="{{route('admin.changepassword',$user_id)}}">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                          

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Password')}}</label>
                                    <div class="input password">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>

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
            $("#changepassword").validate({
                rules: {
                    password: "required",
                    password_confirmation: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: "Password is required",
                    password_confirmation: {
                        equalTo: "Password and confirm password should be same"
                    }
                }
            });
        });
    </script>
  @endsection
