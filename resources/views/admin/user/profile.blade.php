@extends('layouts.admin')

@section('content')

<section class="content-header">

        <h1>

    Users



    <small></small>

    </h1>

        <ol class="breadcrumb">

            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">View</li>

        </ol>

    </section>



    <section class="content">

        <div class="row">

            <div class="col-xs-12">



                <div class="box">

                    <div class="box-header">

                        <h3 class="box-title">{{$userdata->first_name}}</h3>

                    </div>

                    <!-- /.box-header -->

                    <div class="box-body no-padding">

                        <table class="table table-condensed">

                            <tbody>

                                <tr>



                                </tr>

                                <tr>

                                    <th>Id</th>

                                    <td>{{$userdata->id}}</td>

                                </tr>

                                <tr>

                                    <th>Full Name</th>

                                    <td>{{$userdata->first_name}} {{$userdata->last_name}}</td>

                                </tr>



                             

                                <tr>

                                    <th>Email</th>

                                    <td>{{$userdata->email}}</td>

                                </tr>

                                <tr>

                                    <th>{{__('Phone')}}</th>

                                    <td>{{$userdata->phone}}</td>

                                </tr>

                                <tr>

                                    <th>{{__('Country')}}</th>

                                    <td>{{$userdata->country}}</td>

                                </tr>

                        



                                 <tr>

                                  <th>About me</th>

                                  <td>{{$userdata->about_me}}</td>

                                </tr>

                                <tr>

                                  <th>Image</th>

                                  <td>

                                  

                                  <img src="{{App\Helper::userimg($userdata->profile_picture)}}" style="width: 190px; margin-bottom: 20px;

                                    " class="previewHolder"/>

                                  </td>

                                </tr>



                            </tbody>

                        </table>

                         <a href="{{route('admin.edituser',$userdata->id)}}" title="Edit Profile" class="btn btn-success btn-xs">Edit Profile</a>

                          <a href="{{route('admin.changepassword',$userdata->id)}}" title="Change Password" class="btn btn-warning btn-xs">Change Password</a>

                    </div>

                    <!-- /.box-body -->

                </div>



            </div>

        </div>

    </section>

  @endsection

