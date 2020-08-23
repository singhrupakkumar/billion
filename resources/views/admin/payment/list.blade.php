@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    {{__('Payments')}}   <small></small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Payments')}}</a></li>
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
                  <th>{{__('Booking No.')}}</th>
                  <th>{{__('TransactionId')}}</th>
                  <th>{{__('Pay By')}}</th>
                  <th>{{__('Created')}}</th>
<!--                  <th>{{__('Actions')}}</th>-->
                </tr>
                </thead>
                <tbody>

                @if($payments->isNotEmpty())
                @foreach($payments as $list)
                <tr>     
                  <td>{{!empty($list->user) ? $list->user->name:''}}</td>
                  <td>{{!empty($list->user) ? $list->user->phone:''}}</td>
                  <td>{{!empty($list->booking) ? $list->booking->payment_currency:''}} {{$list->amount}}</td>
                  <td><a href="{{route('bookings.view',$list->booking_id)}}">{{!empty($list->booking) ? $list->booking->order_number:''}}</a></td>
                  <td>{{$list->transaction_id}}</td>  
                  <td>{{$list->payment_gatway}}</td>  
                  <td>{{$list->created_at}}</td>   
                 
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
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection