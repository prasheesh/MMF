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
                <h4 style="font-weight: 700">Finance History</h4>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('finance.dailyamount') }}">
                <div class="bg-warning-outline d-flex justify-content-between align-items-center p-4 radius-3">
                    <div>
                        <p class="mb-2">Daily</p>
                        <h2><b>{{  $daily_booking_amount }}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-indian-rupee-sign text-white"></i>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('finance.weeklyamount') }}">
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
                <a href="{{ route('finance.monthlyamount') }}">
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
                <a href="{{ route('finance.index') }}">
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

            @if($finance_historys->isNotEmpty())

            <div class="clearfix mb-3"></div>
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
                            <th>Invoice</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody id="getsearchdata">
                        @php $i = 1; @endphp
                        @foreach ($finance_historys as $finance_history )
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$finance_history->users->name}}</td>
                            <td>{{$finance_history->booking_id}}</td>
                            <td>
                                @foreach ($finance_history->bookingdetails  as $booking_details)
                                <span class="badge bg-info">{{ $booking_details->airport_city_from }} to {{ $booking_details->airport_city_to }}</span><br>

                                @endforeach
                            </td>
                            <td>{{$finance_history->noofpassenger}}</td>
                            <td class="d-flex justify-content-between">
                                <span>MMFInv158478</span>
                                <span><a href="#"><i class="fa fa-eye"></i></a></span>
                            </td>
                            <td>
                                @if ($finance_history->aborted_status == 'SUCCESS')

                                <small class="bg-success text-white plr-2 radius-3">{{$finance_history->aborted_status}}</small>
                                @elseif ($finance_history->aborted_status == 'Cancel')
                                <small class="bg-warning text-white plr-2 radius-3">{{$finance_history->aborted_status}}</small>
                                @else
                                <small class="bg-danger text-white plr-2 radius-3">{{$finance_history->aborted_status}}</small>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{ $finance_historys->links('dashboard.paginator.paginator') }}

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
    </div>


    @section('scripts')

        <script type="text/javascript">

            $('#searchfilter').on('keyup keydown paste', function(e) {

                let searchvalue = e.target.value;

                $.ajax({
                    type: "GET",
                    url: '{{ route("finance.index") }}',
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