@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Edit Page')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Edit Page')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Edit Page')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="faq-form" method="POST" action="{{route('pages.edit',$page->id)}}">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                          
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Name')}}</label>
                                    <div class="input text">
                                        <input type="text" name="name" placeholder="Name" value="{{$page->name}}" class="form-control  @error('name') is-invalid @enderror"  id="name" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror 
                                    </div>
                                </div>

     
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('Description')}}</label>
                                    <div class="input ans required">
                                    <textarea name="description" class="form-control textarea  @error('description') is-invalid @enderror"  id="description" required>{!! $page->description !!}</textarea>
                                        @error('description')
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
            $("#faq-form").validate({
                rules: {
                    name: "required",
                    description: "required"
                },
                messages: {
                    ques: "Please enter name",
                    description: "Write description please"
                }
            });
        });
        
        $(function () { 
         CKEDITOR.replace('description')
        })
    </script>
@endsection