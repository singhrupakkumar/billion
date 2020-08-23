@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{__('Coupon Brands')}}   <a href="{{route('vouchers.create')}}" class="btn btn-warning"><i class="fa fa-plus"></i> Add New</a> <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
    <li><a href="#">{{__('Coupon Brands')}}</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">

    <!-- /.box-header -->
    <div class="box-body">
          <div class="row" style="margin-bottom: 10px;">     
                <div class="col-md-2"> 
                    <form role="search" onchange="this.submit();">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <select class="form-control" name="sort">
                                <option value="">Sort By</option>   
                                <option value="ASC" @if(Request('sort') =='ASC') selected @endif>ASC</option>
                                <option value="DESC" @if(Request('sort') =='DESC') selected @endif>DESC</option>
                            </select>
                        </div>
                    </form>  
                </div>
                <div class="col-md-10">          
                    <form role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                         <input type="text" class="form-control" name="searchquery" value="{{Request('searchquery')}}"
                         placeholder="Search" required="required"> <span class="input-group-btn">
                          <button type="submit" class="btn btn-default">
                           <i class="fa fa-search" aria-hidden="true"></i>
                         </button>   
                       </span> 
                     </div>
                    </form>
                </div> 

            </div> 

   <table id="example1" class="table table-bordered table-striped">
    <thead>

     <tr>
      <th>{{__('Name')}}</th>
      <th>{{__('Coupon Count')}}</th>
      <th>{{__('Image')}}</th>
      <th>{{__('Created')}}</th>   
      <th>{{__('Actions')}}</th>
    </tr>
  </thead>
  <tbody>
    @php 
    if($all->isNotEmpty()){

    @endphp	

    @foreach($all as $list)
    <tr>
      <td>{{$list->name}}</td>
      <td>{{$list->voucher_count}}</td>
      <td>
        <img src="{{App\Helper::catImg($list->image)}}" width="100" height="100">
      </td>
      <td>{{$list->created_at}}</td> 
      <td>          
        <a href="{{route('vouchers.show',$list->id)}}" title="View" class="btn btn-info btn-xs"><span class="fa fa-eye"></span><span class="sr-only">View</span></a>                      
        <a href="{{route('vouchers.edit',$list->id)}}" title="Edit" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span><span class="sr-only">Edit</span></a> 
        <form action="{{route('vouchers.destroy',$list->id)}}" id="deleteform{{$list->id}}" method="POST" style="display: none;">
         @method('DELETE')
         @csrf
       </form>
       <a style="margin-left: 23px;" href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this vouchers?')) { document.getElementById('deleteform{{$list->id}}').submit(); } return false;"><span class="fa fa-trash"></span></a>
     </td>             
   </tr>
   @endforeach
   @php
 }
 @endphp	


</tbody> 
</table>  
{{ $all->appends($_GET)->links() }}
</div>   
<!-- /.box-body -->  
</div>
<!-- /.box -->

</section>
<!-- /.content -->

    @endsection