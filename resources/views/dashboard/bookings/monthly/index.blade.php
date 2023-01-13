<x-dashboard.layout>

    @section('styles')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

    <style type="text/css">

        a{
            text-decoration:none;
        }
    </style>
    @endsection


    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Bookings History</h4>

            </div>

                <div class="col-md-3 mb-3">
                    <a href="{{ route('bookings.dailybookings') }}" >
                    <div class="bg-warning d-flex justify-content-between align-items-center p-4 radius-3">
                        <div class="text-white">
                            <p class="mb-2">Daily</p>
                            <h2><b>{{$booking_history_daliy}}</b></h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar-alt text-warning"></i>
                        </div>
                    </div>
                </a>
                </div>


            <div class="col-md-3 mb-3">
                <a href="{{ route('bookings.weeklybookings') }}" >
                <div class="bg-danger d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">Weekly</p>
                        <h2><b>{{$booking_history_weekly}}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-danger"></i>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('bookings.monthlybookings') }}" >
                <div class="bg-info d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">Monthly</p>
                        <h2><b>{{$booking_history_month}}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-info"></i>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('bookings.index') }}" >
                <div class="bg-success d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">All</p>
                        <h2><b>{{$booking_history_total}}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-success"></i>
                    </div>
                </div>
            </a>
            </div>

            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white booking_datable">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User ID</th>
                            <th>Booking ID</th>
                            <th>Reference ID</th>
                            <th>Sector</th>
                            <th>No. Of Passengers</th>
                            <th>Airlines</th>
                            <th>Amount</th>
                            <th>Aborted</th>
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>

       
    </div>

    @section('scripts')

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>


        <script type="text/javascript">

            $('.booking_datable').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route("bookings.index") }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'users_id', name: 'users_id'},
                    {data: 'booking_id', name: 'booking_id'},
                    {data: 'reference_id', name: 'reference_id'},
                    {data: 'sector', name: 'sector'},
                    {data: 'noofpassenger', name: 'noofpassenger'},
                    {data: 'airlines', name: 'airlines'},
                    {data: 'amount', name: 'amount'},
                    {data: 'aborted_status', name: 'aborted_status'},
                
                ]
            });

           
        </script>

    @endsection

</x-dashboard.layout>