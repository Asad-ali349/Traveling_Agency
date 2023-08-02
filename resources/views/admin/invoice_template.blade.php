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
                  <h3>Invoice</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                     <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Compta</li>
                    <li class="breadcrumb-item active">Invoice</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="invoice" id="invoice">
                      <div>
                        <div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="media">
                                <div class="media-left"><img class="media-object img-60" src="../assets/images/other-images/logo-login.png" alt=""></div>
                                <div class="media-body m-l-20 text-right">
                                  <img src="{{asset('public/assets/images/logo/logo.png')}}" style="width:80%"/>
                                  <!-- <h4 class="media-heading">Cuba</h4>
                                  <p>hello@Cuba.in<br><span>289-335-6503</span></p> -->
                                </div>
                              </div>
                              <!-- End Info-->
                            </div>
                            <div class="col-sm-6">
                              <div class="text-md-end text-xs-center">
                                <h3>Invoice #<span class="counter">1069</span></h3>
                                <p>Invoice Date: May<span> 27, 2015</span><br>                                                            Payment Due: June <span>27, 2015</span></p>
                              </div>
                              <!-- End Title-->
                            </div>
                          </div>
                        </div>
                        <hr>
                        <!-- End InvoiceTop-->
                        <div class="row">
                          <div class="col-md-4">
                            <div class="media">
                              <div class="media-left"><img class="media-object rounded-circle img-60" src="../assets/images/user/1.jpg" alt=""></div>
                              <div class="media-body m-l-20">
                                <h6 class="media-heading">Bill From</h6>
                                <h4 class="media-heading mt-3">Johan Deo</h4>
                                <p>JohanDeo@gmail.com<br><span>City</span><br><span>555-555-5555</span></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="text-md-end" id="project">
                              <div class="media-body m-l-20">
                                <h6 class="media-heading">Bill TO</h6>
                                <h4 class="media-heading mt-3">Hammad</h4>
                                <p>Hammad@gmail.com<br><span>City</span><br><span>555-555-5555</span></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End Invoice Mid-->
                        <div>
                          <div class="table-responsive invoice-table" id="table">
                            <table class="table table-bordered table-striped">
                              <tbody>
                                <tr>
                                  <td class="item">
                                    <h6 class="p-2 mb-0">Item Description</h6>
                                  </td>
                                  <td class="Rate">
                                    <h6 class="p-2 mb-0">Quantity</h6>
                                  </td>
                                  <td class="subtotal">
                                    <h6 class="p-2 mb-0">Sub-total</h6>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label>Visa VIP</label>
                                    <p class="m-0">Visa</p>
                                  </td>
                                  <td>
                                    <p class="itemtext">$75</p>
                                  </td>
                                  <td>
                                    <p class="itemtext">$375.00</p>
                                  </td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>
                          <!-- End Table-->
                          <div class="row mt-5">
                            <div class="col-md-8">
                              <div>
                                <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time</p>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <table width="100%" class="mt-3">
                                <tr>
                                  <td ><h6 class="p-2 mb-0">Sub-Total</h6></td>
                                  <td class="p-2 mb-0">$20</td>
                                </tr>
                                <tr>
                                  <td><h6 class="p-2 mb-0">Taxes</h6></td>
                                  <td class="p-2 mb-0">$2</td>
                                </tr>
                                <tr>
                                  <td><h6 class="p-2 mb-0">Total</h6></td>
                                  <td class="p-2 mb-0">$22</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <!-- End InvoiceBot-->
                      </div>
                      <div class="col-sm-12 text-center mt-3">
                        <button class="btn btn btn-primary me-2" type="button" onclick="myFunction()">Print</button>
                        <button class="btn btn-secondary" type="button">Cancel</button>
                      </div>
                      <!-- End Invoice-->
                      <!-- End Invoice Holder-->
                      <!-- Container-fluid Ends-->
                    </div>
                  </div>
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