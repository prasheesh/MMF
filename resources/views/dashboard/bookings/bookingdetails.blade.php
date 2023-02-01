<x-dashboard.layout>



    @section('styles')

   
    @endsection


    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Bookings Details</h4>

            </div>
            
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="" id="" value="{{$bookingdetails->users->name}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Booking ID</label>
                        <input type="text" class="form-control" name="" id="" value="{{$bookingdetails->booking_id}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" name="" id="" value="{{$bookingdetails->email_id}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="" id="" value="{{$bookingdetails->phone_country_code}}-{{$bookingdetails->phone_number}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Amount</label>
                        <input type="text" class="form-control" name="" id="" value="{{$bookingdetails->amount}}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Status</label>
                        <input type="text" class="form-control" name="" id="" value="{{$bookingdetails->aborted_status}}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Travelling City</label>
                        @foreach ($bookingdetails->bookingdetails  as $booking_detail)
                            <span class="badge bg-info">{{$booking_detail->airport_city_from}} to {{$booking_detail->airport_city_to}}</span><br>
                        @endforeach
                        {{-- <input type="text" class="form-control" name="" id="" value="{{$bookingdetails->aborted_status}}" readonly> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>

    @section('scripts')

    


       

    @endsection

</x-dashboard.layout>