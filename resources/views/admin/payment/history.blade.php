@extends('layouts.admin')
@section('content')
<section class="content-header">
        <h1>
    Wallet History

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
                        <h3 class="box-title">{{$wallet->currency}} {{$wallet->total}}</h3>  
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>

                                </tr>
                                <tr>
                                    <th>Id</th>
                                    <td>{{$wallet->id}}</td>
                                </tr>
                                <tr>
                                    <th>Wallet Amount</th>
                                    <td>{{$wallet->currency}} {{$wallet->total}}</td>
                                </tr> 
                                
                                <tr>
                                    <th>Total Earning</th>  
                                    <td>
                                        {{$wallet->currency}} {{$wallet->total_earning}}
                                        <button class="btn btn-info">View Redeem Request</button>   
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
                        <h3 class="box-title">History</h3> 
                    </div>
                  
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                
                      <tr>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Transaction id')}}</th>
                        <th>{{__('Amount')}}</th>
                        <th>{{__('Payment Gatway')}}</th> 
                        <th>{{__('Created')}}</th>
                   
                      </tr>
                      </thead>
                      <tbody>
                      @php 
                      if($wallet->history->isNotEmpty()){
                      
                      @endphp	

                      @foreach($wallet->history as $list)
                      <tr> 
                        <td>{{$list->type}}</td>
                        <td>{{$list->transaction_id}}</td>
                        <td>{{$wallet->currency}} {{$list->amount}}</td>
                        <td>{{$list->payment_gatway}}</td>   
                        <td>{{$list->created_at}}</td>
                    
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
  @endsection
