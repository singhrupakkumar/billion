@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{__('Users')}}<a href="{{route('admin.adduser')}}" class="btn btn-warning"><i class="fa fa-plus"></i> Add User</a>      <small></small>
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
                <div class="col-md-4">            
                    <form role="search">   
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchquery" value="{{Request('searchquery')}}"
                                   placeholder="Search keyword" required="required"> <span class="input-group-btn">
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
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Last Login')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @if($alluser->isNotEmpty())    
                    @foreach($alluser as $list)
                    <tr>
                        <td>{{$list->first_name}} {{$list->last_name}}</td>
                        <td>{{$list->email}}</td>
                        <td>{{$list->phone}}</td>
                        <td>{{$list->last_login}}</td>    
                        <td>{{$list->created_at}}</td>
                        <td>
                            <a href="{{route('admin.profile',$list->id)}}" title="View" class="btn btn-info btn-xs"><span class="fa fa-eye"></span><span class="sr-only">View</span></a>                      
                            <a href="{{route('admin.edituser',$list->id)}}" title="Edit" class="btn btn-success btn-xs"><span class="fa fa-pencil"></span><span class="sr-only">Edit</span></a> 
                            <a href="{{route('admin.changepassword',$list->id)}}" title="Change Password" class="btn btn-warning btn-xs"><span class="fa fa-key"></span><span class="sr-only">Change Password</span></a>                        

                            <a style="margin-left: 23px;" href="{{route('admin.deleteuser',$list->id."?type=soft")}}" class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this user?')) {
                                        return true;
                                    }
                                    return false;"><span class="fa fa-trash"></span></a>
                              

                        </td>     
                    </tr>  
                    @endforeach
                    @endif
                </tbody>
            </table>
            {{ $alluser->appends($_GET)->links() }}  
              
        </div>     
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection