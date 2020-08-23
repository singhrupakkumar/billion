@extends('layouts.website')

@section('content')
<section class="register"> 
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-md-10 col-sm-12 col-12 m-auto">
			<div class="register-content reset-pass">
				<img src="{{url('/')}}/images/register-bg.png">
				<h2 class="mb-4 text-center">Add Card</h2>
				<ul class="add-cards text-center">
					<li><a href="#"><img src="{{url('/')}}/images/card1.png"></a></li>
					<li><a href="#"><img src="{{url('/')}}/images/card2.png"></a></li>
					<li><a href="#"><img src="{{url('/')}}/images/card3.png"></a></li>
					<li><a href="#"><img src="{{url('/')}}/images/card4.png"></a></li>
				</ul> 
				<div class="row mt-4">
					<div class="col-lg-8 col-md-8 col-sm-10 col-12 m-auto">
						<form method="POST" action="{{route('addCard')}}"  id="pay-form">	
						@csrf
							<div class="form-check form-check-inline form-radio">
								<label class="form-check-label">
									<input class="form-check-input radio-btn" type="radio" name="inlineRadioOptions" value="option1">
									Credit/Debit card
									<span class="label-text-radio"></span>
								</label>
								<label class="form-check-label">
									<input class="form-check-input radio-btn" type="radio" name="inlineRadioOptions" value="option1">
									<span class="label-text-radio1"></span>
									Paypal
								</label>
							</div>									
							<div class="form-group">
								<input class="form-control @error('card_number') is-invalid @enderror" type="number" name="card_number" id="card_number" value="{{ !empty($card) ? $card->card_number : '' }}" placeholder="Card Number">
								@error('card_number')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror 
							</div>
							<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<select class="form-control" name="expired_month" id="expired_month">
										<option value="01" @php if(!empty($card) && '01' == $card->expired_month){ echo "selected"; } @endphp>January</option>
										<option value="02" @php if(!empty($card) && '02' == $card->expired_month){ echo "selected"; } @endphp>February </option>
										<option value="03" @php if(!empty($card) && '03' == $card->expired_month){ echo "selected"; } @endphp>March</option>
										<option value="04" @php if(!empty($card) && '04' == $card->expired_month){ echo "selected"; } @endphp>April</option>
										<option value="05" @php if(!empty($card) && '05' == $card->expired_month){ echo "selected"; } @endphp>May</option>
										<option value="06" @php if(!empty($card) && '06' == $card->expired_month){ echo "selected"; } @endphp>June</option>
										<option value="07" @php if(!empty($card) && '07' == $card->expired_month){ echo "selected"; } @endphp>July</option>
										<option value="08" @php if(!empty($card) && '08' == $card->expired_month){ echo "selected"; } @endphp>August</option>
										<option value="09" @php if(!empty($card) && '09' == $card->expired_month){ echo "selected"; } @endphp>September</option>
										<option value="10" @php if(!empty($card) && '10' == $card->expired_month){ echo "selected"; } @endphp>October</option>
										<option value="11" @php if(!empty($card) && '11' == $card->expired_month){ echo "selected"; } @endphp>November</option>
										<option value="12" @php if(!empty($card) && '12' == $card->expired_month){ echo "selected"; } @endphp>December</option>
									</select>
								</div>
								<div class="col-md-4">
									<select class="form-control" name="expired_year" id="expired_year">  
									@php 
									for($i = date('Y',strtotime('+1 year')); $i <= date('Y', strtotime('+15 year')); $i++)
									{
									@endphp
									<option value="{{$i}}" @php if(!empty($card) && $i == $card->expired_year){ echo "selected"; } @endphp> {{$i}}</option>
									@php
									}
									@endphp
									</select>
								</div>
							</div>
							</div>
							<div class="form-group">
								<input class="form-control @error('card_holder') is-invalid @enderror" type="text" name="card_holder" id="card_holder" value="{{ !empty($card) ? $card->card_holder : '' }}" placeholder="Cardholder Name">
								@error('card_holder')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror 
							</div>
							<div class="bttns">
								<button type="submit" class="read-more-btn" data-toggle="modal" data-target="#reviewModal">Verify</button>	
								<p><a href="{{route('profile')}}">Skip</a></p>               
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>  

<script>
$("#pay-form").validate({
    rules:{
        card_number: {
            required: true,
            creditcard: true
        },
        expired_year: "required",
        card_holder: "required"
    },
    messages:{
        number: {
            required: "Card number is required",
            creditcard: "Please enter valid card number"
        },
        expired_year: "Select expiry year",
        card_holder: "Cardholder\'s Name is required"
    }
});
</script>
@endsection