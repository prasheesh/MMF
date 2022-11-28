<x-dashboard.layout>

    @section('styles')
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

            @if ($booking_history->isNotEmpty())

            <div class="col-md-3 ms-auto mb-2 float-end">
                <form>
                    <input type="text" class="form-control" id="searchfilter" placeholder="Search by User Name / ID" />
                </form>
            </div>

            <div class="col-md-12">
                <table class="table table-bordered table-striped bg-white">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User ID</th>
                            <th>Booking ID</th>
                            <th>Sector</th>
                            <th>No. Of Passengers</th>
                            <th>Airlines</th>
                            <th>Amount</th>
                            <th>Aborted</th>
                        </tr>
                    </thead>
                    <tbody id= "getsearchdata">
                        @php $i = 1; @endphp
                        @foreach ($booking_history as $book_history )

                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$book_history->users->name}}</td>
                            <td>{{$book_history->booking_id}}</td>

                            <td>
                                @foreach ($book_history->bookingdetails  as $booking_details)
                                <span class="badge bg-info">{{ $booking_details->airport_city_from }} to {{ $booking_details->airport_city_to }}</span><br>

                                @endforeach
                            </td>

                            <td>{{$book_history->noofpassenger}}</td>
                            <td>
                                @foreach ($book_history->bookingdetails  as $booking_details)
                                <span class="badge bg-success">{{ $booking_details->airlines_type }} </span><br>

                                @endforeach
                            </td>
                            <td>{{$book_history->amount}}</td>
                            <td>
                                @if ($book_history->aborted_status == 'SUCCESS')

                                <small class="bg-success text-white plr-2 radius-3">{{$book_history->aborted_status}}</small>
                                @elseif ($book_history->aborted_status == 'Cancel')
                                <small class="bg-warning text-white plr-2 radius-3">{{$book_history->aborted_status}}</small>
                                @else
                                <small class="bg-danger text-white plr-2 radius-3">{{$book_history->aborted_status}}</small>
                                @endif
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            {{ $booking_history->links('dashboard.paginator.paginator') }}

            @else

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <p>No data Available</p>
                        </div>
                    </div>
                </div>

            @endif
        </div>

        <footer>
            <div class="row">
                <div class="col-md-12 text-center">
                    <small>© 2022 All Rights Reserved by Makemyfly.com</small>
                </div>
            </div>
        </footer>
    </div>

    @section('scripts')

        <script type="text/javascript">

            $('#searchfilter').on('keyup keydown paste', function(e) {

                let searchvalue = e.target.value;

                $.ajax({
                    type: "GET",
                    url: '{{ route("bookings.index") }}',
                    datatype: "JSON",
                    cache: false,
                    data:{'searchvalue' :searchvalue},
                    success:(data) => {
                        $('#getsearchdata').html(data);

                    },
                    error:(data) => {
                        console.log(data);
                    }


                });

            });
        </script>

    @endsection

</x-dashboard.layout>