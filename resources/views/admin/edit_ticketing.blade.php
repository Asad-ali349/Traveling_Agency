
<!DOCTYPE html>
<html lang="en">
	@include('admin/includes/head')
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/datatables.css')}}">
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
										<h5>Edit Ticket:</h5>
									</div>
									<div class="card-body">
										<form class="needs-validation" novalidate="" method="POST" action="{{url('admin/edit_ticketing')}}">
											@csrf
											<div class="row g-3 mb-2">

												<input type="hidden" name="is_group" value="{{$is_group}}">
                                                
												<input type="hidden" name="id" value="{{$ticketing->id}}">
                                                @if($is_group=="group")
												<input type="hidden" name="group_id" value="{{$ticketing->grouping_id}}">
                                                @endif
												<div class="col-md-12">
												<div class="table-responsive">
													<table class="hover" id="example-style-5">
														<thead style="background-color: #E5E5E5">
															<tr>
																<th>Nationality</th>
																<th>Air Company</th>
																<th>Passport No</th>
																<th>D.O.B</th>
																<th>Gender</th>
																<th>Issuance Date</th>
																<th>First Name</th>
																<th>Last Name</th>
																<th>Groups Entry</th>
																<th>CTO Entry</th>
																<th>Ticket Type</th>
																<th>Fee Amount</th>
																<th>Purchase Price</th>
																<th>Selling Price</th>
															</tr>
														</thead>
														<tbody id="table_data">
                                                            @if($is_group=="group")
															    @foreach($ticketing->grouping->members as $member)
                                                                @if($member->reservation->service_type=="flight")
                                                                <tr>
                                                                    <td style="display:none"><input type="hidden" name="reservation_id[]" value="{{$member->reservation->id}}" id=""></td>
                                                                    <td>{{$member->reservation->customer->nationality}}</td>
                                                                    <td>{{$member->reservation->flight->air_company->name}}</td>
                                                                    <td>{{$member->reservation->customer->passport}}</td>
                                                                    <td>{{$member->reservation->customer->dob}}</td>
                                                                    <td>{{$member->reservation->customer->gender}}</td>
                                                                    <td>{{$member->reservation->customer->passport_issue_date}}</td>
                                                                    <td>{{$member->reservation->customer->first_name}}</td>
                                                                    <td>{{$member->reservation->customer->last_name}}</td>
                                                                    <td>Groups Entry</td>
                                                                    <td>CTO Entry</td>
                                                                    <td><input type="text" name="ticket_type[]" id="" value="{{$ticketing->ticketing_type}}"></td>
                                                                    <td><input type="text" name="fee_amount[]" id="" value="{{$member->reservation->flight->service_price}}"></td>
                                                                    <td><input type="text" name="purchase_amount[]" id="" value="{{$member->reservation->flight->purchased_price}}"></td>
                                                                    <td><input type="text" name="selling_amount[]" id="" value="{{$member->reservation->flight->selling_price}}"></td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            @endif
                                                            @if($is_group=="individual")
                                                                <tr>
                                                                <td style="display:none"><input type="hidden" name="reservation_id[]" value="{{$ticketing->reservation->id}}" id=""></td>
                                                                    <td>{{$ticketing->reservation->customer->nationality}}</td>
                                                                    <td>{{$ticketing->reservation->flight->air_company->name}}</td>
                                                                    <td>{{$ticketing->reservation->customer->passport}}</td>
                                                                    <td>{{$ticketing->reservation->customer->dob}}</td>
                                                                    <td>{{$ticketing->reservation->customer->gender}}</td>
                                                                    <td>{{$ticketing->reservation->customer->passport_issue_date}}</td>
                                                                    <td>{{$ticketing->reservation->customer->first_name}}</td>
                                                                    <td>{{$ticketing->reservation->customer->last_name}}</td>
                                                                    <td>Groups Entry</td>
                                                                    <td>CTO Entry</td>
                                                                    <td><input type="text" name="ticket_type[]" id="" value="{{$ticketing->ticketing_type}}"></td>
                                                                    <td><input type="text" name="fee_amount[]" id="" value="{{$ticketing->reservation->flight->service_price}}"></td>
                                                                    <td><input type="text" name="purchase_amount[]" id="" value="{{$ticketing->reservation->flight->purchased_price}}"></td>
                                                                    <td><input type="text" name="selling_amount[]" id="" value="{{$ticketing->reservation->flight->selling_price}}"></td>
                                                                </tr>
                                                                
                                                            @endif
														</tbody>
													</table>
												</div>
												</div>
												<div class="row  mb-2">
														<center><input name="" class="btn btn-primary mt-4" type="submit" value="Cancel">
														<input name="" class="btn btn-primary mt-4" type="submit" value="Update Ticket"></center>
													
												</div>
											</div>
										</form>
									</div>
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
		<script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<!-- Plugins JS Ends-->
		<!-- Theme js-->
		<script src="{{asset('public/assets/js/script.js')}}"></script>
		<script type="text/javascript">
			setTimeout(function() {
			    $('#messages').fadeOut('fast');
			}, 5000);
			setTimeout(()=> {
			    $('#alert').hide('slow')
			}, 3000)
		</script>
		<script>
			function TicketingFrom () {
			    let value=$('#ticketing_from').val();
			    if(value==="Client"){
			      $('#client').css('display','block');
			      $('#group').css('display','none');
			    }else if(value==="Group"){
			      $('#client').css('display','none');
			      $('#group').css('display','block');
			    }
			  }
		</script>
		
	</body>
</html>