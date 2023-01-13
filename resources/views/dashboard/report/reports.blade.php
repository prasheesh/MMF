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
            

            <div class="col-md-12">
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
                    <tbody id= "getsearchdata">
                        @php $i = 1; @endphp
                        @foreach ($booking_history as $book_history )

                        <tr>
                            <td>{{$i++}}</td>
                            <!-- <td>{{$book_history->users->name}}</td> -->
                            <td>{{$book_history->booking_id}}</td>

                            <td>
                                @foreach ($book_history->bookingdetails  as $booking_details)
                                <span class="badge bg-info">{{ $booking_details->airport_city_from }} to {{ $booking_details->airport_city_to }}</span><br>

                                @endforeach
                            </td>
                            <td>{{$book_history->created_at}}</td>

                            <td>{{$book_history->noofpassenger}}</td>
                            <td class="d-flex justify-content-between">
                            <span>MMFInv158445</span>
                            <span><a href="#"><i class="fa fa-eye"></i></a></span>
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
                            <!-- <td>
                                @foreach ($book_history->bookingdetails  as $booking_details)
                                <span class="badge bg-success">{{ $booking_details->airlines_type }} </span><br>

                                @endforeach
                            </td> -->
                            
                          

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
        @section('scripts')
        
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        
        
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        
        <script type="text/javascript">
        
         $('.all_datable').DataTable();


        var bookinglabels =  {{ Js::from($bookinglabels) }};
        var bookingdatas =  {{ Js::from($bookingdata) }};

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
            name:'booking',
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