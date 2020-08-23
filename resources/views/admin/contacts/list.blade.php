@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    {{__('Contacts')}} 
  
         <small></small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Contacts')}}</a></li>
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
                  <th>{{__('Email')}}</th>
                  <th>{{__('Subject')}}</th>
                  <th>{{__('Status')}}</th>
                  <th>{{__('Date')}}</th>
                  <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($all->isNotEmpty())
                @foreach($all as $list)
                <tr>
                  <td>{{ucfirst($list->name)}}</td>
                  <td>{{$list->phone}}</td>
                  <td>{{$list->email}}</td>
                  <td>{{$list->subject}}</td>
                  <td>@if($list->status ==0) <span class="btn btn-danger btn-xs">{{__('Reply Pending')}}</span> @else <span class="btn btn-success btn-xs">{{__('Replied')}}</span> @endif</td>
                  <td>{{$list->created_at}}</td>
                  <td>
                  <a href="{{route('contacts.view',$list->id)}}" title="View" class="btn btn-info btn-xs"><span class="fa fa-eye"></span><span class="sr-only">View</span></a>
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
    //$('#example1').DataTable()
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