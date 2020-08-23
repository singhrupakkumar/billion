@extends('layouts.website')
@section('content')

<div class="smart_container">
  <div class="cart_wrapper pb-5">
     <div class="container">
        <div class="row">
		
		<div class="col-sm-12 col-lg-6 m-auto">
		<div class="row">

     @if($plan->isNotEmpty())
      @foreach($plan as $key=> $list)
           <div class="col-xs-12 col-md-6">
		   
            <div class="packagebox panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{$list->title}}</h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                           AED {{$list->price}}</h1>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                             Duration:    {{$list->duration}} Month
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                View {{$list->duration}} month live auction
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <form action="{{route('buyPlan')}}" method="post">
                      @csrf
                      <input type="hidden" name="plan_id" value="{{$list->id}}">
                      <button type="submit" class="addtocart"><i class="fab fa-cc-paypal" aria-hidden="true"></i> Perchase</button>
                    </form>
                </div>
            </div>
        </div>
              @endforeach
          @endif
</div>
</div>

        </div>
        </div>
    </div>
 </div>

@endsection