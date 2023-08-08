
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
										<form class="needs-validation" novalidate="" method="POST" action="{{url('admin/add_ticket')}}">
											@csrf
											<div class="row g-3 mb-2">
												<div class="col-md-4">
													<label class="form-label" for="">Ticket From</label>
													<select  id="ticketing_from" class="form-control" name="is_group" onchange="TicketingFrom()">
														<option value="">Select Here</option>
														<option value="Client">Client List</option>
														<option value="Group">Group List</option>
													</select>
												</div>
												<div class="col-md-4" id="client" style="display:none">
													<label class="form-label" for="">Select  Reservation</label>
													<select name="ticket_type" id="reservation" class="form-control" onchange="handleChangeClientChange()">
														<option value="">Select Client</option>
														@foreach($reservations as $reservation)
														@if($reservation->service_type=='flight')
														<option value="{{$reservation->id}}">{{$reservation->customer->first_name.' '.$reservation->customer->last_name.' ['.$reservation->reservation_no.']'}}</option>
														@endif
														@endforeach
													</select>
												</div>
												<div class="col-md-4" id="group" style="display:none">
													<label class="form-label" for="">Select  Reservation</label>
													<select name="group_id" id="group_reservation" class="form-control" onchange="handleChangeGroupReservation()">
														<option value="">Select Group</option>
														@foreach($groupings as $group)
														<option value="{{$group->id}}">{{$group->group_name}}</option>
														@endforeach
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
														<tbody id="table_data">
															
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
			    if(value==="Client"){
			      $('#client').css('display','block');
			      $('#group').css('display','none');
			    }else if(value==="Group"){
			      $('#client').css('display','none');
			      $('#group').css('display','block');
			    }
			  }
		</script>
		<script>
			function handleChangeClientChange() {
				var reservations=@json($reservations);
				var reservation_id=$('#reservation').val();
				// console.log({reservations,reservation_id});
				var filtered_reservation=reservations.filter((data)=>{
						return data.id==reservation_id
				});

				var reservation=filtered_reservation[0];
				// console.log(reservation);
				var tableBody=document.getElementById('table_data');
				tableBody.innerHTML = ""
				var table_row=document.createElement('tr');

				var ReservationIDInput = document.createElement("input");
				ReservationIDInput.type = "text";
				ReservationIDInput.name = "reservation_id[]";
				ReservationIDInput.value = reservation.id;


				var ReservationIDCell = document.createElement("td");
				ReservationIDCell.appendChild(ReservationIDInput)
				ReservationIDCell.style.display="none";
				var NationalityCell = document.createElement("td");
          		NationalityCell.textContent = reservation.customer.nationality
				
				var AirCompanyCell = document.createElement("td");
          		AirCompanyCell.textContent = reservation.flight.air_company.name;

				var PassportNumberCell = document.createElement("td");
				PassportNumberCell.textContent = reservation.customer.passport;
  
				var DOBCell = document.createElement("td");
				DOBCell.textContent = reservation.customer.dob;
				  
				var GenderCell = document.createElement("td");
				GenderCell.textContent = reservation.customer.gender;
  
				var IssuedDteCell = document.createElement("td");
				IssuedDteCell.textContent = reservation.customer.passport_issue_date;

				var FirstNameCell = document.createElement("td");
				FirstNameCell.textContent = reservation.customer.first_name;
				
				var LastNameCell = document.createElement("td");
				LastNameCell.textContent = reservation.customer.last_name;

				var GroupEntryCell = document.createElement("td");
				GroupEntryCell.textContent = "Entry";
				
				var GroupCTOCell = document.createElement("td");
				GroupCTOCell.textContent = "CTO";
				
				var TicketTypeCell = document.createElement("td");
				var TicketTypeInput = document.createElement("input");
				TicketTypeInput.type = "text";
				TicketTypeInput.name = "ticket_type[]";
				TicketTypeCell.appendChild(TicketTypeInput);

				var FeeAmountCell = document.createElement("td");
				var FeeAmountInput = document.createElement("input");
				FeeAmountInput.type = "number";
				FeeAmountInput.name = "fee_amount[]";
				FeeAmountInput.placeholder = "$";
				FeeAmountCell.appendChild(FeeAmountInput);

				var PurchasedCell = document.createElement("td");
				var PurchasedInput = document.createElement("input");
				PurchasedInput.type = "number";
				PurchasedInput.name = "purchase_amount[]";
				PurchasedInput.placeholder = "$";
				PurchasedCell.appendChild(PurchasedInput);

				var SellingCell = document.createElement("td");
				var SellingInput = document.createElement("input");
				SellingInput.type = "number";
				SellingInput.name = "selling_amount[]";
				SellingInput.placeholder = "$";
				SellingCell.appendChild(SellingInput);

				table_row.appendChild(ReservationIDCell);
				table_row.appendChild(NationalityCell);
				table_row.appendChild(AirCompanyCell);
				table_row.appendChild(PassportNumberCell);
				table_row.appendChild(DOBCell);
				table_row.appendChild(GenderCell);
				table_row.appendChild(IssuedDteCell);
				table_row.appendChild(FirstNameCell);
				table_row.appendChild(LastNameCell);
				table_row.appendChild(GroupEntryCell);
				table_row.appendChild(GroupCTOCell);
				table_row.appendChild(TicketTypeCell);
				table_row.appendChild(FeeAmountCell);
				table_row.appendChild(PurchasedCell);
				table_row.appendChild(SellingCell);
				
				tableBody.appendChild(table_row);
			}


			function handleChangeGroupReservation() {
				var groupings=@json($groupings);
				var grouping_id=$('#group_reservation').val();
				// console.log({groupings,grouping_id});

				var filtered_group=groupings.filter((data)=>{
						return data.id==grouping_id
				});

				var grouping=filtered_group[0];
				console.log(grouping);
				var tableBody=document.getElementById('table_data');
				tableBody.innerHTML = ""


				var rows=[];

				grouping.members.map((member)=>{
					var table_row=document.createElement('tr');

					var ReservationIDInput = document.createElement("input");
					ReservationIDInput.type = "text";
					ReservationIDInput.name = "reservation_id[]";
					ReservationIDInput.value = member.reservation.id;


					var ReservationIDCell = document.createElement("td");
					ReservationIDCell.appendChild(ReservationIDInput)
					ReservationIDCell.style.display="none";

					var NationalityCell = document.createElement("td");
					NationalityCell.textContent = member.reservation.customer.nationality
					
					var AirCompanyCell = document.createElement("td");
					AirCompanyCell.textContent = member.reservation.flight.air_company.name;

					var PassportNumberCell = document.createElement("td");
					PassportNumberCell.textContent = member.reservation.customer.passport;
	
					var DOBCell = document.createElement("td");
						DOBCell.textContent = member.reservation.customer.dob;
					
					var GenderCell = document.createElement("td");
						GenderCell.textContent = member.reservation.customer.gender;
	
					var IssuedDteCell = document.createElement("td");
						IssuedDteCell.textContent = member.reservation.customer.passport_issue_date;

					var FirstNameCell = document.createElement("td");
					FirstNameCell.textContent = member.reservation.customer.first_name;
					
					var LastNameCell = document.createElement("td");
					LastNameCell.textContent = member.reservation.customer.last_name;
					var GroupEntryCell = document.createElement("td");
					GroupEntryCell.textContent = "Entry";
					
					var GroupCTOCell = document.createElement("td");
					GroupCTOCell.textContent = "CTO";
					
					var TicketTypeCell = document.createElement("td");
					var TicketTypeInput = document.createElement("input");
					TicketTypeInput.type = "text";
					TicketTypeInput.name = "ticket_type[]";
					TicketTypeCell.appendChild(TicketTypeInput);
	


					var FeeAmountCell = document.createElement("td");
					var FeeAmountInput = document.createElement("input");
					FeeAmountInput.type = "number";
					FeeAmountInput.name = "fee_amount[]";
					FeeAmountInput.placeholder = "$";
					FeeAmountCell.appendChild(FeeAmountInput);

					var PurchasedCell = document.createElement("td");
					var PurchasedInput = document.createElement("input");
					PurchasedInput.type = "number";
					PurchasedInput.name = "purchase_amount[]";
					PurchasedInput.placeholder = "$";
					PurchasedCell.appendChild(PurchasedInput);

					var SellingCell = document.createElement("td");
					var SellingInput = document.createElement("input");
					SellingInput.type = "number";
					SellingInput.name = "selling_amount[]";
					SellingInput.placeholder = "$";
					SellingCell.appendChild(SellingInput);
					table_row.appendChild(ReservationIDCell);
					table_row.appendChild(NationalityCell);
					table_row.appendChild(AirCompanyCell);
					table_row.appendChild(PassportNumberCell);
					table_row.appendChild(DOBCell);
					table_row.appendChild(GenderCell);
					table_row.appendChild(IssuedDteCell);
					table_row.appendChild(FirstNameCell);
					table_row.appendChild(LastNameCell);
					table_row.appendChild(GroupEntryCell);
					table_row.appendChild(GroupCTOCell);
					
					table_row.appendChild(TicketTypeCell);
					table_row.appendChild(FeeAmountCell);
					table_row.appendChild(PurchasedCell);
					table_row.appendChild(SellingCell);


					rows.push(table_row);

				})



				
				
				rows.forEach((row) => {
					tableBody.appendChild(row);
				});



			}
		</script>
	</body>
</html>