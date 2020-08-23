@extends('layouts.website')
@section('content')
<div class="smart_container">
  <div class="globle_box faq pt-5 pb-5">
    <div class="container">
      <div class="row pb-5">
        <div class="col-md-8 m-auto">
          <h3>FAQ'S</h3>
          <div id="accordion" class="accordion mt-3">
            <div class="card mb-0">
            	@if($faq->isNotEmpty())
            	@foreach($faq as $k=>$list)
                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$k+1}}">
                    <a class="card-title">
                       {{$list->ques}}
                    </a>
                </div>
                <div id="collapse{{$k+1}}" class="card-body collapse @if($k+1 == 1) show @endif" data-parent="#accordion" >
                 {!! $list->ans !!}
                </div>
                @endforeach
                @endif
               
            </div>
        </div>
    </div>
        </div>
        
      </div>

     

    </div>
  </div>

@endsection  