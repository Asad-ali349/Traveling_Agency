    
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
                        <h5>Edit Extra Services:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/admin/edit_extra_services')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <label class="form-label" for="">Service Name:</label>
                                <input class="form-control" id="name" name="service_id" type="hidden" placeholder="Service Id" required="required" value="{{$extra_service->id}}">
                                <input class="form-control" id="name" name="service_name" type="text" placeholder="Service Name" required="required" value="{{$extra_service->name}}">
                            </div>
                            <hr>
                            <h5>Pricing:</h5>
                            <div class="row g-3 mb-2">
                              <div class="table-responsive col-md-8">
                                <table class="table table-hover mt-4" id="example-style-51">
                                  <thead style="text-align: center; background-color: #E5E5E5;">
                                    <tr>
                                      <th></th>
                                      <th class="m-2 p-2" colspan="4">Morocco</th>
                                    </tr>
                                    <tr>
                                      <th></th>
                                      <th class="m-2 p-2" colspan="2">One Way</th>
                                      <th class="m-2 p-2" colspan="2">Round Trip</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr style="text-align: center;">
                                      <td class="m-1 p-2" style="font-weight: bold; width: 100px">Adult</td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="adult_buying" value="{{$extra_service->service_price!=null? $extra_service->service_price->adult_buying_one: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="adult_selling" value="{{$extra_service->service_price!=null? $extra_service->service_price->adult_selling_one: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="adult_buying_round" value="{{$extra_service->service_price!=null? $extra_service->service_price->adult_buying_round: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="adult_selling_round" value="{{$extra_service->service_price!=null? $extra_service->service_price->adult_selling_round: ''}}"></td>
                                    </tr>
                                    <tr style="text-align: center;">
                                      <td class="m-1 p-2" style="font-weight: bold; width: 100px">Child</td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="child_buying" value="{{$extra_service->service_price!=null? $extra_service->service_price->child_buying_one: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="child_selling" value="{{$extra_service->service_price!=null? $extra_service->service_price->child_selling_one: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="child_buying_round" value="{{$extra_service->service_price!=null? $extra_service->service_price->child_buying_round: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="child_selling_round" value="{{$extra_service->service_price!=null? $extra_service->service_price->child_selling_round: ''}}"></td>
                                    </tr>
                                    <tr style="text-align: center;">
                                      <td class="m-1 p-2" style="font-weight: bold; width: 100px">Infant</td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="infant_buying" value="{{$extra_service->service_price!=null? $extra_service->service_price->infant_buying_one: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="infant_selling" value="{{$extra_service->service_price!=null? $extra_service->service_price->infant_selling_one: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="infant_buying_round" value="{{$extra_service->service_price!=null? $extra_service->service_price->infant_buying_round: ''}}"></td>
                                      <td class="m-2 p-2"><input class="form-control" style="width: 60px;" type="number" placeholder="$" name="infant_selling_round" value="{{$extra_service->service_price!=null? $extra_service->service_price->infant_selling_round: ''}}"></td>
                                    </tr>
                                    
                                  </tbody>
                                </table>
                              </div>
                            </div>

                            <div class="col-md-12 mt-4">
                              <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Update Extra Services"></center>
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
    <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
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