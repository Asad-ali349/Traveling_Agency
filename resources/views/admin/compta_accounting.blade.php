
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
                        <h3>General Accounting</h3>
                     </div>
                     <div class="col-6">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">                                       
                              <i data-feather="home"></i></a>
                           </li>
                           <li class="breadcrumb-item">General Accounting</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="col-sm-12 col-xl-12 xl-100">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-6">
                           <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                              <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-user"></i>General Accounting</a></li>
                           </ul>
                        </div>
                        <div class="col-6">
                           <a data-bs-toggle="modal" data-bs-target="#exampleModalgetbootstrap" data-whatever="@getbootstrap">
                           <button name="submit" class="btn btn-primary " value="" >Apply Filter</button>
                           </a>
                           <button  onclick="exportTableToExcel()" class="btn btn-primary " style="">Export To Excel</button>

                           <button  onclick="print()" class="btn btn-primary " style="">Print Table</button>
                        </div>
                       
                     </div>
                     <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                           <div class="table-responsive">
                              <table class="hover table" id="example-style-5">
                                 <thead style="background-color: #E5E5E5">
                                    <tr>
                                       <th>Date of Reservation</th>
                                       <th>Full Name</th>
                                       <th>Reservation No</th>
                                       <th>Collaborator</th>
                                       <!-- <th>Service Type</th> -->
                                       <th>Service Name</th>
                                       <th>Buying Price</th>
                                       <th>Selling Price</th>
                                       <th>Rest Price</th>
                                       <th>Profit Amount</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php 
                                    $total_selling=0;
                                    $total_buying=0;
                                    $total_rest=0;
                                    $total_profit=0;
                                    @endphp
                                    @foreach($reservations as $reservation)
                                    <tr>
                                       <td>{{$reservation->created_at}}</td>
                                       <td>{{$reservation->customer->first_name.' '.$reservation->customer->last_name}}</td>
                                       <td>{{$reservation->reservation_no}}</td>
                                       <td>{{$reservation->customer->Collaborator?$reservation->customer->Collaborator->first_name:'No Collaborator'}}</td>
                                       <!-- <td>{{'VIP'}}</td> -->
                                       <td>{{$reservation->service_type}}</td>
                                       <td>
                                          @php 
                                             $buying=0;
                                             if($reservation->service_type=='package')
                                                $buying=$reservation->package->service_buying_price;
                                             elseif($reservation->service_type=='lodging')
                                                $buying=(int)$reservation->lodging->madina_buying_price+(int)$reservation->lodging->makkah_buying_price;
                                             elseif($reservation->service_type=='visa')
                                                $buying=$reservation->visa->service_buying_price;
                                             elseif($reservation->service_type=='transport')
                                                $buying=$reservation->transport->service_buying_price;
                                             elseif($reservation->service_type=='flight')
                                                $buying=$reservation->flight->purchased_price;

                                             $total_buying+=$buying;
                                          @endphp
                                          ${{$buying}}
                                       </td>
                                       <td>
                                          @php
                                          $selling=0;
                                             if($reservation->service_type=='package')
                                             $selling=$reservation->package->service_price;
                                             elseif($reservation->service_type=='lodging')
                                               
                                                $selling=(int)$reservation->lodging->madina_price+(int)$reservation->lodging->makkah_price;
                                                
                                             elseif($reservation->service_type=='visa')
                                               $selling=$reservation->visa->service_price;
                                             elseif($reservation->service_type=='transport')
                                                $selling=$reservation->transport->service_price;
                                             elseif($reservation->service_type=='flight')
                                                $selling=$reservation->flight->selling_price;
                                             
                                             $total_selling+=$selling;
                                          @endphp
                                          ${{$selling}}
                                       </td>
                                       <td>
                                          @php 
                                             $rest=0;
                                             if($reservation->payment!=null){
                                                $rest=$reservation->payment->rest_amount;
                                             }
                                             $total_rest+=$rest;
                                          @endphp

                                          ${{$rest}}
                                       </td>
                                       <td>
                                          @php
                                             $profit_amount = 0;

                                             if ($reservation->service_type == 'package') {
                                                $profit_amount = (int)$reservation->package->service_price - (int)$reservation->package->service_buying_price;
                                             } elseif ($reservation->service_type == 'lodging') {
                                                $sumlodgingselling = (int)$reservation->lodging->madina_price + (int)$reservation->lodging->makkah_price;
                                                $sumlodgingbuying = (int)$reservation->lodging->madina_buying_price + (int)$reservation->lodging->makkah_buying_price;
                                                $profit_amount = $sumlodgingselling - $sumlodgingbuying;
                                             } elseif ($reservation->service_type == 'visa') {
                                                $profit_amount = (int)$reservation->visa->service_price - (int)$reservation->visa->service_buying_price;
                                             } elseif ($reservation->service_type == 'transport') {
                                                $profit_amount = (int)$reservation->transport->service_price - (int)$reservation->transport->service_buying_price;
                                             } elseif ($reservation->service_type == 'flight') {
                                                $profit_amount = (int)$reservation->flight->selling_price - (int)$reservation->flight->purchased_price;
                                             }

                                             $total_profit+=$profit_amount;
                                          @endphp

                                          ${{$profit_amount}}
                                       </td>
                                       <td>
                                          <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/delete_customer/')}}"><i class="fa fa-trash"></i></a>
                                          <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/customer_detail/')}}"><i class="fa fa-list"></i></a>
                                          <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/invoice/'.$reservation->id)}}"><i class="fa fa-print"></i></a>
                                          <a class="btn btn-outline-primary btn-xs" href="{{url('/admin/receipt/'.$reservation->id)}}"><i class="fa fa-info-circle" style="font-size:13px"></i>
