<x-dashboard.layout>
    
    @section('styles')
    
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    
    @endsection
    
    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Balance with Users</h4>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white all_datable">
                    <thead>
                        <tr>
                            <th>SI. No.</th>
                            <th>User ID / Name</th>
                            <th>Allotted Balance</th>
                            <th>Used Balance</th>
                            <th>Left Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $sno =1 @endphp
                    @foreach($user_balances as $key=>$user_balance)
                    @php
                    $user_used_balance = $user_balance->users->user_booking_history()->sum('amount');
                    $user_left_balance = $user_balance->allotted_balance-$user_used_balance
                    @endphp
                    <tr>
                        <td>{{ $sno++ }}</td>
                        <td>{{ $user_balance->users->name }}</td>
                        <td>{{ $user_balance->allotted_balance }}</td>
                        <td>{{ $user_used_balance }}</td>
                        <td>{{ $user_left_balance }}</td>
                    </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
            {{ $user_balances->links('dashboard.paginator.paginator') }}

        </div>
    </div>
    
    
    @section('scripts')
        
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        
        <script type="text/javascript">
        
            $('.all_datable').DataTable();
         </script>
         
    @endsection
</x-dashboard.layout>