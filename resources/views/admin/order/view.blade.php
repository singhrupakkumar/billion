@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        View Order

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
                    <h3 class="box-title">{{$order->order_number}}</h3>
                </div>
                
               
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <form method="post" id="form-Assign" onSubmit="return confirm('Are you sure you want to change status?');">   
                        @csrf
                        <div class="col-md-6">   
                            <div class="panel panel-primary"> 
                                <div class="panel-heading">
                                    Change Status
                                </div>
                                <div class="panel-body">

                                    <div class="col-md-12" data-select2-id="5">  

                                        <select name="status" class="form-control select2" required data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            @if($allStatus->isNotEmpty())
                                            @foreach($allStatus as $list)
                                            <option value="{{$list->id}}" @if($list->id==$order->orderStatus->id) selected @endif > {{$list->id}} |  {{$list->name}} </option>
                                            @endforeach
                                            @endif
                                        </select>

                                        <br>    <br> 
                                       
                                        <input type="submit" name="assign_to_technician" value="Submit" class="btn btn-primary">
                                    </div>  

                                </div>
                            </div>
                        </div>

                </form>
                   
                </div>
                
                <div class="col-md-12">
                    
                            <div class="panel panel-primary">
                                <div class="panel-heading">User Detail</div>
                                <div class="panel-body">
                                    @if($order->user != null)
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td><a href="{{ route('admin.profile', $order->user->id) }}" target="_blank">{{ $order->user->first_name }}</a></td>
                                            </tr>
                                            <tr>    
                                                <th>Phone</th>
                                                <td>{{ $order->user->phone }}</td>
                                            </tr>
                                            <tr>    
                                                <th>Email</th>    
                                                <td>{{ $order->user->email !='' ? $order->user->email: '' }}</td>   
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                   
                                    @endif
                                </div> 
                            </div>
                       
                </div>    
                    

                <table class="table table-condensed">
                    <tbody>
                        <tr>

                        </tr>
                        <tr>
                            <th>Id</th>
                            <td>{{$order->id}}</td>
                        </tr>

                        <tr>
                            <th>Order Number</th>
                            <td>{{$order->order_number}}</td>
                        </tr>
                        <tr>
                            <th>Name</th>  
                            <td><a href="{{ route('admin.profile', $order->user->id) }}" target="_blank">{{$order->first_name !=''? $order->first_name:$order->user->first_name}}</a></td>
                        </tr> 

                        <tr>
                            <th>Phone</th>
                              <td><a href="{{ route('admin.profile', $order->user->id) }}" target="_blank">{{$order->phone}}</a></td>
                        </tr>

                        <tr>
                            <th>Payment Status</th>
                            <td>{{$order->payment_status == 0 ? 'Pending' : 'Completed' }}</td>  
                        </tr>
                        <tr>
                            <th>Order Currency</th>
                            <td>{{$order->currency != '' ? $order->currency : '-'}}</td>  
                        </tr> 
                   
                        <tr>
                            <th>Vat</th>
                            <td>{{!empty($order->vat)? $order->vat:0}}</td>     
                        </tr>  

                        <tr>
                            <th>Subtotal</th>
                            <td>{{$order->subtotal}}</td>    
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td>{{$order->total}}</td>    
                        </tr>

                        
                        <tr>
                            <th>Payment Mode</th>
                            <td>{{$order->payment_mode}}</td>    
                        </tr>
                        
                        <tr> 
                            <th>Status</th> 
                            <td>{{ $order->orderStatus->name}}</td>       
                        </tr> 

                         <tr> 
                            <th>Address</th>
                            <td>{{$order->address}}</td>  
                        </tr>
                        
                         <tr> 
                            <th>House No</th>
                            <td>{{$order->house_no}}</td>  
                        </tr>
                        
                        <tr> 
                            <th>City</th>
                            <td>{{$order->city}}</td>  
                        </tr>
                        <tr> 
                            <th>State</th>
                            <td>{{$order->state}}</td>  
                        </tr>
                        <tr> 
                            <th>Postal Code</th>
                            <td>{{$order->zip}}</td>  
                        </tr>

                         <tr> 
                            <th>Country</th>
                            <td>{{$order->country}}</td>  
                        </tr>



                        <tr> 
                            <th>Cancel Reason</th>
                            <td>{{ $order->cancel_reason }}</td>
                        </tr>


                        
                        <tr>
                            <th>Order Date Time</th>
                            <td>{{$order->created_at}}</td>      
                        </tr>
                        
                        <tr>
                            <th>Order Modified</th>
                            <td>{{$order->updated_at}}</td>         
                        </tr>

                    
                    </tbody> 
                </table> 
                    
                    
                    
                 <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Order Items</div>
                        <div class="panel-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>

                                    <tr>
                                        <th>{{__('Product Name')}}</th> 
                                        <th>{{__('Category')}}</th> 
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Price')}}</th>  
                                    </tr>   
                                </thead>
                                <tbody>  
                                    @if($order->orderItem->isNotEmpty())
                                    @foreach($order->orderItem as $list)
                                    <tr>    
                                        <td>{{!empty($list->product_name)? ucfirst($list->product_name): ''}}</td>  
                                        <td>{{!empty($list->category)? $list->category->name:'' }}</td> 
                                        <td>{{$list->qty}}</td>         
                                        <td>{{$list->price}}</td>   
                                    </tr>  
                                    @endforeach
                                    @endif 
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>        

                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Payment Detail</div>
                        <div class="panel-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>

                                    <tr>
                                        <th>{{__('Payment Mode')}}</th>
                                        <th>{{__('Gateway')}}</th>   
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Transaction Id')}}</th>
                                        <th>{{__('Payment Date')}}</th>  
                                    </tr>
                                </thead>
                                <tbody>  
                                    @if($order->payments->isNotEmpty())
                                    @foreach($order->payments as $list)
                                    <tr> 
                                        <td>{{ucfirst($list->payment_method)}}</td>
                                        <td>{{$list->payment_gateway}}</td>
                                        <td>{{$list->amount}}</td>
                                        <td>{{$list->transaction_id}}</td> 
                                        <td>{{$list->created_at}}</td>
                                    </tr>  
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                       

            </div>

        </div>
        <!-- /.box-body -->
    </div>

</div>
</div>
</section>

<script>
    $(document).ready(function () {
        $('.select2').select2();

    });
</script>


@endsection
