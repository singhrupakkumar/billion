@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    {{__('Categories')}}    <a href="{{route('admin.addcat')}}" class="btn btn-warning"><i class="fa fa-plus"></i> Add Category</a><small></small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li><a href="#">{{__('Categories')}}</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


     <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$category->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>

                                </tr>
                                <tr>
                                    <th>Id</th>
                                    <td>{{$category->id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$category->name}}</td>
                                </tr>

                                 <tr>
                                  <th>Description</th>
                                  <td>{!! $category->description !!}</td>
                                </tr>
                                <tr>
                                  <th>Icon</th>
                                  <td>
                                  
                                  <img src="{{App\Helper::catImg($category->icon)}}" style="width: 190px; margin-bottom: 20px;
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
                        <h3 class="box-title">Sub Categories</h3>
                    </div>
                  
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                
                      <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Actions')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      @php 
                      if($category->categoryChildren->isNotEmpty()){
                      
                      @endphp	

                      @foreach($category->categoryChildren as $list)
                      <tr>
                        <td>{{$list->name}}</td>
                        <td>{{$list->created_at}}</td>
                        <td>
                        @if(\App\Category::isChild($list->id))
                          <a href="{{route('admin.subCategory',\App\Helper::encodeNum($list->id))}}" title="Sub Category" class="btn btn-warning btn-xs">Sub Category</a>
                         
                        @endif
                        <a href="{{route('admin.questionAdd',\App\Helper::encodeNum($list->id))}}" title="Question" class="btn btn-warning btn-xs">Question</a>
                          <a href="{{route('admin.catview',\App\Helper::encodeNum($list->id))}}" title="View" class="btn btn-info btn-xs"><span class="fa fa-eye"></span><span class="sr-only">View</span></a>                      
                          <a href="{{route('admin.editcat',\App\Helper::encodeNum($list->id))}}" title="Edit" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span><span class="sr-only">Edit</span></a> 
                          <a href="{{route('admin.deletecat',\App\Helper::encodeNum($list->id))}}" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this category?')) { return true; } return false;"><span class="fa fa-trash"></span></a>                      
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


            </div>
        </div>





     

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