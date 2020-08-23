@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">  
    <h1>
    {{__('Payment Redeem Request')}}   <small></small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Payment Redeem Request')}}</a></li>  
      </ol>
    </section>  

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{__('Name')}}</th>
                  <th>{{__('Phone')}}</th>
                  <th>{{__('Amount')}}</th> 
                  <th>{{__('Status')}}</th> 
                  <th>{{__('Created')}}</th>
                  <th>{{__('Actions')}}</th> 
                </tr>
                </thead>
                <tbody>

                @if($request->isNotEmpty())
                @foreach($request as $list)
                <tr>     
                  <td>{{!empty($list->vendor) ? $list->vendor->name:''}}</td>
                  <td>{{!empty($list->vendor) ? $list->vendor->phone:''}}</td>  
                  <td>{{!empty($list->vendor) ? $list->vendor->currency:''}} {{$list->amount}}</td>
                   <td>
                    @if($list->status ==1) <span class="btn btn-success btn-xs">{{__('Complete')}}</span> @elseif ($list->status ==2) <span class="btn btn-danger btn-xs">{{__('Reject')}}</span> @else <span class="btn btn-warning btn-xs">{{__('Open')}}</span> @endif
                   </td>   
                  <td>{{$list->created_at}}</td> 
                  <td>  
                       <a href="{{route('payments.requestDetails',\App\Helper::encodeNum($list->id))}}" title="View" class="btn btn-info btn-xs"><span class="fa fa-eye"></span><span class="sr-only">View</span></a>
                  </td>   
                </tr>  

                @endforeach
                @endif

       
                </tbody>  
              </table>  
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

<script>
  $(function () {
   // $('#example1').DataTable()
    $('#example1').DataTable({
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