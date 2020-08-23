@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    {{__('Trash Users')}}     <small></small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Users')}}</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{__('Email')}}</th>
                  <th>{{__('Role')}}</th>
                  <th>{{__('Phone')}}</th>
                  <th>{{__('Created')}}</th>
                  <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @php 
                if($alluser->isNotEmpty()){
                
                @endphp	

                @foreach($alluser as $list)
                <tr>
                  <td>{{$list->email}}</td>
                  <td>{{ucfirst($list->type)}}</td> 
                  <td>{{$list->phone}}</td>
                  <td>{{$list->created_at}}</td>
                  <td> 

                    <a style="margin-left: 23px;" href="{{route('admin.undoUser',$list->id)}}" class="btn btn-info btn-xs" onclick="if (confirm('Are you sure you want to resume this user?')) { return true; } return false;"><span class="fa fa-undo"></span></a>
                    <a style="margin-left: 23px;" href="{{route('admin.deleteuser',$list->id."?type=hard")}}" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete permanently?')) { return true; } return false;"><span title="Permament delete" class="fa fa-trash"></span></a>
                  </td>  
                </tr>

                @endforeach
                    @php
                    }
                 @endphp	

     
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