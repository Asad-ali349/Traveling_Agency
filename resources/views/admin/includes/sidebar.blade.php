<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
   <div>
      <div class="logo-wrapper" >
         <a href="{{url('/admin/dashboard')}}"><img class="img-fluid for-light" src="{{asset('public/assets/images/logo/logo.png')}}" style="width:88%" style="margin-top:-20px !important;" alt=""></a>
         <div class="back-btn"><i class="fa fa-angle-left"></i></div>
         <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="{{asset('public/assets/images/logo/logo.png')}}"><img class="img-fluid" style="width:40px" src="{{asset('public/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
      <nav class="sidebar-main">
         <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
         <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
               <li class="back-btn">
                  <a href="{{asset('public/assets/images/logo/logo.png')}}"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon2.png')}}" style="width:30px" alt=""></a>
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{url('/admin/dashboard')}}"><i data-feather="home"></i><span class="lan-3">Dashboard</span></a>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span>Customers</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('/admin/add_customer')}}">Add Customer</a></li>
                     <li><a href="{{url('/admin/view_customer')}}">View Customers</a></li>
                  </ul>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i class="fa fa-calendar-check-o" style='padding-right:12px;font-size:15px'></i><span>Reservation</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('/admin/add_reservation')}}">Add Reservation</a></li>
                     <li><a href="{{url('/admin/view_reservations')}}">View Reservations</a></li>
                    
                  </ul>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span>Groups</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('/admin/add_group')}}">Add Group</a></li>
                     <li><a href="{{url('/admin/view_group')}}">View Groups</a></li>
                  </ul>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{url('admin/partners')}}"><i data-feather="users"></i><span>Partners</span></a>
               </li>
               <li class="sidebar-list">
               <a class="sidebar-link " href="{{url('admin/airline')}}"><i data-feather="send"></i><span>Air Company</span></a>
               </li>
               
               
               <li class="sidebar-list topbar-items">
                  <a class="sidebar-link " href="{{url('admin/profile')}}"><i data-feather="user"></i><span>Profile</span></a>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link " href="#"><i data-feather="globe"></i><span>Translation</span></a>
               </li>
               <li class="sidebar-list topbar-items">
                  <a class="sidebar-link " href="#"><i data-feather="settings"></i><span>Settings</span></a>
               </li>
               
               <li class="sidebar-list mt-3 topbar-items">
               <form action="{{url('admin/logout')}}" method="POST" id="logout-form">
                      @csrf
                      <a onclick="logout()"><i data-feather="log-in"></i>Logout</a>
                    </form>
                    <script>
                        function logout() {
                          $('#logout-form').submit()
                        }
                    </script>
               </li>
            </ul>
         </div>
         <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
   </div>
</div>
<!-- Page Sidebar Ends-->