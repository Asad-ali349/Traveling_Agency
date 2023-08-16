
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
      @include('admin/includes.topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
      @include('admin/includes.sidebar')
         <div class="page-body">
            <div class="container-fluid">
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
               <div class="page-title">
                  <div class="row">
                     <div class="col-6">
                        <h3>Customers Record</h3>
                     </div>
                     <div class="col-6">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">                                       
                              <i data-feather="home"></i></a>
                           </li>
                           <li class="breadcrumb-item">View Customers</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="col-sm-12 col-xl-12 xl-100">
                  <div class="card-body">
                  <div class="row">
                        <div class="col-7">
                           <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                              <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-user"></i>View Customers</a></li>
                           </ul>
                        </div>
                        <div class="col-5">
                           <a href="{{url('/admin/add_customer')}}">
                           <input name="submit" class="btn btn-primary mt-4" type="submit" value="Add Customer" >
                           </a>
                           <button  onclick="exportTableToExcel()" class="btn btn-primary mt-4" style="">Export To Excel</button>
                        </div>
                     </div>
                     <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                           <div class="table-responsive">
                              <table class="hover" id="example-style-5">
                                 <thead style="background-color: #E5E5E5">
                                    <tr>
                                       <th>Full Name</th>
                                       <th>Phone</th>
                                       <th>Passport</th>
                                       <th>ID Card</th>
                                       <th>Collaborators</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($customers as $customer)
                                    <tr>
                                       <td>{{$customer->first_name.' '. $customer->last_name}}</td>
                                       <td>{{$customer->phone}}</td>
                                       <td>{{$customer->passport}}</td>
                                       <td>{{$customer->id_card}}</td>
                                       <td>{{$customer->Collaborator!=null?$customer->Collaborator->name: "No Collaborator"}}</td>
                                       <td>
                                          <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/customer_detail/'.$customer->id)}}"><i class="fa fa-list"></i></a>
                                          <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/edit_customer/'.$customer->id)}}"><i class="fa fa-edit"></i></a>
                                          <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/delete_customer/'.$customer->id)}}"><i class="fa fa-trash"></i></a>
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
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="https://use.fontawesome.com/43c99054a6.js"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
      <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script src="https://unpkg.com/file-saver"></script>
      <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <!-- <script src="{{asset('public/assets/js/theme-customizer/customizer.js')}}"></script> -->
      <!-- login js-->
      <!-- Plugin used-->
      <script type="text/javascript">
         $(function () {
         $('[data-toggle="tooltip"]').tooltip()
         })
      </script>
      <script>
         function exportTableToExcel() {
            // Get the table element
            var table = document.getElementById("example-style-5");

            // Convert table to worksheet
            var worksheet = XLSX.utils.table_to_sheet(table);

            // Create workbook and add the worksheet
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

            // Convert workbook to Excel file
            var excelFile = XLSX.write(workbook, { bookType: "xlsx", type: "array" });

            // Save the file using FileSaver.js
            saveAs(
               new Blob([excelFile], { type: "application/octet-stream" }),
               "Customer.xlsx"
            );
         }
      function note_form_toggle(x) {
        var xid = document.getElementById(x);
        if (xid.style.display === "none") {
          xid.style.display = "block";
        } else {
          xid.style.display = "none";
        }
      }
      </script>
      <script>
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
    </script>
   </body>
</html>