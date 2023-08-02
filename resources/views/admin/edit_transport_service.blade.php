    
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
                        <h5>Transport:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/admin/edit_transport_service')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                            <h6>Add New Transport:</h6>
                            <input class="form-control" id="name" name="transport_id" type="hidden" placeholder="Transport id" required="required" value="{{$transport->id}}">
                           
                            <div class="col-md-4">
                                <label class="form-label" for="">Transport Name:</label>
                                <input class="form-control" id="name" name="transport_name" type="text" placeholder="Transport Name" required="required" value="{{$transport->name}}">
                            </div>
                            <hr>
                        </div>
                        <div class="row  g-3 mb-2">
                            <h5>Service Pricing:</h5>
                            <div class="mt-3">
                                <h6>For Adult:</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="hover mt-4 col-md-8" style="width: 100%;">
                                            <thead style="background-color: #E5E5E5; text-align: center;">
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2" colspan="4">Morroco</th>
                                                <th class="m-2 p-2" colspan="4">KSA</th>
                                                </tr>
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2" colspan="2">One Way</th>
                                                <th class="m-2 p-2" colspan="2">Round Trip</th>
                                                <th class="m-2 p-2" colspan="2">One Way</th>
                                                <th class="m-2 p-2" colspan="2">Round Trip</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                $count=1;
                                              ?>
                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">VIP</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_morroco_buying" value="{{$transport->price_for_adult->vip_morroco_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_morroco_selling" value="{{$transport->price_for_adult->vip_morroco_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_morroco_buying_round" value="{{$transport->price_for_adult->vip_morroco_buying_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_morroco_selling_round" value="{{$transport->price_for_adult->vip_morroco_selling_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_ksa_buying" value="{{$transport->price_for_adult->vip_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_ksa_selling" value="{{$transport->price_for_adult->vip_ksa_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_ksa_buying_round" value="{{$transport->price_for_adult->vip_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_ksa_selling_round" value="{{$transport->price_for_adult->vip_ksa_selling_round}}"></td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">Normal</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_morroco_buying" value="{{$transport->price_for_adult->normal_morroco_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_morroco_selling" value="{{$transport->price_for_adult->normal_morroco_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_morroco_buying_round" value="{{$transport->price_for_adult->normal_morroco_buying_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_morroco_selling_round" value="{{$transport->price_for_adult->normal_morroco_selling_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_ksa_buying" value="{{$transport->price_for_adult->normal_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_ksa_selling" value="{{$transport->price_for_adult->normal_ksa_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_ksa_buying_round" value="{{$transport->price_for_adult->normal_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_ksa_selling_round" value="{{$transport->price_for_adult->normal_ksa_selling_round}}"></td>
                                                </tr>
                                                
                                                
                                                <?php
                                                  $count+=1;
                                                ?>
                                            </tbody>
                            </table>
                            </div>
                            <div class="mt-3">
                                <h6>For Child:</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="hover mt-4 col-md-8" style="width: 100%;">
                                            <thead style="background-color: #E5E5E5; text-align: center;">
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2" colspan="4">Morroco</th>
                                                <th class="m-2 p-2" colspan="4">KSA</th>
                                                </tr>
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2" colspan="2">One Way</th>
                                                <th class="m-2 p-2" colspan="2">Round Trip</th>
                                                <th class="m-2 p-2" colspan="2">One Way</th>
                                                <th class="m-2 p-2" colspan="2">Round Trip</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                $count=1;
                                              ?>
                                                
                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">VIP</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_morroco_buying" value="{{$transport->price_for_child->vip_morroco_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_morroco_selling" value="{{$transport->price_for_child->vip_morroco_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_morroco_buying_round" value="{{$transport->price_for_child->vip_morroco_buying_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_morroco_selling_round" value="{{$transport->price_for_child->vip_morroco_selling_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_ksa_buying" value="{{$transport->price_for_child->vip_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_ksa_selling" value="{{$transport->price_for_child->vip_ksa_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_ksa_buying_round" value="{{$transport->price_for_child->vip_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_child_ksa_selling_round" value="{{$transport->price_for_child->vip_ksa_selling_round}}"></td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">Normal</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_morroco_buying" value="{{$transport->price_for_child->normal_morroco_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_morroco_selling" value="{{$transport->price_for_child->normal_morroco_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_morroco_buying_round" value="{{$transport->price_for_child->normal_morroco_buying_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_morroco_selling_round" value="{{$transport->price_for_child->normal_morroco_selling_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_ksa_buying" value="{{$transport->price_for_child->normal_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_ksa_selling" value="{{$transport->price_for_child->normal_ksa_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_ksa_buying_round" value="{{$transport->price_for_child->normal_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_child_ksa_selling_round" value="{{$transport->price_for_child->normal_ksa_selling_round}}"></td>
                                                </tr>
                                                
                                                <?php
                                                  $count+=1;
                                                ?>
                                            </tbody>
                            </table>
                            </div>
                            <div class="mt-3">
                                <h6>For Infant:</h6>
                            </div>
                            <div class="table-responsive">
                            <table class="hover mt-4 col-md-8" style="width: 100%;">
                                            <thead style="background-color: #E5E5E5; text-align: center;">
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2" colspan="4">Morroco</th>
                                                <th class="m-2 p-2" colspan="4">KSA</th>
                                                </tr>
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2" colspan="2">One Way</th>
                                                <th class="m-2 p-2" colspan="2">Round Trip</th>
                                                <th class="m-2 p-2" colspan="2">One Way</th>
                                                <th class="m-2 p-2" colspan="2">Round Trip</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                $count=1;
                                              ?>
                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">VIP</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_morroco_buying" value="{{$transport->price_for_infant->vip_morroco_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_morroco_selling" value="{{$transport->price_for_infant->vip_morroco_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_morroco_buying_round" value="{{$transport->price_for_infant->vip_morroco_buying_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_morroco_selling_round" value="{{$transport->price_for_infant->vip_morroco_selling_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_ksa_buying" value="{{$transport->price_for_infant->vip_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_ksa_selling" value="{{$transport->price_for_infant->vip_ksa_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_ksa_buying_round" value="{{$transport->price_for_infant->vip_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="vip_infant_ksa_selling_round" value="{{$transport->price_for_infant->vip_ksa_selling_round}}"></td>
                                                </tr>


                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">Normal</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_morroco_buying" value="{{$transport->price_for_infant->normal_morroco_buying_one}}"></td>

                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_morroco_selling" value="{{$transport->price_for_infant->normal_morroco_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_morroco_buying_round" value="{{$transport->price_for_infant->normal_morroco_buying_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_morroco_selling_round" value="{{$transport->price_for_infant->normal_morroco_selling_round}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_ksa_buying" value="{{$transport->price_for_infant->normal_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_ksa_selling" value="{{$transport->price_for_infant->normal_ksa_selling_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_ksa_buying_round" value="{{$transport->price_for_infant->normal_ksa_buying_one}}"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="normal_infant_ksa_selling_round" value="{{$transport->price_for_infant->normal_ksa_selling_round}}"></td>
                                                </tr>
                                                
                                                <?php
                                                  $count+=1;
                                                ?>
                                            </tbody>
                            </table>
                            </div>
                            <div class="col-md-12 mt-4">
                              <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Add Transport"></center>
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