<x-dashboard.layout>

    @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    @endsection
    <div class="rightpart">
        <div class="row">
            <div class="col-md-7 mb-3">
                <h4 style="font-weight: 700">Reports</h4>
            </div>
            {{-- <div class="col-md-3 ms-auto mb-2 float-end">
                <form>
                    <select class="form-select">
                        <option value="">Filter</option>
                        <option value="">Number of Bookings</option>
                        <option value="">Number of Volumes</option>
                        <option value="">Profits</option>
                    </select>
                </form>
            </div>  --}}
            <div class="clearfix mb-3"></div>

            <div class="col-md-12 mb-2">

                <div id="chart"></div>

            </div>

            <div class="clearfix mb-2"></div>

            {{-- search report (filetr) --}}
            <form method="POST" action={{ route('report.filterReports') }} id="FilterReportForm">
                {{-- <form name="FilterReportForm"> --}}
                @csrf
                <div class="row col-md-12">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" class="form-control" name="from_date" id="FromDate">
                            {{-- value={{ $booking_history[0]->created_at }} --}}
                            <span id="error_from_date" style="color:red"></span>
                        </div>
                    </div>
                    <span class="error text-danger d-none"></span>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>TO Date</label>
                            <input type="date" class="form-control" name="to_date" id="ToDate">
                            {{-- value={{ $booking_history[$booking_history_length - 1]->created_at }}  --}}
                            <span id="error_to_date" style="color:red"></span>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>History</label>
                            <select class="form-select" name="days_history" id="DaysHistory">
                                <option value="">Select History</option>
                                <option value="1">Today</option>
                                <option value="30">Monthly</option>
                                <option value="2">All </option>
                            </select>
                            {{-- <span id="errdays_history" style="color:red"></span> --}}
                            <span id="error_days_history" style="color:red"></span>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label></label>
                            <button type="submit" id="SubmitSearch" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-md-12" id="tableData1">
                <table class="table table-bordered table-striped bg-white all_datable">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Booking ID</th>
                            <th>Sector</th>
                            <th>Date of Booking</th>
                            <!-- <th>Class</th> -->
                            <th>No. of Passengers</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody id="getsearchdata">
                        @php $i = 1; @endphp
                        @foreach ($booking_history as $book_history)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <!-- <td>{{ $book_history->users->name }}</td> -->
                                <td><a
                                        href={{ route('report.user.details', $book_history->booking_id) }}>{{ $book_history->booking_id }}</a>
                                </td>

                                <td>
                                    @foreach ($book_history->bookingdetails as $booking_details)
                                        <span class="badge bg-info">{{ $booking_details->airport_city_from }} to
                                            {{ $booking_details->airport_city_to }}</span><br>
                                    @endforeach
                                </td>
                                <td>{{ $book_history->created_at }}</td>

                                <td>{{ $book_history->noofpassenger }}</td>
                                <td class="d-flex justify-content-between">
                                    <span>MMFInv158445</span>
                                    <span><a href="#"><i class="fa fa-eye"></i></a></span>
                                </td>
                                <td>{{ $book_history->amount }}</td>

                                <td>
                                    @if ($book_history->aborted_status == 'SUCCESS')
                                        <small
                                            class="bg-success text-white plr-2 radius-3">{{ $book_history->aborted_status }}</small>
                                    @elseif ($book_history->aborted_status == 'Cancel')
                                        <small
                                            class="bg-warning text-white plr-2 radius-3">{{ $book_history->aborted_status }}</small>
                                    @else
                                        <small
                                            class="bg-danger text-white plr-2 radius-3">{{ $book_history->aborted_status }}</small>
                                    @endif
                                </td>
                                <!-- <td>
                                @foreach ($book_history->bookingdetails as $booking_details)
<span class="badge bg-success">{{ $booking_details->airlines_type }} </span><br>
@endforeach
                            </td> -->

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div id="tableData"></div>

        </div>
    </div>

    @section('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>



        <script type="text/javascript">
            $('form[name=FilterReportForm]').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '{{ route('report.filterReports') }}',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    async: false,
                    success: function(data, textStatus, xhr) {
                        const booking_history = data.booking_history;
                        console.log(booking_history);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('input-error').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {
                                $('form[name=FilterReportForm] input[name=' + key + ']').addClass(
                                    'is-invalid');
                                $('form[name=FilterReportForm] input[name=' + key + ']').after(
                                    '<span class="text-danger input-error" role="alert">' + value +
                                    '</span>');
                                $('form[name=FilterReportForm] textarea[name=' + key + ']').addClass(
                                    'is-invalid');
                                $('form[name=FilterReportForm] textarea[name=' + key + ']').after(
                                    '<span class="text-danger input-error" role="alert">' + value +
                                    '</span>');
                                $('#' + key).addClass('invalid');
                                $('input#' + key).after('<span class="input-error" style="color:red">' +
                                    value + '</span>');
                                $('#err' + key).after('<span class="input-error" style="color:red">' +
                                    value + '</span>');
                            }
                        } else {
                            $('form[name=FilterReportForm] input[name=' + key + ']').removeClass(
                                'is-invalid');
                        }
                    }
                });
            })

            $("#SubmitSearch").on('click', function(events) {
                //events.preventDefault();
                const from_date = $("#FromDate").val();
                const to_date = $("#ToDate").val();
                const days_history = $("#DaysHistory").val();

                if (from_date == '' && to_date == '' && days_history == '') {
                    $('#error_days_history').text("This field can not be null!");
                    events.preventDefault();
                    return false;
                } else {
                    $('#error_days_history').text("");
                }

                if (from_date != '' && to_date == '') {
                    $("#error_to_date").text("This field can not be null");
                    events.preventDefault();
                    return false;
                } else {
                    $("#error_to_date").text("");
                }


            });

            $('.all_datable').DataTable();


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
    @endsection
</x-dashboard.layout>
