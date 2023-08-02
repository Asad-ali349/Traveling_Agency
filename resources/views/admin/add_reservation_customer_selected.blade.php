
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
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/add_investor')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                        <div class="col-md-4">
                                <label class="form-label" for="">Reservation Type:</label>
                                <select  class="form-control" name="" id="reservation_type" onchange="reservationtype()">
                                  <option>Select Reservation Type</option>
                                  <option value="Individual">Individual</option>
                                  <option value="Group">Group</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="Individual" style="display:none">
                                <label class="form-label" for="">Customer:</label>
                                <select  class="form-control" name="" id="">
                                  <option>Select Customer</option>
                                  <option value="1">Hammad</option>
                                  <option value="2">Sajjad</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="Group" style="display:none">
                                <label class="form-label" for="">Group:</label>
                                <select  class="form-control" name="" id="">
                                  <option>Select Group</option>
                                  <option value="1">Group A</option>
                                  <option value="2">Group B</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Service Type</label>
                                <select  class="form-control" name="" id="servicetype" onchange="serviceChange()">
                                  <option >Select Service Type</option>
                                  <option value="package">Package</option>
                                  <option value="visa">VISA</option>
                                  <option value="ticket">Ticket</option>
                                  <option value="hotel">Hotel</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="package" style="display:none">
                                <label class="form-label" for="">Service Package</label>
                                <select  class="form-control" name="" >
                                  <option >Select Package</option>
                                  <option value="">Package A</option>
                                  <option value="">Package England</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="visa" style="display:none">
                                <label class="form-label" for="">Service Type</label>
                                <select  class="form-control" name="" >
                                  <option >Select Visa</option>
                                  <option value="">Visa Dubai</option>
                                  <option value="">Visa England</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="ticket" style="display:none">
                                <label class="form-label" for="">Service Type</label>
                                <select  class="form-control" name=""> 
                                  <option >Select Ticket</option>
                                  <option value="">Ticket Dubai</option>
                                  <option value="">Ticket England</option>
                                  <option value="">Ticket Canada</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="hotel" style="display:none">
                                <label class="form-label" for="">Service Type</label>
                                <select  class="form-control" name="" >
                                  <option >Select Hotel</option>
                                  <option value="">Hotel Paradise</option>
                                  <option value="">Hotel Royal</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Length of Stay</label>
                            <input class="form-control" id="" name="length_of_stay" type="number" placeholder="Length of Stay">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Going Date</label>
                            <input class="form-control" id="" name="going_date" type="date" placeholder="Going Date">
                            </div>

                            <div class="col-md-4">
                            <label class="form-label" for="">Coming Date</label>
                            <input class="form-control" id="" name="comming_date" type="date" placeholder="Coming Date">
                            </div>
                            
                            <div class="col-md-4" >
                                <label class="form-label" for="">Price</label>
                              <input class="form-control" id="" name="price" type="number" placeholder="Price">
                            </div>
                            <div class="col-md-4" >
                                <label class="form-label" for="">Advance Price</label>
                              <input class="form-control" id="" name="advance_price" type="number" placeholder="Price">
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
      </script>
      <script>
        function serviceChange() {
          let serviceType=$('#servicetype').val();
          if(serviceType==='visa'){
            $('#visa').css('display','block')
            $('#ticket').css('display','none')
            $('#hotel').css('display','none')
            $('#package').css('display','none')
          }else if(serviceType==='ticket'){
            $('#visa').css('display','none')
            $('#ticket').css('display','block')
            $('#hotel').css('display','none')
            $('#package').css('display','none')
          }else if(serviceType==='hotel'){
            $('#visa').css('display','none')
            $('#ticket').css('display','none')
            $('#hotel').css('display','block')
            $('#package').css('display','none')
          }else if(serviceType==='package'){
            $('#visa').css('display','none')
            $('#ticket').css('display','none')
            $('#hotel').css('display','none')
            $('#package').css('display','block')
          }
        }

        function reservationtype() {
          console.log('sss')
          let reservation_type=$('#reservation_type').val();
          if(reservation_type==='Individual'){
            $('#Individual').css('display','block')
            $('#Group').css('display','none')
          }else if(reservation_type==='Group'){
            $('#Individual').css('display','none')
            $('#Group').css('display','block')
          }
        }
      </script>

  </body>

</html>