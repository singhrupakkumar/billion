@extends('layouts.admin')
@section('content')
<section class="content-header">
        <h1>
        Enquiry View

    <small></small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Enquiry View</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Submitted on</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">



            <form method="post">
            @csrf
            <div class="panel panel-primary">
            <div class="panel-heading">Mark to Reply</div>
            <div class="panel-body">
            
            <div class="col-md-4" data-select2-id="5">

                <br>	<br>
            <input type="submit" name="assign_to_technician" value="Click to Mark" class="btn btn-primary">
                </div>	
                    
            </div>
            </div>
            
            </form>


                    
                        <table class="table table-condensed">
                            <tbody>
                                <tr>

                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$contact->name}}</td>
                                </tr>

                                 <tr>
                                  <th>Email</th>
                                  <td>{{$contact->email}}</td> 
                                </tr>

                                
                                <tr>
                                  <th>Phone</th>
                                  <td>{{$contact->phone}}</td>
                                </tr>

                                <tr>
                                  <th>Subject</th>
                                  <td>{{$contact->subject}}</td>
                                </tr>

                                <tr>
                                  <th>Status</th> 
                                  <td>@if($contact->status ==0) <span class="btn btn-danger btn-xs">{{__('Reply Pending')}}</span> @else <span class="btn btn-success btn-xs">{{__('Replied')}}</span> @endif</td>
                                </tr>

                                <tr>
                                  <th>Query</th>
                                  <td>{!! $contact->message !!}</td>
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
