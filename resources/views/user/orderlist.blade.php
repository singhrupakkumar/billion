@extends('layouts.website')
@section('content')

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
                  <h4>{{__('Order History')}}</h4> 
                  <div class="account_box">
                  	<table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Order Number</th>
                          <th scope="col">Total</th>
                          <th scope="col">Status</th>
                          <th scope="col">Address</th>
                          <th scope="col">Order Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($order->isNotEmpty())
                        @foreach($order as $key => $list)
                        <tr>
                          <th scope="row"><a href="{{route('orderDetails',base64_encode($list->id))}}">{{$key+1}}</a></th>
                          <td><a href="{{route('orderDetails',base64_encode($list->id))}}">{{$list->order_number}}</a></td>
                          <td>{{$list->currency}} {{$list->total}}</td>
                          <td>{{$list->orderStatus? $list->orderStatus->name:''}}</td>
                          <td>{{$list->address}}</td>
                          <td>{{date_format(date_create($list->created_at),'j F, Y H:i')}}</td>
                        </tr>
                        @endforeach
                        @endif
               
                      </tbody>
                    </table>
                    {{ $order->appends($_GET)->links() }}
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