@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    {{__('FAQ')}}   <a href="{{route('needhelps.add')}}" class="btn btn-warning"><i class="fa fa-plus"></i> Add FAQ</a>    <small></small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('FAQ')}}</a></li>
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
                  <th>{{__('Question')}}</th>
                  <!-- <th>{{__('For')}}</th> -->
                  <th>{{__('Answer')}}</th>
                  <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>

                @if($all->isNotEmpty())
                @foreach($all as $list)
                <tr>
                  <td>{{$list->ques}}</td>
                  <!-- <td>{{ucfirst($list->type)}}</td> -->
                  <td>{!! $list->ans !!}</td>
                  <td>
                  
                    <a href="{{route('needhelps.edit',$list->id)}}" title="Edit" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span><span class="sr-only">Edit</span></a> 
                    <a href="{{route('needhelps.delete',$list->id)}}" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this help?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
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