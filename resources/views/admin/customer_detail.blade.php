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
						<div class="user-profile">
							<div class="row ">
								<div class="col-md-12">
									<div class="page-title">
										<div class="row">
											<div class="col-6">
												<h3>Customer Detail</h3>
											</div>
											<div class="col-6">
												<ol class="breadcrumb">
													<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">                                       
														<i data-feather="home"></i></a>
													</li>
													<li class="breadcrumb-item">View Customers</li>
													<li class="breadcrumb-item">Customer Detail</li>
												</ol>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-12">
									<div class="card hovercard text-center">
										<div class="cardheader"></div>
										<div class="user-image">
											<div class="avatar"><img alt="" src="{{asset('public/assets/images/user/sample.png')}}"></div>
											<div class="icon-wrapper"><a href="{{url('admin/edit_customer/'.$customer->id)}}"><i class="fa fa-edit"></i></a></div>
										</div>
										<div class="info">
											<div class="row">
												<div class="col-sm-12 col-lg-12 ">
													<div class="user-designation">
														<div class="title">{{$customer->first_name." ".$customer->last_name}}</div>
														<!-- <div class="desc">designer</div> -->
													</div>
												</div>
												<div class="col-sm-6 col-lg-12 ">
													<div class="row">
														<div class="col-md-12 d-flex justify-content-start">
															<h6 class="text-left">Personal Details</h6>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-envelope"></i> Email</h6>
																<span>{{$customer->email}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-child"></i>  Sex</h6>
																<span>{{$customer->sex}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-phone"></i>  Contact Number</h6>
																<span>{{$customer->phone}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-calendar"></i>  Date Of Birth</h6>
																<span>{{$customer->dob}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-id-card-o"></i>  Id Card</h6>
																<span>{{$customer->id_card}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-id-card-o"></i>  Passport</h6>
																<span>{{$customer->passport}}</span>
															</div>
														</div>
														@if($customer->passport_file!=null && $customer->passport_file !='')
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-id-card-o"></i>  Passport File</h6>
																<span><a href="{{asset('storage/app/'.$customer->passport_file)}} " target="blank">Click For Preview</a></span>
															</div>
														</div>
														@endif
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-calendar"></i>  Date of Issue</h6>
																<span>{{$customer->passport_issue_date}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-location-arrow"></i>  Location</h6>
																<span>{{$customer->city.''.$customer->nationality}}</span>
															</div>
														</div>
														<div class="col-md-12 mt-5 d-flex justify-content-start">
															<h6 class="text-left">Guardians Details</h6>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-user"></i>  Guardian Name</h6>
																<span>{{$customer->gaurdian_name}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-phone"></i>  Phone Number</h6>
																<span>{{$customer->gaurdian_phone}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-hand-o-right"></i>  RelationShip</h6>
																<span>{{$customer->gaurdian_relation}}</span>
															</div>
														</div>
														@if($customer->linked_with!=null)
														<div class="col-md-12 mt-5 d-flex justify-content-start">
															<h6 class="text-left">Linked With Details</h6>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-user"></i>  Name</h6>
																<span>{{$customer->linkedWith->first_name}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-phone"></i>  Phone</h6>
																<span>{{$customer->linkedWith->phone}}</span>
															</div>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-hand-o-right"></i>  Sex</h6>
																<span>{{$customer->linkedWith->sex}}</span>
															</div>
														</div>
														@endif
														<div class="col-md-12 mt-5 d-flex justify-content-start">
															<h6 class="text-left">Other Details</h6>
														</div>
														<div class="col-md-3 mt-4">
															<div class="ttl-info text-start">
																<h6><i class="fa fa-user"></i>  Collaborator</h6>
																<span>{{$customer->Collaborator? $customer->Collaborator->name : "No Collaborator"}}</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<!-- Container-fluid starts-->
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
		<script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
		<script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
		<script src="{{asset('public/assets/js/chart/chartist/chartist.js')}}"></script>
		<script src="{{asset('public/assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
		<script src="{{asset('public/assets/js/chart/knob/knob.min.js')}}"></script>
		<script src="{{asset('public/assets/js/chart/knob/knob-chart.js')}}"></script>
		<script src="{{asset('public/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
		<script src="{{asset('public/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
		<script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
		<script src="{{asset('public/assets/js/dashboard/default.js')}}"></script>
		<script src="{{asset('public/assets/js/notify/index.js')}}"></script>
		<script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
		<script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
		<script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead/handlebars.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead/typeahead.bundle.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead/typeahead.custom.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/handlebars.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
		<!-- Plugins JS Ends-->
		<!-- Theme js-->
		<script src="https://use.fontawesome.com/43c99054a6.js"></script>
		<script src="{{asset('public/assets/js/script.js')}}"></script>
	</body>
</html>