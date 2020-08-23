@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Need Help')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Add Need Help')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Add FAQ')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="testimonial-form" method="POST" action="{{route('needhelps.add')}}">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                          
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Question')}}</label>
                                    <div class="input text">
                                        <input type="text" name="ques" placeholder="Question" class="form-control  @error('ques') is-invalid @enderror"  id="ques" required>
                                        @error('ques')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Question For')}}</label>
                                    <div class="input text">
                                    <select name="type" class="form-control  @error('type') is-invalid @enderror"  id="type">
                                        <option value="">{{__('Select Question For')}}</option>
                                        <option value="help">{{__('Help')}}</option>
                                        <option value="faq">{{__('FAQ')}}</option>
                                    </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('Answer')}}</label>
                                    <div class="input ans required">
                                    <textarea name="ans" placeholder="Answer" class="form-control textarea  @error('ans') is-invalid @enderror"  id="ans" required></textarea>
                                        @error('ans')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror  
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
            $("#testimonial-form").validate({
                rules: {
                    ques: "required",
                    type: "required",
                    ans: "required",
                },
                messages: {
                    ques: "Please enter your question",
                    type: "Select Question for",
                    ans: "Write answer please",
                }
            });
        });
    </script>
@endsection