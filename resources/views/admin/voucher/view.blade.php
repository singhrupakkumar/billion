@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Coupon Brand

        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>    
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$voucher->name}}</h3> 
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>

                            </tr>
                            <tr>
                                <th>Id</th>
                                <td>{{$voucher->id}}</td>
                            </tr>
 
                            <tr> 
                                <th>Name</th>
                                <td>{{$voucher->name}}</td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td>{!! $voucher->description !!}</td>
                            </tr>
                            
                            <tr>
                                <th>Image</th>
                                <td> 

                                    <img src="{{App\Helper::catImg($voucher->image)}}" style="width: 190px; margin-bottom: 20px;
                                    " class="previewHolder"/>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>




<div class="col-xs-12">

  <!-- Default box -->
  <div class="box">

    <div class="box-header">
        <h3 class="box-title">Coupon Codes</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
         <table id="product-tbl" class="table table-bordered table-striped">
                <thead>
           
                 <tr>
                  <th>{{__('Code')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($voucher->voucher->isNotEmpty())
                @foreach($voucher->voucher as $list)
                <tr>
                  <td>{{$list->code}}</td>
                </tr>
                @endforeach
                @endif
                </tbody>
              </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->  


</div>  



</div>
</section>

<script>
  $(function () {

    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,  
      'info'        : true,
      'autoWidth'   : true
    })

     $('#product-tbl').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,  
      'info'        : true,
      'autoWidth'   : true
    })


  })
</script> 
@endsection
