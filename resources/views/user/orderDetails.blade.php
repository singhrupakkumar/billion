@extends('layouts.website')
@section('content')
<style type="text/css">
  .label{
    font-weight: bold;
  }
</style>
<div class="smart_container">
  <div class="myaccount_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-10 m-auto">
            <div class="row">
              <div class="col-md-3">
                <div class="left_menu">
                 @include('user.menu',['actionName'=>\Request::route()->getName()])  
                </div> 
              </div>
              <div class="col-md-9">
                <div class="account_box_wrapper">
                  <h4>{{__('Order Details')}}</h4>
                  <div class="account_box">

                    <div class="account_box_item"> 
                    <div class="user_info">
                      <div class="user_info_txt">

                        <h5>{{$order->first_name}} {{$order->last_name}}</h5>
                        <h6>{{$order->email}}</h6>
                        <h6>{{$order->phone}}</h6>

                        <p><span class="label">Order Number :</span> <span>{{$order->order_number}}</span></p>
                        <p><span class="label">Date :</span> <span>{{date_format(date_create($order->created_at),'j F, Y H:i')}}</span></p>
                        <p><span class="label">Order Status :</span> <span>{{$order->orderStatus? $order->orderStatus->name:''}}</span></p>
                        <p><span class="label">Payment Status :</span> <span style="color:{{$order->payment_status=1? "green":"red"}};">{{$order->payment_status=1? 'Complete':'Pending'}}</span></p>
                        <p><span class="label">Address :</span> <span>{{$order->address}}</span></p>
                        <p><span class="label">City :</span> <span>{{$order->city}}</span></p>
                        <p><span class="label">Country :</span> <span>{{$order->country}}</span></p>
                      </div>

                    </div>
                    </div>


                    <div class="account_box_item">
                        <h5>{{__('Order Items')}}</h5>

                          <table class="table table-dark">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Image</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if($order->orderItem->isNotEmpty())
                              @foreach($order->orderItem as $key => $list)
                              <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$list->product_name}}</td>
                                <td>{{$list->price}}</td>
                                <td>{{$list->qty}}</td>
                                <td>
                                  <div class="cartproduct">                         
                                    <img src="{{App\Helper::catImg($list->image)}}">                       
                                  </div>
                                </td>
                                
                              </tr>
                              @endforeach
                              @endif
                     
                            </tbody>
                          </table>

                    </div>

                    <div class="account_box_item"> 
                    <div class="user_info">
                      <div class="user_info_txt">
                        <h5>Total: {{$order->currency}} {{$order->total}}</h5>
                      </div>

                    </div>
                    </div>

                  </div>

                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

@endsection