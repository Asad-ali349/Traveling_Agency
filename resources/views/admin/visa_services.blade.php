    
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
                        <h5>VISA:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/admin/visa_services')}}">
                      @csrf
                        <div class="row g-3 mb-2">
                            <h6>Add New Visa:</h6>
                            <div class="col-md-4">
                                <label class="form-label" for="">VISA Name:</label>
                                <input class="form-control" id="name" name="visa_name" type="text" placeholder="Visa Name" required="required">
                            </div>
                            <hr>
                        </div>
                        <div class="row  g-3 mb-2">
                            <h5>Visa Pricing:</h5>
                            <div class="mt-3">
                                <h6>For Package:</h6>
                            </div>
                            <div>
                            <table class="hover mt-4 col-md-8" id="example-style-1">
                                            <thead style="background-color: #E5E5E5; text-align: center;">
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2">Adult</th>
                                                <th class="m-2 p-2">Child</th>
                                                <th class="m-2 p-2">Infant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                $count=1;
                                              ?>
                                                
                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">Buying Price</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="package_adult_buying"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="package_child_buying"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="package_infant_buying"></td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                <td class="m-2 p-2" style="font-weight: bold;">Selling Price</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="package_adult_selling"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="package_child_selling"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="package_infant_selling"></td>
                                                </tr>
                                                
                                                <?php
                                                  $count+=1;
                                                ?>
                                            </tbody>
                            </table>
                            </div>
                            <div class="mt-3">
                                <h6>For Individual:</h6>
                            </div>
                            <table class="hover mt-2 col-md-8" id="example-style-6">
                                            <thead style="background-color: #E5E5E5; text-align: center;">
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2">Adult</th>
                                                <th class="m-2 p-2">Child</th>
                                                <th class="m-2 p-2">Infant</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                $count=1;
                                              ?>
                                                
                                                <tr style="text-align: center;">
                                                <td class="m-1 p-2" style="font-weight: bold;">Buying Price</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="individual_adult_buying"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="individual_child_buying"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="individual_infant_buying"></td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                <td class="m-2 p-2" style="font-weight: bold;">Selling Price</td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="individual_adult_selling"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="individual_child_selling"></td>
                                                <td class="m-2 p-2"><input style="width: 60px;" type="number" placeholder="$" name="individual_infant_selling"></td>
                                                </tr>
                                                
                                                <?php
                                                  $count+=1;
                                                ?>
                                            </tbody>
                            </table>
                            <div class="col-md-12 mt-4">
                              <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Add VISA"></center>
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
    <script>
			var count=2;
			function add_doc_row(){
			    
			    var additionalhtml='<div class="row mt-4" id="'+count+'">'+
			                            '<div class="col-md-6">'+
                                      '<label class="form-label" for="">Group Members</label>'+
                                      '<select name="member_id[]" class="form-control" required>'+
                                        '<option value="">Choose Group Members</option>'+
                                        
                                        '<option value="1">Hammad</option>'+
                                        '<option value="1">Ali</option>'+
                                       
                                    '</select>'+
			                            '</div>'+
			                            '<div class="col-md-4">'+
			                                 '<button type="button" class="btn btn-danger" onclick="remove_row('+count+')" style="margin-top:30px"><i class="fa fa-times" style="color: white;" aria-hidden="true"></i></button>'+
			                            '</div>'+
			                        '</div>';
                                    
			        $("#group_body").append(additionalhtml);
                 count+=1
			}
			
			function remove_row(id){
			    $('#'+id).remove();
			}
			
		</script>
      

      

  </body>

</html>