
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
                        <h5>Package:</h5>
                    </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/admin/package_services')}}">
                      @csrf
                        <div class="row g-3 mb-2">
                            <h6>Package Detail</h6>
                            <div class="col-md-4">
                                <label class="form-label" for="">Name</label>
                                <input class="form-control" id="name" name="package_name" type="text" placeholder="Name" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Available From</label>
                                <input class="form-control" name="available_from" type="date" placeholder="Going Date" required="required" >
                            </div>
                            <div class="col-md-4">
                            <label class="form-label" for="">Available To</label>
                            <input class="form-control" name="available_to" type="date" placeholder="Comming Date">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">VISA</label>
                                <select name="visa" id="visa" class="form-control" onchange="calPrice()">
                                    <option value="">Select Here</option>
                                    @foreach($visas as $visa)
                                        <option value="{{$visa->id}}">{{$visa->visa_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Lodging in Makkah</label>
                                <select name="makkah_lodging" id="makkah_lodging" class="form-control" onchange="calPrice()"> 
                                    <option value="">Select Here</option>
                                    @foreach($lodging_makkah as $lodging)
                                        <option value="{{$lodging->id}}">{{$lodging->hotel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Room Type in makkah</label>
                                <select name="makkah_room_type" id="makkah_room_type" class="form-control" onchange="calPrice()">
                                    <option value="">Select Here</option>
                                    <option value="room_for_two">Room For 2</option>
                                    <option value="room_for_three">Room For 3</option>
                                    <option value="room_for_four">Room For 4</option>
                                    <option value="room_for_five">Room For 5</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label" for="">Lodging in Madina</label>
                                <select name="madina_lodging" id="madina_lodging" class="form-control" onchange="calPrice()">
                                    <option value="">Select Here</option>
                                    @foreach($lodging_madina as $lodging)
                                        <option value="{{$lodging->id}}">{{$lodging->hotel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Room Type in madnina</label>
                                <select name="madina_room_type" id="madina_room_type" class="form-control" onchange="calPrice()">
                                    <option value="">Select Room Type</option>
                                    <option value="room_for_two">Room For 2</option>
                                    <option value="room_for_three">Room For 3</option>
                                    <option value="room_for_four">Room For 4</option>
                                    <option value="room_for_five">Room For 5</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Ticket</label>
                                <select name="ticket" id="ticket"  onchange="calPrice()" class="form-control">
                                    <option value="">Select Here</option>
                                    @foreach($tickets as $ticket)
                                        <option value="{{$ticket->id}}">{{$ticket->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Package Price For Adult:</label>
                                <input class="form-control" id="adult_package" name="adult_package" type="text" placeholder="$" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Package Price For Child:</label>
                                <input class="form-control" id="child_package" name="child_package" type="text" placeholder="$" readonly >
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Package Price For Infant:</label>
                                <input class="form-control" id="infant_package" name="infant_package" type="text" placeholder="$" readonly>
                            </div>
                            <div class="col-md-12 mt-4">
                            <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Add Package"></center>
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
        
        function calPrice() {
            
            var tickets=@json($tickets);
            var visa_madina=@json($lodging_madina);
            var visa_makkah=@json($lodging_makkah);
            var visa=@json($visas);

            var visa_field=$('#visa').val();
            var makkah_lodging_field=$('#makkah_lodging').val();
            var makkah_room_type_field=$('#makkah_room_type').val();
            var madina_lodging_field=$('#madina_lodging').val();
            var madina_room_type_field=$('#madina_room_type').val();
            var ticket_field=$('#ticket').val();

            // visa price 
            var visa_price_for_adult=0;
            var visa_price_for_child=0;
            var visa_price_for_infant=0
            if(visa_field != "" && visa_field!=null){
                var filtered_visa=visa.filter((data)=>{
                    return data.id==visa_field
                });

                var selected_visa=filtered_visa[0].package_price;
                var visa_price_for_adult=selected_visa.adult_selling;
                var visa_price_for_child=selected_visa.child_selling;
                var visa_price_for_infant=selected_visa.infant_selling;
            }
            
            console.log({visa_price_for_adult,visa_price_for_child,visa_price_for_infant})
            // makkah_lodging
            var makah_lodging_adult=0;
            var makah_lodging_child=0; 
            var makah_lodging_infant=0;
            if(makkah_lodging_field && makkah_room_type_field){

                var filtered_loadging_makkah=visa_makkah.filter((data)=>{
                    return data.id==makkah_lodging_field
                });
                if(makkah_room_type_field=="room_for_two"){

                    makah_lodging_adult=filtered_loadging_makkah[0].price_for_package.room_two_selling_adult
                    makah_lodging_child=filtered_loadging_makkah[0].price_for_package.room_two_selling_child
                    makah_lodging_infant=filtered_loadging_makkah[0].price_for_package.room_two_selling_infant
                }else if(makkah_room_type_field=="room_for_three"){
                    makah_lodging_adult=filtered_loadging_makkah[0].price_for_package.room_three_selling_adult
                    makah_lodging_child=filtered_loadging_makkah[0].price_for_package.room_three_selling_child
                    makah_lodging_infant=filtered_loadging_makkah[0].price_for_package.room_three_selling_infant
                }else if(makkah_room_type_field=="room_for_four"){
                    makah_lodging_adult=filtered_loadging_makkah[0].price_for_package.room_four_selling_adult
                    makah_lodging_child=filtered_loadging_makkah[0].price_for_package.room_four_selling_child
                    makah_lodging_infant=filtered_loadging_makkah[0].price_for_package.room_four_selling_infant
                }else if(makkah_room_type_field=="room_for_five"){
                    makah_lodging_adult=filtered_loadging_makkah[0].price_for_package.room_five_selling_adult
                    makah_lodging_child=filtered_loadging_makkah[0].price_for_package.room_five_selling_child
                    makah_lodging_infant=filtered_loadging_makkah[0].price_for_package.room_five_selling_infant
                }
                console.log({makah_lodging_adult,makah_lodging_child,makah_lodging_infant})
            }


            // madina_lodging
            var madina_lodging_adult=0;
            var madina_lodging_child=0; 
            var madina_lodging_infant=0;
            if(madina_lodging_field && madina_room_type_field){

                var filtered_loadging_madina=visa_madina.filter((data)=>{
                    return data.id==madina_lodging_field
                });
                if(madina_room_type_field=="room_for_two"){
                    

                    madina_lodging_adult=filtered_loadging_madina[0].price_for_package.room_two_selling_adult
                    madina_lodging_child=filtered_loadging_madina[0].price_for_package.room_two_selling_child
                    madina_lodging_infant=filtered_loadging_madina[0].price_for_package.room_two_selling_infant
                }else if(madina_room_type_field=="room_for_three"){
                    madina_lodging_adult=filtered_loadging_madina[0].price_for_package.room_three_selling_adult
                    madina_lodging_child=filtered_loadging_madina[0].price_for_package.room_three_selling_child
                    madina_lodging_infant=filtered_loadging_madina[0].price_for_package.room_three_selling_infant
                }else if(madina_room_type_field=="room_for_four"){
                    madina_lodging_adult=filtered_loadging_madina[0].price_for_package.room_four_selling_adult
                    madina_lodging_child=filtered_loadging_madina[0].price_for_package.room_four_selling_child
                    madina_lodging_infant=filtered_loadging_madina[0].price_for_package.room_four_selling_infant
                }else if(madina_room_type_field=="room_for_five"){
                    madina_lodging_adult=filtered_loadging_madina[0].price_for_package.room_five_selling_adult
                    madina_lodging_child=filtered_loadging_madina[0].price_for_package.room_five_selling_child
                    madina_lodging_infant=filtered_loadging_madina[0].price_for_package.room_five_selling_infant
                }
                console.log({madina_lodging_adult,madina_lodging_child,madina_lodging_infant})
            }
            
            var ticket_selling=0;
            if(ticket_field){
                var filtered_ticket=tickets.filter((data)=>{
                    return data.id==ticket_field
                });
                ticket_selling=filtered_ticket[0].selling_price_for_package
            }



            var PriceForAdult=parseFloat(visa_price_for_adult)+parseFloat(makah_lodging_adult)+parseFloat(madina_lodging_adult)+parseFloat(ticket_selling);
            var PriceForChild=parseFloat(visa_price_for_child)+parseFloat(makah_lodging_child)+parseFloat(madina_lodging_child)+parseFloat(ticket_selling);
            var PriceForInfant=parseFloat(visa_price_for_infant)+parseFloat(makah_lodging_infant)+parseFloat(madina_lodging_infant)+parseFloat(ticket_selling);



            
            $("#adult_package").val(PriceForAdult);
            $("#child_package").val(PriceForChild);
            $("#infant_package").val(PriceForInfant);


            
        }
	</script>
      

      

  </body>

</html>