

<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="{{asset('public/assets/dash_1.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/dash_2.css')}}">
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
            <div class="row ">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                <div class="row widget-statistic">

                    <div class="col-xl- col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <a href="{{url('/admin/collaborator')}}">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                        <i data-feather="user"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" style="font-size: 20px;">Collaborators</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl- col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <a href="{{url('/admin/transport')}}">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                        <i data-feather="user"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" style="font-size: 20px;">Carriers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl- col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <a href="{{url('/admin/airline')}}">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                        <i data-feather="user"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" style="font-size: 20px;">Air Companies</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
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
    <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/chartist/chartist.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/knob/knob.min.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/knob/knob-chart.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('public/assets/js/notify/index.js')}}"></script>
    <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    <script src="{{asset('public/assets/js/typeahead/handlebars.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="https://use.fontawesome.com/43c99054a6.js"></script>
    <script src="{{asset('public/assets/js/script.js')}}"></script>
    <!-- <script src="{{asset('public/assets/dash_1.js')}}"></script> -->
        <!-- login js-->
    <!-- Plugin used-->

   <!-- <script src="{{asset('resources/views/includes/revenue_calculation.js')}}"></script> -->

  </body>

</html>