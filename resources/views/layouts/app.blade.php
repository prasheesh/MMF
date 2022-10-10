<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>:: MakeMyFly | Home </title>

  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/fonts/fontawesome/css/all.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}" >


  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <style type="text/css">

   .validation-error{
      color: red !important;
      display: none;

    }
    .error{
      color: red !important;
    }

    </style>
    @yield('style-content')

    <!-- Jquery min JS google CDN -->
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>

  <link href="{{ asset('assets/css/toast.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="{{ asset('assets/js/toast.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>



    <!-- Login modal -->

<div class="modal" id="loginModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">

         <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
        <h5 class="modal-title modal-titile-mmf">
            Already Using Makemyfly?</h5>
        <p>Login here to your Account</p>

        <div class="clearfix mb-4"></div>
        <form method="post" action="" name="loginForm" id="loginForm" >
          @csrf
            <div class="row">
                <div class="col-md-12 label-modal ">
                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="email" name="email" id="email" class="form-control" autocomplte='off'  placeholder=""/>
                        <label id="email_exist" class="validation-error">Email id does not exist</label>
                        <p class="input-icon"><i class="fa fa-envelope"></i></p>
                    </div>
                </div>
                <div class="col-md-12 label-modal">
                    <div class="form-group">
                         <label>Passsword</label>
                        <input type="password" name="loginPwd" id="loginPwd"  autocomplte='off' class="form-control" placeholder="">
                        <label id="pwd_exist" class="validation-error">Incorrect Password</label>
                        <p class="input-icon"><i class="fa fa-lock"></i></p>
                    </div>
                </div>
                <div class="col-md-8">
                    <p class="gotpw"><a href=""  data-bs-toggle="modal" data-bs-target="#forgot">Forgot Password?</a></p>
                    {{-- <p class="link"><a href="" data-bs-toggle="modal" data-bs-target="#reset"><i>Reset Password</i></a></p> --}}
                </div>
                <div class="col-md-4 text-right">
                    <button disabled  id="loginButton" class="btn btn-theme float-end" data-bs-toggle="modal" data-bs-target="#loginotp" style="cursor:pointer; ">LOGIN</button>
                </div>
            </div>
        </form>
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>




<!-- OTP model -->

<div class="modal" id="loginotp">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">

         <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
        <h5 class="modal-title modal-titile-mmf">
            OTP Sent to your Registered Mobile</h5>
        <p>XXXXXXXX94 Please Verify</p>
        <span id="getOtp"></span>

        <div class="clearfix mb-4"></div>
        <form method="post" action="">
          @csrf
            <div class="row">
                <div class="col-md-12 label-modal ">
                    <div class="form-group">
                        <label>Enter your OTP</label>
                       <div class="otp-input">
                        {{-- <input type="text" name="text" id="text" class="form-control form-otp" autocomplte='off'  placeholder=""/>
                        <input type="text" name="text" id="text" class="form-control form-otp" autocomplte='off'  placeholder=""/>
                        <input type="text" name="text" id="text" class="form-control form-otp" autocomplte='off'  placeholder=""/>
                        <input type="text" name="text" id="text" class="form-control form-otp" autocomplte='off'  placeholder=""/>
                        <input type="text" name="text" id="text" class="form-control form-otp" autocomplte='off'  placeholder=""/> --}}
                        <input type="text" name="enterLoginOtp" id="enterLoginOtp" class="form-control form-otp" autocomplte='off' minlength="6" maxlength="6"  placeholder=""/>

                      </div>
                      <label id="otpError" class="validation-error">Please Enter valid 6  Digit otp</label>
                    </div>
                </div>
                <div class="col-md-12 text-right mt-4">
                    <button type="submit" id="loginSubmit" style="display: none"  class="btn btn-theme float-end">Submit</button>
                </div>
            </div>
        </form>
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>


<!-- forgot password -->


 <div class="modal" id="forgot">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">

         <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
        <h5 class="modal-title modal-titile-mmf">
            Forgot Password?</h5>
            <form method="post" action="" name="forgotOtpForm" id="forgotOtpForm">
              @csrf
        <p class="mb-4">Enter details for Create New Password</p>
        <label>Email ID</label>
            <input type="email" name="forgotEmail" id="forgotEmail" class="form-control" autocomplte='off'  placeholder=""/>
            <label id="forgot_email_exist" class="validation-error">Email id does not exist</label>
        <small id="verifyOtp" style="display:none">OTP Sent to your Registered Mobile Number XXXXXX94 Please verify</small>
        <span id="getForGotOtp"></span>

        <div class="clearfix mb-4"></div>

            <div class="row">
                <div class="col-md-12 mb-3 label-modal ">
                    <div class="form-group">
                        <label>Enter your OTP</label>
                       <div class="otp-input">
                        <input type="text" minlength="6" maxlength="6" name="forgotOtp" id="forgotOtp" class="form-control form-otp" autocomplte='off'  placeholder=""/>


                      </div>
                      <label id="forgotOtpError" class="validation-error">Please Enter valid 6  Digit otp</label>
                    </div>
                </div>
                <div class="clearfix "></div>
                <div class="col-md-12 label-modal">
                    <div class="form-group">
                         <label>New Passsword</label>
                        <input type="password" autocomplte='off' name="forgotPwd" id="forgotPwd" class="form-control" placeholder=""/>
                        <p class="input-icon"><i class="fa fa-lock"></i></p>
                        <p class="input-icon-after"><i class="fa fa-eye"></i></p>
                    </div>
                </div>
                 <div class="col-md-12 label-modal">
                    <div class="form-group">
                         <label>Confirm New Passsword</label>
                        <input type="password" autocomplte='off' name="confirmPwd" id="confirmPwd" class="form-control" placeholder=""/>
                        <p class="input-icon"><i class="fa fa-lock"></i></p>
                        <p class="input-icon-after"><i class="fa fa-eye-slash"></i></p>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-theme">Submit</button>
                </div>
            </div>
        </form>
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>


<!-- Reset password -->

<div class="modal" id="reset">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">

         <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
        <h5 class="modal-title modal-titile-mmf">
            Reset Password</h5>
        <p>Enter detials for Reset password</p>
        <div class="clearfix mb-4"></div>
        <form method="post">
            <div class="row">
                  <div class="col-md-12 label-modal">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" autocomplte='off' name="password" id="password" class="form-control" placeholder=" "/>
                        <p class="input-icon"><i class="fa fa-lock"></i></p>
                        <p class="input-icon-after"><i class="fa fa-eye"></i></p>
                    </div>
                </div>
                <div class="col-md-12 label-modal">
                    <div class="form-group">
                          <label>New Password</label>
                        <input type="password" autocomplte='off' name="password" id="password" class="form-control" placeholder=""/>
                        <p class="input-icon"><i class="fa fa-lock"></i></p>
                        <p class="input-icon-after"><i class="fa fa-eye"></i></p>
                    </div>
                </div>
                 <div class="col-md-12 label-modal">
                    <div class="form-group">
                            <label>Confirm New Password</label>
                        <input type="password" autocomplte='off' name="password" id="password" class="form-control" placeholder=""/>
                        <p class="input-icon"><i class="fa fa-lock"></i></p>
                        <p class="input-icon-after"><i class="fa fa-eye-slash"></i></p>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <a href="" class="btn btn-theme">Submit</a>
                </div>
            </div>
        </form>
         <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>




  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container container-make   d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ route('index') }}"><img src="assets/img/MMF.png"></a></h1>

      @if(Auth::check())
      <div class="col-md-6
			 float-end">
				<div class="row">
					<div class="col-md-2 top-details">
						<p class="Hi-user">Hi {{ Str::ucfirst(Auth::user()->name) }} </p>
						<p>12345</p>

					</div>
					<div class="col-md-4 text-end  top-details">
						<p class="Hi-user">Credit Balance </p>
						<p>50,0000</p>
					</div>
					<div class="col-md-4 text-end  top-details">
						<p class="Hi-user">Due Balance</p>
						<p>2000,000 - 15/6/2022</p>
					</div>
					<div class="col-md-2  top-details">
            <form action="{{ route('logout') }}" method="post">
              @csrf
						<input type="submit" value="Logout" class="Hi-user">
						<p></p>
            </form>
					</div>
				</div>

			</div>
      @else


      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <!--<li><a class="" href="javascript:void(0);">Flights</a></li>-->
          <li><a class="active" href="{{ route('index') }}">Home</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('services') }}">Services</a></li>
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
          @if(Auth::check())
                    <li><a data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor:pointer">Logout</a></li>
                    @else
                    <li><a data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor:pointer">Login</a></li>
                    @endif

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      @endif
    </div>
  </header>

  <!-- End Header -->


  <main id="main">

          @yield('content')

