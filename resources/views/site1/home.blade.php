@extends('layouts.app')

@section('style-content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- <link href="{{ asset('mobiscroll/css/mobiscroll.jquery.min.css') }}" rel="stylesheet"> --}}
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        body,
        html {
            height: 100%;
        }

        .md-calendar-booking .mbsc-calendar-text {
            text-align: center;
        }

        .md-calendar-booking .booking-datetime .mbsc-datepicker-tab-calendar {
            flex: 1 1 0;
            min-width: 300px;
        }

        .md-calendar-booking .mbsc-timegrid-item {
            margin-top: 1.5em;
            margin-bottom: 1.5em;
        }

        .md-calendar-booking .mbsc-timegrid-container {
            top: 30px;
        }

        .modal-header {
            background: #3f90a1;
            color: #fff;
            border-radius: 0;
        }

        .modal-header i {
            color: #fff;
        }

        .count {
            margin: 0;
            padding: 0;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
            border-radius: 6px;
            overflow: hidden;
            width: auto;
            float: left;
        }

        .count li {
            padding: 10px 15px;
            list-style: none;
            float: left;
            transition: 0.3s;
            border-right: solid 0px #ccc;
        }

        .count li:hover {
            background: #3f90a1;
            color: #fff;
            transition: 0.3s;
        }

        .count li.active {
            background: #3f90a1;
            color: #fff;
            transition: 0.3s;
        }
        .select2  {
            width:100% !important;
        }
    </style>
@endsection

@section('content')
    <section class="banner">
        <div class="container-make container">

            <div class="row pt-5">
                <div class="col-md-12 text-center">
                    <h1>Domestic and International Flights</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container container-make" style="    margin-top: -100px;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item nav-item-border" role="presentation">
                {{-- <button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">One Way</button> --}}
                <label class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab"
                    aria-controls="home" aria-selected="true">
                    One way
                    <input class="demo-flight-type" value="oneway" id="oneWay" mbsc-radio data-theme="material"
                        data-theme-variant="light" type="radio" name="flight-type" checked>
                </label>
            </li>
            <li class="nav-item  nav-item-border" role="presentation">
                {{-- <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Round Trip</button> --}}
                <label class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab"
                    aria-controls="profile" aria-selected="false">
                    Round trip
                    <input class="demo-flight-type" value="round" mbsc-radio data-theme="material"
                        data-theme-variant="light" type="radio" name="flight-type" id="roundTrip">
                </label>
            </li>
            <li class="nav-item" role="presentation">
                {{-- <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">Multi City</button> --}}

                <label class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">
                    Multi City
                    <input class="demo-flight-type" value="multi" id="multi" mbsc-radio data-theme="material"
                        data-theme-variant="light" type="radio" name="flight-type">
                </label>

            </li>
        </ul>



        <div class="tab-content tab-content-btm" id="myTabContent">

            <!-- 1st tab -->

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form method="get" action="{{ route('SearchFlights') }}" name="searchOneWay" id="searchOneWay">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="tripType" id="tripType" value="oneway">
                        <div class="col-md-3 " style="position: relative;">
                            <small>From</small>

                            <div class="airport-name ">
                                {{-- <div class="mbsc-col-sm-12 mbsc-col-md-6">
                                <label>
                                    From
                                    <input mbsc-input id="fromPlace" name="fromPlace" data-dropdown="true" data-input-style="box" data-label-style="stacked" placeholder="Please select..."></select>
                                </label>
                            </div> --}}
                                {{-- <p><b>Hyderabad</b></p>
     			                <p>Rajiv Gandi international Airport</p> --}}
                                <select class="form-control" name="fromPlace" id="fromPlace">
                                    {{-- <option value="">Select From</option> --}}
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <span class=" from-to"> </span>
                        </div>
                        {{-- <div class="col-md-1" style="position: relative;">
                        <div class=" from-to" style="position: relative;"></div>
                    </div> --}}
                        <div class="col-md-3">

                            <small>To</small>
                            <div class="airport-name">
                                {{-- <p><b>Mumbai</b></p>
     			              <p>Chathrapathi Shivaji international Airport</p> --}}
                                {{-- <div class="mbsc-col-sm-12 mbsc-col-md-6">
                          <label>
                              To
                              <input mbsc-input id="toPlace" name="toPlace" data-dropdown="true" data-input-style="box" data-label-style="stacked" placeholder="Please select..."></select>
                          </label>
                      </div> --}}

                                <select class="form-control" name="toPlace" id="toPlace">
                                    {{-- <option value="">Select To</option> --}}
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <span id="sameFromTo" class="validation-error">From & To airports cannot be the same</span>

                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <small>Departure</small>
                                    {{-- <div class="mbsc-row"> --}}
                                    <label>
                                        {{-- Departure --}}

                                        <input type="text" name="flightBookingDepart" id="flightBookingDepart"
                                            placeholder="Start date" autocomplete="off" required />
                                        {{-- <input id="flightBookingDepart" mbsc-input data-input-style="outline"
                                                name="flightBookingDepart" data-label-style="stacked"
                                                placeholder="Please select..." /> --}}
                                    </label>

                                    {{-- </div> --}}


                                </div>
                                <div class="col-md-6">
                                    <small>Return</small>
                                    <label>
                                        {{-- Return --}}
                                        <input type="text" name="flightBookingReturn" id="flightBookingReturn"
                                            placeholder="Return date" autocomplete="off" required />
                                        {{-- <input id="flightBookingReturn" name="flightBookingReturn" mbsc-input
                                            data-input-style="outline" data-label-style="stacked"
                                            placeholder="Please select..." /> --}}
                                    </label>

                                </div>
                            </div>
                        </div>



                        <div class="col-md-2 travellerData" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <small>Travellers & Classs</small>
                            <input type="hidden" value="1" id="adultval" name="adultval" class="">
                            <input type="hidden" value="ECONOMY" name="travelClass" id="travelClass" class=""
                                autocomplete="off">
                            <div class="airport-name" id="travelInfo">

                                <p><b>1 Adult </b></p>
                                <p>Economy</p>
                            </div>
                        </div>

                        <div class="col-md-2 ms-auto " style="    margin-top: 1rem;">
                            {{-- <a href="{{ route('search-flights') }}"> --}}
                            <button id="searchFlightsButton" type="submit" class="btn btn-search-flights">Search Flights
                                one
                                Way</button>
                            {{-- </a> --}}
                        </div>
                    </div>
                </form>
            </div>

            <!-- 2nd tab -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Travellers & Class</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                                    class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-7 mb-4">
                                    <p>ADULTS (12y +)</p>
                                    <ul class="count" id="passengerCount">
                                        <li class="active" id="adult1" data-val="1">1</li>
                                        <li data-val="2" id="adult2">2</li>
                                        <li data-val="3" id="adult3">3</li>
                                        <li data-val="4" id="adult4">4</li>
                                        <li data-val="5" id="adult5">5</li>
                                        <li data-val="6" id="adult6">6</li>
                                        <li data-val="7" id="adult7">7</li>
                                        <li data-val="8" id="adult8">8</li>
                                        <li data-val="9" id="adult9">9</li>
                                    </ul>
                                </div>

                                {{-- <div class="col-md-5 mb-4">
<p>CHILDREN (2y - 12y )</p>
<ul class="count">
<li class="active">0</li>
<li>1</li>
<li>2</li>
<li>2</li>
<li>4</li>
<li>5</li>
<li>6</li>
</ul>
</div>

<div class="col-md-12 mb-4">
<p>INFANTS (below 2y)</p>
<ul class="count">
<li class="active">0</li>
<li>1</li>
<li>2</li>
<li>2</li>
<li>4</li>
<li>5</li>
<li>6</li>
</ul>
</div> --}}

                                <div class="col-md-12 mb-4">
                                    <p>CHOOSE TRAVEL CLASS</p>
                                    <ul class="count" id="chooseTravel">
                                        {{-- <li class="active" id="travel1" data-val="PREMIUM_ECONOMY">Premium Economy</li> --}}
                                        <li class="active" id="travel2" data-val="ECONOMY">Economy</li>
                                        <li id="travel3" data-val="BUSINESS">Business</li>
                                        <li id="travel4" data-val="FIRST">First Class</li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-one" data-bs-dismiss="modal">Close</button>
                            <button id="saveTravelDetail" type="button" class="btn btn-theme"
                                data-bs-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->

            <!-- 3rd tab -->

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <form method="get" action="{{ route('SearchFlights') }}" id="MultiCityForm" name="MultiCityForm">
                    @csrf
                    <div class="row align-items-center newrow">
                        <input type="hidden" name="tripType" id="tripTypeMulti" value="multi">
                        <div class="col-md-3 " style="position: relative;">
                            <small>From</small>
                            <div class="airport-name">
                                <select class="form-select form-control" onchange="validateLocation(1)"
                                    name="fromPlace[]" id="FromPlace1">
                                    <option value="">Select From</option>
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <small>To</small>
                            <div class="airport-name">
                                <select class="form-select" name="toPlace[]" onchange="setFromPlace(1)" id="ToPlace1">
                                    <option value="">Select To</option>
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small>Departure</small>
                            <div class="airport-name">
                                <input type="text" name="flightBookingDepart[]" class="flightBookingDepart"
                                    placeholder="Start date" autocomplete="off" id="flightBookingDepart1" />
                            </div>
                            <span id="error_date1" style="color:red"></span>
                        </div>
                        <div class="col-md-3 travellerData" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <small>Travellers & Classs</small>
                            <input type="hidden" value="1" id="adultval" name="adultval" class="">
                            <input type="hidden" value="ECONOMY" name="travelClass" id="travelClass" class="">
                            <div class="airport-name travelInfo" id="travelInfo">

                                <p><b>1 Adult </b></p>
                                <p>Economy</p>
                            </div>

                        </div>

                    </div>
                    <span id="error_same1" style="color:red"></span>
                    <div class="row align-items-center newrow" id="multiCityDiv">
                        <div class="col-md-3 " style="position: relative;">
                            <small>From</small>
                            <div class="airport-name">
                                <select class="form-control" onchange="validateLocation(2)" name="fromPlace[]"
                                    id="FromPlace2">
                                    <option value="">Select From</option>
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small>To</small>
                            <div class="airport-name">
                                <select class="form-control" name="toPlace[]" onchange="setFromPlace(2)" id="ToPlace2">
                                    <option value="">Select To</option>
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <small>Departure</small>
                            <div class="airport-name">
                                {{-- <p><b>10 June, 22</b></p>
                                      <p>Friday</p> --}}
                                <input type="text" name="flightBookingDepart[]" class="flightBookingDepart"
                                    placeholder="Start date" autocomplete="off" id="flightBookingDepart2" />
                            </div>
                            <span id="error_date2" style="color:red"></span>

                        </div>
                        <div class="col-md-3 ">
                            <button type="button" id="addCity1" onclick="clone_div()" class="btn btn-sm btn-primary">+
                                Add Another City</button>

                        </div>


                        {{-- <div class="col-md-2 ">
                          <button onclick="clone_div()" class="btn btn-sm btn-primary">+ Add Another City</button>
                      </div> --}}

                        <span id="error_same2" style="color:red"></span>
                    </div>

                    <div class="col-md-2 ms-auto">
                        <a href="{{ route('search-flights') }}"> <button id="Submit"
                                class="btn btn-search-flights">Search
                                Flights</button></a>
                    </div>


            </div>

            </form>
        </div>


    </div>

    <section class="title">
        <h1>Makemyfly Flights offers for you</h1>
        <div class="row">
            <div class="col-md-4">
                <img src="assets/img/covid-precations.png" class="img-fluid">
            </div>
            <div class="col-md-8">
                <img src="assets/img/covid-precations-offers.png" class="img-fluid">
            </div>
        </div>
    </section>

    </div>
    <!--End of container -->
@endsection

@section('script-content')
    {{-- <script src="{{ asset('mobiscroll/js/mobiscroll.jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        //default from to selection
        $(document).ready(onLoadFromToAirport);

        function onLoadFromToAirport() {
            $('#fromPlace').val('HYD');
            $('#toPlace').val('VGA');
            $('#toPlace').trigger('change');
            $('#fromPlace').trigger('change');
        }


        $(function() {

            $('#fromPlace').select2({
                placeholder: 'Select from',
            });
            $('#toPlace').select2({
                placeholder: 'Select to'
            });


            //choose no of passenger
            $('#passengerCount li').click(function() {
                // alert($(this).data('val'));
                $("#passengerCount li").removeClass('active');
                $(this).addClass('active');
            });

            //Choose travel type
            $('#chooseTravel li').click(function() {
                // alert($(this).data('val'));
                $("#chooseTravel li").removeClass('active');
                $(this).addClass('active');
            });

            $(document).on('click', '#saveTravelDetail', function() {
                // $('#saveTravelDetail').click(function(){

                localStorage.clear();
                var adultsVal = $("#passengerCount .active").data('val');
                var travelClassVal = $("#chooseTravel .active").data('val');

                var adultsId = $("#passengerCount .active").attr('id');
                var travelId = $("#chooseTravel .active").attr('id');

                //    alert(adults);

                localStorage.setItem('adultsVal', adultsVal);
                localStorage.setItem('travelClassVal', travelClassVal);
                localStorage.setItem('adultsId', adultsId);
                localStorage.setItem('travelId', travelId);

                // alert(adultsVal);
                $("input[name='travelClass']").val(travelClassVal);
                $("input[name='adultval']").val(adultsVal);



                if (travelClassVal == 'PREMIUM_ECONOMY') {
                    var travelName = "Premium Economy";
                } else if (travelClassVal == 'ECONOMY') {
                    var travelName = "Economy";
                } else if (travelClassVal == 'BUSINESS') {
                    var travelName = "Business";
                } else if (travelClassVal == 'FIRST') {
                    var travelName = "First Class";
                }




                $('#travelInfo').replaceWith('<div class="airport-name" id="travelInfo"><p><b>' +
                    adultsVal + ' Adult </b></p><p>' + travelName + '</p></div>');
                $('.travelInfo').replaceWith('<div class="airport-name travelInfo" id="travelInfo"><p><b>' +
                    adultsVal + ' Adult </b></p><p>' + travelName + '</p></div>');

            });

            $('.travellerData').click(function() {
                // alert('hj');
                let adultsId = localStorage.getItem('adultsId');
                let travelId = localStorage.getItem('travelId');

                if (adultsId == null || travelId == null) {
                    $('#adult1').addClass('active');
                    $('#travel2').addClass('active');

                } else {

                    $("#passengerCount li").removeClass('active');
                    $('#' + adultsId).addClass('active');

                    $("#chooseTravel li").removeClass('active');
                    $('#' + travelId).addClass('active');
                }
            });


            // function travelInfo(){

            let adultsVal = localStorage.getItem('adultsVal');
            if (adultsVal == null) {
                adultsVal = '1';
                localStorage.setItem('adultsVal', adultsVal);
                $('#adultval').val(adultsVal);

            }
            let travelClassVal = localStorage.getItem('travelClassVal');
            if (travelClassVal == null) {
                travelClassVal = 'ECONOMY';
                localStorage.setItem('travelClassVal', travelClassVal);
                $('#travelClass').val(travelClassVal);
            }
            $("input[name='travelClass']").val(travelClassVal);
            $("input[name='adultval']").val(adultsVal);



            if (travelClassVal == 'PREMIUM_ECONOMY') {
                var travelName = "Premium Economy";
            } else if (travelClassVal == 'ECONOMY') {
                var travelName = "Economy";
            } else if (travelClassVal == 'BUSINESS') {
                var travelName = "Business";
            } else if (travelClassVal == 'FIRST') {
                var travelName = "First Class";
            }

            $('#travelInfo').replaceWith('<div class="airport-name" id="travelInfo"><p><b>' + adultsVal +
                ' Adult </b></p><p>' + travelName + '</p></div>');

            $('.travelInfo').replaceWith('<div class="airport-name travelInfo" id="travelInfo"><p><b>' + adultsVal +
                ' Adult </b></p><p>' + travelName + '</p></div>');
            // }

            // $('#flightBookingDepart').change(function() {
            //     alert($(this).val());
            // })
            // $('#flightBookingReturn').change(function() {
            //     alert($(this).val());
            // })

            $('.from-to').click(function() {
                var fromPlace = $('#fromPlace').val();
                var toPlace = $('#toPlace').val();

                $('#fromPlace').val(toPlace);
                $('#toPlace').val(fromPlace);
                $('#toPlace').trigger('change');
                $('#fromPlace').trigger('change');
                // console.log($('#fromPlace :selected').text());
            });



            $('#fromPlace, #toPlace').on('change', function() {
                var fromPlace = $('#fromPlace').val();
                var toPlace = $('#toPlace').val();
                if (fromPlace == toPlace) {
                    $('#sameFromTo').show();
                    $('#searchFlightsButton').hide();

                } else {
                    $('#sameFromTo').hide();
                    $('#searchFlightsButton').show();
                }

            });


        });

        function clone_div() {
            var count1 = $('.newrow').length;
            var count = count1 + 1;
            // alert(count);
            var html =`<div class="row align-items-center newrow" id="newrow${count}">
                                    <div class="col-md-3 " style="position: relative;">
                        <small>From</small>
                        <div class="airport-name ">
                            <select class="form-select" onchange="validateLocation(${count})" name="fromPlace[]${count}" id="FromPlace${count}">
                            <option value="">Select From</option>
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}"
                                        >{{ $airport->name . ', ' .$airport->city.', '. $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <small>To</small>
                        <div class="airport-name">
                            <select class="form-control" onchange="setFromPlace(${count})" name="toPlace[]${count}" id="ToPlace${count}">
                            <option value="">Select To</option>
                                    @foreach (DB::table('airport_details')->get() as $airport)
                                        <option value="{{ $airport->code }}">{{ $airport->name . ', ' .$airport->city.', '. $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-md-2">

                                <small>Departure</small>
                                <div class="airport-name">
                                    <input type="text" name="flightBookingDepart[]${count}" class="flightBookingDepart" placeholder="Start date"
                                    autocomplete="off" id="flightBookingDepart${count}"  />
                                </div>
                                <span id="error_date${count}" style="color:red"></span>
                    </div>


                    <div class="col-md-2 ">
                        <button id="addCity${count}" onclick="clone_div()" type="button" class="btn btn-sm btn-primary">+ Add Another City</button>
                    </div>
                    <div class="col-md-2 ">
                        <button id="removeCity${count}" type="button" class="plus-bg bg-danger" onclick="remove(${count})">
                                    <i class="fa-solid fa-minus"></i>
                                </button>

                    </div>
                </div>
                 </br> <span id="error_same${count}" style="color:red"></span>`;


                $('#multiCityDiv').append(html);

                $('#addCity1').hide();


                if(count >= 5){
                    $('#addCity5').hide();
                    $('#addCity'+(parseInt(count)-1)).hide();
                    $('#removeCity'+(parseInt(count)-1)).hide();
                }else{

                    $('#addCity'+(parseInt(count)-1)).hide();
                    $('#removeCity'+(parseInt(count)-1)).hide();
                }


                $('#FromPlace'+count).select2({
                    placeholder: 'Select from',
                });
                var prev_count = parseInt(count) - 1 ;
                var prev_to_place = $("#ToPlace"+prev_count).val();
                $("#FromPlace"+count).select2();
                $("#FromPlace"+count).val(prev_to_place).trigger("change");
                $('#ToPlace'+count).select2({
                        placeholder: 'Select to'
                });
        }

        function remove(id) {
            var count = $('.newrow').length;
            // alert(count)
            // alert(id+'kkk')
            $('#newrow' + id).remove();
            if(count == 3){
                $('#addCity1').show();
            }
            // $('#addCity1').show();
            if (count <= 5) {
                // alert('addCity'+(parseInt(id)-1));
                $('#addCity' + (parseInt(id) - 1)).show();
                $('#removeCity' + (parseInt(id) - 1)).show();
            }

        }
        $('#flightBookingReturn').prop('disabled', true);
        $('#oneWay').click(function() {
            $('#tripType').val('oneway');
            $('#flightBookingReturn').prop('disabled', true);
        });
        $('#roundTrip').click(function() {
            $('#tripType').val('round');
            $('#flightBookingReturn').prop('disabled', false);
        });
    </script>

    <script>
        var start_date = null,
            end_date = null;
        var timestamp_start_date = null,
            timestamp_end_date = null;
        var $input_start_date = null,
            $input_end_date = null;



        function getDateClass(date, start, end) {
            if (end != null && start != null) {
                if (date > start && date < end)
                    return [true, "sejour", "Séjour"];
            }

            if (date == start)
                return [true, "start", "Début de votre séjour"];
            if (date == end)
                return [true, "end", "Fin de votre séjour"];

            return false;
        }

        function datepicker_draw_nb_nights() {
            var $datepicker = jQuery("#ui-datepicker-div");
            setTimeout(function() {
                if (start_date != null && end_date != null) {
                    var $qty_days_stay = jQuery("<div />", {
                        class: "ui-datepicker-stay-duration"
                    });
                    var qty_nights_stay = get_days_difference(timestamp_start_date, timestamp_end_date);
                    $qty_days_stay.text(qty_nights_stay + " nights stay");
                    $qty_days_stay.appendTo($datepicker);
                }
            });
        }

        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();

        var todayDate = (day < 10 ? '0' : '') + day + '-' +
            (month < 10 ? '0' : '') + month + '-' + d.getFullYear();

        // var todayDate = '21/09/2022';

        var maxDate = '31-03-' + parseInt(d.getFullYear() + 1);



        var options_start_date = {
            dateFormat: "dd-mm-yy",
            showAnim: false,
            constrainInput: true,
            numberOfMonths: 1,
            showOtherMonths: true,
            minDate: todayDate,
            maxDate: maxDate,
            beforeShow: function(input, datepicker) {

                datepicker_draw_nb_nights();
            },
            beforeShowDay: function(date) {

                // 0: published
                // 1: class
                // 2: tooltip
                var timestamp_date = date.getTime();
                var result = getDateClass(timestamp_date, timestamp_start_date, timestamp_end_date);
                if (result != false)
                    return result;

                return [true, "", ""];
                // return [ true, "chocolate", "Chocolate! " ];
            },
            onSelect: function(date_string, datepicker) {
                // this => input
                if ($('#tripType').val() != 'oneway') {
                    start_date = $input_start_date.datepicker("getDate", 'minDate');
                    timestamp_start_date = start_date.getTime();
                }

            },
            onClose: function() {
                if (end_date != null) {
                    if (timestamp_start_date >= timestamp_end_date || end_date == null) {
                        $input_end_date.datepicker("setDate", null);
                        end_date = null;
                        timestamp_end_date = null;
                        $input_end_date.datepicker("show");
                        return;
                    }
                }
                if (start_date != null && end_date == null)
                    $input_end_date.datepicker("show");
            }
        };

        var options_end_date = {
            dateFormat: "dd-mm-yy",
            showAnim: false,
            constrainInput: true,
            numberOfMonths: 1,
            showOtherMonths: true,
            minDate: todayDate,
            maxDate: maxDate,
            beforeShow: function(input, datepicker) {
                datepicker_draw_nb_nights();
            },
            beforeShowDay: function(date) {
                var timestamp_date = date.getTime();
                var result = getDateClass(timestamp_date, timestamp_start_date, timestamp_end_date);
                if (result != false)
                    return result;

                return [true, "", "Chocolate !"];
            },
            onSelect: function(date_string, datepicker) {
                // this => input
                end_date = $input_end_date.datepicker("getDate", 'minDate');
                timestamp_end_date = end_date.getTime();
            },
            onClose: function() {
                if (end_date == null)
                    return;

                if (timestamp_end_date <= timestamp_start_date || start_date == null) {
                    $input_start_date.datepicker("setDate", null);
                    start_date = null;
                    timestamp_start_date = null;
                    $input_start_date.datepicker("show");
                }
            }
        };

        $input_start_date = jQuery("#flightBookingDepart");
        $input_end_date = jQuery("#flightBookingReturn");




        $input_start_date.datepicker(options_start_date);
        $input_start_date.datepicker('setDate', todayDate);
        $input_end_date.datepicker(options_end_date);





        function get_days_difference(start_date, end_date) {
            return Math.floor(end_date - start_date) / (1000 * 60 * 60 * 24);
        }


        $(document).on('focus', '.flightBookingDepart', function() {
            $(this).datepicker(options_start_date);
        })


        // ================ mrunal===========================
        function setFromPlace(id) {
            var nxt_id = parseInt(id) + 1;
            var to_place = $("#ToPlace" + id).val();
            var from_place = $("#FromPlace" + id).val();
            if (to_place == from_place) {
                $("#error_same" + id).text('From-Place and To-Place can not be same...!');
                //$("#Submit").prop('disabled', true);
                $("#Submit").hide();
            } else {
                $("#error_same" + id).text('');
                //$("#Submit").prop('disabled', false);
                $("#Submit").show();
                $("#FromPlace" + nxt_id).val(to_place);
                $("#FromPlace" + nxt_id).select2();
                $("#FromPlace" + nxt_id).val(to_place).trigger("change");
            }
        }

        function validateLocation(id) {
            var to_place = $("#ToPlace" + id).val();
            var from_place = $("#FromPlace" + id).val();
            if (to_place != '' || from_place != '') {
                if (to_place == from_place) {
                    $("#error_same" + id).text('From-Place and To-Place can not be same...!');
                    $("#Submit").hide();
                } else {
                    $("#error_same" + id).text('');
                    $("#Submit").show();
                }
            }
        }

        $('form[name="MultiCityForm"]').submit(function(e){

    var count1 = $('.newrow').length;
    var arr=[];
    for(var i=1; i<=count1; i++)
    {
      arr.push(i);
    }
     $.each(arr, function(key, value){
         var fplace = $("#FromPlace"+value).val();
          var tplace = $("#ToPlace"+value).val();
          var date = $("#flightBookingDepart"+value).val();
          var prev_date = $("#flightBookingDepart"+parseInt(value - 1)).val();
          var nxt_date = $("#flightBookingDepart"+parseInt(value + 1)).val();
          var temp = '';
         if(value <= count1)
         {
           if(date == '')
              {
                   $("#error_date"+value).text('This field can not be empty...!');
                   e.preventDefault();
              }else if(date > nxt_date)
                  {
                      $.each(arr, function(key1, value1){
                      $("#flightBookingDepart"+value1).val('');
                      });

                      $("#error_date"+value).text('Please enter correct date...!');
                      e.preventDefault();
                  }
               else if(fplace == '')
              {
                  $("#error_same"+value).text('This field can not be empty...!');
                  e.preventDefault();
                  return false;
              }else if(tplace == '')
              {
                  $("#error_same"+value).text('This field can not be empty...!');
                   e.preventDefault();
                  return false;
              }
              else{
                  $("#error_date"+value).text('');
                  $("#error_same"+value).text('');
                  $("#error_date"+value).text('');
                  return true;
              }
         }

     });
  });

  $(document).on('focus','.flightBookingDepart',function(){
        $(this).datepicker(options_start_date);
    });

    $(document).on('select2:open', () => {
   document.querySelector('.select2-search__field').focus();
});

$('#FromPlace1').select2({
    placeholder: 'Select from',
});


$('#ToPlace1').select2({
        placeholder: 'Select to',
});

$('#FromPlace2').select2({
    placeholder: 'Select from',
});

$('#ToPlace2').select2({
        placeholder: 'Select to'
});
        // ================ mrunal===========================
    </script>
@endsection
