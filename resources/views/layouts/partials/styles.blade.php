        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>:: MakeMyFly | Home </title>

        <meta content="" name="description">
        <meta content="" name="keywords">
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <!-- Favicons -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

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


        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

        <style type="text/css">
            .validation-error {
                color: red !important;
                display: none;

            }

            .error {
                color: red !important;
            }
            
            
            /* Absolute Center Spinner */
    .loading {
      position: fixed;
      z-index: 9999;
      overflow: show;
      margin: auto;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      width: 50px;
      height: 50px;
    }
	#loader_div:before {
		content: '';
		display: block;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background-color: rgba(0,0,0,0.5);
	}

	/* Transparent Overlay */
	.loading:before {
	content: '';
	display: block;
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0,0,0,0.5);
	}

    
    
    .svg-calLoader {
       width: 230px; height: 230px;
      transform-origin: 115px 115px;
      animation: 1.4s linear infinite loader-spin;
      position: absolute;
      top: 40%;
      left: 42%;
      z-index: 9999;
    }
    
    .cal-loader__plane { fill: $c-hilight; }
    .cal-loader__path { stroke: $c-front; animation: 1.4s ease-in-out infinite loader-path; }
    
    @keyframes loader-spin {
      to{
        transform: rotate(360deg);
      }
    }
    @keyframes loader-path {
      0%{
        stroke-dasharray:  0, 580, 0, 0, 0, 0, 0, 0, 0;
      }
      50%{
        stroke-dasharray: 0, 450, 10, 30, 10, 30, 10, 30, 10;
      }
      100%{
        stroke-dasharray: 0, 580, 0, 0, 0, 0, 0, 0, 0;
      }
    }
    
    
        </style>
        @yield('style-content')

        <!-- Jquery min JS google CDN -->
        <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>

        <link href="{{ asset('assets/css/toast.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('assets/js/toast.js') }}"></script>
        <script src="{{ asset('assets/js/dist/select2.min.js') }}"></script>
