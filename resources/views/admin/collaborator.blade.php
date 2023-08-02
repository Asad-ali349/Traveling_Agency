
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
                    <h5>Add Collaborator:</h5>
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/admin/collaborator')}}">
                      @csrf
                      <div class="row g-3 mb-2">
                        <div class="col-md-4">
                          <label class="form-label" for="">Collaborator Name</label>
                          <input class="form-control" id="" name="collaborator_name" type="text" placeholder="Collaborator Name" required="required">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Location</label>
                          <input class="form-control" id="" name="location" type="text" placeholder="City" required="required">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Phone</label>
                          <input class="form-control" id="" name="phone" type="text" placeholder="Phone" required="required">
                        </div>
                        <div class="col-md-12">
                         <center><input name="" class="btn btn-primary mt-4" type="submit" value="Add Collaborator"></center>
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
                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-user"></i>View Collaborator</a></li>
                            </ul>
                            <div class="tab-content" id="top-tabContent">
                                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                    <div class="table-responsive">
                                        <table class="hover" id="example-style-5">
                                            <thead style="background-color: #E5E5E5">
                                                <tr>
                                                <th>Collaborator Name</th>
                                                <th>Location</th>
                                                <th>Phone</th>
                                                <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                                $count=1;
                                              ?>
                                                @foreach($collaborators as $collaborator)
                                                <tr>
                                                <td>{{$collaborator->name}}</td>
                                                <td>{{$collaborator->location}}</td>
                                                <td>{{$collaborator->phone}}</td>
                                                <td >
                                                    
                                                    <a class="btn btn-outline-primary btn-xs" data-bs-toggle="modal" data-bs-target="#exampleModalgetbootstrap{{$count}}" data-whatever="@getbootstrap"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/delete_collaborator/'.$collaborator->id)}}" onclick="confirm('Are your Sure to delete this Collaborator?')"><i class="fa fa-trash"></i></a>
                                                </td>
                                                </tr>
                                              

                                                <div class="modal fade" id="exampleModalgetbootstrap{{$count}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <form method="post" action="{{url('/admin/edit_collaborator')}}">
                                                          @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Collaborator</h5>
                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <div class="mb-3">
                                                                <label class="col-form-label" for="recipient-name">Collaborator Name:</label>
                                                                <input class="form-control"  name="collaborator_name" type="text" placeholder="Collaborator Name" value="{{$collaborator->name}}">
                                                                <label class="col-form-label" for="recipient-name">Location:</label>
                                                                <input class="form-control"  name="location" type="text" placeholder="city" value="{{$collaborator->location}}" >
                                                                <label class="col-form-label" for="recipient-name">Phone:</label>
                                                                <input class="form-control"  name="phone" type="text" placeholder="Phone" value="{{$collaborator->phone}}" >
                                                                


                                                                <input class="form-control" name="id" type="hidden" placeholder="Collaborator_id" value="{{$collaborator->id}}" >
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                          
                                                            <button class="btn btn-primary" type="submit" >Update Collaborator</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                  $count+=1;
                                                ?>
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