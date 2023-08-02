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
										<h5>Edit Reservation:</h5>
									</div>
									<div class="card-body">
										<form class="needs-validation" novalidate="" method="POST" action="{{url('admin/edit_reservation')}}">
											@csrf
											<div class="row g-3 mb-2">
												<input type="hidden" name="reservation_id" id="" value="{{$reservation->id}}" required>
												<div class="col-md-4 mt-3">
													<label class="form-label" for="">Customer:</label>
													<select  class="form-control" id="customer" name="customer" required>
														<option value="">Select Customer</option>
														@foreach($customers as $customer)
														@if($reservation->customer_id==$customer->id)
														<option value="{{$customer->id}}" selected>{{$customer->first_name.' '.$customer->last_name}}</option>
														@else
														<option value="{{$customer->id}}">{{$customer->first_name.' '.$customer->last_name}}</option>
														@endif
														@endforeach
													</select>
												</div>
												<div class="col-md-4 mt-3">
													<label class="form-label" for="">Service Type</label>
													<select  class="form-control" name="service_name" id="servicetype" onchange="serviceChange()" required>
														<option value="" >Select Service Type</option>
														@if ($reservation->service_type == 'package')
														<option value="package" selected>Package</option>
														<option value="lodging">Lodging</option>
														<option value="visa">VISA</option>
														<option value="flight">Flight</option>
														<option value="transport">Transport</option>
														@elseif ($reservation->service_type == 'lodging')
														<option value="package">Package</option>
														<option value="lodging" selected>Lodging</option>
														<option value="visa">VISA</option>
														<option value="flight">Flight</option>
														<option value="transport">Transport</option>
														@elseif ($reservation->service_type == 'visa')
														<option value="package">Package</option>
														<option value="lodging">Lodging</option>
														<option value="visa" selected>VISA</option>
														<option value="flight">Flight</option>
														<option value="transport">Transport</option>
														@elseif ($reservation->service_type == 'flight')
														<option value="package">Package</option>
														<option value="lodging">Lodging</option>
														<option value="visa">VISA</option>
														<option value="flight" selected>Flight</option>
														<option value="transport">Transport</option>
														@elseif ($reservation->service_type == 'transport')
														<option value="package">Package</option>
														<option value="lodging">Lodging</option>
														<option value="visa">VISA</option>
														<option value="flight">Flight</option>
														<option value="transport" selected>Transport</option>
														@else
														<option value="package">Package</option>
														<option value="lodging">Lodging</option>
														<option value="visa">VISA</option>
														<option value="flight">Flight</option>
														<option value="transport">Transport</option>
														@endif
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
																@if($reservation->lodging!=null)
																@if ($reservation->lodging->destination == "Al Madina")
																<option value="Al Madina" selected>Al Madina</option>
																<option value="Al Makkah">Al Makkah</option>
																<option value="Both">Both</option>
																@elseif ($reservation->lodging->destination == "Al Makkah")
																<option value="Al Madina">Al Madina</option>
																<option value="Al Makkah" selected>Al Makkah</option>
																<option value="Both">Both</option>
																@elseif ($reservation->lodging->destination == "Both")
																<option value="Al Madina">Al Madina</option>
																<option value="Al Makkah">Al Makkah</option>
																<option value="Both" selected>Both</option>
																@else
																<!-- Default case when $reservation->lodging->destination doesn't match any of the above cases -->
																<option value="Al Madina">Al Madina</option>
																<option value="Al Makkah">Al Makkah</option>
																<option value="Both">Both</option>
																@endif
																@else
																<option value="Al Madina">Al Madina</option>
																<option value="Al Makkah">Al Makkah</option>
																<option value="Both">Both</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Hotel in Madina</label>
															<select  class="form-control" name="lodging_madina" id="madina_lodging" onchange="cal_lodging_service_price()">
																<option value="" >Select Hotel</option>
																@foreach($lodging_madina as $loadging)
																@if($reservation->lodging!=null)
																@if($loadging->id==$reservation->lodging->lodging_in_madina)
																<option value="{{$loadging->id}}" selected>{{$loadging->hotel_name}}</option>
																@else
																<option value="{{$loadging->id}}" >{{$loadging->hotel_name}}</option>
																@endif
																@else
																<option value="{{$loadging->id}}" >{{$loadging->hotel_name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Room Type in Madina</label>
															<select  class="form-control" name="room_type_madina" id="madina_room_type" onchange="cal_lodging_service_price()">
																<option value="">Select Room Type </option>
																@if (isset($reservation->lodging) &&$reservation->lodging->room_type_in_madina == "room_for_two")
																<option value="room_for_two" selected>Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@elseif (isset($reservation->lodging) &&$reservation->lodging->room_type_in_madina == "room_for_three")
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three" selected>Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@elseif (isset($reservation->lodging) &&$reservation->lodging->room_type_in_madina == "room_for_four")
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four" selected>Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@elseif (isset($reservation->lodging) &&$reservation->lodging->room_type_in_madina == "room_for_five")
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five" selected>Room For 5</option>
																@else
																<!-- Default case when $reservation->lodging->room_type_in_madina doesn't match any of the above cases -->
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From</label>
															<input type="date" name="lodging_from_madina" id="" class="form-control" value="{{$reservation->lodging!=null? $reservation->lodging->from_date_madina :''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="lodging_to_madina" id="" class="form-control" value="{{$reservation->lodging!=null?  $reservation->lodging->to_date_madina: ''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Hotel in Makkah</label>
															<select  class="form-control" name="lodging_makkah" id="makkah_lodging" onchange="cal_lodging_service_price()">
																<option value="" >Select Hotel</option>
																@foreach($lodging_makkah as $loadging)
																@if(isset($reservation->lodging) && $loadging->id==$reservation->lodging->lodging_in_makkah)
																<option value="{{$loadging->id}}" selected>{{$loadging->hotel_name}}</option>
																@else
																<option value="{{$loadging->id}}" >{{$loadging->hotel_name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Room Type in Makkah</label>
															<select  class="form-control" name="room_type_makkah" id="makkah_room_type" onchange="cal_lodging_service_price()">
																<option value="" >Select Room Type</option>
																@if (isset($reservation->lodging) &&$reservation->lodging->room_type_in_makkah == "room_for_two")
																<option value="room_for_two" selected>Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@elseif (isset($reservation->lodging) &&$reservation->lodging->room_type_in_makkah == "room_for_three")
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three" selected>Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@elseif (isset($reservation->lodging) &&$reservation->lodging->room_type_in_makkah == "room_for_four")
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four" selected>Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@elseif (isset($reservation->lodging) &&$reservation->lodging->room_type_in_makkah == "room_for_five")
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five" selected>Room For 5</option>
																@else
																<!-- Default case when $reservation->lodging->room_type_in_makkah doesn't match any of the above cases -->
																<option value="room_for_two">Room For 2</option>
																<option value="room_for_three">Room For 3</option>
																<option value="room_for_four">Room For 4</option>
																<option value="room_for_five">Room For 5</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From</label>
															<input type="date" name="lodging_from_makkah" id="" class="form-control" value="{{$reservation->lodging ? $reservation->lodging->from_date_makkah:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="lodging_to_makkah" id="" class="form-control" value="{{$reservation->lodging ? $reservation->lodging->to_date_makkah:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Length Of Stay</label>
															<input type="text" name="loadging_length_stay" id="" class="form-control" placeholder="Length Of Stay" value="{{$reservation->lodging ? $reservation->lodging->length_of_stay:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Madina Price</label>
															<input type="text" name="loadging_madina_price" id="madina_price" class="form-control" placeholder="Madina Service Price" value="{{$reservation->lodging ? $reservation->lodging->madina_price:'0'}}" readonly/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Makkah Price</label>
															<input type="text" name="loadging_makkah_price" id="makkah_price" class="form-control" placeholder="Makkah Service Price" value="{{$reservation->lodging ? $reservation->lodging->makkah_price:'0'}}" readonly/>
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
																@if(isset($reservation->package) && $reservation->package->package_service_id==$package->id)
																<option value="{{$package->id}}" selected>{{$package->name}}</option>
																@else
																<option value="{{$package->id}}">{{$package->name}}</option>
																@endif
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
															<input type="date" name="from_package" id="" class="form-control" value="{{$reservation->package?$reservation->package->from_date:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="to_package" id="" class="form-control" value="{{$reservation->package?$reservation->package->to_date:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Length Of Stay</label>
															<input type="text" name="length_of_stay" id="" class="form-control" placeholder="Length Of Stay" value="{{$reservation->package?$reservation->package->length_of_stay:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="package_service_price" id="package_service_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="{{$reservation->package?$reservation->package->service_price:'0'}}"readonly/>
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
																@if(isset($reservation->visa) &&$visa->id==$reservation->visa->visa_type)
																<option value="{{$visa->id}}" selected>{{$visa->visa_name}}</option>
																@else
																<option value="{{$visa->id}}">{{$visa->visa_name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From</label>
															<input type="date" name="from_visa" id="" class="form-control" value="{{$reservation->visa ? $reservation->visa->from_date:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To</label>
															<input type="date" name="to_visa" id="" class="form-control" value="{{$reservation->visa ? $reservation->visa->to_date:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Length Of Stay</label>
															<input type="text" name="visa_stay" id="" class="form-control" placeholder="Length Of Stay" value="{{$reservation->visa ? $reservation->visa->length_of_stay:''}}"/>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="service_price" id="visa_service_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="{{$reservation->visa ? $reservation->visa->service_price:'0'}}" readonly/>
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
																@if(isset($reservation->transport) && $transport->id==$reservation->transport->transport_service_id)
																<option value="{{$transport->id}}" selected>{{$transport->name}}</option>
																@else
																<option value="{{$transport->id}}">{{$transport->name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Country</label>
															<select  class="form-control" id="transport_country_field" name="transport_country" onchange="cal_transport_service_price()">
																<option value="">Select Country</option>
																@if (isset($reservation->transport) && $reservation->transport->country == "MAR")
																	<option value="MAR" selected>MAR</option>
																	<option value="KSA">KSA</option>
																	<option value="BOTH">BOTH</option>
																@elseif (isset($reservation->transport) && $reservation->transport->country == "KSA")
																	<option value="MAR">MAR</option>
																	<option value="KSA" selected>KSA</option>
																	<option value="BOTH">BOTH</option>
																@elseif (isset($reservation->transport) && $reservation->transport->country == "BOTH")
																	<option value="MAR">MAR</option>
																	<option value="KSA">KSA</option>
																	<option value="BOTH" selected>BOTH</option>
																@else
																	<!-- Default case when $reservation->transport->country doesn't match any of the above cases -->
																	<option value="MAR">MAR</option>
																	<option value="KSA">KSA</option>
																	<option value="BOTH">BOTH</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Type</label>
															<select  class="form-control" name="transport_type" id="transport_type_field" onchange="cal_transport_service_price()">
																<option value="">Select Type</option>
																@if (isset($reservation->transport) && $reservation->transport->type == "Normal")
																	<option value="Normal" selected>Normal</option>
																	<option value="VIP">VIP</option>
																@elseif (isset($reservation->transport) && $reservation->transport->type == "VIP")
																	<option value="Normal">Normal</option>
																	<option value="VIP" selected>VIP</option>
																@else
																	<!-- Default case when $reservation->transport->type doesn't match any of the above cases -->
																	<option value="Normal">Normal</option>
																	<option value="VIP">VIP</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Trip Type</label>
															<select  class="form-control" name="transport_trip_type" id="transport_trip_type_field" onchange="cal_transport_service_price()">
																<option value="">Select Trip Type</option>
																@if (isset($reservation->transport) && $reservation->transport->trip_type == "Round way")
																	<option value="Round way" selected>Round way</option>
																	<option value="One Way">One Way</option>
																@elseif (isset($reservation->transport) && $reservation->transport->trip_type == "One Way")
																	<option value="Round way">Round way</option>
																	<option value="One Way" selected>One Way</option>
																@else
																	<!-- Default case when $reservation->transport->trip_type doesn't match any of the above cases -->
																	<option value="Round way">Round way</option>
																	<option value="One Way">One Way</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="transport_service_price" id="transport_service_price" class="form-control" placeholder="Service Price" placeholder="Service Price" value="{{$reservation->transport?$reservation->transport->service_price:'0'}}" readonly/>
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
																@if(isset($reservation->flight) && $ticket->id==$reservation->flight->flight_id)
																<option value="{{$ticket->id}}" selected>{{$ticket->name}}</option>
																@else 
																<option value="{{$ticket->id}}">{{$ticket->name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">From (Airport Name)</label>
															<select  class="form-control" name="flight_from" >
																<option value="" >Select Airport</option>
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
																$selectedAirport = $reservation->flight->from_airport ?? null;
															@endphp

															@foreach ($airports as $airport)
																<option value="{{ $airport }}" {{ $airport === $selectedAirport ? 'selected' : '' }}>
																	{{ $airport }}
																</option>
															@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">To (Airport Name)</label>
															<select  class="form-control" name="flight_to" >
																<option value="" >Select Airport</option>
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
																$selectedAirport = $reservation->flight->to_airport ?? null;
															@endphp

															@foreach ($airports as $airport)
																<option value="{{ $airport }}" {{ $airport === $selectedAirport ? 'selected' : '' }}>
																	{{ $airport }}
																</option>
															@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Trip Type</label>
															<select  class="form-control" name="flight_trip_type" >
																<option value="" >Select Trip Type</option>
																@if (isset($reservation->flight) && $reservation->flight->trip_type == "Round Trip")
																	<option value="Round Trip" selected>Round Trip</option>
																	<option value="One-way">One-way</option>
																@elseif (isset($reservation->flight) && $reservation->flight->trip_type == "One-way")
																	<option value="Round Trip">Round Trip</option>
																	<option value="One-way" selected>One-way</option>
																@else
																	<!-- Default case when $reservation->flight->trip_type doesn't match any of the above cases -->
																	<option value="Round Trip">Round Trip</option>
																	<option value="One-way">One-way</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Flight Type</label>
															<select  class="form-control" name="flight_type" >
																<option value="" >Select Flight Type</option>
																@if (isset($reservation->flight) &&$reservation->flight->flight_type == "Direct")
																	<option value="Direct" selected>Direct</option>
																	<option value="Indirect">Indirect</option>
																	<option value="Mixed">Mixed</option>
																@elseif (isset($reservation->flight) &&$reservation->flight->flight_type == "Indirect")
																	<option value="Direct">Direct</option>
																	<option value="Indirect" selected>Indirect</option>
																	<option value="Mixed">Mixed</option>
																@elseif (isset($reservation->flight) &&$reservation->flight->flight_type == "Mixed")
																	<option value="Direct">Direct</option>
																	<option value="Indirect">Indirect</option>
																	<option value="Mixed" selected>Mixed</option>
																@else
																	<!-- Default case when $reservation->flight->flight_type doesn't match any of the above cases -->
																	<option value="Direct">Direct</option>
																	<option value="Indirect">Indirect</option>
																	<option value="Mixed">Mixed</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Airline</label>
															<select  class="form-control" name="flight_airline" >
																<option value="" >Select Airline</option>
																@foreach($airlines as $airline)
																@if(isset($reservation->flight) && $reservation->flight->air_company_id==$airline->id)
																<option value="{{$airline->id}}" selected>{{$airline->name}}</option>
																@else 
																<option value="{{$airline->id}}">{{$airline->name}}</option>

																@endif
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Departure Time</label>
															<input type="date" name="flight_departure" id="" class="form-control" placeholder="Departure Time" value="{{$reservation->flight?$reservation->flight->return_time:''}}">
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Return</label>
															<input type="date" name="flight_return" id="flight_return" class="form-control" placeholder="Departure Time" value="{{$reservation->flight?$reservation->flight->departure_time:''}}">
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price</label>
															<input type="text" name="flight_service_price" id="" class="form-control" placeholder="Service Price (Unknown)" value="{{$reservation->flight?$reservation->flight->service_price:'0'}}" readonly/>
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
																@if (isset($reservation->extra_service) && $reservation->extra_service->extra_service_id ==$extra_service->id )
																<option value="{{$extra_service->id}}" selected>{{$extra_service->name}}</option>
																@else
																<option value="{{$extra_service->id}}">{{$extra_service->name}}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Trip Type</label>
															<select  class="form-control" name="extra_trip_type" id="extra_type_field" onchange="cal_extra_service_price()">
																<option value="">Select Trip Type</option>
																@if (isset($reservation->extra_service) && $reservation->extra_service->trip_type == 'round way')
																<option value="round way" selected>Round Way</option>
																<option value="one way">One Way</option>
																@elseif (isset($reservation->extra_service) && $reservation->extra_service->trip_type == 'one way')
																<option value="round way">Round Way</option>
																<option value="one way" selected>One Way</option>
																@else
																<!-- Default case when $reservation->extra_service is null or $reservation->extra_service->trip_type doesn't match any of the above cases -->
																<option value="round way">Round Way</option>
																<option value="one way">One Way</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Service Price:</label>
															<input type="text" name="extra_service_price" id="extra_service_price" class="form-control" placeholder="Service Price" name="extra_service_price" value="{{$reservation->extra_service!=null?$reservation->extra_service->service_price : 0}}" readonly/>
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
																@if (isset($reservation->payment) && $reservation->payment->payment_method == 'Cash')
																<option value="Cash" selected>Cash</option>
																<option value="Bank Check">Bank Check</option>
																<option value="Credit Card">Credit Card</option>
																<option value="Bank Transfer">Bank Transfer</option>
																@elseif (isset($reservation->payment) && $reservation->payment->payment_method == 'Bank Check')
																<option value="Cash">Cash</option>
																<option value="Bank Check" selected>Bank Check</option>
																<option value="Credit Card">Credit Card</option>
																<option value="Bank Transfer">Bank Transfer</option>
																@elseif (isset($reservation->payment) && $reservation->payment->payment_method == 'Credit Card')
																<option value="Cash">Cash</option>
																<option value="Bank Check">Bank Check</option>
																<option value="Credit Card" selected>Credit Card</option>
																<option value="Bank Transfer">Bank Transfer</option>
																@elseif (isset($reservation->payment) && $reservation->payment->payment_method == 'Bank Transfer')
																<option value="Cash">Cash</option>
																<option value="Bank Check">Bank Check</option>
																<option value="Credit Card">Credit Card</option>
																<option value="Bank Transfer" selected>Bank Transfer</option>
																@else
																<!-- Default case when $reservation->payment is null or $reservation->payment->payment_method doesn't match any of the above cases -->
																<option value="Cash">Cash</option>
																<option value="Bank Check">Bank Check</option>
																<option value="Credit Card">Credit Card</option>
																<option value="Bank Transfer">Bank Transfer</option>
																@endif
															</select>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="" >Total Amount</label>
															<input type="text" name="total_amount" id="total_amount" class="form-control" placeholder="Total Amount" value="{{$reservation->payment->total_amount}}" readonly />
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Advance Amount</label>
															<input type="text" name="advance_amount" id="advance_amount" class="form-control" placeholder="Advance Amount" value="{{$reservation->payment->advance_amount}}" />
															<span id="message" ></span>
														</div>
														<div class="col-md-4 mt-3">
															<label class="form-label" for="">Rest Amount</label>
															<input type="text" name="rest_amount" id="rest_amount" class="form-control" placeholder="Rest Amount" readonly value="{{$reservation->payment->rest_amount}}" />
														</div>
													</div>
												</div>
												<div class="col-md-12 mt-4">
													<center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Update Reservation"></center>
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
			document.addEventListener("DOMContentLoaded", function(){
			  var service = '{{$reservation->service_type}}';
			
			  // Show the element with the ID matching the service_type value
			  $(`#${service}`).css('display', 'block');
			});
			
			
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
			
					var filtered_package=packages.filter((data)=>{
						return data.id==package_field
					});
			
					var filtered_customer=customers.filter((data)=>{
						return data.id==customer_field
					});
					var sex=filtered_customer[0].gender;
					if(sex=="Adult"){
						price=filtered_package[0].price_for_adult
					}else if(sex=="Child"){
						price=filtered_package[0].price_for_child
						
					}else if(sex=="Infant"){
						price=filtered_package[0].price_for_infant
					}
			
					$('#package_service_price').val(price)
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
					if(makkah_lodging_field && makkah_room_type_field){
			
						var filtered_loadging_makkah=lodgings_makkah.filter((data)=>{
							return data.id==makkah_lodging_field
						});
						if(makkah_room_type_field=="room_for_two"){
			
							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_two_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_two_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_two_selling_infant
						}else if(makkah_room_type_field=="room_for_three"){
							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_three_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_three_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_three_selling_infant
						}else if(makkah_room_type_field=="room_for_four"){
							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_four_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_four_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_four_selling_infant
						}else if(makkah_room_type_field=="room_for_five"){
							makah_lodging_adult=filtered_loadging_makkah[0].price_for_individual.room_five_selling_adult
							makah_lodging_child=filtered_loadging_makkah[0].price_for_individual.room_five_selling_child
							makah_lodging_infant=filtered_loadging_makkah[0].price_for_individual.room_five_selling_infant
						}
					}
			
			
					// madina_lodging
					var madina_lodging_adult=0;
					var madina_lodging_child=0; 
					var madina_lodging_infant=0;
					if(madina_lodging_field && madina_room_type_field){
			
						var filtered_loadging_madina=lodgings_madina.filter((data)=>{
							return data.id==madina_lodging_field
						});
						if(madina_room_type_field=="room_for_two"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_two_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_two_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_two_selling_infant
						}else if(madina_room_type_field=="room_for_three"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_three_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_three_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_three_selling_infant
						}else if(madina_room_type_field=="room_for_four"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_four_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_four_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_four_selling_infant
						}else if(madina_room_type_field=="room_for_five"){
							madina_lodging_adult=filtered_loadging_madina[0].price_for_individual.room_five_selling_adult
							madina_lodging_child=filtered_loadging_madina[0].price_for_individual.room_five_selling_child
							madina_lodging_infant=filtered_loadging_madina[0].price_for_individual.room_five_selling_infant
						}
					}
					
					var PriceForAdult=parseFloat(makah_lodging_adult)+parseFloat(madina_lodging_adult);
					var PriceForChild=parseFloat(makah_lodging_child)+parseFloat(madina_lodging_child);
					var PriceForInfant=parseFloat(makah_lodging_infant)+parseFloat(madina_lodging_infant);
					// console.log({PriceForAdult,PriceForChild,PriceForInfant})
					if(sex=="Adult"){
						$('#makkah_price').val(makah_lodging_adult)
						$('#madina_price').val(madina_lodging_adult)
						var extra_service=$('#extra_service_price').val();
						var total=parseFloat(extra_service)+parseFloat(makah_lodging_adult)+parseFloat(madina_lodging_adult);
						$('#total_amount').val(total)
					}else if(sex=="Child"){
						$('#makkah_price').val(makah_lodging_child)
						$('#madina_price').val(madina_lodging_child)
						var extra_service=$('#extra_service_price').val();
						var total=parseFloat(extra_service)+parseFloat(makah_lodging_child)+parseFloat(madina_lodging_child);
						$('#total_amount').val(total)
					}else if(sex=="Infant"){
						$('#makkah_price').val(makah_lodging_infant)
						$('#madina_price').val(madina_lodging_infant)
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
							
						}else if(extra_type_field=="one way"){
							price=filtered_extra_service[0].service_price.adult_selling_one
						}
					}else if(sex=="Child"){
						if(extra_type_field=="round way"){
							price=filtered_extra_service[0].service_price.child_selling_round
						}else if(extra_type_field=="one way"){
							price=filtered_extra_service[0].service_price.child_selling_one
						}
						
					}else if(sex=="Infant"){
						if(extra_type_field=="round way"){
							price=filtered_extra_service[0].service_price.infant_selling_round
						}else if(extra_type_field=="one way"){
							price=filtered_extra_service[0].service_price.infant_selling_one
						}
					}
			
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
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.vip_morroco_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.normal_morroco_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.normal_morroco_selling_one
								}
							}
						}else if(transport_country_field=="KSA"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_one
								}
							}
						}else if(transport_country_field=="BOTH"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_round+filtered_transport_service[0].price_for_adult.vip_morroco_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.vip_ksa_selling_one+filtered_transport_service[0].price_for_adult.vip_morroco_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_round+filtered_transport_service[0].price_for_infant.normal_morroco_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_adult.normal_ksa_selling_one+filtered_transport_service[0].price_for_adult.normal_morroco_selling_one
								}
							}
						}
			
			
			
						
					}else if(sex=="Child"){
						if(transport_country_field=="MAR"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].service_price.adult_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].service_price.adult_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].service_price.adult_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].service_price.adult_selling_one
								}
							}
						}else if(transport_country_field=="KSA"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].service_price.adult_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].service_price.adult_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].service_price.adult_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].service_price.adult_selling_one
								}
							}
						}else if(transport_country_field=="BOTH"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].service_price.adult_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].service_price.adult_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].service_price.adult_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].service_price.adult_selling_one
								}
							}
						}
					}else if(sex=="Infant"){
						if(transport_country_field=="MAR"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.vip_morroco_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].service_price.vip_morroco_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.normal_morroco_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.normal_morroco_selling_one
								}
							}
						}else if(transport_country_field=="KSA"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.vip_ksa_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.vip_ksa_selling_one
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=filtered_transport_service[0].price_for_infant.normal_ksa_selling_round
							
								}else if(transport_trip_type_field=="One Way"){
									price=filtered_transport_service[0].price_for_infant.normal_ksa_selling_one
								}
							}
						}else if(transport_country_field=="BOTH"){
							if(transport_type_field=="VIP"){
								if(transport_trip_type_field=="Round way"){
									price=parseFloat(filtered_transport_service[0].price_for_infant.vip_ksa_selling_round)+parseFloat(filtered_transport_service[0].price_for_infant.vip_morroco_selling_round)
							
								}else if(transport_trip_type_field=="One Way"){
									price=parseFloat(filtered_transport_service[0].price_for_infant.vip_ksa_selling_one)+parseFloat(filtered_transport_service[0].price_for_infant.vip_morroco_selling_one)
								}
							}else if(transport_type_field=="Normal"){
								if(transport_trip_type_field=="Round way"){
									price=parseFloat(filtered_transport_service[0].price_for_infant.normal_ksa_selling_round)+parseFloat(filtered_transport_service[0].price_for_infant.normal_morroco_selling_round)
							
								}else if(transport_trip_type_field=="One Way"){
									price=parseFloat(filtered_transport_service[0].price_for_infant.normal_ksa_selling_one)+parseFloat(filtered_transport_service[0].price_for_infant.normal_morroco_selling_one)
								}
							}
						}
						
					}
			
					$('#transport_service_price').val(price)
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
			
					var filtered_visa=visas.filter((data)=>{
						return data.id==visa_field
					});
			
					var filtered_customer=customers.filter((data)=>{
						return data.id==customer_field
					});
					var sex=filtered_customer[0].gender;
					if(sex=="Adult"){
						price=filtered_visa[0].individual_price.adult_selling
					}else if(sex=="Child"){
						price=filtered_visa[0].individual_price.child_selling
						
					}else if(sex=="Infant"){
						price=filtered_visa[0].individual_price.infant_selling
					}
			
					$('#visa_service_price').val(price)
					var extra_service=$('#extra_service_price').val();
					var total=parseFloat(extra_service)+parseFloat(price);
					$('#total_amount').val(total)
				}
			}
		</script>
	</body>
</html>