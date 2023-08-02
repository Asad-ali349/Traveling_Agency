
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
                        <h5>Add Package:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/add_investor')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <label class="form-label" for="">Package Name</label>
                                <input class="form-control" id="" name="package_name" type="text" placeholder="First Name" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Visa</label>
                                <select class="form-control" name="visa" id="" required>
                                    <option >Select Visa</option>
                                    <option value="">Dubai</option>
                                    <option value="">Canada</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Ticket</label>
                                <select class="form-control" name="visa" id="" required>
                                    <option >Select Ticket</option>
                                    <option value="">Dubai - Direct</option>
                                    <option value="">Canada - Mixed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Going Date</label>
                                <input class="form-control" id="" name="going_date" type="date" placeholder="Going date" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Coming Date</label>
                                <input class="form-control" id="" name="comming_date" type="date" placeholder="Coming date" required="required">
                            </div>
                            <div class="col-md-12">
                              <h6>Accommodation</h6>
                            </div>
                            
                            <div class="col-md-4">
                            <label class="form-label" for="">City A</label>
                            <input class="form-control" id="" name="city_1" type="text" placeholder="City A" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Price</label>
                            <input class="form-control" id="" name="price_1" type="text" placeholder="Price" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Level</label>
                            <select name="level_accomodation_1" id="" class="form-control">
                              <option value="">Select Level</option>
                              <option value="">Paradise Hote - VIP</option>
                              <option value="">Royal Hote - Economy</option>
                              <option value="">Sky Hote - Normal</option>
                            </select>
                            </div>

                            <div class="col-md-4">
                            <label class="form-label" for="">City B</label>
                            <input class="form-control" id="" name="city_1" type="text" placeholder="City B" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Price</label>
                            <input class="form-control" id="" name="price_1" type="text" placeholder="Price" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Level</label>
                            <select name="level_accomodation_2" id="" class="form-control">
                              <option value="">Select Level</option>
                              <option value="">Paradise Hote - VIP</option>
                              <option value="">Royal Hote - Economy</option>
                              <option value="">Sky Hote - Normal</option>
                            </select>
                            </div>
                            <div class="col-md-12">
                              <h6>Logistics</h6>
                            </div>
                            
                            <div class="col-md-4">
                            <label class="form-label" for="">Hotel to Airport Price</label>
                            <input class="form-control" id="" name="hotel_to_airport_price" type="text" placeholder="Hotel to Airport Price" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Airport to Hotel Price</label>
                            <input class="form-control" id="" name="airport_to_hotel_price" type="text" placeholder="Airport to Hotel Price" required="required" >
                            </div>
                           
                            
                            <div class="col-md-12 mt-4">
                            <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Add Package"></center>
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
      </script>

  </body>

</html>