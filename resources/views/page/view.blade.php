@extends('layouts.website')
@section('content')

<div class="smart_container">
  <div class="globle_box terms_conditions pt-5 pb-5">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$page->name}}</li>  
        </ol>
      </nav>
     
 {!! $page->description !!} 
      

    </div>
  </div>
</div>
@endsection