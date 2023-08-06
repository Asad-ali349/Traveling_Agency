
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
                    <h5>Group Detail:</h5>
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/services')}}">
                      @csrf
                      <div class="row g-3 mb-2">
                        <div class="col-md-4">
                          <p><b>Group Name:</b> {{$group->group_name}}</p>
                        </div>
                        <div class="col-md-4">
                            <p><b>Going Date:</b> {{$group->going_date}}</p>
                        </div>
                        <div class="col-md-4">
                            <p><b>Coming Date:</b> {{$group->coming_date}}</p>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                </div>
                
              </div>
              <div class="col-sm-12 col-xl-12 xl-100">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-user"></i>View Members Detail</a></li>
                            </ul>
                            <div class="tab-content" id="top-tabContent">
                                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                    <div class="table-responsive">
                                        <table class="hover" id="example-style-5">
                                            <thead style="background-color: #E5E5E5">
                                              <tr>
                                                <th>Reservation No</th>
                                                <th>Reservation Date</th>
                                                <th>Customer Name</th>
                                                <th>Linked To</th>
                                                <th>Collaborator</th>
                                                <th>Service Name</th>
                                                <th>Service Price</th>
                                                <th>Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($group->members as $member)
                                              <tr>
                                                <td>{{$member->reservation->reservation_no}}</td>
                                                <td>{{$member->reservation->created_at}}</td>
                                                <td><a href="{{url('/admin/customer_detail/'.$member->reservation->customer->id)}}" target="_blank">{{$member->reservation->customer->first_name.''.$member->reservation->last_name}}</a></td>
                                                <td>{{$member->reservation->customer->LinkedWith!=null?$member->reservation->customer->LinkedWith->first_name.''.$member->reservation->customer->LinkedWith->last_name:'No Linked'}}</td>
                                                <td>{{$member->reservation->customer->Collaborator!=null?$member->reservation->customer->Collaborator->name:'No Collaborator'}}</td>
                                                <td>{{$member->reservation->service_type}}</td>
                                                <td>${{$member->reservation->payment->total_amount}}</td>
                                                <td>
                                                  <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/edit_reservation/'.$member->reservation_id)}}" target="_blank"><i class="fa fa-list"></i></a>
                                                </td>

                                              </tr>
                                              @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script type="text/javascript">
        setTimeout(function() {
            $('#messages').fadeOut('fast');
        }, 5000);
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
        </script>

        <!-- login js-->
    <!-- Plugin used-->
  </body>

</html>