</main><!-- End #main -->

    <!-- ======= Footer ======= -->
 <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <img src="{{asset('assets/img/MMF.png')}}" class="img-fluid" width="150">
            <p class="mt-3">

              <strong>Phone:</strong> +9140 66464466<br>
              <strong>Email:</strong>support@makemyfly.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4></h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('index') }}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('about') }}">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('services') }}">Services</a></li>
               <li><i class="bx bx-chevron-right"></i> <a href="{{ route('contact')}}">Contact Us</a></li>

            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4></h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacy') }}">Privacy Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('terms-conditions') }}">Terms of Service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="payment">Make Payment</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <!--<h4>Join Our Newsletter</h4>-->
            <!--<p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>-->
            <!--<form action="" method="post">-->
            <!--  <input type="email" name="email"><input type="submit" value="Subscribe">-->
            <!--</form>-->

             <div style="text-align:left;">
                  <h4>Address</h4>

                <p class="" style="color:#777;"> 21-7-760 , Ghansi bazaar,<br> Hyderabad - 500002</p>

            </div>

            <div class="social-links text-left text-md-right pt-3 pt-md-0">

            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>

            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>


          </div>




          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright" style="color: #fff;">
          &copy; Copyright <strong><span>MakeMyFly</span></strong>. All Rights Reserved
        </div>

      </div>


       <div class="credits">

          Designed by <a href="https://vmaxindia.com" target="_blank">VMax</a>
        </div>




    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/purecounter/purecounter.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  {{-- <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script> --}}

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="{{ asset('assets/js/dist/jquery.validate.js') }}"></script>

  <script>
      $(document).ready(function(){
        $('#email').val('');
        $('#loginPwd').val('');

//check login email
        $(document).on('change','#email',function(){
          var email = $('#email').val();
          if(email != '' ){
            // alert(email);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          });
          // alert(email);
            $.ajax({
              url : "{{ route('check-exist-email') }}",
              type : 'POST',
              data : {'email': email},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data){

               if(data == 1){
                      $('#email_exist').hide();
                      // $('#loginButton').removeAttr('disabled');
               }else{
                $('#email_exist').show();
                $('#loginButton').prop("disabled", true);

               }
              }
            });
          }

        });

        // check login password
        $(document).on('change','#loginPwd',function(){
          var password = $('#loginPwd').val();
          var email = $('#email').val();
          if(password != ''){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          });
            $.ajax({
              url : "{{ route('check-exist-pwd') }}",
              type : 'POST',
              data : {'email':email,'password': password},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data){

                if(data == 1){
                      $('#pwd_exist').hide();
                      // $('#loginButton').show();
                      $('#loginButton').prop("disabled", false);
               }else{
                $('#pwd_exist').show();
                // $('#loginButton').hide();
                $('#loginButton').prop("disabled", true);
               }
              }
            });

          }

        });

        //submit login
      $(document).on('click','#loginButton',function(e){
        e.preventDefault();
          // var password = $('#loginPwd').val();
          var email = $('#email').val();
          if(password != ''){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          });
            $.ajax({
              url : "{{ route('getOTPNumber') }}",
              type : 'POST',
              data : {'email':email},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data,result){
                if(result =='success'){
                    $('#getOtp').html(data.message);
                }

              }
            });

          }

        });

        //check otp validation
