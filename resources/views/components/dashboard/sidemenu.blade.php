<div class="leftpart">
    <ul class="main-menu">
        @if (Auth::user()->user_type != 'Admin')
            <li><a href="{{ route('home') }}"><i class="fas fa-search"></i> Search for Flight</a></li>
        @endif

        <li><a href="{{ route('dashboard.index') }}"><i class="fas fa-calendar"></i> Dashboard</a></li>
        <li><a href="{{ route('bookings.index', 'all') }}"><i class="fas fa-calendar"></i> Bookings</a></li>
        <li><a href="{{ route('finance.index', 'all') }}"><i class="fas fa-money-bill"></i> Finance</a></li>
        <li><a href="{{ route('managetax.index') }}"><i class="fas fa-credit-card"></i> Manage Tax</a></li>
        <li><a href="{{route('cancellationfee.index')}}"><i class="fas fa-credit-card"></i> Add Cancellation Fee</a></li>
        <li><a href="{{ route('report.index') }}"><i class="fas fa-chart-pie"></i> Reports</a></li>
        {{-- <li><a href="{{route('number.of.user.index')}}"><i class="fas fa-users"></i> Number of Users</a></li> --}}
        <li><a href="{{ route('credit.limit.index') }}"><i class="fas fa-credit-card"></i> Credit Limit</a></li>
        
        <li><a href="{{ route('balance.with.users.index') }}"><i class="fas fa-user-check"></i> Balance with Users</a>
        </li>
        <li><a href="{{ route('create.user.index') }}"><i class="fas fa-user-plus"></i> Create Users</a></li>
        <li><a href="{{ route('manage.user.index') }}"><i class="fas fa-user-cog"></i> Manage Users</a></li>
        <li><a href="{{ route('paymnet.summery.index') }}"><i class="fas fa-wallet"></i> Payment Summery</a></li>
    </ul>
</div>
