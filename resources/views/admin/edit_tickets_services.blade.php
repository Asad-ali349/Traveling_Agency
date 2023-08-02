
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
                        <h5>Tickets:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/admin/edit_tickets_services')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                            <h6>Edit New Ticket:</h6>
                                <input class="form-control" id="ticket_id" name="ticket_id" type="hidden" placeholder="id" required="required" value="{{$ticket->id}}">
                            <div class="col-md-3">
                                <label class="form-label" for="">Ticket Name</label>
                                <input class="form-control" id="ticket_name" name="ticket_name" type="text" placeholder="Name" required="required" value="{{$ticket->name}}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Ticket Type {{$ticket->type}}</label>
                                <select name="ticket_type" id="" class="form-control">
                                    <option value="">Select Here</option>
                                    @if($ticket->type=="One Way")
                                    <option value="One Way" selected>One Way</option>
                                    <option value="Round Way">Round Way</option>
                                    @elseif($ticket->type=="Round Way")
                                    <option value="One Way">One Way</option>
                                    <option value="Round Way" selected>Round Way</option>
                                    @else
                                    <option value="One Way">One Way</option>
                                    <option value="Round Way">Round Way</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Flight Type</label>
                                <select name="flight_type" id="" class="form-control">
                                    <option value="">Select Here</option>

                                    @if($ticket->flight_type=="Direct")
                                    <option value="Direct" selected>Direct</option>
                                    <option value="InDirect">InDirect</option>
                                    <option value="Mixed">Mixed</option>
                                    @elseif($ticket->flight_type=="InDirect")
                                    <option value="Direct">Direct</option>
                                    <option value="InDirect" selected>InDirect</option>
                                    <option value="Mixed">Mixed</option>
                                    @elseif($ticket->flight_type=="Mixed")
                                    <option value="Direct">Direct</option>
                                    <option value="InDirect">InDirect</option>
                                    <option value="Mixed" selected>Mixed</option>
                                    @else
                                    <option value="Direct">Direct</option>
                                    <option value="InDirect">InDirect</option>
                                    <option value="Mixed">Mixed</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="">Air Company</label>
                                <select name="air_company" id="" class="form-control">
                                    <option value="">Select Here</option>
                                    @foreach($airlines as $airline)
                                    @if($airline->id==$ticket->air_company)
                                    <option value="{{$airline->id}}" selected>{{$airline->name}}</option>
                                    @else
                                    <option value="{{$airline->id}}">{{$airline->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="row  g-3 mb-2">
                                <h5>Pricing:</h5>
                                <div class="mt-3">
                                    <h6>For Package:</h6>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="">Estimated Buying Price:</label>
                                    <input class="form-control" id="buy_price" name="buy_price" type="number" placeholder="Buying Price" value="{{$ticket->buying_price_for_package}}" required="required">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="">Estimated Selling Price:</label>
                                    <input class="form-control" id="sell_price" name="sell_price" type="number" placeholder="Selling Price" required="required" value="{{$ticket->selling_price_for_package}}"> 
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                            <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Update Ticket"></center>
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