<nav class="navbar fixed-top navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard.index')}}"><img src="{{asset('assets/img/MMF.png')}}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              
                @if (Auth::check() && Auth::user()->user_type  != 'Admin')
                    @php 
                    
                        
                        if(Auth::user()->user_balance_allocated != null){
                            
                            $user_leftbalances = Auth::user()->user_balance_allocated->allotted_balance;
                            if($user_leftbalances != null){

                                $user_leftbalance = $user_leftbalances;
                            }else{
                                $user_leftbalance = 0;
                            }
                        }else{
                            $user_leftbalance = 0;
                        }
                        if(Auth::user()->user_booking_history != null){
                            $user_allocatedbalances = Auth::user()->user_booking_history()->where('users_id', Auth::id())->sum('amount');
                        }else{
                            $user_allocatedbalances = 0;
                        }
                        
                        $user_duebalance =  $user_leftbalance - $user_allocatedbalances;
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link" href="#"><small>Left Balance</small><br><b>
                            {{$user_leftbalance}}
                            </b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><small>Due Balance</small><br><b>{{$user_duebalance}}</b></a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div><small>Hi</small><br><b>{{ Auth::user()->name }}</b></div>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" ><form action="{{ route('logout') }}" method="post">
              @csrf
						<input type="submit" value="Logout" class="btn btn-sm btn-secondary mt-1">
						<p></p>
            </form></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>