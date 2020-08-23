@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Plan')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Edit Plan')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">    
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Edit Plan')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="cat-form" method="POST" action="{{route('plans.update',$plan->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                          
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Title')}}</label>
                                    <div class="input text">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{$plan->title}}" placeholder="Title" required>
                                       @error('title')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Price')}}</label>
                                    <div class="input text">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" min="0" value="{{$plan->price}}" name="price" placeholder="Price" required>
                                       @error('price')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Duration (In months)')}}</label>
                                    <div class="input text">
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Duration" min="1" value="{{$plan->duration}}" required>
                                       @error('duration')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror 
                                    </div>
                                </div>
                            
                            </div>
                            <!-- /.box-body --> 

                            <div class="box-footer">
                                <button class="btn btn-info" type="submit">{{__('Submit')}}</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $().ready(function() {
            $("#cat-form").validate({
                rules: {
                    title: "required",
                },
                messages: {
                    name: "Please enter name",
                }
            });
               
            
        });


    </script>
@endsection
