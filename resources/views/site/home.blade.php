@extends('layouts.app')

@section('style-content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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

        .travel-class{
            padding:4px 15px !important;
        }
        .airport-name-search{
            padding:4px 15px !important;
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
                <form method="post" action="{{ route('filterfilghts') }}" name="searchOneWay" id="searchOneWay">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="tripType" id="tripType" value="oneway">
                        <div class="col-md-3 " style="position: relative;">
                            <small>From</small>

                            <div class="airport-name ">
                                <select class="form-control" name="fromPlace" id="fromPlace">
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->code .' - '. $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <span class=" from-to"> </span>
                        </div>
                        <div class="col-md-3">

                            <small>To</small>
                            <div class="airport-name">

                                <select class="form-control" name="toPlace" id="toPlace">
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->code .' - '. $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
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
                                    <label>
                                        {{-- Departure --}}

                                        <input class="form-control date-picker-hide"  type="text" name="flightBookingDepart" id="flightBookingDepart"
                                            placeholder="Start date" autocomplete="off" required />

                                    </label>


                                </div>
                                <div class="col-md-6">
                                    <small>Return</small>
                                    <label>
                                        {{-- Return --}}
                                        <input class="form-control date-picker-hide" type="text" name="flightBookingReturn" id="flightBookingReturn"
                                            placeholder="Return date" autocomplete="off" />
                                            <span id="return_date_error" class="d-none error"  >Please Select Return Date</span>

                                    </label>

                                </div>
                            </div>
                        </div>



                        <div class="col-md-2 travellerData" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <small>Travelers & Class</small>
                            <input type="hidden" value="1" id="adultval" name="adultval" class="">
                            <input type="hidden" value="0" id="childval" name="childval" class="">
                            <input type="hidden" value="0" id="infantval" name="infantval" class="">
                            <input type="hidden" value="ECONOMY" name="travelClass" id="travelClass" class=""
                                autocomplete="off">
                            <div class="airport-name airport-name-search travel-class" id="travelInfo">

                                <p><b>1 Traveller </b></p>
                                <p>Economy</p>
                            </div>
                        </div>

                        <div class="col-md-2 ms-auto " style="    margin-top: 1rem;">
                            {{-- <a href="{{ route('search-flights') }}"> --}}
                            <button id="searchFlightsButton" type="submit" class="btn btn-search-flights">Search Flights</button>
                            {{-- </a> --}}
                        </div>
                    </div>
                </form>
            </div>

            <!-- 2nd tab -->


            <!-- 3rd tab -->

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <form method="post" action="{{ route('filterfilghts') }}" id="MultiCityForm" name="MultiCityForm">
                    @csrf
                    <div class="row align-items-center newrow">
                        <input type="hidden" name="tripType" id="tripTypeMulti" value="multi">
                        <div class="col-md-3 " style="position: relative;">
                            <small>From</small>
                            <div class="airport-name">
                                <select class="form-select form-control" onchange="validateLocation(1)"
                                    name="fromPlace[]" id="FromPlace1">
                                    <option value="">Select From</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{$airport->code .' - '. $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
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
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->code .' - '. $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small>Departure</small>
                            <div class="airport-name">
                                <input  type="text" name="flightBookingDepart[]" class="flightBookingDepart form-control p-0"
                                    placeholder="Start date" autocomplete="off" id="flightBookingDepart1" />
                            </div>
                            <span id="error_date1" style="color:red"></span>
                        </div>
                        <div class="col-md-3 travellerData" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <small>Travellers & Class</small>
                            <input type="hidden" value="1" id="adultval" name="adultval" class="">
                            <input type="hidden" value="ECONOMY" name="travelClass" id="travelClass" class="">
                            <div class="airport-name airport-name-search travelInfo" id="travelInfo">

                                <p><b>1 Traveller </b></p>
                                <p>Economy</p>
                            </div>

                        </div>

                    </div>
                    <span id="error_same1" style="color:red"></span>
                    <div id="multiCityDiv" class="newrow">
                    <div class="row align-items-center ">
                        <div class="col-md-3 " style="position: relative;">
                            <small>From</small>
                            <div class="airport-name">
                                <select class="form-control" onchange="validateLocation(2)" name="fromPlace[]"
                                    id="FromPlace2">
                                    <option value="">Select From</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->code .' - '. $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
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
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}">
                                            {{ $airport->code .' - '. $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <small>Departure</small>
                            <div class="airport-name">
                                <input  type="text" name="flightBookingDepart[]" class="flightBookingDepart form-control p-0"
                                    placeholder="Start date" autocomplete="off" id="flightBookingDepart2" />
                            </div>
                            <span id="error_date2" style="color:red"></span>

                        </div>
                        <div class="col-md-3 mt-3">
                            <small>&nbsp;</small>
                            <button type="button" id="addCity1" onclick="clone_div()" class="btn  btn-primary">+
                                Add Another City</button>

                        </div>
                        <span id="error_same2" style="color:red"></span>
                    </div>
                    </div>



                    <div class="col-md-2 mt-3 ms-auto">
                        <a href="{{ route('search-flights') }}"> <button id="Submit"
                                class="btn btn-search-flights">Search
                                Flights</button></a>
                    </div>


            </div>

            </form>
        </div>


    </div>

    <section class="title">
        <div class="container container-make">
        <h1>Makemyfly Flights offers for you</h1>
        <div class="row">
            <div class="col-md-4">
                <img src="assets/img/covid-precations.png" class="img-fluid">
            </div>
            <div class="col-md-8">
                <img src="assets/img/covid-precations-offers.png" class="img-fluid">
            </div>
        </div>
    </div>
    </section>

    </div>
    <!--End of container -->
@endsection

@section('script-content')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Passenger List -->
    <script src="{{asset('assets/customjs/passengerlist.js')}}"></script>
    <script>

    $(document).ready(function(){
        //  Return Flights Select dates
        $('#flightBookingReturn').click(function(){
           $("#roundTrip").click();
        });

        //  On click Loader
        $("#searchFlightsButton").click(function(e){
            let trip_type = $("#tripType").val();
            if(trip_type == 'round'){
                let flightBookingReturn =  $("#flightBookingReturn").val();
                if(flightBookingReturn == ''){
                    $('#return_date_error').removeClass('d-none');
                    $("#flightBookingReturn").attr('required','true');
                    return false;

                }else{
                    $("#loader_div").removeClass('d-none');
                    $("#loader_div").show();
                }
            }else{
                $("#loader_div").removeClass('d-none');
                $("#loader_div").show();
            }

        });
    })




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
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}"
                                        >{{ $airport->code .' - '. $airport->name . ', ' .$airport->city.', '. $airport->country }}
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
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->code }}">{{ $airport->code .' - '. $airport->name . ', ' .$airport->city.', '. $airport->country }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-md-3">

                                <small>Departure</small>
                                <div class="airport-name">
                                    <input type="text" name="flightBookingDepart[]${count}" class="flightBookingDepart form-control p-0" placeholder="Start date"
                                    autocomplete="off" id="flightBookingDepart${count}"  />
                                </div>
                                <span id="error_date${count}" style="color:red"></span>
                    </div>


                    <div class="col-md-3 ">
                    <small>&nbsp;</small>
                        <button id="addCity${count}" onclick="clone_div()" type="button" class="btn btn-primary mt-1">+ Add Another City</button>

                        <button id="removeCity${count}" type="button" class="btn btn-danger" onclick="remove(${count})">
                                    <i class="fa-solid fa-minus"></i>
                                </button>

                    </div>
                </div>
                 <span id="error_same${count}" style="color:red"></span>`;


                $('#multiCityDiv').append(html);

                $('#addCity1').hide();


                if(count >= 4){
                    $('#addCity4').hide();
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
            if (count <= 4) {
                // alert('addCity'+(parseInt(id)-1));
                $('#addCity' + (parseInt(id) - 1)).show();
                $('#removeCity' + (parseInt(id) - 1)).show();
                // $('#error_same' + (parseInt(id) - 1)).show();
                // $('#error_date' + (parseInt(id) - 1)).show();
            }

        }
        $('#flightBookingReturn').prop('disabled', true);
        $('#oneWay').click(function() {
            $('#tripType').val('oneway');
            $('#return_date_error').addClass('d-none');
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
                    if (timestamp_start_date > timestamp_end_date || end_date == null) {
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

                if (timestamp_end_date < timestamp_start_date || start_date == null) {
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


@section('modals')

@include('site.modals.passengerlist')

@endsection