$(document).on('keyup','#enterLoginOtp',function(){
  var login_otp = $('#enterLoginOtp').val();
  var email = $('#email').val();
  // alert(login_otp.length)
  if(login_otp.length == '6' ){

    $.ajax({
      url : "{{ route('checkOtpNumber') }}",
              type : 'POST',
              data : {'email':email,'login_otp':login_otp},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data){
                if(data == '1'){
                  $('#loginSubmit').show();
                    $('#otpError').hide();
                }else{
                  $('#loginSubmit').hide();
                  $('#otpError').show();
                }

              }
    })
    $('#otpError').hide();
  }else{
    $('#otpError').show();
    $('#loginSubmit').hide();
  }
});


$('#loginSubmit').click(function(){
  // e.preventDefault();
  var email = $('#email').val();
  var password = $('#loginPwd').val();
  var login_otp = $('#enterLoginOtp').val();
  if(login_otp.length == '6' ){
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          });
  $.ajax({
      url : "{{ route('login') }}",
              type : 'POST',
              data : {'email':email,'password':password},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data){
// console.log(data);
location.replace("/home");

              }
    })
  }
})


$(document).on('change','#forgotEmail',function(){
          var email = $('#forgotEmail').val();
          if(email != '' ){
            // alert(email);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          });
          // alert(email);
            $.ajax({
              url : "{{ route('check-exist-email') }}",
              type : 'POST',
              data : {'email': email},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data){

               if(data == 1){
                      $('#forgot_email_exist').hide();
                      $('#verifyOtp').show();

                      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          });
            $.ajax({
              url : "{{ route('getOTPNumber') }}",
              type : 'POST',
              data : {'email':email},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data,result){
                if(result =='success'){
                    $('#getForGotOtp').html(data.message);
                }

              }
            });





               }else{
                $('#forgot_email_exist').show();
               }
              }
            });
          }

        });




        $(document).on('keyup','#forgotOtp',function(){
  var login_otp = $('#forgotOtp').val();
  var email = $('#forgotEmail').val();
  // alert(login_otp.length)
  if(login_otp.length == '6' ){

    $.ajax({
      url : "{{ route('checkOtpNumber') }}",
              type : 'POST',
              data : {'email':email,'login_otp':login_otp},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data){
                if(data == '1'){
                    $('#forgotOtpError').hide();
                }else{
                  $('#forgotOtpError').show();
                }

              }
    })
    $('#forgotOtpError').hide();
  }else{
    $('#forgotOtpError').show();
  }
});



      });

      $(function() {
      $("#forgotOtpForm").validate({
        rules:{
          forgotEmail:{
            required:true,
            // email:true
          },
          forgotOtp:{
            required:true
          },
          forgotPwd :{
            required:true,
          },
          confirmPwd:{
            required:true,
            equalTo :"#forgotPwd"
          },
        },
        messages:{
          forgotEmail:{
            required:"Please Enter Your Email",
            // email:"Entered email is invalid"

          },
          forgotOtp:{
            required:"Please Enter OTP"
          },
          forgotPwd :{
            required:"Please Enter new Password",
          },
          confirmPwd:{
            required:"Please Enter Confirm Password",
            equalTo :"Password Does Not match",
          },

        },
        submitHandler: function(form) {
              // form.submit();
              // var formData = new FormData($(this)[0]);
              var email = $('#forgotEmail').val();
              var password = $('#forgotPwd').val();
              $.ajax({
              url : "{{ route('forgot-pwd') }}",
              type : 'POST',
              data : {'email':email,'password':password},
              dataType:'json',
              // processData : false,
              // cache : false,
              // async : false,
              success : function(data, textStatus, xhr){
                // if(data == '1'){
                  if (xhr.status == 201) {
                  $('form[name=forgotOtpForm]')[0].reset();
                  $('.input-error').remove();
                  $.toast({
                            heading: 'Success',
                            text: data.message,
                            icon: 'success',
                            position:'top-right'
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 3000);

                }
              // }

              }
    })
      }
    });

  });



  </script>



@yield('script-content')

</body>

</html>