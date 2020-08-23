@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Plan')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Add Plan')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">    
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Add Plan')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="cat-form" method="POST" action="{{route('plans.store')}}" enctype="multipart/form-data">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Title')}}</label>
                                    <div class="input text">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" required>
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
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" min="0" name="price" placeholder="Price" required>
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
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Duration" min="1" required>
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
                    name: "required",
                },
                messages: {
                    name: "Please enter name",
                }
            });
               
            
        });

        $(function () {
            //Initialize Select2 Elements
         $('.select2').select2()
        })

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
        
        $(function () {
         CKEDITOR.replace('description')
        })
    </script>
@endsection
