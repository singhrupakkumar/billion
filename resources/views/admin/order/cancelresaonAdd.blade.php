@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
    {{__('Reason')}}
    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            <li class="active">{{__('Add Reason')}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Add Reason')}}</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="reason-form" method="POST" action="{{route('bookings.cancelresaonAdd')}}">
                       @csrf
                        <div class="box-body">
                            <div class="form-group">
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Reason')}}</label>
                                    <div class="input file">
                                        <input type="text" name="reason" id="reason" class="form-control">
                                     </div>  
                                 </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button class="btn btn-success" type="submit">{{__('Add')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $().ready(function() {
            $("#reason-form").validate({
                rules: {
                    reason: "required",
                },
                messages: {
                    reason: "reason required",
                }
            });
        });

    </script>
@endsection
