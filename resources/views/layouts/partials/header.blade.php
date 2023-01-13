  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container container-make   d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ route('index') }}"><img src="assets/img/MMF.png"></a></h1>

      @if(Auth::check())
      <div class="col-md-6
			 float-end">
				<div class="row">
					<div class="col-md-2 top-details">
            <a href="{{ route('dashboard.index') }}">
						<p class="Hi-user">Hi {{ Str::ucfirst(Auth::user()->name) }} </p>
						<p>12345</p>
          </a>
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
          <li><a href="{{ route('index') }}">Home</a></li>
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