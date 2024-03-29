
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
                        <h5>Add Hotel:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/add_investor')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <label class="form-label" for="">Hotel Name</label>
                                <input class="form-control" id="" name="hotel_name" type="text" placeholder="Hotel Name" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Number of Rooms</label>
                                <input class="form-control" id="num_of_room" name="num_of_rooms" type="text" placeholder="Number of Rooms" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">City</label>
                            <input class="form-control" id="" name="city" type="text" placeholder="City">
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Hotel Type</label>
                                <select name="hotel_type" id="" class="form-control">
                                  <option value="">Select Hotel Type</option>
                                  <option value="">Economy</option>
                                  <option value="">Normal</option>
                                  <option value="">VIP</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                    <h6>Room Details</h6>
                                    <button class="btn btn-primary " type="button" onclick="add_doc_row()"><i class="fa fa-plus" style="color: white;"> Add Room Details</i></button>
                                </div>
                            </div>
                            <div class="col-md-12" id="hotel_body">
                            <div class="row">
			                            <div class="col-md-4">
                                      <label class="form-label" for="">Room Type</label>
                                      <select name="room_level" id="" class="form-control">
                                        <option value="">Select Room Type</option>
                                        <option value="">Room For 1 Person</option>
                                        <option value="">Room For 2 Person</option>
                                        <option value="">Room For 3 Person</option>
                                        <option value="">Room For 4 Person</option>
                                        <option value="">Room For 5 Person</option>
                                        <option value="">Room For 6 Person</option>
                                      </select> 
			                            </div>
                                  <div class="col-md-4">
                                      <label class="form-label" for="">Price</label>
                                      <input type="text" name="room_price[]" id="" class="form-control" placeholder="Price"> 
			                            </div>
			                        </div>
                            </div>
                            <div class="col-md-12 mt-4">
                            <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Add Hotel"></center>
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
			var count=2;
			function add_doc_row(){
			    console.log('ss')
			    var additionalhtml = '<div class="row mt-4" id="' + count + '">' +
                      '<div class="col-md-4">' +
                        '<label class="form-label" for="">Room Type</label>' +
                        '<select name="room_level" id="" class="form-control">'+
                            '<option value="">Select Room Type</option>'+
                            '<option value="1">Room For 1 Person</option>'+
                            '<option value="2">Room For 2 Person</option>'+
                            '<option value="3">Room For 3 Person</option>'+
                            '<option value="4">Room For 4 Person</option>'+
                            '<option value="5">Room For 5 Person</option>'+
                            '<option value="6">Room For 6 Person</option>'+
                          '</select>' +
                      '</div>' +
                      '<div class="col-md-4">' +
                        '<label class="form-label" for="">Price</label>' +
                        '<input type="text" name="room_price[]" id="" class="form-control" placeholder="Price">' +
                      '</div>' +
                      '<div class="col-md-4">' +
                        '<button type="button" class="btn btn-danger" onclick="remove_row(' + count + ')" style="margin-top:30px"><i class="fa fa-times" style="color: white;" aria-hidden="true"></i></button>' +
                      '</div>' +
                    '</div>';
                                    
			        $("#hotel_body").append(additionalhtml);
                 count+=1
			}
			
			function remove_row(id){
			    $('#'+id).remove();
			}
			
		</script>
      

      

  </body>

</html>