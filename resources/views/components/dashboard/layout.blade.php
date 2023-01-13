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
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('assets/css/toast.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fonts/fontawesome/css/all.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <!-- slick carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">

    <!-- Template Main CSS File -->
    {{-- <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('assets/dashboard/css/dashboard.css') }}" rel="stylesheet">  

    <style>
        .table-booking {
            font-size: 14px;
            margin-bottom: 0;
        }

        .table-booking th {
            padding: 15px;
        }

        .table-booking td {
            padding: 15px;
        }

        .final-price {
            font-size: 18px;
            margin-bottom: 0;
        }
        .roundtrip-card {
            border: solid 1px #ccc;
        }
        .roundtrip-card input[type=radio] {
            border: 0px;
            width: 18px;
            height: 18px;
            margin-top: 10px;
        }
        .deapt {
            padding: 5px 20px;
            float: left;
        }
    </style>


</head>
<body>

    <x-dashboard.header />
    <x-dashboard.sidemenu />

    <main>
       
        {{$slot}}

    </main>

    <x-dashboard.footer />

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
    <script src="{{ asset('assets/js/toast.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!--Sidemenu Js -->
    <script src="{{ asset('assets/js/sidemenu.js') }}"></script>
    <!--- End SideMenu Js -->
    <!-- slick js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js"></script>

    <script>
        $.ajaxSetup({
            statusCode: {
                500: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown + ' - ' + jqXHR.responseJSON.exception);
                }
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                // removeInputValidationErros();
                $("#overlay").fadeIn();
                $('body').css({
                    'cursor': 'progress'
                });
                // TODO encrypt before send
            },
            dataFilter: function(retData, json) {
                // TODO decrypt response data before processing further
                return retData;
            },
            complete: function() {
                $("#overlay").fadeOut();
                $('body').css({
                    'cursor': 'default'
                });
                //  renewToken();
            }
        });
    </script>
     @yield('scripts')
</body>
</html>