</a>
                                       </td>
                                    </tr>
                                    @endforeach


                                    <!-- Filter Model Start -->
                                    <div class="modal fade" id="exampleModalgetbootstrap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <form method="post" action="{{url('/edit_service')}}">
                                          @csrf
                                          <div class="modal-header">
                                            <h5 class="modal-title">Filter Options</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <label class="col-form-label" for="recipient-name">From Date:</label>
                                              <input class="form-control"  name="from_date" type="date" placeholder="From Date"  >
                                              <label class="col-form-label" for="recipient-name">To Date:</label>
                                              <input class="form-control"  name="to_date" type="date" placeholder="to Date"  >
                                              <label class="col-form-label" for="recipient-name">Service</label>
                                              <select name="service_name" id="" class="form-control select2">
                                                <option value="">Select Service</option>
                                                <option value="">Package</option>
                                                <option value="">Lodging</option>
                                                <option value="">Visa</option>
                                                <option value="">Flight</option>
                                                <option value="">Transport</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit" >Apply Filter</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Filter Model End -->
                                    
                                 </tbody>
                              </table>

                              
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6"></div>
                           <div class="col-md-6">
                           <table width="100%" class="mt-3">
                                   <tr>
                                     <td ><h6 class="p-2 mb-0">Total Buying Price</h6></td>
                                     <td class="p-2 mb-0">${{$total_buying}}</td>
                                   </tr>
                                   <tr>
                                     <td><h6 class="p-2 mb-0">Total Selling Price</h6></td>
                                     <td class="p-2 mb-0">${{$total_selling}}</td>
                                   </tr>
                                   <tr>
                                     <td><h6 class="p-2 mb-0">Total Rest Amount</h6></td>
                                     <td class="p-2 mb-0">${{$total_rest}}</td>
                                   </tr>
                                   <tr>
                                     <td><h6 class="p-2 mb-0">Total Profit Amount</h6></td>
                                     <td class="p-2 mb-0">${{$total_profit}}</td>
                                   </tr>
                                 </table>
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
      <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
      <script src="https://unpkg.com/file-saver"></script>
    <!-- <script src="{{asset('public/assets/js/theme-customizer/customizer.js')}}"></script> -->
      <!-- login js-->
      <!-- Plugin used-->
      <script type="text/javascript">
         $(function () {
         $('[data-toggle="tooltip"]').tooltip()
         })
      </script>
      <script>
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
    <script>
      function print(){
         var table = document.getElementById("example-style-5").outerHTML;
         var printWindow = window.open('', '', 'width=800,height=600');
         printWindow.document.write('<html><head><title>Print Table</title>');
         printWindow.document.write('<style>@media print { table { page-break-inside: avoid; } } table { border-collapse: collapse; width: 100%; } table, th, td { border: 1px solid black; padding: 8px; }</style> ');
         printWindow.document.write('</head><body>');
         printWindow.document.write(table);
         printWindow.document.write('</body></html>');
         printWindow.document.close();
         printWindow.print();

      }
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
            "Compta.xlsx"
         );
      }
    </script>
   </body>
</html>