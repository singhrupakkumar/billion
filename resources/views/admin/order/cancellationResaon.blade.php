@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    {{__('Reasons')}} 
      <a href="{{route('bookings.cancelresaonAdd')}}" class="btn btn-warning"><i class="fa fa-plus"></i> Add More</a> 
         <small></small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Reasons')}}</a></li>
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
                  <th>{{__('Reason')}}</th>
                  <th>{{__('Created')}}</th>
                  <!-- <th>{{__('Actions')}}</th> -->
                </tr>
                </thead>
                <tbody>
                @if($all->isNotEmpty())
                @foreach($all as $list)
                <tr>
                  <td>{{$list->reason}}</td>
                  <td>{{$list->created_at}}</td>
                  <!-- <td> <a style="margin-left: 23px;" href="{{route('roles.delete',$list->id)}}" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this role?')) { return true; } return false;"><span class="fa fa-trash"></span></a></td> -->
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