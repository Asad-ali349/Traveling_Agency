<!DOCTYPE html>
<html lang="en">
  

@include('admin/includes/head')
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('admin/includes/topbar')
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('admin/includes/sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Receipt</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                    <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">General Accounting</li>
                    <li class="breadcrumb-item active">Receipt</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="card" id="invoice">
                  <div class="card-body">
                    <div class="invoice" >
                      <!-- <div style="background-color:#BC8E36; height:30px">

                      </div> -->
                      <div>
                        <div>
                          <div class="row">
                            <div style="display:flex; justify-content:space-between ">
                              <div class="col-sm-6 logo_invoice" >
                                <div class="media">
                                  <div class="media-body m-l-20 text-right logo_invoice">
                                    <img src="{{asset('public/assets/images/logo/logo.png')}}" style="width:80%"/>
                                    
                                  </div>
                                </div>
                                <!-- End Info-->
                              </div>
                              <div class="col-sm-6">
                                <div class="text-md-end text-xs-center">
                                  <h3>Receipt</h3>

                                  
                                  <p style="color:grey"><b>Receipt Number:</b> <span style="color:#BC8E36"> {{date('d/Y')}}</span><br><b>Receipt Date:</b><span style="color:#BC8E36"> {{date('M d Y')}}</span><br><b>Operated by:</b> <span style="color:#BC8E36"> {{Auth::guard('admin')->user()->name}}</span></p>
                                </div>
                                <!-- End Title-->
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <!-- End InvoiceTop-->
                        <div class="row mt-5" >
                          <div style="display:flex; "> 
                          <div class="col-md-4">
                            <div class="media">
                              <div class="media-left"><img class="media-object rounded-circle img-60" src="../assets/images/user/1.jpg" alt=""></div>
                              <div class="media-body m-l-20">
                                <p class="media-heading"><b>Customer Name:</b> <br>
                                <span style="color:#BC8E36">{{$reservation->customer->first_name.' '.strtoupper($reservation->customer->last_name)}}</span></p>
                                <p class="media-heading"><b><span style="color:#BC8E36">{{$reservation->customer->passport}}</span></b> <br><span style="color:#BC8E36">{{$reservation->customer->phone}}</span></p>
                                <!-- <h4 class="media-heading mt-3">Johan Deo</h4>
                                <p>JohanDeo@gmail.com<br><span>City</span><br><span>555-555-5555</span></p> -->
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 reservation_detail_secttion">
                            <div class="media">
                              <div class="media-body m-l-20" style="padding-left:15px">
                                <p class="media-heading"><b>Reservation Number:</b> <br><span style="color:#BC8E36">{{$reservation->reservation_no}}</span></p>
                                <p class="media-heading"><b>Reservation Date:</b> <br><span style="color:#BC8E36">
                                  @php 
                                  $created=strtotime($reservation->created_at);
                                  $date=date('d M Y',$created);
                                  @endphp 
                                  {{$date}}
                              </span></p>
                                <!-- <h4 class="media-heading mt-3">Johan Deo</h4>
                                <p>JohanDeo@gmail.com<br><span>City</span><br><span>555-555-5555</span></p> -->
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                        <!-- End Invoice Mid-->
                        <div>
                          <div class="table-responsive invoice-table mt-5" id="table">
                            <table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th >
                                  Item Description
                                  </th>
                                  <th >
                                  Quantity
                                  </th>
                                  <th >
                                    Unit Price (MAD)
                                  </th>
                                  <th >
                                    Sub-Total (MAD)
                                  </th>
                                </tr>
                              </thead>  
                            <tbody>
                                <tr>
                                  <td>
                                    @php 
                                    $item="";
                                      if($reservation->service_type=='package')
                                        $item=$reservation->package->package_service->name;
                                      elseif($reservation->service_type=='visa')
                                        $item=$reservation->visa->visa_service->visa_name;
                                      elseif($reservation->service_type=='transport')
                                        $item=$reservation->transport->transport_service->name;
                                      elseif($reservation->service_type=='flight')
                                        $item=$reservation->flight->flight_service->name;
                                    @endphp
                                    <label>{{$reservation->service_type.' - '.$item}}</label>
                                  </td>
                                  <td>
                                    <p class="itemtext">1</p>
                                  </td>
                                  <td>
                                  @php 
                                    $price="";
                                      if($reservation->service_type=='package')
                                        $price=$reservation->package->service_price;
                                      elseif($reservation->service_type=='visa')
                                        $price=$reservation->visa->service_price;
                                      elseif($reservation->service_type=='transport')
                                        $price=$reservation->transport->service_price;
                                      elseif($reservation->service_type=='flight')
                                        $price=$reservation->flight->service_price;
                                    @endphp

                                    <p class="itemtext">{{$price}}</p>
                                  </td>
                                  <td>
                                  @php 
                                    $price="";
                                      if($reservation->service_type=='package')
                                        $price=$reservation->package->service_price;
                                      elseif($reservation->service_type=='visa')
                                        $price=$reservation->visa->service_price;
                                      elseif($reservation->service_type=='transport')
                                        $price=$reservation->transport->service_price;
                                      elseif($reservation->service_type=='flight')
                                        $price=$reservation->flight->service_price;
                                    @endphp

                                    <p class="itemtext">{{$price}}</p>
                                  </td>
                                </tr>
                                @if($reservation->extra_service!=null)
                                <tr>
                                  <td>
                                    
                                    <label>{{'Extra Service '.'- '.$reservation->extra_service->extra_service->name}}</label>
                                  </td>
                                  <td>
                                    <p class="itemtext">1</p>
                                  </td>
                                  <td>
                                  @php 
                                    $price="";
                                      if($reservation->service_type=='package')
                                        $price=$reservation->package->service_price;
                                      elseif($reservation->service_type=='visa')
                                        $price=$reservation->visa->service_price;
                                      elseif($reservation->service_type=='transport')
                                        $price=$reservation->transport->service_price;
                                      elseif($reservation->service_type=='flight')
                                        $price=$reservation->flight->service_price;
                                    @endphp

                                    <p class="itemtext">{{$reservation->extra_service->service_price}}</p>
                                  </td>
                                  <td>
                                  

                                    <p class="itemtext">{{$reservation->extra_service->service_price}}</p>
                                  </td>
                                </tr>
                                @endif
                                
                              </tbody>
                            </table>
                          </div>
                          <!-- End Table-->
                          <div class="row mt-5">
                            <div style="display:flex; justify-content:space-between ">
                            <div class="col-md-8" id="legal">
                              
                            </div>
                            <div class="col-md-4" id="total">
                              <table width="100%" class="mt-3">
                                <tr>
                                  <td ><b>Sub-Total (MAD)</b></td>
                                  <td class="p-2 mb-0">{{$reservation->payment->total_amount}}</td>
                                </tr>
                                <tr>
                                  <td ><b>Taxes (MAD)</b></td>
                                  <td class="p-2 mb-0">
                                    @php
                                    $tax=0;
                                    if($reservation->payment->payment_method=='Credit Card'){
                                      $tax=3;
                                    }
                                    @endphp
                                    {{((float)$reservation->payment->total_amount*$tax)/100;}}
                                  </td>
                                </tr>
                                <tr>
                                  <td class="item"><b>Total (MAD)</b></td>
                                  <td class="p-2 mb-0">
                                    @php 
                                      $total_amount=$reservation->payment->total_amount;
                                      $tax_amount=((float)$total_amount*$tax)/100;
                                    @endphp
                                    {{(float)$total_amount+(float)$tax_amount}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            </div>
                            
                          </div>
                          <div class="table-responsive invoice-table" style="margin-top:30px">
                            <table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th class="item">
                                    Payment Method
                                  </th>
                                  <th class="Rate">
                                    Date
                                  </th>
                                  <th class="subtotal">
                                    Total Amount (MAD)
                                  </th>
                                </tr>
                              </thead>  
                            <tbody>
                                <tr>
                                  <td>
                                    
                                    <label>{{$reservation->payment->payment_method}}</label>
                                  </td>
                                  <td>
                                    <p class="itemtext">
                                    @php 
                                      $created_at=strtotime($reservation->payment->created_at);
                                      $date=date("d M Y",$created_at);
                                      @endphp
                                      {{$date}}
                                    </p>
                                  </td>
                                  <td>
                                    <p class="itemtext">
                                    @php 
                                      $total_amount=$reservation->payment->total_amount;
                                      $tax_amount=((float)$total_amount*$tax)/100;
                                    @endphp
                                    {{(float)$total_amount+(float)$tax_amount}}

                                    </p>
                                  </td>
                                </tr>
                               
                                
                              </tbody>
                            </table>
                          </div>
                          <div class="table-responsive invoice-table" style="margin-top:30px">
                            <table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th class="item">
                                    Payment Method
                                  </th>
                                  <th class="Rate">
                                    Date
                                  </th>
                                  <th class="subtotal">
                                    Received Amount (MAD)
                                  </th>
                                </tr>
                              </thead>  
                            <tbody>
                                <tr>
                                  <td>
                                    
                                    <label>{{$reservation->payment->payment_method}}</label>
                                  </td>
                                  <td>
                                    <p class="itemtext">
                                      @php 
                                      $created_at=strtotime($reservation->payment->created_at);
                                      $date=date("d M Y",$created_at);
                                      @endphp
                                      {{$date}}
                                    </p>
                                  </td>
                                  <td>
                                    <p class="itemtext">
                                    @php 
                                      $advance_amount=$reservation->payment->advance_amount;
                                      $tax_amount=((float)$advance_amount*$tax)/100;
                                    @endphp
                                    {{(float)$advance_amount+(float)$tax_amount}}

                                    </p>
                                  </td>
                                </tr>
                               
                                
                              </tbody>
                            </table>
                          </div>
                          <div class="table-responsive invoice-table" style="margin-top:30px">
                            <table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th class="item">
                                    Payment Method
                                  </th>
                                  <th class="Rate">
                                    Date
                                  </th>
                                  <th class="subtotal">
                                    Rest Amount (MAD)
                                  </th>
                                </tr>
                              </thead>  
                            <tbody>
                                <tr>
                                  <td>
                                    
                                    <label>{{$reservation->payment->payment_method}}</label>
                                  </td>
                                  <td>
                                    <p class="itemtext">
                                    @php 
                                      $created_at=strtotime($reservation->payment->created_at);
                                      $date=date("d M Y",$created_at);
                                      @endphp
                                      {{$date}}
                                    </p>
                                  </td>
                                  <td>
                                    <p class="itemtext">
                                    @php 
                                      $rest_amount=$reservation->payment->rest_amount;
                                      $tax_amount=((float)$rest_amount*$tax)/100;
                                    @endphp
                                    {{(float)$rest_amount+(float)$tax_amount}}

                                    </p>
                                  </td>
                                </tr>
                               
                                
                              </tbody>
                            </table>
                          </div>
                          <div>
                            
                          </div>
                        </div>
                        
                        <!-- End InvoiceBot-->
                      </div>
                      <!-- End Invoice-->
                      <!-- End Invoice Holder-->
                      <!-- Container-fluid Ends-->
                    </div>
                  </div>
                  <div class="invoice_footer" style="width:100%;background-image:url({{asset('public/assets/images/golden_background.PNG')}});">
                  
                    <div class="row px-5 py-4 text-black">
                     <div style="display:flex; justify-content:space-between">

                     
                     <div class="col-md-8">
                      <p>
                        <b>ICE:</b> 000070291000045
                      <br>
                       <b>Address:</b> Op. Bab Targa, Imm A Appt 01 -Azzouzia Marrakech 
                      <br>
                      <b>Mail:</b> contact@ci-voyages.com
                      <br>
                      <b>Phone:</b> +212 524 205 599 | +212 666 660 813 | +212 666 660 814
                      </p>
                     </div>
                     <div class="col-md-4  footer_invvoice_logo">
                      <img src="{{asset('public/assets/images/logo/iata-logo.png')}}" class="footer_invvoice_logo" style="width:80%">
                     </div>
                     </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 text-center mt-3 mb-5">
                  <button class="btn btn btn-primary me-2" type="button" onclick="myFunction()">Print</button>
                  <button class="btn btn-secondary" type="button">Cancel</button>
                </div>
              </div>
            </div>
          </div>
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
    <script src="{{asset('public/assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('public/assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('public/assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('public/assets/js/print.js')}}"></script>
    <script src="{{asset('public/assets/js/tooltip-init.js')}}"></script>
  
  </body>
</html>