<x-dashboard.layout>

    
    
    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Bookings History</h4>
               
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-warning d-flex justify-content-between align-items-center p-4 radius-3">
                    <div class="text-white">
                        <p class="mb-2">Daily</p>
                        <h2><b>{{$booking_history_daliy}}</b></h2>
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
                        <h2><b>{{$booking_history_weekly}}</b></h2>
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
                        <h2><b>{{$booking_history_month}}</b></h2>
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
                        <h2><b>{{$booking_history_total}}</b></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-alt text-success"></i>
                    </div>
                </div>
            </div>

            <div class="clearfix mb-3"></div>
            <div class="col-md-3 ms-auto mb-2 float-end">
                <form>
                    <input type="text" class="form-control" placeholder="Search by User Name / ID" />
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
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($booking_history as $book_history )
                            
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$book_history->users->name}}</td>
                            <td>{{$book_history->booking_id}}</td>
                            <td>{{$book_history->fromcity}} to {{$book_history->tocity}}</td>
                            <td>{{$book_history->noofpassenger}}</td>
                            <td>{{$book_history->airlines_type}}</td>
                            <td>{{$book_history->amount}}</td>
                            <td>
                                @if ($book_history->aborted_status == 'Success')

                                <small class="bg-success text-white plr-2 radius-3">{{$book_history->aborted_status}}</small>
                                @elseif ($book_history->aborted_status == 'Cancel')
                                <small class="bg-warning text-white plr-2 radius-3">{{$book_history->aborted_status}}</small>
                                @else
                                <small class="bg-danger text-white plr-2 radius-3">{{$book_history->aborted_status}}</small>
                                @endif
                            </td>
                           
                        </tr>
                        @endforeach
                        {{-- <tr>
                            <td>2</td>
                            <td>12345</td>
                            <td>MMF000002</td>
                            <td>Hyderabad to Banglore</td>
                            <td>03</td>
                            <td>Fly Dubai</td>
                            <td>18,000</td>
                            <td><small class="bg-warning text-white plr-2 radius-3">Cancel</small></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>12345</td>
                            <td>MMF000003</td>
                            <td>Hyderabad to Vishakapatnam</td>
                            <td>01</td>
                            <td>Indigo</td>
                            <td>35,000</td>
                            <td><small class="bg-danger text-white plr-2 radius-3">Terminated</small></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

        </div>

        <footer>
            <div class="row">
                <div class="col-md-12 text-center">
                    <small>© 2022 All Rights Reserved by Makemyfly.com</small>
                </div>
            </div>
        </footer>
    </div>

</x-dashboard.layout>