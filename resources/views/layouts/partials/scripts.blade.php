<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

{{-- <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script> --}}

<script src="{{ asset('assets/js/sidemenu.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/dist/jquery.validate.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#email').val('');
        $('#loginPwd').val('');

        //check login email
        $(document).on('change', '#email', function() {
            var email = $('#email').val();
            if (email != '') {
                // alert(email);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                // alert(email);
                $.ajax({
                    url: "{{ route('check-exist-email') }}",
                    type: 'POST',
                    data: {
                        'email': email
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data) {

                        if (data == 1) {
                            $('#email_exist').hide();
                            // $('#loginButton').removeAttr('disabled');
                        } else {
                            $('#email_exist').show();
                            $('#loginButton').prop("disabled", true);

                        }
                    }
                });
            }

        });

        // check login password
        $(document).on('change', '#loginPwd', function() {
            var password = $('#loginPwd').val();
            var email = $('#email').val();
            if (password != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                $.ajax({
                    url: "{{ route('check-exist-pwd') }}",
                    type: 'POST',
                    data: {
                        'email': email,
                        'password': password
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data) {

                        if (data == 1) {
                            $('#pwd_exist').hide();
                            // $('#loginButton').show();
                            $('#loginButton').prop("disabled", false);
                        } else {
                            $('#pwd_exist').show();
                            // $('#loginButton').hide();
                            $('#loginButton').prop("disabled", true);
                        }
                    }
                });

            }

        });

        //submit login
        $(document).on('click', '#loginButton', function(e) {
            e.preventDefault();
            // var password = $('#loginPwd').val();
            var email = $('#email').val();
            if (password != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                $.ajax({
                    url: "{{ route('getOTPNumber') }}",
                    type: 'POST',
                    data: {
                        'email': email
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data, result) {
                        if (result == 'success') {
                            $('#getOtp').html(data.message);
                        }

                    }
                });

            }

        });

        //check otp validation
        $(document).on('keyup', '#enterLoginOtp', function() {
            var login_otp = $('#enterLoginOtp').val();
            var email = $('#email').val();
            // alert(login_otp.length)
            if (login_otp.length == '6') {

                $.ajax({
                    url: "{{ route('checkOtpNumber') }}",
                    type: 'POST',
                    data: {
                        'email': email,
                        'login_otp': login_otp
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data) {
                        if (data == '1') {
                            $('#loginSubmit').show();
                            $('#otpError').hide();
                        } else {
                            $('#loginSubmit').hide();
                            $('#otpError').show();
                        }

                    }
                })
                $('#otpError').hide();
            } else {
                $('#otpError').show();
                $('#loginSubmit').hide();
            }
        });


        $('#loginSubmit').click(function() {
            // e.preventDefault();
            var email = $('#email').val();
            var password = $('#loginPwd').val();
            var login_otp = $('#enterLoginOtp').val();
            if (login_otp.length == '6') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                $.ajax({
                    url: "{{ route('login') }}",
                    type: 'POST',
                    data: {
                        'email': email,
                        'password': password
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data) {
                        // console.log(data);
                        location.replace("home");

                    }
                })
            }
        })


        $(document).on('change', '#forgotEmail', function() {
            var email = $('#forgotEmail').val();
            if (email != '') {
                // alert(email);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                // alert(email);
                $.ajax({
                    url: "{{ route('check-exist-email') }}",
                    type: 'POST',
                    data: {
                        'email': email
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data) {

                        if (data == 1) {
                            $('#forgot_email_exist').hide();
                            $('#verifyOtp').show();

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr('content')
                                },
                            });
                            $.ajax({
                                url: "{{ route('getOTPNumber') }}",
                                type: 'POST',
                                data: {
                                    'email': email
                                },
                                dataType: 'json',
                                // processData : false,
                                // cache : false,
                                // async : false,
                                success: function(data, result) {
                                    if (result == 'success') {
                                        $('#getForGotOtp').html(data.message);
                                    }

                                }
                            });





                        } else {
                            $('#forgot_email_exist').show();
                        }
                    }
                });
            }

        });




        $(document).on('keyup', '#forgotOtp', function() {
            var login_otp = $('#forgotOtp').val();
            var email = $('#forgotEmail').val();
            // alert(login_otp.length)
            if (login_otp.length == '6') {

                $.ajax({
                    url: "{{ route('checkOtpNumber') }}",
                    type: 'POST',
                    data: {
                        'email': email,
                        'login_otp': login_otp
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data) {
                        if (data == '1') {
                            $('#forgotOtpError').hide();
                        } else {
                            $('#forgotOtpError').show();
                        }

                    }
                })
                $('#forgotOtpError').hide();
            } else {
                $('#forgotOtpError').show();
            }
        });



    });

    $(function() {
        $("#forgotOtpForm").validate({
            rules: {
                forgotEmail: {
                    required: true,
                    // email:true
                },
                forgotOtp: {
                    required: true
                },
                forgotPwd: {
                    required: true,
                },
                confirmPwd: {
                    required: true,
                    equalTo: "#forgotPwd"
                },
            },
            messages: {
                forgotEmail: {
                    required: "Please Enter Your Email",
                    // email:"Entered email is invalid"

                },
                forgotOtp: {
                    required: "Please Enter OTP"
                },
                forgotPwd: {
                    required: "Please Enter new Password",
                },
                confirmPwd: {
                    required: "Please Enter Confirm Password",
                    equalTo: "Password Does Not match",
                },

            },
            submitHandler: function(form) {
                // form.submit();
                // var formData = new FormData($(this)[0]);
                var email = $('#forgotEmail').val();
                var password = $('#forgotPwd').val();
                $.ajax({
                    url: "{{ route('forgot-pwd') }}",
                    type: 'POST',
                    data: {
                        'email': email,
                        'password': password
                    },
                    dataType: 'json',
                    // processData : false,
                    // cache : false,
                    // async : false,
                    success: function(data, textStatus, xhr) {
                        // if(data == '1'){
                        if (xhr.status == 201) {
                            $('form[name=forgotOtpForm]')[0].reset();
                            $('.input-error').remove();
                            $.toast({
                                heading: 'Success',
                                text: data.message,
                                icon: 'success',
                                position: 'top-right'
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



    //   password show hide

    function password_show_hide() {
        var x = document.getElementById("forgotPwd");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>



@yield('script-content')
