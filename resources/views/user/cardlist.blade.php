	@extends('layouts.website')

@section('content')
	<section class="register addCardSection" style="min-height: 522px !important;">
					<div class="container">
						<div class="row">
							<div class="col-lg-10 col-md-10 col-sm-12 col-12 m-auto">
								<div class="register-content">
									<img src="images/register-bg.png">
									<h5 class="mb-4 text-center">Add Card</h5>
									<div class="row mt-4">
										<div class="col-lg-8 col-md-8 col-sm-12 col-12 m-auto">	
											<div class="card-details">
												<span class="delete-info">
													<p class="client-name">John Doe</p>
													<p>XXXX XXXX XXXX 1234</p>
													<a class="cross-btn" href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
												</span>
											</div>	
											<div class="pls-btn text-right">
												<button type="button" class="btn btn-primary form-btn-plus">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</button>
											</div>
											<form class="add-form">							
												<div class="form-group">
													<input class="form-control" type="number" name="" placeholder="1234   1234   1234   1234">
												</div>
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<input type="date" name="bday" min="1000-01-01"
															max="3000-12-31" class="form-control" placeholder="Expiration Date">
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<input class="form-control" type="number" name="" placeholder="CVV">
														</div>
													</div>
												</div>
												<div class="form-group">
													<input class="form-control" type="text" name="" placeholder="Cardholder Name">
												</div>
												<div class="bttns">
													<button type="button" class="read-more-btn" data-toggle="modal" data-target="#reviewModal">Save Changes</button>	            
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
			$(document).ready(function(){
				$(".add-form").css('display','none');
				$(".form-btn-plus").click(function(){
					$(".add-form").toggle('slow');
				});
				
			});
			// $(document).ready(function(){
				$(document).on("click", ".cross-btn", function(){
					if(confirm('Are you sure')){
						$('.delete-info').remove();
					}	
				});
			// });
		</script>

@endsection		