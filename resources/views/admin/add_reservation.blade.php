<!DOCTYPE html>
<html lang="en">
	@include('admin/includes/head')
	<body>
		<div class="loader-wrapper">
			<div class="loader-index"><span></span></div>
			<svg>
				<defs></defs>
				<filter id="goo">
					<fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
					<fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
				</filter>
			</svg>
		</div>
		<div class="page-wrapper compact-wrapper" id="pageWrapper">
			@include('admin/includes/topbar')
			<!-- Page Body Start-->
			<div class="page-body-wrapper">
				@include('admin/includes/sidebar')
				<div class="page-body">
					<div class="container-fluid">
						<div class="row">
							@if(session('success_msg'))
							<div class="alert alert-success mt-2 " role="alert" id="alert">           
								<strong>Success! </strong>{{session('success_msg')}}
							</div>
							@endif  
							@if(session('error_msg'))
							<div class="alert alert-danger mt-2 " role="alert" id="alert">           
								<strong>Error! </strong>{{session('error_msg')}}
							</div>
							@endif
							<div class="col-sm-12 ">
								<div class="card mt-4">
									<div class="card-header">
										<h5>Add Reservation:</h5>
									</div>
									<div class="card-body">
										<form class="needs-validation" novalidate="" method="POST" action="{{url('admin/add_reservation')}}">
											@csrf
											<div class="row g-3 mb-2">
												@if($customer_id!=0)
												<input type="hidden" name="customer" id="customer" value="{{$customer_id}}">
												@else
												<div class="col-md-4 mt-3">
													<label class="form-label" for="">Customer:</label>
													<select  class="form-control" id="customer" name="customer" required>
														<option value="">Select Customer</option>
														@foreach($customers as $customer)
														<option value="{{$customer->id}}">{{$customer->first_name.' '.$customer->last_name}}</option>
														@endforeach
													</select>
												</div>
												@endif

												
												<div class="col-md-4 mt-3">
													<label class="form-label" for="">Service Type</label>
													<select  class="form-control" name="service_name" id="servicetype" onchange="serviceChange()" required>
														<option value="" >Select Service Type</option>
														<option value="package">Package</option>
														<option value="lodging">Lodging</option>
														<option value="visa">VISA</option>
														<option value="flight">Flight</option>
														<option value="transport">Transport</option>
													</select>
												</div>
												<div class="col-md-12" id="lodging" style="display:none">
													<div class="row">
														<div class="col-md-12">
															<h6>Lodging:</h6>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Destination</label>
															<select  class="form-control" name="lodging_destination" >
																<option value="" >Select Destination</option>
																<option value="Al Madina">Al Madina</option>
																<option value="Al Makkah">Al Makkah</option>
																<option value="Both">Both</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Hotel in Madina</label>
															<select  class="form-control" name="lodging_madina" id="madina_lodging" onchange="cal_lodging_service_price()">
																<option value="" >Select Hotel</option>
																@foreach($lodging_madina as $loadging)
																<option value="{{$loadging->id}}">{{$loadging->hotel_name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Room Type in Madina</label>
															<select  class="form-control" name="room_type_madina" id="madina_room_type" onchange="cal_lodging_service_price()">
															<option value="" >Select Room Type</option>
															<option value="room_for_two">Room For 2</option>
															<option value="room_for_three">Room For 3</option>
															<option value="room_for_four">Room For 4</option>
															<option value="room_for_five">Room For 5</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From</label>
															<input type="date" name="lodging_from_madina" id="lodging_from_madina" class="form-control" onchange="madinaLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="lodging_to_madina" id="lodging_to_madina" class="form-control" onchange="madinaLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Hotel in Makkah</label>
															<select  class="form-control" name="lodging_makkah" id="makkah_lodging" onchange="cal_lodging_service_price()">
																<option value="" >Select Hotel</option>
																@foreach($lodging_makkah as $loadging)
																<option value="{{$loadging->id}}">{{$loadging->hotel_name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Room Type in Makkah</label>
															<select  class="form-control" name="room_type_makkah" id="makkah_room_type" onchange="cal_lodging_service_price()">
																<option value="" >Select Room Type</option>
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five">Room For 5</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From</label>
															<input type="date" name="lodging_from_makkah" id="lodging_from_makkah" class="form-control" onchange="makkahLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="lodging_to_makkah" id="lodging_to_makkah" class="form-control" onchange="makkahLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Madina Length Of Stay</label>
															<input type="number" name="lodging_length_stay_madina" id="lodging_length_of_stay_madina" class="form-control" placeholder="Length Of Stay" readonly/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Makkah Length Of Stay</label>
															<input type="number" name="lodging_length_stay_makkah" id="lodging_length_of_stay_makkah" class="form-control" placeholder="Length Of Stay" readonly />
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Madina Price</label>
															<input type="text" name="loadging_madina_price" id="madina_price" class="form-control" placeholder="Madina Service Price" value="0" readonly  />
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Makkah Price</label>
															<input type="text" name="loadging_makkah_price" id="makkah_price" class="form-control" placeholder="Makkah Service Price"value="0" readonly/>
														</div>
														<div class="col-md-4 mt-3" style="display:none">
															<label class="form-label" for="">Buying Madina Price</label>
															<input type="text" name="loadging_madina_buying_price" id="madina_price_buying" class="form-control" placeholder="Madina Service Price" value="0" readonly/>
														</div>
														<div class="col-md-4 mt-3" style="display:none">
															<label class="form-label" for="">Buyig Makkah Price</label>
															<input type="text" name="loadging_makkah_buying_price" id="makkah_price_buying" class="form-control" placeholder="Makkah Service Price"value="0" readonly/>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="package" style="display:none">
													<div class="row">
														<div class="col-md-12">
															<h6>Package:</h6>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Package</label>
															<select  class="form-control" name="package_name" id="package_field" onchange="cal_package_service_price()">
																<option value="" >Select Package</option>
																@foreach($packages as $package)
																<option value="{{$package->id}}">{{$package->name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Type</label>
															<select  class="form-control" name="package_type" >
																<option value="" >Select Type</option>
																<option value="Economy">Economy</option>
																<option value="Normal">Normal</option>
																<option value="VIP">VIP</option>
															</select>
														</div>
														
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From</label>
															<input type="date" name="from_package" id="from_package" class="form-control" onchange="packageLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="to_package" id="to_package" class="form-control" onchange="packageLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Length Of Stay</label>
															<input type="number" name="length_of_stay" id="package_length_of_stay" class="form-control" placeholder="Length Of Stay" readonly/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="package_service_price" id="package_service_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="0" readonly/>
														</div>
														<div class="col-md-4 mt-3" style="display:none">
															<label class="form-label" for="">Buying Service Price</label>
															<input type="hidden" name="package_service_buying_price" id="package_service_buying_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="0" readonly/>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="visa" style="display:none">
													<div class="row">
														<div class="col-md-12">
															<h6>Visa:</h6>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Visa</label>
															<select  class="form-control" name="visa" id="visa_field" onchange="cal_visa_service_price()">
																<option value="" >Select Visa</option>
																@foreach($visas as $visa)
																<option value="{{$visa->id}}">{{$visa->visa_name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From</label>
															<input type="date" name="from_visa" id="from_visa" class="form-control" onchange="visaLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="to_visa" id="to_visa" class="form-control" onchange="visaLengthOfStay()"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Length Of Stay</label>
															<input type="number" name="visa_stay" id="visa_length_of_stay" class="form-control" placeholder="Length Of Stay" readonly/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="service_price" id="visa_service_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="0" readonly/>
															<input type="hidden" name="service_buying_price" id="visa_service_buying_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="0" readonly/>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="transport" style="display:none">
													<div class="row">
														<div class="col-md-12">
															<h6>Transport:</h6>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Transport</label>
															<select  class="form-control" name="transport_id" id="transport_field" onchange="cal_transport_service_price()">
																<option value="">Select Transport</option>
																@foreach($transports as $transport)
																<option value="{{$transport->id}}">{{$transport->name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Country</label>
															<select  class="form-control" id="transport_country_field" name="transport_country" onchange="cal_transport_service_price()">
																<option value="">Select Visa</option>
																<option value="MAR">MAR</option>
																<option value="KSA">KSA</option>
																<option value="BOTH">BOTH</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Type</label>
															<select  class="form-control" name="transport_type" id="transport_type_field" onchange="cal_transport_service_price()">
																<option value="">Select Type</option>
																<option value="Normal">Normal</option>
																<option value="VIP">VIP</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Trip Type</label>
															<select  class="form-control" name="transport_trip_type" id="transport_trip_type_field" onchange="cal_transport_service_price()">
																<option value="">Select Trip Type</option>
																<option value="Round way">Round way</option>
																<option value="One Way">One Way</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="transport_service_price" id="transport_service_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="0" readonly/>
															<input type="hidden" name="transport_service_buying_price" id="transport_service_buying_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="0" readonly/>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="flight" style="display:none">
													<div class="row">
														<div class="col-md-12">
															<h6>Flight:</h6>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Flight</label>
															<select  class="form-control" name="flight_name" >
																<option value="" >Select Flight</option>
																@foreach($tickets as $ticket)
																<option value="{{$ticket->id}}">{{$ticket->name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From (Airport Name)</label>
															<select  class="form-control" name="flight_from" >
															@php
																$airports = [
																	'MARRAKECH AIRPORT (RAK)',
																	'CASABLANCA AIRPORT (CMN)',
																	'AGADIR AIRPORT (AGA)',
																	'RABAT AIRPORT (RBA)',
																	'TANGER AIRPORT (TNG)',
																	'JEDDAH AIRPORT (JED)',
																	'AL-MADINAH AIRPORT (MED)',
																	'ABHA AIRPORT (AHB)',
																	'RIYAD AIRPORT (RUH)'
																];
															@endphp
																<option value="" >Select Airport</option>
																@foreach ($airports as $airport)
																	<option value="{{ $airport }}">
																		{{ $airport }}
																	</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To (Airport Name)</label>
															<select  class="form-control" name="flight_to" >
															@php
																$airports = [
																	'MARRAKECH AIRPORT (RAK)',
																	'CASABLANCA AIRPORT (CMN)',
																	'AGADIR AIRPORT (AGA)',
																	'RABAT AIRPORT (RBA)',
																	'TANGER AIRPORT (TNG)',
																	'JEDDAH AIRPORT (JED)',
																	'AL-MADINAH AIRPORT (MED)',
																	'ABHA AIRPORT (AHB)',
																	'RIYAD AIRPORT (RUH)'
																];
															@endphp
																<option value="" >Select Airport</option>
																@foreach ($airports as $airport)
																	<option value="{{ $airport }}">
																		{{ $airport }}
																	</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Trip Type</label>
															<select  class="form-control" name="flight_trip_type" >
																<option value="" >Select Trip Type</option>
																<option value="Round Trip">Round Trip</option>
																<option value="One-way">One-way</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Flight Type</label>
															<select  class="form-control" name="flight_type" >
																<option value="" >Select Flight Type</option>
																<option value="Direct">Direct</option>
																<option value="Indirect">Indirect</option>
																<option value="Mixed">Mixed</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Airline</label>
															<select  class="form-control" name="flight_airline" >
																<option value="" >Select Airline</option>
																@foreach($airlines as $airline)
																<option value="{{$airline->id}}">{{$airline->name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Departure Time</label>
															<input type="date" name="flight_departure" id="" class="form-control" placeholder="Departure Time">
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Return</label>
															<input type="date" name="flight_return" id="flight_return" class="form-control" placeholder="Departure Time">
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="flight_service_price" id="" class="form-control" placeholder="Service Price (Unknown)" value="0" readonly/>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="extra_service">
													<div class="row mt-4">
														<div class="col-md-12">
															<h6>Extra Services:</h6>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Extra Service Name</label>
															<select  class="form-control" name="extra_service_name" id="extra_field" onchange="cal_extra_service_price()">
																<option value="">Select Extra Service</option>
																@foreach($extra_services as $extra_service)
																<option value="{{$extra_service->id}}">{{$extra_service->name}}</option>
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Trip Type</label>
															<select  class="form-control" name="extra_trip_type" id="extra_type_field" onchange="cal_extra_service_price()">
																<option value="">Select Trip Type</option>
																<option value="round way">Round Way</option>
																<option value="one way">One Way</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price:</label>
															<input type="text" name="extra_service_price" id="extra_service_price" class="form-control" placeholder="Service Price" name="extra_service_price" value="0" readonly/>
															<input type="hidden" name="extra_service_buying_price" id="extra_service_buying_price" class="form-control" placeholder="Service Price" value="0" readonly/>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="payment">
													<div class="row">
														<div class="col-md-12 mt-4">
															<h6>Payment Details</h6>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Payment Method</label>
															<select  class="form-control" name="payment_method" >
																<option value="">Select Payment Method</option>
																<option value="Cash">Cash</option>
																<option value="Bank Check">Bank Check</option>
																<option value="Credit Card<">Credit Card</option>
																<option value="Bank Transfer">Bank Transfer</option>
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="" >Total Amount</label>
															<input type="number" name="total_amount" id="total_amount" class="form-control" placeholder="Total Amount" value="0" readonly />
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Advance Amount</label>
															<input type="number" name="advance_amount" id="advance_amount" class="form-control" placeholder="Advance Amount" />
															<span id="message"></span>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Rest Amount</label>
															<input type="number" name="rest_amount" id="rest_amount" class="form-control" placeholder="Rest Amount" readonly value="0" />
														</div>
													</div>	
												</div>	
												<div class="col-md-12 mt-4">
													<center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Add Reservation"></center>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Container-fluid Ends-->
			</div>
			<!-- footer start-->
			@include('admin/includes.footer')
		</div>
		</div>
		<!-- latest jquery-->
		<script src="{{asset('public/assets/js/jquery-3.5.1.min.js')}}"></script>
		<!-- Bootstrap js-->
		<script src="{{asset('public/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
		<!-- feather icon js-->
		<script src="{{asset('public/assets/js/icons/feather-icon/feather.min.js')}}"></script>
		<script src="{{asset('public/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
		<!-- scrollbar js-->
		<script src="{{asset('public/assets/js/scrollbar/simplebar.js')}}"></script>
		<script src="{{asset('public/assets/js/scrollbar/custom.js')}}"></script>
		<!-- Sidebar jquery-->
		<script src="{{asset('public/assets/js/config.js')}}"></script>
		<!-- Plugins JS start-->
		<script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
		<script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
		<script src="{{asset('public/assets/js/dashboard/default.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/handlebars.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
		<script src="{{asset('public/assets/js/form-validation-custom.js')}}"></script>
		<script src="https://use.fontawesome.com/43c99054a6.js"></script>
		<script src="{{asset('public/assets/js/script.js')}}"></script>
		<script type="text/javascript">
			setTimeout(function() {
			    $('#messages').fadeOut('fast');
			}, 5000);
		</script>
		<script>
			setTimeout(()=> {
			    $('#alert').hide('slow')
			}, 3000)
			$('#advance_amount').on('keyup', function () {
				const totalAmountInput = $('#total_amount');
				const advanceAmountInput = $('#advance_amount');
				const restAmountInput = $('#rest_amount');
				const messageDiv = $('#message');

				const totalAmount = parseFloat(totalAmountInput.val());
				const advanceAmount = parseFloat(advanceAmountInput.val());

				if (advanceAmount !== NaN && !isNaN(advanceAmount)) {
				// Valid advance amount entered
				if (advanceAmount > totalAmount) {
					// Advance amount is greater than the total amount
					restAmountInput.val('0');
					messageDiv.html('Advance amount must be less than total amount').css('color', 'red');
				} else {
					// Calculate and set the remaining amount
					const rest = totalAmount - advanceAmount;
					restAmountInput.val(rest);
					messageDiv.empty(); // Clear any previous messages
				}
				} else {
				// Invalid advance amount (NaN or not a number)
				restAmountInput.val('0');
				messageDiv.empty(); // Clear any previous messages
				}
			});
		</script>
		<script>
			function serviceChange() {
			  let serviceType=$('#servicetype').val();

				

			  if(serviceType==='visa'){
			    $('#visa').css('display','block')
			    $('#transport').css('display','none')
			    $('#hotel').css('display','none')
			    $('#package').css('display','none')
			    $('#flight').css('display','none')
			    $('#lodging').css('display','none')
				$('#payment').css('display','block')
			  }else if(serviceType==='transport'){
			    $('#visa').css('display','none')
			    $('#transport').css('display','block')
			    $('#hotel').css('display','none')
			    $('#package').css('display','none')
			    $('#flight').css('display','none')
			    $('#lodging').css('display','none')
				$('#payment').css('display','block')
			  }else if(serviceType==='hotel'){
			    $('#visa').css('display','none')
			    $('#transport').css('display','none')
			    $('#hotel').css('display','block')
			    $('#package').css('display','none')
			    $('#flight').css('display','none')
			    $('#lodging').css('display','none')
				$('#payment').css('display','block')
			  }else if(serviceType==='package'){
			    $('#visa').css('display','none')
			    $('#transport').css('display','none')
			    $('#hotel').css('display','none')
			    $('#package').css('display','block')
			    $('#flight').css('display','none')
			    $('#lodging').css('display','none')
				$('#payment').css('display','block')
			  }else if(serviceType==='flight'){
			    $('#visa').css('display','none')
			    $('#transport').css('display','none')
			    $('#hotel').css('display','none')
			    $('#package').css('display','none')
			    $('#flight').css('display','block')
			    $('#lodging').css('display','none')
			    $('#payment').css('display','none')
			  }
			  else if(serviceType==='lodging'){
			    $('#visa').css('display','none')
			    $('#transport').css('display','none')
			    $('#hotel').css('display','none')
			    $('#package').css('display','none')
			    $('#flight').css('display','none')
			    $('#lodging').css('display','block')
				$('#payment').css('display','block')
			  }
			}
			
			
		</script>
		<script>
			function cal_package_service_price(){
				var customer_field=$('#customer').val();
				var package_field=$('#package_field').val();
				if(customer_field != '' && package_field != ''){
					var customers=@json($customers);
					var packages=@json($packages);
					var price=0;
					var buying_price=0;

					var filtered_package=packages.filter((data)=>{
						return data.id==package_field
					});

					var filtered_customer=customers.filter((data)=>{
						return data.id==customer_field
					});
					var sex=filtered_customer[0].gender;
					if(sex=="Adult"){
						price=filtered_package[0].price_for_adult
						buying_price=filtered_package[0].buying_price_for_adult
					}else if(sex=="Child"){
						price=filtered_package[0].price_for_child
						buying_price=filtered_package[0].buying_price_for_child
					}else if(sex=="Infant"){
						price=filtered_package[0].price_for_infant
						buying_price=filtered_package[0].buying_price_for_infant
					}
					$('#package_service_price').val(price)
					$('#package_service_buying_price').val(buying_price)
					var extra_service=$('#extra_service_price').val();
					var total=parseFloat(extra_service)+parseFloat(price);
					$('#total_amount').val(total)
				}
				

			}
			function cal_lodging_service_price(){
				var customer_field=$('#customer').val();
				var makkah_lodging_field=$('#makkah_lodging').val();
				var makkah_room_type_field=$('#makkah_room_type').val();
				var madina_lodging_field=$('#madina_lodging').val();
				var madina_room_type_field=$('#madina_room_type').val();

				if(customer_field != '' && makkah_lodging_field != '' && makkah_room_type_field != '' &&madina_lodging_field != '' && madina_room_type_field != '' ){
					var customers=@json($customers);
					var filtered_customer=customers.filter((data)=>{
						return data.id==customer_field
					});
					var sex=filtered_customer[0].gender;
					
					var lodgings_madina=@json($lodging_madina);
					var lodgings_makkah=@json($lodging_makkah);
					
					// makkah_lodging
					var makah_lodging_adult=0;
					var makah_lodging_child=0; 
					var makah_lodging_infant=0;
					var makah_lodging_adult_buying=0;
					var makah_lodging_child_buying=0; 
					var makah_lodging_infant_buying=0;
					if(makkah_lodging_field && makkah_room_type_field){

						var filtered_loadging_makkah=lodgings_makkah.filter((data)=>{
							return data.id==makkah_lodging_field
						});
						if(makkah_room_type_field=="room_for_two"){

							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_two_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_two_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_two_selling_infant
							makah_lodging_adult_buying=filtered_loadging_makkah[0].price_for_individual.room_two_buying_adult
							makah_lodging_child_buying=filtered_loadging_makkah[0].price_for_individual.room_two_buying_child
							makah_lodging_infant_buying=filtered_loadging_makkah[0].price_for_individual.room_two_buying_infant
						}else if(makkah_room_type_field=="room_for_three"){
							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_three_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_three_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_three_selling_infant
							makah_lodging_adult_buying=filtered_loadging_makkah[0].price_for_individual.room_three_buying_adult
							makah_lodging_child_buying=filtered_loadging_makkah[0].price_for_individual.room_three_buying_child
							makah_lodging_infant_buying=filtered_loadging_makkah[0].price_for_individual.room_three_buying_infant
						}else if(makkah_room_type_field=="room_for_four"){
							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_four_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_four_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_four_selling_infant
							makah_lodging_adult_buying=filtered_loadging_makkah[0].price_for_individual.room_four_buying_adult
							makah_lodging_child_buying=filtered_loadging_makkah[0].price_for_individual.room_four_buying_child
							makah_lodging_infant_buying=filtered_loadging_makkah[0].price_for_individual.room_four_buying_infant
						}else if(makkah_room_type_field=="room_for_five"){
							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_five_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_five_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_five_selling_infant
							makah_lodging_adult_buying=filtered_loadging_makkah[0].price_for_individual.room_five_buying_adult
							makah_lodging_child_buying=filtered_loadging_makkah[0].price_for_individual.room_five_buying_child
							makah_lodging_infant_buying=filtered_loadging_makkah[0].price_for_individual.room_five_buying_infant
						}
					}


					// madina_lodging
					var madina_lodging_adult=0;
					var madina_lodging_child=0; 
					var madina_lodging_infant=0;
					var madina_lodging_adult_buying=0;
					var madina_lodging_child_buying=0; 
					var madina_lodging_infant_buying=0;
					if(madina_lodging_field && madina_room_type_field){

						var filtered_loadging_madina=lodgings_madina.filter((data)=>{
							return data.id==madina_lodging_field
						});
						if(madina_room_type_field=="room_for_two"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_two_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_two_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_two_selling_infant
							madina_lodging_adult_buying=filtered_loadging_madina[0].price_for_individual.room_two_buying_adult
							madina_lodging_child_buying=filtered_loadging_madina[0].price_for_individual.room_two_buying_child
							madina_lodging_infant_buying=filtered_loadging_madina[0].price_for_individual.room_two_buying_infant
						}else if(madina_room_type_field=="room_for_three"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_three_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_three_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_three_selling_infant
							madina_lodging_adult_buying=filtered_loadging_madina[0].price_for_individual.room_three_buying_adult
							madina_lodging_child_buying=filtered_loadging_madina[0].price_for_individual.room_three_buying_child
							madina_lodging_infant_buying=filtered_loadging_madina[0].price_for_individual.room_three_buying_infant
						}else if(madina_room_type_field=="room_for_four"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_four_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_four_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_four_selling_infant
							madina_lodging_adult_buying=filtered_loadging_madina[0].price_for_individual.room_four_buying_adult
							madina_lodging_child_buying=filtered_loadging_madina[0].price_for_individual.room_four_buying_child
							madina_lodging_infant_buying=filtered_loadging_madina[0].price_for_individual.room_four_buying_infant
						}else if(madina_room_type_field=="room_for_five"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_five_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_five_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_five_selling_infant
							madina_lodging_adult_buying=filtered_loadging_madina[0].price_for_individual.room_five_buying_adult
							madina_lodging_child_buying=filtered_loadging_madina[0].price_for_individual.room_five_buying_child
							madina_lodging_infant_buying=filtered_loadging_madina[0].price_for_individual.room_five_buying_infant
						}
					}
					
					var PriceForAdult=parseFloat(makah_lodging_adult)+parseFloat(madina_lodging_adult);
					var PriceForChild=parseFloat(makah_lodging_child)+parseFloat(madina_lodging_child);
					var PriceForInfant=parseFloat(makah_lodging_infant)+parseFloat(madina_lodging_infant);
					var PriceForAdultBuying=parseFloat(makah_lodging_adult_buying)+parseFloat(madina_lodging_adult_buying);
					var PriceForChildBuying=parseFloat(makah_lodging_child_buying)+parseFloat(madina_lodging_child_buying);
					var PriceForInfantBuying=parseFloat(makah_lodging_infant_buying)+parseFloat(madina_lodging_infant_buying);
					// console.log({PriceForAdult,PriceForChild,PriceForInfant})
					if(sex=="Adult"){
						$('#makkah_price').val(makah_lodging_adult)
						$('#madina_price').val(madina_lodging_adult)
						$('#makkah_price_buying').val(makah_lodging_adult_buying)
						$('#madina_price_buying').val(madina_lodging_adult_buying)
						var extra_service=$('#extra_service_price').val();
						var total=parseFloat(extra_service)+parseFloat(makah_lodging_adult)+parseFloat(madina_lodging_adult);
						$('#total_amount').val(total)
					}else if(sex=="Child"){
						$('#makkah_price').val(makah_lodging_child)
						$('#madina_price').val(madina_lodging_child)
						$('#makkah_price_buying').val(makah_lodging_child_buying)
						$('#madina_price_buying').val(madina_lodging_child_buying)
						var extra_service=$('#extra_service_price').val();
						var total=parseFloat(extra_service)+parseFloat(makah_lodging_child)+parseFloat(madina_lodging_child);
						$('#total_amount').val(total)
					}else if(sex=="Infant"){
						$('#makkah_price').val(makah_lodging_infant)
						$('#madina_price').val(madina_lodging_infant)
						$('#makkah_price_buying').val(makah_lodging_infant_buying)
						$('#madina_price_buying').val(madina_lodging_infant_buying)
						var extra_service=$('#extra_service_price').val();
						var total=parseFloat(extra_service)+parseFloat(makah_lodging_infant)+parseFloat(madina_lodging_infant);
						$('#total_amount').val(total)
					}
				}
				

			}
			function cal_extra_service_price(){

				var customer_field=$('#customer').val();
				var extra_field=$('#extra_field').val();
				var extra_type_field=$('#extra_type_field').val();

				if(customer_field != '' && customer_field != null && extra_field != '' && extra_type_field != '' && extra_field != null && extra_type_field != null ){
					var customers=@json($customers);
					var extra_service=@json($extra_services);
					var price=0;
					var price_buying=0;

					
					var filtered_customer=customers.filter((data)=>{
						return data.id==customer_field
					});
					var filtered_extra_service=extra_service.filter((data)=>{
						return data.id==extra_field
					});

					var sex=filtered_customer[0].gender;
					if(sex=="Adult"){
						if(extra_type_field=="round way"){
							price=filtered_extra_service[0].service_price.adult_selling_round
							price_buying=filtered_extra_service[0].service_price.adult_buying_round
							
						}else if(extra_type_field=="one way"){
							price=filtered_extra_service[0].service_price.adult_selling_one
							price_buying=filtered_extra_service[0].service_price.adult_buying_one
						}
					}else if(sex=="Child"){
						if(extra_type_field=="round way"){
							price=filtered_extra_service[0].service_price.child_selling_round
							price_buying=filtered_extra_service[0].service_price.child_buying_round
						}else if(extra_type_field=="one way"){
							price=filtered_extra_service[0].service_price.child_selling_one
							price_buying=filtered_extra_service[0].service_price.child_buying_one
						}
						
					}else if(sex=="Infant"){
						if(extra_type_field=="round way"){
							price=filtered_extra_service[0].service_price.infant_selling_round
							price_buying=filtered_extra_service[0].service_price.infant_buying_round
						}else if(extra_type_field=="one way"){
							price=filtered_extra_service[0].service_price.infant_selling_one
							price_buying=filtered_extra_service[0].service_price.infant_buying_one
						}
					}


					$('#extra_service_buying_price').val(price_buying)

					if($("#servicetype").val()=='package'){
						$('#extra_service_price').val(price)
						var package_service=$('#package_service_price').val();
						var total=parseFloat(package_service)+parseFloat(price);
						$('#total_amount').val(total)
					}else if($("#servicetype").val()=='lodging'){
						$('#extra_service_price').val(price)
						var madina_service=$('#madina_price').val();
						var makkah_service=$('#makkah_price').val();
						var total=parseFloat(makkah_service)+parseFloat(madina_service)+parseFloat(price);
						$('#total_amount').val(total)
					}else if($("#servicetype").val()=='transport'){
						$('#extra_service_price').val(price)
						var transport_service=$('#transport_service_price').val();
						var total=parseFloat(transport_service)+parseFloat(price);
						$('#total_amount').val(total)
					}else if($("#servicetype").val()=='visa'){
						$('#extra_service_price').val(price)
						var visa_service=$('#visa_service_price').val();
						var total=parseFloat(visa_service)+parseFloat(price);
						$('#total_amount').val(total)
					}else{
						$('#extra_service_price').val(price);
						var total=parseFloat(price);
						$('#total_amount').val(total)
					}
				}
				
			}
			function cal_transport_service_price(){

				var customer_field=$('#customer').val();
				var transport_field=$('#transport_field').val();
				var transport_country_field=$('#transport_country_field').val();
				var transport_type_field=$('#transport_type_field').val();
				var transport_trip_type_field=$('#transport_trip_type_field').val();
				// console.log({customer_field,transport_field,transport_country_field,transport_type_field,transport_trip_type_field})

				if(customer_field != '' && transport_field != ''  && transport_country_field != '' && transport_type_field != '' && transport_trip_type_field != ''){
					var customers=@json($customers);
					var transport_services=@json($transports);
					var price=0;
					var price_buying=0;
					
					var filtered_customer=customers.filter((data)=>{
						return data.id==customer_field
					});
					var filtered_transport_service=transport_services.filter((data)=>{
						return data.id==transport_field
					});

					var sex=filtered_customer[0].gender;

					if(sex=="Adult"){
						if(transport_country_field=="MAR"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.vip_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_adult.vip_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.vip_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_adult.vip_morroco_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.normal_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_adult.normal_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.normal_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_adult.normal_morroco_buying_one
								}
							}
						}else if(transport_country_field=="KSA"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_round
									price_buying=filtered_transport_service[0].price_for_adult.vip_ksa_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_one
									price_buying=filtered_transport_service[0].price_for_adult.vip_ksa_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_round
									price_buying=filtered_transport_service[0].price_for_adult.normal_ksa_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_one
									price_buying=filtered_transport_service[0].price_for_adult.normal_ksa_buying_one
								}
							}
						}else if(transport_country_field=="BOTH"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_round+filtered_transport_service[0].price_for_adult.vip_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_adult.vip_ksa_buying_round+filtered_transport_service[0].price_for_adult.vip_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_one+filtered_transport_service[0].price_for_adult.vip_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_adult.vip_ksa_buying_one+filtered_transport_service[0].price_for_adult.vip_morroco_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_round+filtered_transport_service[0].price_for_infant.normal_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_adult.normal_ksa_buying_round+filtered_transport_service[0].price_for_infant.normal_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_one+filtered_transport_service[0].price_for_adult.normal_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_adult.normal_ksa_buying_one+filtered_transport_service[0].price_for_adult.normal_morroco_buying_one
								}
							}
						}



						
					}else if(sex=="Child"){
						if(transport_country_field=="MAR"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_child.vip_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_child.vip_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_child.vip_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_child.vip_morroco_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_child.normal_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_child.normal_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_child.normal_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_child.normal_morroco_buying_one
								}
							}
						}else if(transport_country_field=="KSA"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_child.vip_ksa_selling_round
									price_buying=filtered_transport_service[0].price_for_child.vip_ksa_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_child.vip_ksa_selling_one
									price_buying=filtered_transport_service[0].price_for_child.vip_ksa_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_child.normal_ksa_selling_round
									price_buying=filtered_transport_service[0].price_for_child.normal_ksa_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_child.normal_ksa_selling_one
									price_buying=filtered_transport_service[0].price_for_child.normal_ksa_buying_one
								}
							}
						}else if(transport_country_field=="BOTH"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_child.vip_ksa_selling_round+filtered_transport_service[0].price_for_child.vip_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_child.vip_ksa_buying_round+filtered_transport_service[0].price_for_child.vip_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_child.vip_ksa_selling_one+filtered_transport_service[0].price_for_child.vip_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_child.vip_ksa_buying_one+filtered_transport_service[0].price_for_child.vip_morroco_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_child.normal_ksa_selling_round+filtered_transport_service[0].price_for_infant.normal_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_child.normal_ksa_buying_round+filtered_transport_service[0].price_for_infant.normal_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_child.normal_ksa_selling_one+filtered_transport_service[0].price_for_child.normal_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_child.normal_ksa_buying_one+filtered_transport_service[0].price_for_child.normal_morroco_buying_one
								}
							}
						}



						
					}else if(sex=="Infant"){
						if(transport_country_field=="MAR"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.vip_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_infant.vip_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.vip_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_infant.vip_morroco_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.normal_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_infant.normal_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.normal_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_infant.normal_morroco_buying_one
								}
							}
						}else if(transport_country_field=="KSA"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.vip_ksa_selling_round
									price_buying=filtered_transport_service[0].price_for_infant.vip_ksa_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.vip_ksa_selling_one
									price_buying=filtered_transport_service[0].price_for_infant.vip_ksa_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.normal_ksa_selling_round
									price_buying=filtered_transport_service[0].price_for_infant.normal_ksa_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.normal_ksa_selling_one
									price_buying=filtered_transport_service[0].price_for_infant.normal_ksa_buying_one
								}
							}
						}else if(transport_country_field=="BOTH"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.vip_ksa_selling_round+filtered_transport_service[0].price_for_infant.vip_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_infant.vip_ksa_buying_round+filtered_transport_service[0].price_for_infant.vip_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.vip_ksa_selling_one+filtered_transport_service[0].price_for_infant.vip_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_infant.vip_ksa_buying_one+filtered_transport_service[0].price_for_infant.vip_morroco_buying_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.normal_ksa_selling_round+filtered_transport_service[0].price_for_infant.normal_morroco_selling_round
									price_buying=filtered_transport_service[0].price_for_infant.normal_ksa_buying_round+filtered_transport_service[0].price_for_infant.normal_morroco_buying_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.normal_ksa_selling_one+filtered_transport_service[0].price_for_infant.normal_morroco_selling_one
									price_buying=filtered_transport_service[0].price_for_infant.normal_ksa_buying_one+filtered_transport_service[0].price_for_infant.normal_morroco_buying_one
								}
							}
						}



						
					}

					$('#transport_service_price').val(price)
					$('#transport_service_buying_price').val(price_buying)
					var extra_service=$('#extra_service_price').val();
					var total=parseFloat(extra_service)+parseFloat(price);
					$('#total_amount').val(total)
				}

			}
			function cal_visa_service_price() {
				var customer_field=$('#customer').val();
				var visa_field=$('#visa_field').val();
				if(customer_field != '' && visa_field != ''){
					var customers=@json($customers);
					var visas=@json($visas);
					var price=0;
					var price_buying=0;

					var filtered_visa=visas.filter((data)=>{
						return data.id==visa_field
					});

					var filtered_customer=customers.filter((data)=>{
						return data.id==customer_field
					});
					var sex=filtered_customer[0].gender;
					if(sex=="Adult"){
						price=filtered_visa[0].individual_price.adult_selling
						price_buying=filtered_visa[0].individual_price.adult_buying
					}else if(sex=="Child"){
						price=filtered_visa[0].individual_price.child_selling
						price_buying=filtered_visa[0].individual_price.child_buying
						
					}else if(sex=="Infant"){
						price=filtered_visa[0].individual_price.infant_selling
						price_buying=filtered_visa[0].individual_price.infant_buying
					}

					$('#visa_service_price').val(price)
					$('#visa_service_buying_price').val(price_buying)
					var extra_service=$('#extra_service_price').val();
					var total=parseFloat(extra_service)+parseFloat(price);
					$('#total_amount').val(total)
				}
			}
		</script>

		<!-- Length of stay -->
		<script>
			function packageLengthOfStay() {
				var from=$('#from_package').val()
				var to=$('#to_package').val()
				console.log({from,to})
				if(from!=null && to!=null && from!='' && to!=''){
					var timeDifference = new Date(to) - new Date(from);

					// Convert milliseconds to days
					var daysDifference = timeDifference / (1000 * 60 * 60 * 24);

					// console.log("Difference in days: " + daysDifference);
					$('#package_length_of_stay').val(daysDifference)
				}

			}
			function madinaLengthOfStay() {
				
				var from=$('#lodging_from_madina').val()
				var to=$('#lodging_to_madina').val()
				console.log({from,to})
				if(from!=null && to!=null && from!='' && to!=''){
					var timeDifference = new Date(to) - new Date(from);

					// Convert milliseconds to days
					var daysDifference = timeDifference / (1000 * 60 * 60 * 24);

					$('#lodging_length_of_stay_madina').val(daysDifference)
				}

			}
			function makkahLengthOfStay() {
				var from=$('#lodging_from_makkah').val()
				var to=$('#lodging_to_makkah').val()
				console.log({from,to})
				if(from!=null && to!=null && from!='' && to!=''){
					var timeDifference = new Date(to) - new Date(from);

					// Convert milliseconds to days
					var daysDifference = timeDifference / (1000 * 60 * 60 * 24);

					$('#lodging_length_of_stay_makkah').val(daysDifference)
				}

			}
			function visaLengthOfStay() {
				var from=$('#from_visa').val()
				var to=$('#to_visa').val()
				console.log({from,to})
				if(from!=null && to!=null && from!='' && to!=''){
					var timeDifference = new Date(to) - new Date(from);

					// Convert milliseconds to days
					var daysDifference = timeDifference / (1000 * 60 * 60 * 24);

					console.log("Difference in days: " + daysDifference);
					$('#visa_length_of_stay').val(daysDifference)
				}

			}
		</script>
	</body>
</html>