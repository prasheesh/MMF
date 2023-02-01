<x-dashboard.layout>



    @section('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/datatable/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/datatable/dataTables.bootstrap5.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">

        <style type="text/css">
            a {
                text-decoration: none;
            }
        </style>
    @endsection


    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Bookings History</h4>

            </div>

            <form action="" method="post">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-3">
                        <label for="" class="form-label">Select From Date</label>
                        <input type="text" class="form-control datepicker" name="from_date" id="" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Select End Date</label>
                        <input type="text" class="form-control datepicker" name="end_date" id="" readonly>
                    </div>
                    <div class="col-md-3 mt-1">
                        <input type="submit" value="Search" class="btn btn-primary mt-4">
                    </div>
                </div>
            </form>

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
                            <th>Booking Date</th>
                            <th>Amount</th>
                            <th>Invoice</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($table as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->users->name }}</td>
                                <td>
                                    <a href="{{ route('bookings.details', $data->booking_id) }}">
                                        {{ $data->booking_id }}
                                    </a>


                                </td>
                                <td>
                                    <a href="{{ route('bookings.details', $data->booking_id) }}">
                                        {{ $data->reference_id }}
                                    </a>


                                </td>
                                <td>
                                    @foreach ($data->bookingdetails as $booking_details)
                                        <span class="badge bg-info">{{ $booking_details->airport_city_from }} to
                                            {{ $booking_details->airport_city_to }}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $data->noofpassenger }}
                                </td>
                                <td>
                                    @foreach ($data->bookingdetails as $booking_details)
                                        <span class="badge bg-info">{{ $booking_details->airlines_type }}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $data->created_at->format('d-M-y') }}
                                </td>
                                <td>
                                    {{ $data->amount }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <span>MMFInv158478</span>
                                        <span>
                                            <a href="#">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                </td>


                                <td>

                                    @if ($data->aborted_status == 'SUCCESS')
                                        <small
                                            class="bg-success text-white plr-2 radius-3">{{ $data->aborted_status }}</small>
                                    @elseif ($data->aborted_status == 'Cancel')
                                        <small
                                            class="bg-warning text-white plr-2 radius-3">{{ $data->aborted_status }}</small>
                                    @else
                                        <small
                                            class="bg-danger text-white plr-2 radius-3">{{ $data->aborted_status }}</small>
                                    @endif




                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

        <script src="{{ asset('assets/js/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/dataTables.bootstrap5.min.js') }}"></script>


        <script type="text/javascript">
            $('.booking_datable').DataTable({


            });

            var datevalid = $('.datepicker').datepicker({
                dateFormat: "yy-mm-dd",

                onSelect: function(selectedDate) {
                    var orginalDate = new Date(selectedDate);

                }
            });
            // $('.datepicker').datePicker();
        </script>
    @endsection

</x-dashboard.layout>
