@extends('layouts.admin')
@section('content')
<section class="content-header">
        <h1>
    Page

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
                        <h3 class="box-title">{{$page->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>

                                </tr>
                                <tr>
                                    <th>Id</th>
                                    <td>{{$page->id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$page->name}}</td>
                                </tr>
             
                           
                        

                                 <tr>
                                  <th>Description</th>
                                  <td>{!! $page->description !!}</td>
                                </tr>
                             

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </section>
  @endsection
