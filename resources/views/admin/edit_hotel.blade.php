
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
                        <h5>Edit Hotel:</h5>
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
                            <label class="form-label" for="">Type</label>
                            <input class="form-control" id="" name="type" type="text" placeholder="Type">
                            </div>
                            <div class="col-md-12" id="hotel_body"></div>
                            <div class="col-md-12 mt-4">
                            <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Update Hotel"></center>
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
  $(document).ready(function() {
    $('#num_of_room').on('keyup', function() {
      let num_of_rooms = $('#num_of_room').val();
      if (num_of_rooms == '') {
        num_of_rooms = 0;
      } else {
        num_of_rooms = parseInt(num_of_rooms);
      }

      let hotel_rooms = `<div class="row">`;
      for (let i = 1; i <= num_of_rooms; i++) {
        let room = `
          <div class="col-md-12">
            <div class="row mt-2">
                <div class="col-md-4">
                    <label class="form-label" for="">Room Name</label>
                    <input class="form-control" id="" name="room_name[]" type="text" placeholder="Room Name">
                </div>
            </div>
          </div>`;
        hotel_rooms += room;
      }
      hotel_rooms += `</div>`;

      $('#hotel_body').empty().append(hotel_rooms);
      console.log($('#hotel_body').html());
    });
  });
</script>
      

      

  </body>

</html>