<x-dashboard.layout>

    @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

        <style type="text/css">
            a {
                text-decoration: none;
            }
        </style>
    @endsection

    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Finance History</h4>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('finance.index', 'daily') }}">
                    <div class="bg-warning-outline d-flex justify-content-between align-items-center p-4 radius-3">
                        <div>
                            <p class="mb-2">Daily</p>
                            <h2><b>{{ $daily_booking_amount }}</b></h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-indian-rupee-sign text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('finance.index', 'weekly') }}">
                    <div class="bg-danger-outline d-flex justify-content-between align-items-center p-4 radius-3">
                        <div>
                            <p class="mb-2">Weekly</p>
                            <h2><b>{{ $weekly_booking_amount }}</b></h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-indian-rupee-sign text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('finance.index', 'monthly') }}">
                    <div class="bg-info-outline d-flex justify-content-between align-items-center p-4 radius-3">
                        <div>
                            <p class="mb-2">Monthly</p>
                            <h2><b>{{ $monthly_booking_amount }}</b></h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-indian-rupee-sign text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('finance.index', 'all') }}">
                    <div class="bg-success-outline d-flex justify-content-between align-items-center p-4 radius-3">
                        <div>
                            <p class="mb-2">All</p>
                            <h2><b>{{ $total_booking_amount }}</b></h2>
                        </div>
                        <div class="icon">
                            <i class="fas fa-indian-rupee-sign text-white"></i>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white finance_datable">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User ID</th>
                            <th>Booking ID</th>
                            <th>Sector</th>
                            <th>No. Of Passengers</th>
                            <th>Invoice</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>


        @section('scripts')
            <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

            <script type="text/javascript">
                'user strict';

                /****** Finance DataTable *****/
                $('.finance_datable').DataTable({

                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('finance.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'users_id',
                            name: 'users_id'
                        },
                        {
                            data: 'booking_id',
                            name: 'booking_id'
                        },
                        {
                            data: 'sector',
                            name: 'sector'
                        },
                        {
                            data: 'noofpassenger',
                            name: 'noofpassenger'
                        },
                        {
                            data: 'invoice',
                            name: 'invoice'
                        },
                        {
                            data: 'aborted_status',
                            name: 'aborted_status'
                        },

                    ]
                });
            </script>
        @endsection

</x-dashboard.layout>
