@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Edit City')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Edit City')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Edit City')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="city-form" method="POST" action="{{route('admin.editCity',$data->id)}}" enctype="multipart/form-data">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">

                          
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Name')}}</label>
                                    <div class="input text">
                                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$data->name}}" placeholder="Name" required>
                                      @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror 
                                    </div>
                                </div>
                            
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button class="btn btn-success" type="submit">{{__('Update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $().ready(function() {
            $("#city-form").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter name",
                   
                }
            });
        });

    </script>
@endsection
