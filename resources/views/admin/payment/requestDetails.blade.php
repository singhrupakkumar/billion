@extends('layouts.admin')
@section('content')
<section class="content-header">
        <h1>
    Request Details 

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
                        <h3 class="box-title">Account Balance: {{ !empty($requestDetails->vendor) ? $requestDetails->vendor->currency : ''}} {{ !empty($requestDetails->vendor->wallet) ? $requestDetails->vendor->wallet->total_earning : '0.00'}}</h3>
                    </div>    
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
    
                        <table class="table table-condensed">
                            <tbody>
                                <tr>

                                </tr>
								
				<tr>
                                    <th>Request Amount</th>
                                    <td>{{ !empty($requestDetails->vendor) ? $requestDetails->vendor->currency : ''}} {{$requestDetails->amount}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ !empty($requestDetails->vendor) ? $requestDetails->vendor->name : ''}}</td>
                                </tr>
								
				<tr>
                                    <th>Phone</th>
                                    <td>{{ !empty($requestDetails->vendor) ? $requestDetails->vendor->phone : ''}}</td>
                                </tr>

				<tr>
                                    <th>Bank Name</th>
                                    <td>{{ !empty($requestDetails->bank) ? $requestDetails->bank->bank_name : ''}}</td>
                                </tr>
                                <tr>
                                    <th>Account Number</th>
                                    <td>{{ !empty($requestDetails->bank) ? $requestDetails->bank->acc_number : ''}}</td>
                                </tr>
                                
                                <tr>
                                    <th>Ifsc/Swift Code</th>
                                    <td>{{ !empty($requestDetails->bank) ? $requestDetails->bank->ifsc_or_swift : ''}}</td>
                                </tr>
                                
                                <tr>
                                    <th>Others Details</th>   
                                    <td>{{ !empty($requestDetails->bank) ? $requestDetails->bank->details : ''}}</td>
                                </tr>

                                <tr>
                                  <th>Request Date</th> 
                                  <td>{{ $requestDetails->created_at }}</td>
                                </tr>
                                
                                
                                <tr>
                                  <th>Action</th>   
                                  <td>  
                                      <a style="margin-left: 23px;" href="#" class="btn btn-success" onclick="if (confirm('Are you sure you want to delete this offer?')) { return true; } return false;">Transfered</a>
                                   
                                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-info">Request Cancel</button>
                                  </td>           
                                </tr>  
                            

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </section>


    <div class="modal modal-info fade" id="modal-info">     
              <div class="modal-dialog">     
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Info Modal</h4>
                  </div>
                  <div class="modal-body">
                    <p>One fine body…</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline">Save changes</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
    </div> 

  @endsection
    