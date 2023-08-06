
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
                        <h5>Add Customer:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('admin/add_customer')}}" enctype="multipart/form-data" id="customer_form">
                      @csrf
                        <div class="row g-3 mb-2">
                          <div class="col-md-12">
                            <h6>Personal Details</h6>
                          </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">First Name</label>
                                <input class="form-control" id="first_name" name="first_name" type="text" placeholder="First Name" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Last Name</label>
                                <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Last Name" required="required">
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Sex</label>
                              <select name="sex" id="sex" class="form-control">
                                <option value="">Select Sex</option>
                                <option value="Masculine">Masculine</option>
                                <option value="Faminine">Faminine</option>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Gender</label>
                              <select name="gender" id="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Adult">Adult</option>
                                <option value="Child">Child</option>
                                <option value="Infant">Infant</option>
                              </select>
                            </div>
                            
                            
                            <div class="col-md-4">
                            <label class="form-label" for="">Phone</label>
                            <input class="form-control" id="phone" name="phone" type="text" placeholder="Phone" required="required"  minlength="10">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Date of Birth</label>
                            <input class="form-control" id="dob" name="dob" type="date" placeholder="DOB" required="required" maxlength="13" minlength="13">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">ID Card</label>
                            <input class="form-control" id="cnic" name="cnic" type="text" placeholder="CNIC"  >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Passport</label>
                            <input class="form-control" id="passport" name="passport" type="text" placeholder="Passport"  >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Passport File</label>
                            <input class="form-control" id="passport_file" name="passport_file" type="file" placeholder="Passport/CNIC"  >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Date of Issue</label>
                            <input class="form-control" id="issue_date" name="issue_date" type="date" placeholder="Date of Issue"  >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Nationality</label>
                            <input class="form-control" id="nationality" name="nationality" type="text" placeholder="Nationality" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">City</label>
                            <input class="form-control" id="city" name="city" type="text" placeholder="City" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email">
                            </div>
                            <div class="col-md-12">
                              <h6>Guardians Details</h6>
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Guardian Name</label>
                            <input class="form-control" id="guardian_name" name="guardian_name" type="text" placeholder="Guardian Name" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Guardian Phone</label>
                            <input class="form-control" id="guardian_phone" name="guardian_phone" type="text" placeholder="Guardian Phone" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Relationship</label>
                            <input class="form-control" id="relation" name="relation" type="text" placeholder="Relationship" >
                            </div>
                            <div class="col-md-12">
                              <h6>Collaborator/Partner Details</h6>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Collaborator</label>
                                <select  class="form-control select2" name="collaborator" id="collaborator"> 
                                  <option >Select Collaborator</option>
                                  @foreach($collaborators as $collaborator)
                                    <option value="{{$collaborator->id}}">{{$collaborator->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                              <h6>Linked with (Optional)</h6>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Linked With</label>
                                <select  class="form-control select2" name="linked_with" id="linked_with"> 
                                  <option >Select Link</option>
                                  @foreach($customers as $customer)
                                  <option value="{{$customer->id}}">{{$customer->first_name.' '.$customer->last_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                            <center>
                              <input name="submit" class="btn btn-primary mt-4 m-2" type="submit" id="add_customer" value="Only Save Customer">
                              <input name="submit" class="btn btn-primary mt-4 m-2" type="submit" id="reservation" value="Go to Reservation">
                            </center>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script type="text/javascript">
        setTimeout(function() {
            $('#messages').fadeOut('fast');
        }, 5000);
        $(document).ready(function() {
            $('.select2').select2();
        });
      </script>
      <script>
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
      </script>
      <!-- <script>
         function submit_customer(){
          var first_name=$('#first_name').val();
          var last_name=$('#last_name').val();
          var sex=$('#sex').val();
          var gender=$('#gender').val();
          var phone=$('#phone').val();
          var dob=$('#dob').val();
          var cnic=$('#cnic').val();
          var passport=$('#passport').val();
          var passport_file=$('#passport_file').val();
          var issue_date=$('#issue_date').val();
          var nationality=$('#nationality').val();
          var city=$('#city').val();
          var email=$('#email').val();
          var guardian_name=$('#guardian_name').val();
          var guardian_phone=$('#guardian_phone').val();
          var relation=$('#relation').val();
          var collaborator=$('#collaborator').val();
          var linked_with=$('#linked_with').val();

         }

      </script> -->

      <!-- <script>
        $(document).ready(function() {
        // Event listener for button1
        $('#add_customer').on('click', function() {
          console.log("aaa")

            $('#customer_form').attr('action', `{{ url('admin/add_customer') }}`);
            console.log($('#customer_form'));
            $('#customer_form').submit();
        });

        // Event listener for button2
        $('#reservation').on('click', function() {
            $('#customer_form').attr('action', '{{ url('admin/go_to_reservation') }}');
            $('#customer_form').submit();
        });
    });
      </script> -->

  </body>

</html>