<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from admin.pixelstrap.com/cuba/theme/login-sa-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:54:10 GMT -->
@include('admin.includes.head')
  <body>
    <!-- login page start-->
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
      <div class="row">
        <div class="col-12 p-0">
          <div class="login-card">
            <div>
              <div><center><img class="img-fluid for-light" src="{{asset('public/assets/images/logo/login.png')}}" width="200px" style="margin-bottom:20px" alt="looginpage"></center></div>
              <div class="login-main"> 
                <form class="theme-form"  method='post' action="{{url('admin/reset_password')}}"> 
                  @csrf
                  <h4>Reset Password</h4>
                  <div class="form-group">
                    <input type="hidden" value="{{$uid}}" name="id">
                    <label class="col-form-label">New Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="new_pass" required="" placeholder="*********" id="pwd" minlength="8">
                      <div class="show-hide"><span class="show" onclick="toggle_pass('pwd')"></span></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Confirm Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="c_pass" required="" minlength="8" placeholder="*********" id="cpwd">
                      <div class="show-hide"><span class="show" onclick="toggle_pass('cpwd')"></span></div>
                    </div>
                  </div>
                  
                  <div class="form-group mt-4 mb-0">
                    <div class="text-end mt-3 mb-2">
                        <button class="btn btn-primary btn-block w-100" type="submit">Reset</button>
                    </div>
                    <div class=" text-center mt-4 mb-2">
                        <a href="{{url('/')}}" style="color:black !important">Back To Sign In</a>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
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
      <!-- Sidebar jquery-->
      <script src="{{asset('public/assets/js/config.js')}}"></script>
      <!-- Plugins JS start-->
      <script src="{{asset('public/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{asset('public/assets/js/script.js')}}"></script>
      <!-- login js-->
      <!-- Plugin used-->
      <script>
        $(document).on('click', '#error', function(e) {
          if($('.email').val() == '' || $('.pwd').val() == ''){
          swal(
            "Error!", "Sorry, looks like some data are not filled, please try again !", "error"           
          )
          }
        });
        function toggle_pass(id){
          pwdtype=document.getElementById(id).type
          if(pwdtype=='password'){
            document.getElementById(id).type='text'
          }else{
            document.getElementById(id).type='password'
          }
        }
      </script>
      <script>
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
    </script>
    </div>
  </body>
</html>