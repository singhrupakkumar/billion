@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->

    <section class="content-header">

    <h1>

    {{__('Pages')}}   <a href="{{route('pages.add')}}" class="btn btn-warning"><i class="fa fa-plus"></i> Add Page</a>    <small></small>

    </h1>

      <ol class="breadcrumb">

        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>

        <li><a href="#">{{__('Pages')}}</a></li>

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
                  <th>{{__('Slug')}}</th>
                  <th>{{__('Created')}}</th>

                  <th>{{__('Actions')}}</th>

                </tr>

                </thead>

                <tbody>



                @if($all->isNotEmpty())

                @foreach($all as $list)

                <tr>

                  <td>{{$list->name}}</td>
                  <td>{{$list->slug}}</td>
                  <td>{{$list->created_at}}</td>

                  

                  <td>     

                    <a href="{{route('pages.view',$list->id)}}" title="View" class="btn btn-info btn-xs"><span class="fa fa-eye"></span><span class="sr-only">View</span></a>

                    <a href="{{route('pages.edit',$list->id)}}" title="Edit" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span><span class="sr-only">Edit</span></a> 

                    <!-- <a href="{{route('pages.delete',$list->id)}}" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this help?')) { return true; } return false;"><span class="fa fa-trash"></span></a> -->

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