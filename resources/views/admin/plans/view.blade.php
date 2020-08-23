@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Category

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

                            <tr>
                                <th>Image</th>
                                <td> 

                                    <img src="{{App\Helper::catImg($category->image)}}" style="width: 190px; margin-bottom: 20px;
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
        <h3 class="box-title">Products</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
         <table id="product-tbl" class="table table-bordered table-striped">
                <thead>
           
                 <tr>
                  <th>{{__('Name')}}</th>
                  <th>{{__('Category')}}</th>
                  <th>{{__('Price')}}</th>
                  <th>{{__('Stock')}}</th>
                  <th>{{__('Image')}}</th>
                  <th>{{__('Country')}}</th>
                  <th>{{__('Created')}}</th>
                  <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($category->products->isNotEmpty())
                @foreach($category->products as $list)
                <tr>
                  <td>{{$list->name}}</td>
                  <td>{{!empty($list->category)?$list->category->name:''}}</td>
                  <td>{{$list->price}}</td>
                  <td>{{$list->stock}}</td> 
                  <td>
                    <img src="{{App\Helper::catImg($list->image)}}" width="100" height="100">
                  </td>  
                  <td>{{$list->created_at}}</td>  
                 <td>    
                  <a href="{{route('products.edit',$list->id)}}" title="Edit" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span><span class="sr-only">Edit</span></a>
                <form action="{{route('products.destroy',$list->id)}}" id="deleteform" method="POST" style="display: none;">
                   @method('DELETE')
                   @csrf
                </form>
                  <a style="margin-left: 23px;" href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this code?')) { document.getElementById('deleteform').submit(); } return false;"><span class="fa fa-trash"></span></a>
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
