@extends('layouts.website')

@section('content')

<section class="register">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 col-12 m-auto">
                <div class="register-content text-center">
                    <img src="images/register-bg.png">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-12 m-auto">
                            <h5 class="mb-4">{{__('Manage Address')}}</h5>
                            <div class="manage-address">
                                <ul class="nav nav-tabs listing nav-justified" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if(request('tab') =='home') active @endif" id="homeTab"  href="{{route('manageAddress')}}?tab=home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(request('tab') =='gifts') active @endif" id="giftsTab" href="{{route('manageAddress')}}?tab=gifts" role="tab" aria-controls="profile" aria-selected="false">Gifts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if(request('tab') =='others') active @endif" id="othersTab" href="{{route('manageAddress')}}?tab=others" role="tab" aria-controls="contact" aria-selected="false">Others</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                @if(request('tab') =='home')
                                    <div class="tab-pane fade @if(request('tab') =='home') show active @endif" id="home" role="tabpanel" aria-labelledby="homeTab">
                                    <form method="POST" action="{{ route('manageAddress') }}?tab=home">
                                        @csrf
                                            <div class="form-group">
                                                <input class="form-control" type="hidden" name="type" value="home">
                                                
                                                    <select class="form-control" name="country" id="exampleFormControlSelect1" required>
                                                        <option value="">{{ __('Select Country') }}</option> 
                                                        @php 
                                                            $result = App\Country::countrieslist();
                                                            if($result->isNotEmpty()){
                                                        @endphp
                                                        @foreach($result as $list)
                                                        <option value="{{ $list->name }}" @if(!empty($homeAddress) && $homeAddress->country ==$list->name) selected @endif>{{ $list->name }}</option>
                                                        @endforeach
                                                        @php
                                                            } 
                                                        @endphp	      
                                                    </select>
                                               
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="city" value="{{ !empty($homeAddress) ? $homeAddress->city : '' }}"  placeholder="City">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="zip" value="{{ !empty($homeAddress) ? $homeAddress->zip : '' }}" placeholder="Zip">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" type="text" name="address" placeholder="#9524 Summer Street Asheville,NC 28803">{!! !empty($homeAddress) ? $homeAddress->address : '' !!}</textarea>
                                            </div>
                                            <div class="bttns edit-bttns">
                                                <button type="submit" class="btn btn-primary read-more-btn">{{__('Submit')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                    @elseif(request('tab') =='gifts')
                                    <div class="tab-pane fade @if(request('tab') =='gifts') show active @endif" id="gifts" role="tabpanel" aria-labelledby="giftsTab">
                                    <form method="POST" action="{{ route('manageAddress') }}?tab=gifts">
                                    @csrf
                                            <div class="form-group">
                                                <input class="form-control" type="hidden" name="type" value="gifts">
                                                <select class="form-control" name="country" id="exampleFormControlSelect1" required>
                                                        <option value="">{{ __('Select Country') }}</option> 
                                                        @php 
                                                            $result = App\Country::countrieslist();
                                                            if($result->isNotEmpty()){
                                                        @endphp
                                                        @foreach($result as $list)
                                                        <option value="{{ $list->name }}" @if(!empty($giftsAddress) && $giftsAddress->country ==$list->name) selected @endif>{{ $list->name }}</option>
                                                        @endforeach
                                                        @php
                                                            } 
                                                        @endphp	      
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="city" value="{{ !empty($giftsAddress) ? $giftsAddress->city : '' }}"  placeholder="City">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="zip" value="{{ !empty($giftsAddress) ? $giftsAddress->zip : '' }}" placeholder="Zip">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" type="text" name="address" placeholder="#9524 Summer Street Asheville,NC 28803">{!! !empty($giftsAddress) ? $giftsAddress->address : '' !!}</textarea>
                                            </div>
                                            <div class="bttns edit-bttns"> 
                                                <button type="submit" class="btn btn-primary read-more-btn">{{__('Submit')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                    @else
                                    <div class="tab-pane fade @if(request('tab') =='others') show active @endif" id="others" role="tabpanel" aria-labelledby="othersTab">
                                    <form method="POST" action="{{ route('manageAddress') }}?tab=others">
                                    @csrf
                                            <div class="form-group">
                                                <input class="form-control" type="hidden" name="type" value="others">
                                                <select class="form-control" name="country" id="exampleFormControlSelect1" required>
                                                        <option value="">{{ __('Select Country') }}</option> 
                                                        @php 
                                                            $result = App\Country::countrieslist();
                                                            if($result->isNotEmpty()){
                                                        @endphp
                                                        @foreach($result as $list)
                                                        <option value="{{ $list->name }}" @if(!empty($othersAddress) && $othersAddress->country ==$list->name) selected @endif>{{ $list->name }}</option>
                                                        @endforeach
                                                        @php
                                                            } 
                                                        @endphp	      
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="city" value="{{ !empty($othersAddress) ? $othersAddress->city : '' }}"  placeholder="City">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="zip" value="{{ !empty($othersAddress) ? $othersAddress->zip : '' }}" placeholder="Zip">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" type="text" name="address" placeholder="#9524 Summer Street Asheville,NC 28803">{!! !empty($othersAddress) ? $othersAddress->address : '' !!}</textarea>
                                            </div>
                                            <div class="bttns edit-bttns">
                                                <button type="submit" class="btn btn-primary read-more-btn">{{__('Submit')}}</button>
                                            </div>
                                    </form>
                                    </div> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection