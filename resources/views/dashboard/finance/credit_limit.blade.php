<x-dashboard.layout>
    
    @section('styles')
    
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    
    @endsection
    
    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Credit Limit</h4>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white all_datable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Allotted Balance</th>
                            <th>Available Balance</th>
                            <th>Used Balance</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($credit_balances as $key=>$credit_balance)
                    @php
                    $user_used_balance = $credit_balance->users->user_booking_history()->sum('amount');
                    $user_left_balance = $credit_balance->allotted_balance-$user_used_balance
                    @endphp
                        <tr>
                            <td>{{ $credit_balance->users->name }}</td>
                            <td>{{ $credit_balance->allotted_balance }}</td>
                            <td>{{ $user_used_balance }}</td>
                            <td>{{ $user_left_balance }}</td>
                            <td class="d-flex justify-content-between">
                                <small class="bg-success text-white plr-2 radius-3"><i class="fa fa-indian-rupee-sign"></i> Add Balance</small>
                                <small class="bg-warning text-white plr-2 radius-3"><i class="fa fa-indian-rupee-sign"></i> Manage Balance</small>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

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