<x-dashboard.layout>

    @section('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.7.1/nv.d3.css">
    @endsection

    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Bookings History</h4>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-warning d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">Daily</p>
                        <h2><b>{{ $booking_history_daliy }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-danger d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">Weekly</p>
                        <h2><b>{{ $booking_history_weekly }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-info d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">Monthly</p>
                        <h2><b>{{ $booking_history_month }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-info"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-success d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">All</p>
                        <h2><b>{{ $booking_history_total }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-success"></i>
                    </div>
                </div>
            </div>

            <div class="clearfix mb-3"></div>

            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Finance History</h4>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-warning-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">Daily</p>
                        <h2><b>{{ $daily_booking_amount }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-danger-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">Weekly</p>
                        <h2><b>{{ $weekly_booking_amount }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-info-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">Monthly</p>
                        <h2><b>{{ $monthly_booking_amount }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-success-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">All</p>
                        <h2><b>{{ $total_booking_amount }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
            </div>

            <div class="clearfix mb-3"></div>

            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Reports</h4>
            </div>

            <div class="col-md-12 mb-2">

                <div id="chart"></div>
            </div>


            @if (Auth::check() && Auth::user()->user_type == 'Admin')
                <div class="clearfix mb-3"></div>

                <div class="col-md-12 mb-3">
                    <h4 style="font-weight: 700">Users Data</h4>
                </div>
                <div class="col-md-6">
                    <div class="bg-success-outline d-flex justify-content-between align-items-center p-4 radius-3">
                        <div>
                            <p class="mb-2">B2B Users</p>
                            <h2><b>{{ $users_b2b }}</b></h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-info-outline d-flex justify-content-between align-items-center p-4 radius-3">
                        <div>
                            <p class="mb-2">B2E Users</p>
                            <h2><b>{{ $users_b2e }}</b></h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>


    @section('scripts')
        <!--  report bar data files  -->

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script type="text/javascript">
            var bookinglabels = {{ Js::from($bookinglabels) }};
            var bookingdatas = {{ Js::from($bookingdata) }};

            /** Apex Chart **/
            var options = {
                series: [{

                    data: bookingdatas
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {
                            // console.log(chart, w, e)
                        }
                    }
                },
                // colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: bookinglabels,

                    labels: {
                        name: 'booking',
                        style: {
                            //   colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>

        <!--  report bar data files  end -->
    @endsection
</x-dashboard.layout>
