
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
										<h5>Add Ticket:</h5>
									</div>
									<div class="card-body">
										<form class="needs-validation" novalidate="" method="POST" action="{{url('/services')}}">
											@csrf
											<div class="row g-3 mb-2">
												<div class="col-md-4">
													<label class="form-label" for="">Ticket From</label>
													<select name="ticket_type" id="ticketing_from" class="form-control" onchange="TicketingFrom()">
														<option value="">Select Here</option>
														<option value="Client List">Client List</option>
														<option value="Group List">Group List</option>
													</select>
												</div>
												<div class="col-md-4" id="client" style="display:none">
													<label class="form-label" for="">Select  Reservation</label>
													<select name="ticket_type" id="" class="form-control">
														<option value="">Select Client</option>
														<option value="">Client A</option>
														<option value="">Client B</option>
													</select>
												</div>
												<div class="col-md-4" id="group" style="display:none">
													<label class="form-label" for="">Select  Reservation</label>
													<select name="ticket_type" id="" class="form-control">
														<option value="">Select Group</option>
														<option value="">Group A</option>
														<option value="">Group B</option>
													</select>
												</div>
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
														<tbody>
															<?php
																$count=1;
																?>
															<tr>
																<td>Pakistani</td>
																<td>PIA</td>
																<td>45646545</td>
																<td>121221212</td>
																<td>Male</td>
																<td>5645645</td>
																<td>Ijazz</td>
																<td>Hammad</td>
																<td>groups</td>
																<td>CTO</td>
																<td><input type="text" placeholder="$" name="ticket_type"></td>
																<td><input type="text" placeholder="$" name="fee_amount"></td>
																<td><input type="text" placeholder="$" name="purchase_price"></td>
																<td><input type="text" placeholder="$" name="selling_price"></td>
															<tr>
																<td>Pakistani</td>
																<td>PIA</td>
																<td>45646545</td>
																<td>121221212</td>
																<td>Male</td>
																<td>5645645</td>
																<td>Ijazz</td>
																<td>Hammad</td>
																<td>groups</td>
																<td>CTO</td>
																<td><input type="text" placeholder="$" name="ticket_type"></td>
																<td><input type="text" placeholder="$" name="fee_amount"></td>
																<td><input type="text" placeholder="$" name="purchase_price"></td>
																<td><input type="text" placeholder="$" name="selling_price"></td>
															</tr>
															
															<?php
																$count+=1;
															?>
														</tbody>
													</table>
												</div>
												</div>
												<div class="row  mb-2">
														<center><input name="" class="btn btn-primary mt-4" type="submit" value="Cancel">
														<input name="" class="btn btn-primary mt-4" type="submit" value="Add Ticket"></center>
													
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
			    if(value==="Client List"){
			      $('#client').css('display','block');
			      $('#group').css('display','none');
			    }else if(value==="Group List"){
			      $('#client').css('display','none');
			      $('#group').css('display','block');
			    }
			  }
		</script>
	</body>
</html>