@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Offer')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Add Offer')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Add Offer')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="offer-form" method="POST" action="{{route('admin.addOffer')}}" enctype="multipart/form-data">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Image')}}</label>
                                    <div class="input file">
                                        <input type="file" name="image" id="profilePic" class="form-control">
                                     </div>  
                                 </div>
                                 <img class="previewHolder" style="width: 135px;"/>
                            
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
            $("#offer-form").validate({
                rules: {
                    image: "required",
                },
                messages: {
                    icon: "Image required",
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
