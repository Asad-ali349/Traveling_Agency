
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
                        <h5>Edit Customer:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('admin/edit_customer')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                          <div class="col-md-12">
                            <h6>Personal Details</h6>
                          </div>
                            <input class="form-control" id="" name="id" type="hidden" required="required" value="{{$customer->id}}">
                            <div class="col-md-4">
                                <label class="form-label" for="">First Name</label>
                                <input class="form-control" id="" name="first_name" type="text" placeholder="First Name" required="required" value="{{$customer->first_name}}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Last Name</label>
                                <input class="form-control" id="" name="last_name" type="text" placeholder="Last Name" required="required" value="{{$customer->last_name}}">
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Sex</label>
                              <select name="sex" id="" class="form-control">
                                
                                <option value="">Select Sex</option>
                                @if($customer->sex == "Masculine")
                                    <option value="Masculine" selected>Masculine</option>
                                    <option value="Faminine">Feminine</option>
                                @elseif($customer->sex == "Faminine")
                                    <option value="Masculine">Masculine</option>
                                    <option value="Faminine" selected>Faminine</option>
                                @else
                                    <option value="Masculine">Masculine</option>
                                    <option value="Faminine">Faminine</option>
                                @endif
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Gender</label>
                              <select name="gender" id="" class="form-control">
                                <option value="">Select Gender </option>
                                  @if($customer->gender == "Adult")
                                      <option value="Adult" selected>Adult</option>
                                      <option value="Child">Child</option>
                                      <option value="Infant">Infant</option>
                                  @elseif($customer->gender == "Child")
                                      <option value="Adult">Adult</option>
                                      <option value="Child" selected>Child</option>
                                      <option value="Infant">Infant</option>
                                  @elseif($customer->gender == "Infant")
                                      <option value="Adult">Adult</option>
                                      <option value="Child">Child</option>
                                      <option value="Infant" selected>Infant</option>
                                  @else
                                      <option value="Adult">Adult</option>
                                      <option value="Child">Child</option>
                                      <option value="Infant">Infant</option>
                                  @endif
                              </select>
                            </div>
                            
                            
                            <div class="col-md-4">
                            <label class="form-label" for="">Phone</label>
                            <input class="form-control" id="" name="phone" type="text" placeholder="Phone" required="required" maxlength="11" minlength="10" value="{{$customer->phone}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Date of Birth</label>
                            <input class="form-control" id="" name="dob" type="date" placeholder="DOB" required="required" value="{{$customer->dob}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">ID Card</label>
                            <input class="form-control" id="" name="cnic" type="text" placeholder="CNIC" required="required" value="{{$customer->id_card}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Passport</label>
                            <input class="form-control" id="" name="passport" type="text" placeholder="Passport" required="required" value="{{$customer->passport}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Passport File</label>
                            <input class="form-control" id="" name="passport_file" type="file" placeholder="Passport/CNIC" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Date of Issue</label>
                            <input class="form-control" id="" name="issue_date" type="date" placeholder="Date of Issue" required="required" value="{{$customer->passport_issue_date}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Nationality</label>
                            <input class="form-control" id="" name="nationality" type="text" placeholder="Nationality" required="required" value="{{$customer->nationality}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">City</label>
                            <input class="form-control" id="" name="city" type="text" placeholder="City" required="required" value="{{$customer->city}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Email</label>
                            <input class="form-control" id="" name="email" type="email" placeholder="Email" value="{{$customer->email}}">
                            </div>
                            <div class="col-md-12">
                              <h6>Guardians Details</h6>
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Guardian Name</label>
                            <input class="form-control" id="" name="guardian_name" type="text" placeholder="Guardian Name" required="required" value="{{$customer->gaurdian_name}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Guardian Phone</label>
                            <input class="form-control" id="" name="guardian_phone" type="text" placeholder="Guardian Phone" required="required" value="{{$customer->gaurdian_phone}}">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Relationship</label>
                            <input class="form-control" id="" name="relation" type="text" placeholder="Relationship" required="required" value="{{$customer->gaurdian_relation}}">
                            </div>
                            <div class="col-md-12">
                              <h6>Collaborator/Partner Details</h6>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Collaborator</label>
                                <select  class="form-control select2" name="collaborator"> 
                                  <option >Select Collaborator</option>
                                  <option value="">Sajjad</option>
                                  <option value="">Hadeed</option>
                                  <option value="">Hammad</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                              <h6>Linked with (Optional)</h6>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="">Linked With</label>
                                <select  class="form-control select2" name="linked_with"> 
                                  <option >Select Link</option>
                                  @foreach($customers as $singlecustomer)
                                    @if($singlecustomer->id==$customer->linked_with)
                                    <option value="{{$singlecustomer->id}}" selected>{{$singlecustomer->first_name.' '.$singlecustomer->last_name}}</option>
                                    @else
                                    <option value="{{$singlecustomer->id}}">{{$singlecustomer->first_name.' '.$singlecustomer->last_name}}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                            <center>
                              <input name="submit" class="btn btn-primary mt-4 m-2" type="submit" value="Update Customer">
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

  </body>

</html>