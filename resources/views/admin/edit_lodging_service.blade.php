
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
                        <h5>Edit Lodging:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/admin/edit_lodging_services')}}">
                      @csrf
                        <div class="row g-3 mb-2">
                            <h6>Add New Hotel:</h6>
                            <input class="form-control" id="hotel_id" name="hotel_id" type="hidden" placeholder="Hotel ID" required="required" value="{{$lodging->id}}">
                            <div class="col-md-3">
                                <label class="form-label" for="">Hotel Name</label>
                                <input class="form-control" id="hotel_name" name="hotel_name" type="text" placeholder="Hotel Name" required="required" value="{{$lodging->hotel_name}}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">City</label>
                                <select name="city" id="" class="form-control">
                                    <option value="">Select Here</option>
                                    @if($lodging->city == "Madina")
                                    <option value="Madina" selected>Madina</option>
                                    <option value="Makkah">Makkah</option>
                                    @elseif($lodging->city == "Makkah")
                                    <option value="Madina">Madina</option>
                                    <option value="Makkah" selected>Makkah</option>
                                    @else
                                    <option value="Madina">Madina</option>
                                    <option value="Makkah">Makkah</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Hotel Type</label>
                                <select name="hotel_type" id="" class="form-control">
                                    <option value="">Select Here</option>
                                    @if($lodging->hotel_type == "Economic")
                                    <option value="Economic" selected>Economic</option>
                                    <option value="Normal">Normal</option>
                                    <option value="VIP">VIP</option>
                                    @elseif($lodging->hotel_type == "Normal")
                                    <option value="Economic">Economic</option>
                                    <option value="Normal" selected>Normal</option>
                                    <option value="VIP">VIP</option>
                                    @elseif($lodging->hotel_type == "VIP")
                                    <option value="Economic">Economic</option>
                                    <option value="Normal">Normal</option>
                                    <option value="VIP" selected>VIP</option>
                                    @else
                                    <option value="Economic">Economic</option>
                                    <option value="Normal">Normal</option>
                                    <option value="VIP">VIP</option>
                                    @endif

                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Available From</label>
                                <input class="form-control" name="available_from" type="date" placeholder="Available From" required="required" value="{{$lodging->available_from}}">
                            </div>
                            <div class="col-md-3">
                            <label class="form-label" for="">Available To</label>
                            <input class="form-control" name="available_to" type="date" placeholder="Available To" value="{{$lodging->available_to}}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Room For 2:</label>
                                <input class="form-control" id="room_two" name="room_two" type="number" placeholder="Number of Rooms"  value="{{$lodging->rooms_for_two}}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Room For 3:</label>
                                <input class="form-control" id="room_three" name="room_three" type="number" placeholder="Number of Rooms" value="{{$lodging->rooms_for_three}}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Room For 4:</label>
                                <input class="form-control" id="room_four" name="room_four" type="number" placeholder="Number of Rooms" value="{{$lodging->rooms_for_four}}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Room For 5:</label>
                                <input class="form-control" id="room_five" name="room_five" type="number" placeholder="Number of Rooms" value="{{$lodging->rooms_for_five}}">
                            </div>
                            <div class="row  g-3 mb-2">
                            <h5>Visa Pricing:</h5>
                            <div class="mt-3">
                                <h6>For Package:</h6>
                            </div>
                            <div class="row g-3 mb-2">
                              <div class="table-responsive">
                                  <table class="table table-hover mt-4">
                                    <thead class="text-center">
                                      <tr>
                                        <th></th>
                                        <th class="p-2" colspan="2">Room For 2</th>
                                        <th class="p-2" colspan="2">Room For 3</th>
                                        <th class="p-2" colspan="2">Room For 4</th>
                                        <th class="p-2" colspan="2">Room For 5</th>
                                      </tr>
                                      <tr>
                                        <th></th>
                                        <th class="p-2">Buying Price</th>
                                        <th class="p-2">Selling Price</th>
                                        <th class="p-2">Buying Price</th>
                                        <th class="p-2">Selling Price</th>
                                        <th class="p-2">Buying Price</th>
                                        <th class="p-2">Selling Price</th>
                                        <th class="p-2">Buying Price</th>
                                        <th class="p-2">Selling Price</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="text-center">
                                        <td class="p-2 font-weight-bold">Adult</td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_two_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_two_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_two_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_two_selling_adult : ''}}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_three_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_three_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_three_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_three_selling_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_four_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_four_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_four_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_four_selling_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_five_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_five_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_adult_five_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_five_selling_adult : '' }}"></td>
                                      </tr>
                                      <tr class="text-center">
                                        <td class="p-2 font-weight-bold">Child</td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_two_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_two_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_two_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_two_selling_child : ''}}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_three_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_three_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_three_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_three_selling_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_four_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_four_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_four_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_four_selling_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_five_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_five_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_child_five_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_five_selling_child : '' }}"></td>
                                      </tr>
                                      <tr class="text-center">
                                        <td class="p-2 font-weight-bold">Infant</td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_two_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_two_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_two_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_two_selling_infant : ''}}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_three_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_three_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_three_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_three_selling_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_four_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_four_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_four_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_four_selling_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_five_buying" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_five_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="package_infant_five_selling" value="{{$lodging->price_for_package!=null? $lodging->price_for_package->room_five_selling_infant : '' }}"></td>
                                      </tr>
                                    
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                            <div class="mt-3">
                                <h6>For Individual:</h6>
                            </div>
                            <div class="row g-3 mb-2">
                              <div class="table-responsive">
                                <table class="table table-hover mt-4">
                                  <thead class="text-center">
                                    <tr>
                                      <th></th>
                                      <th class="p-2" colspan="2">Room For 2</th>
                                      <th class="p-2" colspan="2">Room For 3</th>
                                      <th class="p-2" colspan="2">Room For 4</th>
                                      <th class="p-2" colspan="2">Room For 5</th>
                                    </tr>
                                    <tr>
                                      <th></th>
                                      <th class="p-2">Buying Price</th>
                                      <th class="p-2">Selling Price</th>
                                      <th class="p-2">Buying Price</th>
                                      <th class="p-2">Selling Price</th>
                                      <th class="p-2">Buying Price</th>
                                      <th class="p-2">Selling Price</th>
                                      <th class="p-2">Buying Price</th>
                                      <th class="p-2">Selling Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <tr class="text-center">
                                        <td class="p-2 font-weight-bold">Adult</td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_two_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_two_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_two_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_two_selling_adult : ''}}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_three_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_three_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_three_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_three_selling_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_four_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_four_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_four_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_four_selling_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_five_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_five_buying_adult : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_adult_five_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_five_selling_adult : '' }}"></td>
                                      </tr>
                                      <tr class="text-center">
                                        <td class="p-2 font-weight-bold">Child</td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_two_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_two_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_two_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_two_selling_child : ''}}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_three_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_three_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_three_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_three_selling_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_four_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_four_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_four_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_four_selling_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_five_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_five_buying_child : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_child_five_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_five_selling_child : '' }}"></td>
                                      </tr>
                                      <tr class="text-center">
                                        <td class="p-2 font-weight-bold">Infant</td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_two_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_two_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_two_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_two_selling_infant : ''}}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_three_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_three_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_three_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_three_selling_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_four_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_four_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_four_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_four_selling_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_five_buying" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_five_buying_infant : '' }}"></td>
                                        <td class="p-2"><input class="form-control" type="number" placeholder="$" name="individual_infant_five_selling" value="{{$lodging->price_for_individual!=null? $lodging->price_for_individual->room_five_selling_infant : '' }}"></td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>


                        </div>
                        <div class="col-md-12 mt-3">
                                <center><input name="submit" class="btn btn-primary mt-3" type="submit" value="Update Lodging"></center>
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
    <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
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