
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
                        <h5>Add Group:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('admin/add_group')}}" enctype="multipart/form-data">
                      @csrf
                        <div class="row g-3 mb-2">
                            <h6>Group Detail</h6>
                            <div class="col-md-4">
                                <label class="form-label" for="">Group Name</label>
                                <input class="form-control" id="" name="group_name" type="text" placeholder="Group Name" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Going Date</label>
                                <input class="form-control" name="going_date" id="going_date" type="date" placeholder="Going Date" required="required" onchange="getCustomers()" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Coming Date</label>
                            <input class="form-control" name="comming_date" type="date" id="coming_date"
                            onchange="getCustomers()" placeholder="Comming Date">
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between">
                                    <h6>Add Group Members</h6>
                                </div>
                                <div class="table-responsive">
                                  <table class="hover mt-4 col-md-8" id="example-style-51">
                                            <thead style="background-color: #E5E5E5">
                                                <tr>
                                                <th></th>
                                                <th class="m-2 p-2">Surname</th>
                                                <th class="m-2 p-2">Gender</th>
                                                <th class="m-2 p-2">Collaborator</th>
                                                <th class="m-2 p-2">Linked to</th>
                                                <th class="m-2 p-2">Service Type</th>
                                                <th class="m-2 p-2">Total Price</th>
                                                <th class="m-2 p-2">Rest</th>
                                                </tr>
                                            </thead>
                                            <tbody id="customer_table">
                                             
                                            </tbody>
                                      </table>
                                  </div>
                                </div>
                                <div id="group_body"></div>
                              </div>
                            <div class="col-md-12 mt-4">
                            <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Add Group"></center>
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
      function getCustomers() {
  var going_date = $('#going_date').val();
  var coming_date = $('#coming_date').val();
  console.log({ going_date, coming_date });

  if (coming_date !== "" && going_date !== "") {
    $.get(`get_reservation_customers/${going_date}/${coming_date}`).then((result) => {
      if (result !== '' && result.length !== 0) {
        console.log(result);
        var tableBody = document.getElementById("customer_table");

        // Clear existing rows from the table body
        tableBody.innerHTML = "";

        var rows = [];

        result.map((data) => {
          console.log("new_row")
          var new_row = document.createElement("tr");

          // Create table cells for the new row
          var checkbox = document.createElement("input");
          checkbox.type = "checkbox";
          checkbox.name = "reservation_id[]";
          checkbox.value = data.id;


          var checkCell = document.createElement("td");
          // checkCell.classList.add('m-2 p-2');
          checkCell.appendChild(checkbox)

          var nameCell = document.createElement("td");
          nameCell.textContent = data.customer.first_name + " " + data.customer.last_name;

          var genderCell = document.createElement("td");
          genderCell.textContent = data.customer.gender;

          var collaboratorCell = document.createElement("td");
          collaboratorCell.textContent = data.customer.collaborator != null ? data.customer.collaborator.name : "No Collaborator";

          var linkedCell = document.createElement("td");
          linkedCell.textContent = data.customer.linked_with
            ? data.customer.linked_with.first_name + " " + data.customer.linked_with.last_name
            : "No Linked";

          var serviceCell = document.createElement("td");
          serviceCell.textContent = data.service_type;

          var totalPriceCell = document.createElement("td");
          totalPriceCell.textContent = "$"+data.payment.total_amount;

          var restPriceCell = document.createElement("td");
          restPriceCell.textContent = "$"+data.payment.rest_amount;

          // Append cells to the new row
          new_row.appendChild(checkCell);
          new_row.appendChild(nameCell);
          new_row.appendChild(genderCell);
          new_row.appendChild(collaboratorCell);
          new_row.appendChild(linkedCell);
          new_row.appendChild(serviceCell);
          new_row.appendChild(totalPriceCell);
          new_row.appendChild(restPriceCell);
         
          rows.push(new_row);
        });
        console.log(rows)
        // Append all rows to the table body
        rows.forEach((row) => {
          tableBody.appendChild(row);
        });

        console.log(rows);
      } else {
        console.log('empty result');
      }
    });
  }
}
    </script>
      

  </body>

</html>