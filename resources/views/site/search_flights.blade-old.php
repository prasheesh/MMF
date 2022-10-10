@extends('layouts.app')
@section('style-content')
    <link rel="stylesheet" href="assets/css/all.min.css">

    <!-- slick carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    {{-- mobi date picker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- <link href="{{ asset('mobiscroll/css/mobiscroll.jquery.min.css') }}" rel="stylesheet"> --}}

    <style>
        .table-booking {
            font-size: 14px;
            margin-bottom: 0;
        }

        .table-booking th {
            padding: 15px;
        }

        .table-booking td {
            padding: 15px;
        }

        .final-price {
            font-size: 18px;
            margin-bottom: 0;
        }

        .mt-5 {
            margin-top: 3rem;
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

        .round-trip1 p {
            font-size: 15px;
            font-weight: 500;
        }

        .round-trip1 span {
            font-size: 12px;
            margin-left: 5px;
        }

        .shadow {
            border: 1px solid #b0dae3;
        }

        .departture {
            text-align: left;
        }

        .departture p {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 0;
        }

        .departture span:nth-child(1) {
            font-size: 16px;
            font-weight: 600;
            border-bottom: 1px solid #ccc;
            margin-bottom: 0px;
        }

        .departture span:nth-child(2) {
            font-size: 10px;
            margin-bottom: 0px;
        }

        .shadow img {
            width: 40px;
        }

        .time-gap span:nth-child(1) {
            font-size: 11px;
            font-weight: 500;
            padding-bottom: 3px;
            line-height: 0;
        }

        .price-round {
            font-size: 13px !important;
            font-weight: 600 !important;
            text-align: center;
        }

        .price-round i {
            font-size: 11px;
        }

        .departture input {
            width: 20px;
            height: 20px;
            /* border-bottom: 5px solid #ccc; */
            margin-bottom: 5px;
            margin-top: 0;
        }

        .pricedetails {
            position: relative;
        }

        .pricedetails-btm {
            position: sticky;
            bottom: 0;
            background-color: #9bd3df;
            padding: 15px;
            border-radius: 5px;
            width: 100%;
            z-index: 9999;
            float: right;
            margin-top: 15px;
        }

        .btm-price {
            border-right: 1px solid #293389;

        }

        .btm-flights-price p {
            font-weight: 600;
            margin-bottom: 0;
            font-size: 13px;
        }

        .btm-flights-price a {
            color: #0d6efd;
            font-size: 12px;
        }

        .btm-fligh-price {
            text-align: right !important;
            margin-top: 15px;
        }

        .btm-fligh-price p {
            text-align: right !important;
        }

        .btm-fligh-price a {
            color: #0d6efd;
            font-size: 12px;
        }

        .fixed-btm {
            position: relative;
        }

        :host {
            display: block;
        }

        .final-price {
            font-size: 18px;
            margin-bottom: 0;
        }

        .bg-tablle {
            display: flex;
            background-color: #eeeeee;
            padding: 0px 5px;
            margin-top: 15px;
        }

        .bg-tablle p {
            width: 33%;
            padding: 1px 5px;
            font-size: 13px;
        }

        .loader_div {
            position: absolute;
            top: 0;
            bottom: 0%;
            left: 0;
            right: 0%;
            z-index: 9999999;
            opacity: 0.7;
            display: none;
            background: lightgrey url('http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif') center center no-repeat;
        }
    </style>
@endsection

@section('content')
    <div id="loader_div" class="loader_div"></div>


    <!-- book modal -->

    @if ($_GET['tripType'] == 'oneway')

        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
            @if (isset($result_array->searchResult->tripInfos))
                @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value)
                    <div class="modal" id="book-table{{ $value->sI[0]->id }}">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body p-0">

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                                            class="fa fa-times"></i></button>

                                    <table class="table table-booking" style="">
                                        <thead class="bg-grey" style="border-bottom: 2px solid #fff;">
                                            <tr>
                                                <th class="">FARES </th>
                                                <th>CABIN BAG</th>
                                                <th>CHECK-IN</th>
                                                <th>CANCELLATION</th>
                                                <th>DATE CHANGE</th>
                                                <th>SEAT</th>
                                                <th>MEAL</th>
                                                <th></th>
                                            </tr>

                                        </thead>
                                        <tbody>

                                            <?php
                                            $i = 1;
                                            $id = 1;
                                            $c = 1;
                                            $d = 1;
                                            $s = 1;
                                            $totalPriceList = count($value->totalPriceList);

                                            ?>
                                            <input type="hidden" name="totalPriceList{{ $value->sI[0]->id }}"
                                                id="totalPriceList{{ $value->sI[0]->id }}" value="{{ $totalPriceList }}">
                                            @foreach ($value->totalPriceList as $key => $values)
                                                <tr>
                                                    <td class=""><b>{{ $values->fareIdentifier }}</b>
                                                        <input type="hidden"
                                                            name="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $i++ }}"
                                                            id="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $id++ }}"
                                                            value="{{ $values->id }}">

                                                        <p>
                                                            Fair offered by airline.
                                                        </p>
                                                    </td>
                                                    <td>{{ $values->fd->ADULT->bI->cB }}</td>
                                                    <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                        echo $values->fd->ADULT->bI->iB;
                                                    } else {
                                                        echo '--';
                                                    } ?></td>
                                                    <td id="cancellation{{ $value->sI[0]->id }}{{ $c++ }}">--
                                                        {{-- cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500 --}}
                                                    </td>
                                                    <td id="dateChangeText{{ $value->sI[0]->id }}{{ $d++ }}">--
                                                        {{-- Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250 --}}
                                                    </td>
                                                    <td id="seatChargeId{{ $value->sI[0]->id }}{{ $s++ }}">--
                                                        {{-- Middle Seat Free, <br> Window/Asile Chargeable --}}
                                                    </td>
                                                    <td>
                                                        @if (isset($values->fd->ADULT->mI))
                                                            @if ($values->fd->ADULT->mI == true)
                                                                Free Meal
                                                            @else
                                                                Paid Meal
                                                            @endif
                                                        @else
                                                            --
                                                        @endif


                                                    </td>
                                                    <td align="right">
                                                        <p class="final-price"><b><i
                                                                    class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($values->fd->ADULT->fC->NF) }}</b>
                                                        </p>
                                                        <a href="{{ route('reviewDetails') }}?pKey={{ $values->id }}">
                                                            <button class="btn btn-book-now">Book Now</button> </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- book modal end -->
                @endforeach
            @endif
        @endif
    @endif


    <!-- View Price -->
    @if ($_GET['tripType'] == 'round')

        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
            @if (isset($result_array->searchResult->tripInfos))
                @if (isset($result_array->searchResult->tripInfos->ONWARD))
                    @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value)
                        <div class="modal" id="ViewPrice{{ $value->sI[0]->id }}">
                            <div class="modal-dialog modal-lg">
                                <form action="" method="get" name="viewPriceForm" id="viewPriceForm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>You have <b>more fares</b> to select from</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                                                    class="fa fa-times"></i></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="container card-bkdetail">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="col-md-12 mb-3">
                                                            <p class="deapt">DEPART</p>
                                                        </div>
                                                        <div class="clearfix mb-2"></div>
                                                        <div class="row ">
                                                            <div class="col-md-3">
                                                                <div class="row">
                                                                    <div class="col-md-3 p-0">
                                                                        {{-- <img src="assets/img/flight-logo-2.png" class="img-fluid"> --}}
                                                                    </div>
                                                                    <div class="col-md-9 ps-0">
                                                                        {{-- <span><b>{{ $value->sI[0]->fD->aI->name }}</b> | {{ $value->sI[0]->fD->aI->code }}-{{ $value->sI[0]->fD->fN }}</span> --}}
                                                                        {{-- <p class="ms-0">Airways | QF-1533</p> --}}
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 m-auto">
                                                                <h4 class="citiname">{{ $_GET['fromPlace'] }}</h4>
                                                                <p>Date and Departure</p>
                                                            </div>
                                                            <div class="col-md-3 m-auto">
                                                                <h4 class="citiname">{{ $_GET['toPlace'] }}</h4>
                                                                <p>Return</p>
                                                            </div>
                                                        </div>

                                                        <table class="table table-borderless table-striped mt-3">
                                                            <tr class="bg-grey">
                                                                <td colspan="2"></td>
                                                                <td class="bag-icon"><i class="fa-solid fa-briefcase"></i>
                                                                    <br>Cabin Bag</td>
                                                                <td class="bag-icon"><i
                                                                        class="fa-solid fa-suitcase-rolling"></i><br> Check
                                                                    In</td>
                                                                <td class="bag-icon"><i class="fa-solid fa-plane-slash"></i>
                                                                    <br>Cancellation</td>
                                                                <td class="bag-icon"><i
                                                                        class="fa-solid fa-calendar-days"></i><br> Date
                                                                    Change</td>
                                                            </tr>
                                                            <?php
                                                            $i = 1;
                                                            $id = 1;
                                                            $c = 1;
                                                            $d = 1;
                                                            $s = 1;
                                                            $totalPriceList = count($value->totalPriceList);
                                                            ?>
                                                            <input type="hidden"
                                                                name="totalPriceList{{ $value->sI[0]->id }}"
                                                                id="totalPriceList{{ $value->sI[0]->id }}"
                                                                value="{{ $totalPriceList }}">
                                                            @foreach ($value->totalPriceList as $key => $values)
                                                                <tr>
                                                                    <td>
                                                                        <span><input required type="radio" name="pKey"
                                                                                data-onPrice="{{ $values->fd->ADULT->fC->NF }}"
                                                                                value="{{ $values->id }}"></span>
                                                                        <span><b>{{ $values->fareIdentifier }}</b></span><br>
                                                                        <input type="hidden"
                                                                            name="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $i++ }}"
                                                                            id="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $id++ }}"
                                                                            value="{{ $values->id }}">
                                                                        <small>Fare offered by Airlines</small>
                                                                    </td>
                                                                    <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        {{ number_format($values->fd->ADULT->fC->NF) }}
                                                                    </td>
                                                                    <td>{{ $values->fd->ADULT->bI->cB }}</td>
                                                                    <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                                        echo $values->fd->ADULT->bI->iB;
                                                                    } else {
                                                                        echo '--';
                                                                    } ?></td>
                                                                    <td
                                                                        id="cancellation{{ $value->sI[0]->id }}{{ $c++ }}">
                                                                        --
                                                                        {{-- cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500 --}}
                                                                    </td>
                                                                    <td
                                                                        id="dateChangeText{{ $value->sI[0]->id }}{{ $d++ }}">
                                                                        --
                                                                        {{-- Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250 --}}
                                                                    </td>

                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="card ">
                                                    <div class="card-body">
                                                        <div class="col-md-12 mb-3">
                                                            <p class="deapt">RETURN</p>
                                                        </div>
                                                        <div class="clearfix mb-2"></div>
                                                        <div class="row ">
                                                            <div class="col-md-3">
                                                                <div class="row">
                                                                    <div class="col-md-3 p-0">
                                                                        {{-- <img src="assets/img/flight-logo-2.png" class="img-fluid"> --}}
                                                                    </div>
                                                                    <div class="col-md-9 ps-0">
                                                                        {{-- <span><b>{{ $value->sI[0]->fD->aI->name }}</b> | {{ $value->sI[0]->fD->aI->code }}-{{ $value->sI[0]->fD->fN }}</span> --}}
                                                                        {{-- <p class="ms-0">Airways | QF-1533</p> --}}
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 m-auto">
                                                                <h4 class="citiname">{{ $_GET['toPlace'] }}</h4>
                                                                <p>Date and Departure</p>
                                                            </div>
                                                            <div class="col-md-3 m-auto">
                                                                <h4 class="citiname">{{ $_GET['fromPlace'] }}</h4>
                                                                <p>Return</p>
                                                            </div>
                                                        </div>

                                                        <table class="table table-borderless table-striped mt-3">
                                                            <tr class="bg-grey">
                                                                <td colspan="2"></td>
                                                                <td class="bag-icon"><i class="fa-solid fa-briefcase"></i>
                                                                    <br>Cabin Bag</td>
                                                                <td class="bag-icon"><i
                                                                        class="fa-solid fa-suitcase-rolling"></i><br> Check
                                                                    In</td>
                                                                <td class="bag-icon"><i
                                                                        class="fa-solid fa-plane-slash"></i>
                                                                    <br>Cancellation</td>
                                                                <td class="bag-icon"><i
                                                                        class="fa-solid fa-calendar-days"></i><br> Date
                                                                    Change</td>
                                                            </tr>

                                                            @foreach ($result_array->searchResult->tripInfos->RETURN as $key => $value)
                                                                <?php
                                                                $i = 1;
                                                                $id = 1;
                                                                $c = 1;
                                                                $d = 1;
                                                                $s = 1;
                                                                $totalPriceList = count($value->totalPriceList);
                                                                ?>
                                                                <input type="hidden"
                                                                    name="totalPriceList{{ $value->sI[0]->id }}"
                                                                    id="totalPriceList{{ $value->sI[0]->id }}"
                                                                    value="{{ $totalPriceList }}">
                                                                @foreach ($value->totalPriceList as $key => $values)
                                                                    <tr class="showFare{{ $value->sI[0]->id }} showFare"
                                                                        style="display: none">
                                                                        <td>
                                                                            <span><input required type="radio"
                                                                                    name="rKey"
                                                                                    data-downPrice="{{ $values->fd->ADULT->fC->NF }}"
                                                                                    value="{{ $values->id }}"></span>
                                                                            <span><b>{{ $values->fareIdentifier }}</b></span><br>
                                                                            <input type="hidden"
                                                                                name="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $i++ }}"
                                                                                id="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $id++ }}"
                                                                                value="{{ $values->id }}">
                                                                            <small>Fare offered by Airlines</small>
                                                                        </td>
                                                                        <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                            {{ number_format($values->fd->ADULT->fC->NF) }}
                                                                        </td>
                                                                        <td>{{ $values->fd->ADULT->bI->cB }}</td>
                                                                        <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                                            echo $values->fd->ADULT->bI->iB;
                                                                        } else {
                                                                            echo '--';
                                                                        } ?></td>
                                                                        <td
                                                                            id="cancellationRe{{ $value->sI[0]->id }}{{ $c++ }}">
                                                                            --
                                                                        </td>
                                                                        <td
                                                                            id="dateChangeTextRe{{ $value->sI[0]->id }}{{ $d++ }}">
                                                                            --
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="modal-footer footer-btn">
                                            <p><i class="fa-solid fa-indian-rupee-sign"></i> <span id="priceOnUp"></span>
                                                <br> <small> FOR 1 ADULT</small></p>
                                            <a id="reviewDetailsRoundTrip" href="">
                                                <button type="submit" class="btn btn-book-now">Continue</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @endforeach
                @endif
            @endif
        @endif
    @endif
    <!-- View Price end -->


    <!-- View Price international-->
    @if ($_GET['tripType'] == 'round')

        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
            @if (isset($result_array->searchResult->tripInfos))
                @if (isset($result_array->searchResult->tripInfos->COMBO))
                    @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $value)
                        <?php

                        $city_name_from = DB::table('airport_details')
                            ->where('code', $_GET['fromPlace'])
                            ->first('city');
                        $city_name_to = DB::table('airport_details')
                            ->where('code', $_GET['toPlace'])
                            ->first('city');

                        ?>

                        <div class="modal" id="ViewPriceInternational{{ $value->sI[0]->id }}">
                            {{-- <form action="" method="get" name="viewPriceFormInt" id="viewPriceFormInt"> --}}
                            <div class="modal-dialog modal-xl ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>You have <b>more fares</b> to select from </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                                                class="fa fa-times"></i></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="container card-bkdetail">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-md-12 mb-3">
                                                        <p class="deapt">ROUND TRIP</p>
                                                    </div>
                                                    <div class="clearfix mb-2"></div>
                                                    <div class="row ">
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                                <div class="col-md-3 p-0">
                                                                    <?php
                                                                    $flight_code = $value->sI[0]->fD->aI->code;
                                                                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';

                                                                    ?>
                                                                    <img src="{{ $flight_logo }}" class="img-fluid">
                                                                </div>
                                                                <div class="col-md-9 ps-0">
                                                                    <span><b>{{ $value->sI[0]->fD->aI->name }}</b> |
                                                                        {{ $value->sI[0]->fD->aI->code }}-{{ $value->sI[0]->fD->fN }}</span>
                                                                    {{-- <p class="ms-0">Airways | QF-1533</p> --}}
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 m-auto">
                                                            <h4 class="citiname">{{ $city_name_from->city }}</h4>
                                                            <p>Date and Departure</p>
                                                        </div>
                                                        <div class="col-md-3 m-auto">
                                                            <h4 class="citiname">{{ $city_name_to->city }}</h4>
                                                            <p>Return</p>
                                                        </div>
                                                    </div>

                                                    <table class="table table-borderless table-striped mt-3">
                                                        <tr class="bg-grey">
                                                            <td colspan="2"></td>
                                                            <td class="bag-icon"><i class="fa-solid fa-briefcase"></i>
                                                                <br>Cabin Bag</td>
                                                            <td class="bag-icon"><i
                                                                    class="fa-solid fa-suitcase-rolling"></i><br> Check In
                                                            </td>
                                                            <td class="bag-icon"><i class="fa-solid fa-plane-slash"></i>
                                                                <br>Cancellation</td>
                                                            <td class="bag-icon"><i
                                                                    class="fa-solid fa-calendar-days"></i><br> Date Change
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <?php
                                                        $i = 1;
                                                        $id = 1;
                                                        $c = 1;
                                                        $d = 1;
                                                        $s = 1;
                                                        $totalPriceList = count($value->totalPriceList);

                                                        ?>

                                                        <input type="hidden"
                                                            name="totalPriceList{{ $value->sI[0]->id }}"
                                                            id="totalPriceList{{ $value->sI[0]->id }}"
                                                            value="{{ $totalPriceList }}">
                                                        @foreach ($value->totalPriceList as $key => $values)
                                                            <input type="hidden"
                                                                name="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $i++ }}"
                                                                id="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $id++ }}"
                                                                value="{{ $values->id }}">
                                                            <tr>
                                                                <td>
                                                                    <span>
                                                                        {{-- <input type="radio" required type="radio" name="pKey" data-onPrice="{{ $values->fd->ADULT->fC->NF }}" value="{{ $values->id }}"> --}}
                                                                    </span>
                                                                    <span><b>{{ $values->fareIdentifier }}</b></span><br>
                                                                    <small>Fare offered by Airlines</small>
                                                                </td>
                                                                <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ number_format($values->fd->ADULT->fC->NF) }}</td>
                                                                <td>{{ $values->fd->ADULT->bI->cB }}</td>
                                                                <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                                    echo $values->fd->ADULT->bI->iB;
                                                                } else {
                                                                    echo '--';
                                                                } ?></td>
                                                                <td
                                                                    id="cancellationRe{{ $value->sI[0]->id }}{{ $c++ }}">
                                                                    --
                                                                </td>
                                                                <td
                                                                    id="dateChangeTextRe{{ $value->sI[0]->id }}{{ $d++ }}">
                                                                    --
                                                                </td>
                                                                <td>
                                                                    <a
                                                                        href="{{ route('reviewDetails') }}?pKey={{ $values->id }}">
                                                                        <button class="btn btn-book-now">Book Now</button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="modal-footer footer-btn d-none">
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> <span id="priceOnUp"></span> <br>
                                            <small> FOR 1 ADULT</small></p>
                                        <button type="submit" class="btn btn-book-now">Continue</button>
                                    </div>
                                </div>
                            </div>
                            {{-- </form> --}}
                        </div>
                    @endforeach
                @endif
            @endif
        @endif
    @endif
    <!-- View Price internatinal end -->

    <section class="bg-grey" style="height: 300px; margin-bottom: -150px;">
        <form method="get" action="{{ route('SearchFlights') }}" name="searchOneWay" id="searchOneWay">
            @csrf
            <div class="container container-make mt-5" style="  ">

                <div class="row">
                    <div class="col-md-2 " style="">

                        <div class="airport-name-inner ">
                            <small class="inner-smaltext">Trip Type</small>
                            <select name="tripType" id="trip_type" class="form-control">
                                <option <?php if ($_GET['tripType'] == 'oneway') {
                                    echo 'selected';
                                } ?> value="oneway">One Way Trip</option>
                                <option <?php if ($_GET['tripType'] == 'round') {
                                    echo 'selected';
                                } ?> value="round">Round Trip</option>
                                <option <?php if ($_GET['tripType'] == 'multi') {
                                    echo 'selected';
                                } ?> value="3">Multi-Trip</option>
                            </select>
                            {{-- <p><b>Round trip</b></p> --}}

                        </div>
                    </div>
                    <div class="col-md-3" style="position: relative;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="airport-name-inner">
                                    <small class="inner-smaltext">From</small>
                                    {{-- <p><b>Hyderabad</b></p> --}}

                                    <select class="form-control" name="fromPlace" id="fromPlace">
                                        {{-- <option value="">Select From</option> --}}
                                        @foreach (DB::table('airport_details')->get() as $airport)
                                            <option <?php echo $_GET['fromPlace'] == $airport->code ? 'selected' : ''; ?> value="{{ $airport->code }}">
                                                {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class=" from-to-inner"> </span>

                            </div>

                            <div class="col-md-6">
                                <div class="airport-name-inner">
                                    <small class="inner-smaltext">To</small>
                                    <select class="form-control" name="toPlace" id="toPlace">
                                        {{-- <option value="">Select To</option> --}}
                                        @foreach (DB::table('airport_details')->get() as $airport)
                                            <option <?php echo $_GET['toPlace'] == $airport->code ? 'selected' : ''; ?> value="{{ $airport->code }}">
                                                {{ $airport->name . ', ' . $airport->city . ', ' . $airport->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span id="sameFromTo" class="validation-error">From & To airports cannot be the
                                    same</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="airport-name-inner">
                                    <small class="inner-smaltext">Departure</small>
                                    {{-- <div class="mbsc-row"> --}}
                                    <label>
                                        {{-- Departure --}}
                                        @if ($_GET['tripType'] != 'multi')
                                            <input required autocomplete="off" id="flightBookingDepart"
                                                name="flightBookingDepart" placeholder="Please select..."
                                                value="{{ $_GET['flightBookingDepart'] }}" />
                                        @else
                                            <input required autocomplete="off" id="flightBookingDepart"
                                                name="flightBookingDepart" placeholder="Please select..."
                                                value="" />
                                        @endif
                                    </label>

                                    {{-- </div> --}}
                                </div>
                            </div>

                            <div class="col-md-6">
                                @if ($_GET['tripType'] != 'multi')
                                    <div class="airport-name-inner" style=" padding: 6px 10px;">
                                        <small>Return</small>
                                        <label>

                                            {{-- Return --}}
                                            <?php
                                            if (isset($_GET['flightBookingReturn'])) {
                                                $return_date = $_GET['flightBookingReturn'];
                                            } else {
                                                $return_date = '';
                                            }
                                            ?>
                                            @if (!is_array($_GET['flightBookingDepart']))
                                                <input required autocomplete="off" id="flightBookingReturn"
                                                    name="flightBookingReturn" placeholder="Please select..."
                                                    value="{{ $return_date }}" />

                                            @endif


                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

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


                    <div class="col-md-2 travellerData">

                        <div class="airport-name-inner" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <input type="hidden" value="1" id="adultval" name="adultval" class="">
                            <input type="hidden" value="ECONOMY" name="travelClass" id="travelClass" class="">
                            <small class="inner-smaltext">Travellers & Class</small>
                            <span id="travelInfo">
                                <p><b>1 Adult</b></p>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-2 ms-auto">
                        <button type="submit" class="btn btn-search-flights" id="searchFlightsButton">Search
                            Flights</button>
                    </div>
                </div>

            </div>
        </form>
    </section>
    {{-- {{ print_r($result_array->searchResult->tripInfos->ONWARD[0]) }} --}}

    <section style="padding-top: 50px;">

        <div class="container container-make">
            <div class="row">
                <div class="col-md-3 p-3">
                    <div class="card">
                        <div class=" card-body card-shadow">
                            <h5>One Way Price</h5>

                            <div class="mt-4">
                                <form>
                                    <input type="range" name="" class="form-range">
                                </form>
                                <span class=" left-range"><i class="fa-solid fa-indian-rupee-sign"></i> 6,363</span>
                                <span class=" right-range"><i class="fa-solid fa-indian-rupee-sign"></i> 20,636</span>

                            </div>

                            <div class="mt-4">
                                <h5>Stops From Hyderabad</h5>
                                <div class="d-flex justify-content-between mt-3">
                                    <div> <input type="radio" name=""> 1 Stop (2)</div>
                                    <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div> <input type="radio" name=""> 1 Stop (2)</div>
                                    <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div> <input type="radio" name=""> 1 Stop (2)</div>
                                    <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                                </div>
                            </div>


                            <div class="mt-4">
                                <h5>Departure From Hyderabad</h5>

                                <div class="row mt-3">
                                    <div class="col-md-4 align-items-center main-departure">
                                        <div class="departure-1">
                                            <div class=""><img src="{{ 'assets/img/sun.png' }}" class="img-fluid">
                                            </div>
                                            <p>Before 6 AM <br> 9418</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 main-departure">
                                        <div class="departure-1">
                                            <div class=""><img src="{{ 'assets/img/sun.png' }}" class="img-fluid">
                                            </div>
                                            <p>Before 6 AM <br> 9418</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 main-departure">
                                        <div class="departure-1">
                                            <div class=""><img src="{{ 'assets/img/sun.png' }}" class="img-fluid">
                                            </div>
                                            <p>Before 6 AM <br> 9418</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="mt-4">
                                <h5>Arrival at Mumbai</h5>

                                <div class="row mt-3">
                                    <div class="col-md-4 align-items-center main-departure">
                                        <div class="departure-1">
                                            <div class=""><img src="{{ 'assets/img/sun.png' }}" class="img-fluid">
                                            </div>
                                            <p>Before 6 AM <br> 9418</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 main-departure">
                                        <div class="departure-1">
                                            <div class=""><img src="{{ 'assets/img/sun.png' }}" class="img-fluid">
                                            </div>
                                            <p>Before 6 AM <br> 9418</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 main-departure">
                                        <div class="departure-1">
                                            <div class=""><img src="{{ 'assets/img/sun.png' }}" class="img-fluid">
                                            </div>
                                            <p>Before 6 AM <br> 9418</p>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="mt-4">
                                <h5>Airlines</h5>
                                <div class="d-flex justify-content-between mt-3">
                                    <div> <input type="radio" name=""> 1 Stop (2)</div>
                                    <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div> <input type="radio" name=""> 1 Stop (2)</div>
                                    <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div> <input type="radio" name=""> 1 Stop (2)</div>
                                    <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                                </div>
                                <div class="text-end mt-2"><a href="#">View more</a></div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-9 p-3 bbook-price-details">
                    <div class="card">
                        <div class="card-body card-shadow">
                            <?php

                            $city_name_from = DB::table('airport_details')
                                ->where('code', $_GET['fromPlace'])
                                ->first('city');
                            $city_name_to = DB::table('airport_details')
                                ->where('code', $_GET['toPlace'])
                                ->first('city');

                            ?>

                            @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                                @if (isset($result_array->searchResult->tripInfos->ONWARD))
                                    <h5>Flights from
                                        {{ $city_name_from->city }} to
                                        {{ $city_name_to->city }}
                                        @if ($_GET['tripType'] == 'round')
                                            , and back
                                        @endif

                                    </h5>
                                @elseif (isset($result_array->searchResult->tripInfos->COMBO))
                                    <h5>Flights from
                                        {{ $city_name_from->city }} to
                                        {{ $city_name_to->city }}
                                        @if ($_GET['tripType'] == 'round')
                                            , and back
                                        @endif

                                    </h5>
                                @endif
                            @endif


                            @if ($_GET['tripType'] == 'oneway')
                                <div class="wrapper">
                                    <div class="carousel">
                                        <div class="date-active">
                                            <p class="date-inner ">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>
                                        <div>
                                            <p class="date-inner">Mon, Jul 04</p>
                                            <p class="price-inner"><i class="fa-solid fa-indian-rupee-sign"></i> 6,825</p>
                                        </div>

                                    </div>
                                </div>
                                <table class="table mt-3 mb-3">
                                    <thead class="bg-thead">
                                        <tr>

                                            <th>Sorted By: </th>
                                            <th>Departure</th>
                                            <th>Duration</th>
                                            <th>Arrival</th>
                                            <th>Price</th>

                                        </tr>
                                    </thead>
                                    <tbody class="bg-tbody">

                                        {{-- {{ print_r($result_array->searchResult->tripInfos->ONWARD[2]->totalPriceList ) }} --}}

                                        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                                            @if (isset($result_array->searchResult->tripInfos))
                                                <?php
                                                $sno = 1;
                                                $flight_count = count($result_array->searchResult->tripInfos->ONWARD);

                                                ?>

                                                @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value)
                                                    {{-- {{ print_r($value->totalPriceList[0]->fd->ADULT) }} --}}
                                                    {{-- {{  $key.'<<<=>>>>'.print_r($value->totalPriceList[0]) }} --}}



                                                    <tr>
                                                        <td style="width:25%">
                                                            <div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <?php
                                                                        $flight_code = $value->sI[0]->fD->aI->code;
                                                                        $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';

                                                                        ?>
                                                                        <img src="{{ $flight_logo }}">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <p class="flight-number">
                                                                            FI.No.{{ $value->sI[0]->fD->aI->code }}
                                                                            {{ $value->sI[0]->fD->fN }}</p>
                                                                        <p class="flight-brand">
                                                                            {{ $value->sI[0]->fD->aI->name }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="width:15%">
                                                            <div>
                                                                <p class="flight-number">{{ $value->sI[0]->da->city }}
                                                                </p>
                                                                <p class="flight-brand">
                                                                    {{ date('H:m', strtotime($value->sI[0]->dt)) }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td style="width:25%">
                                                            <div>
                                                                <p class="flight-number"><span class="brdr-btm-time">
                                                                        @if ($value->sI[0]->stops == '0')
                                                                            NON-STOP
                                                                        @else
                                                                            {{ $value->sI[0]->stops }} Stops
                                                                        @endif

                                                                    </span></p>
                                                                <?php
                                                                $minutes = $value->sI[0]->duration;
                                                                $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                ?>

                                                                <p class="flight-brand">{{ $hours }} </p>
                                                            </div>
                                                        </td>
                                                        <td style="width:15%">
                                                            <div>
                                                                <p class="flight-number">{{ $value->sI[0]->aa->city }}
                                                                </p>
                                                                <p class="flight-brand">
                                                                    {{ date('H:m', strtotime($value->sI[0]->at)) }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td style="width:20%">
                                                            <div>
                                                                <p class=" flight-brand"><i
                                                                        class="fa-solid fa-indian-rupee-sign"></i>

                                                                    {{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}
                                                                </p>
                                                                <p class="flight-brand oneWayFromTo"><a href="#"
                                                                        data-bs-toggle="modal" id=""
                                                                        class="airportApiId{{ $sno++ }}"
                                                                        data-bs-target="#book-table{{ $value->sI[0]->id }}"
                                                                        data-airportId={{ $value->sI[0]->id }}
                                                                        data-flight_count={{ $flight_count }}
                                                                        onclick="getFareRules({{ $value->sI[0]->id }})">View
                                                                        & More</a></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- {{ print_r($errors) }} --}}

                                                <tr>
                                                    <td colspan="5" align="center">
                                                        <div>{{ 'No Flights Found' }}</div>
                                                    </td>
                                                </tr>

                                            @endif
                                        @else
                                            {{-- {{ print_r($errors) }} --}}

                                            <tr>
                                                <td colspan="5" align="center">
                                                    <div>{{ $errors[0]->message }}</div>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            @elseif($_GET['tripType'] == 'round')
                                @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                                    @if (isset($result_array->searchResult->tripInfos->ONWARD))
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body round-trip1">
                                                        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                                                            @if (isset($result_array->searchResult->tripInfos->ONWARD))


                                                                <p>{{ $city_name_from->city }}
                                                                    →
                                                                    {{ $city_name_to->city }}
                                                                    <span>{{ date('D, d M', strtotime($_GET['flightBookingDepart'])) }}</span>
                                                                </p>
                                                            @endif
                                                        @endif
                                                        <div class="bg-tablle">
                                                            <p>Departure</p>
                                                            <p>Duration</p>
                                                            <p>Arrival</p>
                                                            <p>Price</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body round-trip1">
                                                        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                                                            @if (isset($result_array->searchResult->tripInfos->RETURN))
                                                                <p>{{ $city_name_to->city }}
                                                                    →
                                                                    {{ $city_name_from->city }}
                                                                    <span>{{ date('D, d M', strtotime($_GET['flightBookingReturn'])) }}</span>
                                                                </p>
                                                            @endif
                                                        @endif
                                                        <div class="bg-tablle">
                                                            <p>Departure</p>
                                                            <p>Duration</p>
                                                            <p>Arrival</p>
                                                            <p>Price</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif (isset($result_array->searchResult->tripInfos->COMBO))
                                        {{-- //international round trip --}}

                                        <!-- View flight Detials   -->
                                        <div class="modal" id="flightdetails">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-grey">
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        <h4 class="m-0">Flight Detials</h4>
                                                    </div>

                                                    <div class="modal-body">

                                                        {{-- <hr>
                <div class="clearfix mb-3"></div> --}}

                                                        <div class="row align-items-center">
                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <span><img
                                                                                        src="assets/img/flight-logo-2.png"
                                                                                        class="img-fluid"
                                                                                        width="30%"></span>
                                                                                <span><b>Indigo</b></span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <p>Abu Dhabi to Bengaluru , 27 Sep</p>
                                                                            </div>
                                                                            <div class="col-md-12 mt-3">
                                                                                <table class="table table-borderless">
                                                                                    <tr>
                                                                                        <td width="33.3%">
                                                                                            <div>
                                                                                                <p class="flight-brand">
                                                                                                    05:30</p>
                                                                                                <p class="flight-number">
                                                                                                    Hyderabad</p>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td width="33.3%">
                                                                                            <div>
                                                                                                <small><span
                                                                                                        class="brdr-btm-time">NON-STOP</span></small><br>
                                                                                                <!--                                            <small>01 h 25 m </small>-->
                                                                                            </div>
                                                                                        </td>
                                                                                        <td width="33.3%">
                                                                                            <div>
                                                                                                <p class="flight-brand">
                                                                                                    07:40</p>
                                                                                                <p class="flight-number">
                                                                                                    Mumbai</p>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <small>Terminal 1<br>Abu
                                                                                                Dhabi,<br>United Arab
                                                                                                Emirate</small>
                                                                                        </td>
                                                                                        <td></td>
                                                                                        <td>
                                                                                            <small>Terminal 2<br>Mumbai,
                                                                                                India</small>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p><b>BAGGAGE</b></p>
                                                                                            <small>ADULT</small>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><b>CHECK IN</b></p><small>40
                                                                                                Kgs</small>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><b>CABIN</b></p><small>8
                                                                                                Kgs</small>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <span><img
                                                                                        src="assets/img/flight-logo-2.png"
                                                                                        class="img-fluid"
                                                                                        width="30%"></span>
                                                                                <span><b>Indigo</b></span>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <p>Abu Dhabi to Bengaluru , 27 Sep</p>
                                                                            </div>
                                                                            <div class="col-md-12 mt-3">
                                                                                <table class="table table-borderless">
                                                                                    <tr>
                                                                                        <td width="33.3%">
                                                                                            <div>
                                                                                                <p class="flight-brand">
                                                                                                    05:30</p>
                                                                                                <p class="flight-number">
                                                                                                    Hyderabad</p>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td width="33.3%">
                                                                                            <div>
                                                                                                <small><span
                                                                                                        class="brdr-btm-time">NON-STOP</span></small><br>
                                                                                                <!--                                            <small>01 h 25 m </small>-->
                                                                                            </div>
                                                                                        </td>
                                                                                        <td width="33.3%">
                                                                                            <div>
                                                                                                <p class="flight-brand">
                                                                                                    07:40</p>
                                                                                                <p class="flight-number">
                                                                                                    Mumbai</p>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <small>Terminal 1<br>Abu
                                                                                                Dhabi,<br>United Arab
                                                                                                Emirate</small>
                                                                                        </td>
                                                                                        <td></td>
                                                                                        <td>
                                                                                            <small>Terminal 2<br>Mumbai,
                                                                                                India</small>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p><b>BAGGAGE</b></p>
                                                                                            <small>ADULT</small>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><b>CHECK IN</b></p><small>40
                                                                                                Kgs</small>
                                                                                        </td>
                                                                                        <td>
                                                                                            <p><b>CABIN</b></p><small>8
                                                                                                Kgs</small>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- View flight detials end   -->









                                        @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $value)
                                            {{-- {{ print_r($value->sI) }} --}}
                                            <div class="card mt-3 mb-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <?php
                                                            $flight_code = $value->sI[0]->fD->aI->code;
                                                            $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                                            ?>
                                                            <span><img src="{{ $flight_logo }}" class="img-fluid"
                                                                    width="10%"></span>
                                                            <span><b>{{ $value->sI[0]->fD->aI->name }}</b></span>
                                                        </div>
                                                        <div class="col-md-6 mb-3 text-end">
                                                            <span><i class="fas fa-indian-rupee-sign"></i>
                                                                <b>{{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF) }}</b></span>&nbsp;&nbsp;
                                                            <span><a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#ViewPriceInternational{{ $value->sI[0]->id }}"
                                                                    class="btn btn-outline-primary btn-sm"
                                                                    onclick="getDownFareRules({{ $value->sI[0]->id }})">View
                                                                    Prices</a></span>
                                                        </div>

                                                        @foreach ($value->sI as $key => $v)
                                                            @if ($v->isRs == false)
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p><b>Depart</b>
                                                                                {{ date('D, d M', strtotime($value->sI[$key]->dt)) }}
                                                                                • {{ $value->sI[$key]->fD->aI->name }}</p>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <ul class="tab-view-data clearfix">
                                                                                <li class="col-md-4">
                                                                                    <div>
                                                                                        <p class="flight-brand">
                                                                                            {{ date('H:m', strtotime($value->sI[$key]->dt)) }}
                                                                                        </p>
                                                                                        <p class="flight-number">
                                                                                            {{ $value->sI[$key]->da->city }}
                                                                                        </p>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="col-md-4 text-center">
                                                                                    <div>
                                                                                        <small><span class="brdr-btm-time">
                                                                                                @if ($value->sI[$key]->stops == '0')
                                                                                                    NON-STOP
                                                                                                @else
                                                                                                    {{ $value->sI[$key]->stops }}
                                                                                                    Stops
                                                                                                @endif
                                                                                            </span></small><br>
                                                                                        <?php
                                                                                        $minutes = $value->sI[$key]->duration;
                                                                                        $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                                        ?>
                                                                                        <small>{{ $hours }}
                                                                                        </small>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="col-md-4 text-end">
                                                                                    <div>
                                                                                        <p class="flight-brand">
                                                                                            {{ date('H:m', strtotime($value->sI[$key]->at)) }}
                                                                                        </p>
                                                                                        <p class="flight-number">
                                                                                            {{ $value->sI[$key]->aa->city }}
                                                                                        </p>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        {{-- <small>Partially Refundable</small> --}}
                                                                    </div>
                                                                </div>
                                                            @elseif($v->isRs == true)
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p><b>Return</b>
                                                                                {{ date('D, d M', strtotime($value->sI[$key]->dt)) }}
                                                                                • {{ $value->sI[$key]->fD->aI->name }}</p>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <ul class="tab-view-data clearfix">
                                                                                <li class="col-md-4">
                                                                                    <div>
                                                                                        <p class="flight-brand">
                                                                                            {{ date('H:m', strtotime($value->sI[$key]->dt)) }}
                                                                                        </p>
                                                                                        <p class="flight-number">
                                                                                            {{ $value->sI[$key]->da->city }}
                                                                                        </p>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="col-md-4 text-center">
                                                                                    <div>
                                                                                        <small><span class="brdr-btm-time">
                                                                                                @if ($value->sI[$key]->stops == '0')
                                                                                                    NON-STOP
                                                                                                @else
                                                                                                    {{ $value->sI[$key]->stops }}
                                                                                                    Stops
                                                                                                @endif
                                                                                            </span></small><br>
                                                                                        <?php
                                                                                        $minutes = $value->sI[$key]->duration;
                                                                                        $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                                        ?>
                                                                                        <small>{{ $hours }}
                                                                                        </small>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="col-md-4 text-end">
                                                                                    <div>
                                                                                        <p class="flight-brand">
                                                                                            {{ date('H:m', strtotime($value->sI[$key]->at)) }}
                                                                                        </p>
                                                                                        <p class="flight-number">
                                                                                            {{ $value->sI[$key]->aa->city }}
                                                                                        </p>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        {{-- <small class="text-end"><a href="#" data-bs-toggle="modal" data-bs-target="#flightdetails">View Flight Details</a></small> --}}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif

                                <div class="row mt-2">

                                    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                                        @if (isset($result_array->searchResult->tripInfos->ONWARD))

                                            <?php

                                            // foreach ($result_array->searchResult->tripInfos->ONWARD as $key=>$value){
                                            //     // foreach($value->sI as $k=>$v){
                                            //         // echo '<pre>';
                                            //         //     // echo count($value->sI);
                                            //         //     for($i=0;$i<= count($value->sI); $i++){

                                            //         //     }
                                            //         // // print_r($value->sI[0]);
                                            //         // echo '</pre>';
                                            //     // }
                                            // }
                                            ?>

                                            <div class="col-md-6">
                                                <?php $radio_on_cnt = 1; ?>
                                                @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value)
                                                    <?php
                                                    // print_r($value->totalPriceList[0]->id);

                                                    ?>
                                                    <?php $cnt_up = count($value->sI); ?>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-body round-trip1 shadow">
                                                                    <?php
                                                                    $flight_code = $value->sI[0]->fD->aI->code;
                                                                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                                                    ?>

                                                                    <img src="{{ $flight_logo }}">
                                                                    <span>FI.No.{{ $value->sI[0]->fD->aI->code }}
                                                                        {{ $value->sI[0]->fD->fN }},
                                                                        <b>{{ $value->sI[0]->fD->aI->name }}</b></span>
                                                                    <div class="row pt-3">
                                                                        <div class="col-md-3 departture">
                                                                            <span>{{ date('H:m', strtotime($value->sI[0]->dt)) }}</span>
                                                                            <span>{{ $value->sI[0]->da->city }}</span>
                                                                        </div>
                                                                        <div class="col-md-3 departture time-gap">
                                                                            <?php
                                                                            $minutes = $value->sI[0]->duration;
                                                                            $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                            ?>

                                                                            <span
                                                                                class="">{{ $hours }}</span>
                                                                            <span>
                                                                                @if ($value->sI[0]->stops == '0')
                                                                                    NON-STOP
                                                                                @else
                                                                                    {{ $value->sI[0]->stops }} Stops
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                        @for ($i = 0; $i < $cnt_up; $i++)
                                                                            @if ($i == $cnt_up - 1)
                                                                                <div class="col-md-3 departture">
                                                                                    <span>{{ date('H:m', strtotime($value->sI[$i]->at)) }}</span>
                                                                                    <span>{{ $value->sI[$i]->aa->city }}</span>
                                                                                </div>
                                                                            @endif
                                                                        @endfor
                                                                        <div class="col-md-3 departture text-center">
                                                                            <input <?php echo $radio_on_cnt == 1 ? 'Checked' : ''; ?> type="radio"
                                                                                name="roundFromTo"
                                                                                class="form-check-input roundFromTo"
                                                                                data-flight_up_id="{{ $value->sI[0]->id }}"
                                                                                data-fare_on_id="{{ $value->totalPriceList[0]->id }}"
                                                                                data-f_on_code="{{ $value->sI[0]->fD->fN }}"
                                                                                data-f_on_name="{{ $value->sI[0]->fD->aI->name }}"
                                                                                data-f_on_depat_time="{{ date('H:m', strtotime($value->sI[0]->dt)) }}"
                                                                                data-f_on_arival_time="{{ date('H:m', strtotime($value->sI[0]->at)) }}"
                                                                                data-f_on_price="{{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}"
                                                                                data-f_on_logo="{{ $flight_logo }}"
                                                                                data-onward_price="{{ $value->totalPriceList[0]->fd->ADULT->fC->TF }}">
                                                                            <p class="price-round"> <i
                                                                                    class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                                                                {{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $radio_on_cnt++; ?>
                                                @endforeach
                                            </div>




                                            <div class="col-md-6">
                                                <?php
                                                $radio_re_cnt = 1;
                                                ?>
                                                @foreach ($result_array->searchResult->tripInfos->RETURN as $key => $value)
                                                    <?php
                                                    // print_r($value->totalPriceList[0]->id);

                                                    ?>
                                                    <?php $cnt_dwn = count($value->sI); ?>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-body round-trip1 shadow">
                                                                    <?php
                                                                    $flight_code = $value->sI[0]->fD->aI->code;
                                                                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                                                    ?>
                                                                    <img src="{{ $flight_logo }}">
                                                                    <span>FI.No.{{ $value->sI[0]->fD->aI->code }}
                                                                        {{ $value->sI[0]->fD->fN }},
                                                                        <b>{{ $value->sI[0]->fD->aI->name }}</b></span>
                                                                    <div class="row pt-3">
                                                                        <div class="col-md-3 departture">
                                                                            <span>{{ date('H:m', strtotime($value->sI[0]->dt)) }}</span>
                                                                            <span>{{ $value->sI[0]->da->city }}</span>
                                                                        </div>
                                                                        <div class="col-md-3 departture time-gap">
                                                                            <?php
                                                                            $minutes = $value->sI[0]->duration;
                                                                            $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                            ?>

                                                                            <span
                                                                                class="">{{ $hours }}</span>
                                                                            <span>
                                                                                @if ($value->sI[0]->stops == '0')
                                                                                    NON-STOP
                                                                                @else
                                                                                    {{ $value->sI[0]->stops }} Stops
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                        @for ($j = 0; $j < $cnt_dwn; $j++)
                                                                            @if ($j == $cnt_dwn - 1)
                                                                                <div class="col-md-3 departture">
                                                                                    <span>{{ date('H:m', strtotime($value->sI[$j]->at)) }}</span>
                                                                                    <span>{{ $value->sI[$j]->aa->city }}</span>
                                                                                </div>
                                                                            @endif
                                                                        @endfor
                                                                        <div class="col-md-3 departture text-center">
                                                                            <input <?php echo $radio_re_cnt == 1 ? 'Checked' : ''; ?> type="radio"
                                                                                name="roundToFrom"
                                                                                class="form-check-input roundToFrom"
                                                                                value=""
                                                                                data-flight_down_id="{{ $value->sI[0]->id }}"
                                                                                data-fare_re_id="{{ $value->totalPriceList[0]->id }}"
                                                                                data-f_re_code="{{ $value->sI[0]->fD->fN }}"
                                                                                data-f_re_name="{{ $value->sI[0]->fD->aI->name }}"
                                                                                data-f_re_depat_time="{{ date('H:m', strtotime($value->sI[0]->dt)) }}"
                                                                                data-f_re_arival_time="{{ date('H:m', strtotime($value->sI[0]->at)) }}"
                                                                                data-f_re_price="{{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}"
                                                                                data-f_re_logo={{ $flight_logo }}
                                                                                data-return_price="{{ $value->totalPriceList[0]->fd->ADULT->fC->TF }}">
                                                                            <p class="price-round"> <i
                                                                                    class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                                                                {{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $radio_re_cnt++; ?>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @elseif($_GET['tripType'] == 'multi')
                                <input type="hidden" id="TripType" value="{{ $_GET['tripType'] }}">
                                {{-- tab starts  --}}
                                <div class="data">
                                    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                                        @if (isset($result_array->searchResult->tripInfos->COMBO))
                                            @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $tis)
                                                <div class="" id="nav-tab Content">
                                                    <div class="tab-pane fade show active" id="Cheapest" role="tabpanel"
                                                        aria-labelledby="nav-home-tab">
                                                        <div class="card mt-3 mb-3">

                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            @php
                                                                                $array_size = sizeof($tis->sI);
                                                                            @endphp
                                                                            <h5>{{ $tis->sI[0]->da->city }} -
                                                                                {{ $tis->sI[$array_size - 1]->aa->city }}
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-6 text-end">
                                                                            <span><i class="fas fa-indian-rupee-sign"></i>
                                                                                <b>{{ $tis->totalPriceList[0]->fd->ADULT->fC->TF }}</b></span>&nbsp;&nbsp;
                                                                            <span><a href="#"class="btn btn-outline-primary btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#getInterntionalFlightPrices{{ $key }}"
                                                                                    onclick="getFareRules({{ $tis->sI[0]->id }})">View
                                                                                    & More</a></span>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    @foreach ($tis->sI as $k => $v)
                                                                        <div class="row mb-2">
                                                                            <div class="col-md-12 mb-2">
                                                                                <p>Trip {{ $k + 1 }}</p>
                                                                                <h6><b>{{ $v->da->city }} to
                                                                                        {{ $v->aa->city }}</b>
                                                                                    {{ date('D, d M', strtotime($v->dt)) }}
                                                                                </h6>
                                                                            </div>
                                                                            <div class="col-md-3 mb-3">
                                                                                <span>
                                                                                    @php
                                                                                        $flight_code = $v->fD->aI->code;
                                                                                        $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                                                                    @endphp
                                                                                    <div class="col-md-4">
                                                                                        <img src="{{ $flight_logo }}">
                                                                                    </div>
                                                                                </span>
                                                                                <span><b>{{ $v->fD->aI->name }}</b></span>
                                                                            </div>
                                                                            <div class="col-md-3 mb-3">
                                                                                <p class="flight-brand">
                                                                                    {{ date('H:i', strtotime($v->dt)) }}
                                                                                </p>
                                                                                <p class="flight-number">
                                                                                    {{ $v->da->city }}</p>
                                                                            </div>
                                                                            <div class="col-md-3 mb-3">
                                                                                <?php
                                                                                $minutes = $v->duration;
                                                                                $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                                ?>
                                                                                @if ($v->stops == '0')
                                                                                    <p class="flight-number"><span
                                                                                            class="brdr-btm-time">NON-STOP</span>
                                                                                    </p>
                                                                                @else
                                                                                    <p class="flight-number"><span
                                                                                            class="brdr-btm-time">
                                                                                            {{ $v->stops }}
                                                                                            Stops</span></p>
                                                                                @endif
                                                                                <span>
                                                                                    <p class="flight-brand">
                                                                                        {{ $hours }} </p>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-3 mb-3">
                                                                                <p class="flight-brand">
                                                                                    {{ date('H:i', strtotime($v->at)) }}
                                                                                </p>
                                                                                <p class="flight-number">
                                                                                    {{ $v->aa->city }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- View flight Detials   -->
                                            @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $tis)
                                                @foreach ($tis->sI as $k => $v)
                                                    <div class="modal" id="flightdetails{{ $v->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"><i
                                                                            class="fa fa-times"></i></button>
                                                                    <h4>Flight Detials</h4>
                                                                    <hr>
                                                                    <div class="clearfix mb-3"></div>
                                                                    <div class="row align-items-center">
                                                                        <div class="col-md-4">
                                                                            <span>
                                                                                @php
                                                                                    $flight_code = $v->fD->aI->code;
                                                                                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                                                                @endphp
                                                                                <div class="col-md-4">
                                                                                    <img src="{{ $flight_logo }}">
                                                                                </div>
                                                                            </span>
                                                                            <span><b>{{ $v->fD->aI->name }}</b></span>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <p>{{ $v->da->city }} to
                                                                                {{ $v->aa->city }} ,
                                                                                {{ date('D, d M', strtotime($v->dt)) }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <table class="table table-borderless">
                                                                                <tr>
                                                                                    <td width="33.3%">
                                                                                        <div>
                                                                                            <p class="flight-brand">
                                                                                                {{ date('D, d M', strtotime($v->dt)) }}
                                                                                            </p>
                                                                                            <p class="flight-number">
                                                                                                {{ $v->da->city }}</p>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="33.3%">
                                                                                        <div>
                                                                                            <?php
                                                                                            $minutes = $v->duration;
                                                                                            $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                                            ?>
                                                                                            @if ($v->stops == '0')
                                                                                                <p class="flight-number">
                                                                                                    <span
                                                                                                        class="brdr-btm-time">NON-STOP</span>
                                                                                                </p>
                                                                                            @else
                                                                                                <p class="flight-number">
                                                                                                    <span
                                                                                                        class="brdr-btm-time">
                                                                                                        {{ $v->stops }}
                                                                                                        Stops</span></p>
                                                                                            @endif
                                                                                            <span>
                                                                                                <p class="flight-brand">
                                                                                                    {{ $hours }}
                                                                                                </p>
                                                                                            </span>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="33.3%">
                                                                                        <div>
                                                                                            <p class="flight-brand">
                                                                                                {{ date('D, d M', strtotime($v->at)) }}
                                                                                            </p>
                                                                                            <p class="flight-number">
                                                                                                {{ $v->aa->city }}</p>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <small>Terminal 1<br>Abu
                                                                                            Dhabi,<br>United Arab
                                                                                            Emirate</small>
                                                                                    </td>
                                                                                    <td></td>
                                                                                    <td>
                                                                                        <small>Terminal 2<br>Mumbai,
                                                                                            India</small>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <p><b>BAGGAGE</b></p>
                                                                                        <small>ADULT</small>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p><b>CHECK IN</b></p>
                                                                                        <small>{{ $tis->totalPriceList[0]->fd->ADULT->bI->iB }}</small>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p><b>CABIN</b></p>
                                                                                        <small></small>{{ $tis->totalPriceList[0]->fd->ADULT->bI->cB }}
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                            <!-- View flight detials end   -->
                                            {{-- international view prices  --}}
                                            <div>
                                                @if (!empty($result_array->searchResult->tripInfos->COMBO))
                                                    @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $tis)
                                                        @foreach ($tis->sI as $k => $value1)
                                                            <div class="modal"
                                                                id="getInterntionalFlightPrices{{ $key }}">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body p-0">
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"><i
                                                                                    class="fa fa-times"></i></button>
                                                                            <table class="table table-booking"
                                                                                style="">
                                                                                <thead class="bg-grey"
                                                                                    style="border-bottom: 2px solid #fff;">
                                                                                    <tr>
                                                                                        <th class="">FARES </th>
                                                                                        <th>CABIN BAG</th>
                                                                                        <th>CHECK-IN</th>
                                                                                        <th>CANCELLATION</th>
                                                                                        <th>DATE CHANGE</th>
                                                                                        <th>SEAT</th>
                                                                                        <th>MEAL</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $i = 1;
                                                                                    $id = 1;
                                                                                    $c = 1;
                                                                                    $d = 1;
                                                                                    $s = 1;
                                                                                    $totalPriceList = count($tis->totalPriceList);
                                                                                    ?>
                                                                                    <input type="hidden"
                                                                                        name="totalPriceList{{ $value1->id }}"
                                                                                        id="totalPriceList{{ $value1->id }}"
                                                                                        value="{{ $totalPriceList }}">
                                                                                    @foreach ($tis->totalPriceList as $key => $values)
                                                                                        <tr>
                                                                                            <td class="">
                                                                                                <b>Saver</b>
                                                                                                <input type="hidden"
                                                                                                    name="uniqueTripPriceId{{ $value1->id }}{{ $i++ }}"
                                                                                                    id="uniqueTripPriceId{{ $value1->id }}{{ $id++ }}"
                                                                                                    value="{{ $values->id }}">
                                                                                                <p>
                                                                                                    Fair offered by airline.
                                                                                                </p>
                                                                                            </td>
                                                                                            <td>{{ $values->fd->ADULT->bI->cB }}
                                                                                            </td>
                                                                                            <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                                                                echo $values->fd->ADULT->bI->iB;
                                                                                            } else {
                                                                                                echo '--';
                                                                                            } ?></td>
                                                                                            <td
                                                                                                id="cancellation{{ $value1->id }}{{ $c++ }}">
                                                                                                --
                                                                                                {{-- cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500 --}}
                                                                                            </td>
                                                                                            <td
                                                                                                id="dateChangeText{{ $value1->id }}{{ $d++ }}">
                                                                                                --
                                                                                                {{-- Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250 --}}
                                                                                            </td>
                                                                                            <td
                                                                                                id="seatChargeId{{ $value1->id }}{{ $s++ }}">
                                                                                                --
                                                                                                {{-- Middle Seat Free, <br> Window/Asile Chargeable --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @if (isset($value->fd->ADULT->mI))
                                                                                                    @if ($value->fd->ADULT->mI == true)
                                                                                                        Free Meal
                                                                                                    @else
                                                                                                        Paid Meal
                                                                                                    @endif
                                                                                                @else
                                                                                                    --
                                                                                                @endif
                                                                                            </td>
                                                                                            <td align="right">
                                                                                                <p class="final-price">
                                                                                                    <b><i
                                                                                                            class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($values->fd->ADULT->fC->NF) }}</b>
                                                                                                </p>
                                                                                                <a
                                                                                                    href="{{ route('reviewDetails') }}?pKey={{ $values->id }}">
                                                                                                    <button
                                                                                                        class="btn btn-book-now">Book
                                                                                                        Now</button> </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                            {{-- International prices --}}
                                            {{-- INTERNATION FLIGHTS CODE ENDS  --}}
                                            {{-- DOMESTIC FLIGHTS CODE STARTS --}}
                                        @elseif (isset($result_array->searchResult->tripInfos))
                                            <div class="multi-city d-flex justify-content-start">
                                                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                                    @foreach ($result_array->searchResult->tripInfos as $key => $tis)
                                                        <button class="nav-link mb-0  p-tb15 d-flex align-items-center"
                                                            id="nav-home-tab" data-bs-toggle="tab"
                                                            data-bs-target="#ShowFlightDetails{{ $key }}"
                                                            type="button" role="tab"
                                                            aria-controls="nav-home{{ $key }}"
                                                            aria-selected="true">
                                                            <div class="detailss">
                                                                <h5>
                                                                    {{ $tis[0]->sI[0]->da->city }}
                                                                    -
                                                                    {{ $tis[0]->sI[0]->aa->city }}
                                                                </h5>
                                                            </div>
                                                        </button>
                                                    @endforeach
                                        @endif
                                    @endif
                                </div>
                        </div>
                    </div>
                    {{-- tab ends --}}
                    <div class="tab-content" id="nav-tabContent">
                        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                            @if (isset($result_array->searchResult->tripInfos))
                                @foreach ($result_array->searchResult->tripInfos as $key => $tis)
                                    <div class="tab-pane fade show " id="ShowFlightDetails{{ $key }}"
                                        role="tabpanel" aria-labelledby="nav-home-tab{{ $key }}">
                                        <div class="card mt-3 mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table mt-3 mb-3">
                                                        <thead class="bg-thead">
                                                            <tr>
                                                                <th>Sorted By: </th>
                                                                <th>Departure</th>
                                                                <th>Duration</th>
                                                                <th>Arrival</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        @foreach ($tis as $tisKey => $tisI)
                                                            @foreach ($tisI->sI as $k => $v)
                                                                <tbody class="bg-tbody">
                                                                    <tr>
                                                                        <td style="width:25%">
                                                                            <div>
                                                                                <div class="row">
                                                                                    @php
                                                                                        $flight_code = $v->fD->aI->code;
                                                                                        $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                                                                    @endphp
                                                                                    <div class="col-md-4">
                                                                                        <img src="{{ $flight_logo }}">
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <p class="flight-number">
                                                                                            FI.No.{{ $v->fD->fN }}</p>
                                                                                        <p class="flight-brand">
                                                                                            {{ $v->fD->aI->name }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td style="width:15%">
                                                                            <div>
                                                                                <p class="flight-number">
                                                                                    {{ $v->da->city }}</p>
                                                                                <p class="flight-brand">
                                                                                    {{ date('H:i', strtotime($v->dt)) }}
                                                                                </p>
                                                                            </div>
                                                                        </td>
                                                                        <td style="width:25%">
                                                                            <div>
                                                                                <?php
                                                                                $minutes = $v->duration;
                                                                                $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                                                ?>
                                                                                @if ($v->stops == '0')
                                                                                    <p class="flight-number"><span
                                                                                            class="brdr-btm-time">NON-STOP</span>
                                                                                    </p>
                                                                                @else
                                                                                    <p class="flight-number"><span
                                                                                            class="brdr-btm-time">
                                                                                            {{ $v->stops }}
                                                                                            Stops</span></p>
                                                                                @endif
                                                                                <span>
                                                                                    <p class="flight-brand">
                                                                                        {{ $hours }} </p>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td style="width:15%">
                                                                            <div>
                                                                                <p class="flight-number">
                                                                                    {{ $v->aa->city }}</p>
                                                                                <p class="flight-brand">
                                                                                    {{ date('H:i', strtotime($v->at)) }}
                                                                                </p>
                                                                            </div>
                                                                        </td>
                                                                        <td style="width:20%">
                                                                            <div>
                                                                                <p class=" flight-brand"><i
                                                                                        class="fa-solid fa-indian-rupee-sign"></i>
                                                                                    {{ number_format($tisI->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}
                                                                                </p>
                                                                                <p class="flight-brand"><a href="#"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#book-table{{ $v->id }}"
                                                                                        onclick="getFareRules({{ $v->id }})">View
                                                                                        & More</a></p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            @endforeach
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            {{-- @endif --}}
                        {{-- @endif --}}
                    </div>
                    {{-- DOMESTIC FLIGHTS CODE ENDS --}}
                    {{-- modal --}}
                    <div>
                        @if (!empty($result_array->searchResult->tripInfos))
                            @foreach ($result_array->searchResult->tripInfos as $key => $value)
                                @foreach ($value as $ke => $val)
                                    @foreach ($val->sI as $key1 => $value1)
                                        <div class="modal" id="book-table{{ $value1->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        <table class="table table-booking" style="">
                                                            <thead class="bg-grey" style="border-bottom: 2px solid #fff;">
                                                                <tr>
                                                                    <th class="">FARES </th>
                                                                    <th>CABIN BAG</th>
                                                                    <th>CHECK-IN</th>
                                                                    <th>CANCELLATION</th>
                                                                    <th>DATE CHANGE</th>
                                                                    <th>SEAT</th>
                                                                    <th>MEAL</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $id = 1;
                                                                $c = 1;
                                                                $d = 1;
                                                                $s = 1;
                                                                $totalPriceList = count($val->totalPriceList);

                                                                ?>
                                                                <input type="hidden"
                                                                    name="totalPriceList{{ $value1->id }}"
                                                                    id="totalPriceList{{ $value1->id }}"
                                                                    value="{{ $totalPriceList }}">
                                                                @foreach ($val->totalPriceList as $key => $values)
                                                                    <tr>
                                                                        <td class="">
                                                                            <b>Saver</b>
                                                                            <input type="hidden"
                                                                                name="uniqueTripPriceId{{ $value1->id }}{{ $i++ }}"
                                                                                id="uniqueTripPriceId{{ $value1->id }}{{ $id++ }}"
                                                                                value="{{ $values->id }}">
                                                                            <p>
                                                                                Fair offered by airline.
                                                                            </p>
                                                                        </td>
                                                                        <td>{{ $values->fd->ADULT->bI->cB }}</td>
                                                                        <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                                            echo $values->fd->ADULT->bI->iB;
                                                                        } else {
                                                                            echo '--';
                                                                        } ?></td>
                                                                        <td
                                                                            id="cancellation{{ $value1->id }}{{ $c++ }}">
                                                                            --
                                                                            {{-- cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500 --}}
                                                                        </td>
                                                                        <td
                                                                            id="dateChangeText{{ $value1->id }}{{ $d++ }}">
                                                                            --
                                                                            {{-- Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250 --}}
                                                                        </td>
                                                                        <td
                                                                            id="seatChargeId{{ $value1->id }}{{ $s++ }}">
                                                                            --
                                                                            {{-- Middle Seat Free, <br> Window/Asile Chargeable --}}
                                                                        </td>
                                                                        <td>
                                                                            @if (isset($value->fd->ADULT->mI))
                                                                                @if ($value->fd->ADULT->mI == true)
                                                                                    Free Meal
                                                                                @else
                                                                                    Paid Meal
                                                                                @endif
                                                                            @else
                                                                                --
                                                                            @endif
                                                                        </td>
                                                                        <td align="right">
                                                                            <p class="final-price"><b><i
                                                                                        class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($values->fd->ADULT->fC->NF) }}</b>
                                                                            </p>
                                                                            <a
                                                                                href="{{ route('reviewDetails') }}?pKey={{ $values->id }}">
                                                                                <button class="btn btn-book-now">Book
                                                                                    Now</button> </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                @else
                    {{-- {{ print_r($errors) }} --}}

                    <tr>
                        <td colspan="5" align="center">
                            <div>{{ 'No Flights Found' }}</div>
                        </td>
                    </tr>

                    @endif
                @else
                    {{-- {{ print_r($errors) }} --}}

                    <tr>
                        <td colspan="5" align="center">
                            <div>{{ $errors[0]->message }}</div>
                        </td>
                    </tr>
                    @endif

                    </tbody>
                    </table>
                @else
                    {{-- {{ print_r($errors) }} --}}

                    <div>
                        <div>{{ $errors[0]->message }}</div>
                    </div>
                    @endif



                </div>
            </div>



            <!-- pricedetails -->
            @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                @if (isset($result_array->searchResult->tripInfos->ONWARD) &&
                    isset($result_array->searchResult->tripInfos->RETURN))
                    <?php $key = $result_array->searchResult->tripInfos->ONWARD[0]; ?>


                    <div class="row pricedetails-btm pricedetails-btm-full">
                        <div class="col-md-8">
                            <div class="row">


                                {{-- @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value) --}}
                                <div class="col-md-6 btm-price">
                                    <p id="f_on_name">Departure ・ {{ $key->sI[0]->fD->aI->name }}</p>
                                    <div class="row align-items-center">
                                        <div class="col-md-2 p-0">
                                            <?php
                                            $flight_code = $key->sI[0]->fD->aI->code;
                                            $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                            ?>
                                            <img id="f_on_logo" src="{{ $flight_logo }}" class="img-fluid">
                                        </div>
                                        <div class="col-md-5 btm-flights-price">
                                            <p id="f_on_a_d_time">{{ date('H:m', strtotime($key->sI[0]->dt)) }} →
                                                {{ date('H:m', strtotime($key->sI[0]->at)) }}</p>
                                            {{-- <a href="#">Flight Details</a> --}}
                                        </div>
                                        <div class="col-md-5 p-0">
                                            <p class="price-round"> <i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                                <span
                                                    id="f_on_price">{{ number_format($key->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}</span>

                                                <input type="hidden" name="ontripPrice" id="ontripPrice"
                                                    value="{{ $key->totalPriceList[0]->fd->ADULT->fC->TF }}">

                                                <input type="hidden" name="upFarePrice" id="upFarePrice"
                                                    value="{{ $key->sI[0]->id }}">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endforeach --}}


                                <?php $return = $result_array->searchResult->tripInfos->RETURN[0]; ?>

                                <div class="col-md-6 btm-price">
                                    <p id="f_re_name">Return ・ {{ $return->sI[0]->fD->aI->name }}</p>
                                    <div class="row align-items-center">
                                        <div class="col-md-2 p-0">
                                            <?php
                                            $flight_code = $return->sI[0]->fD->aI->code;
                                            $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                            ?>
                                            <img id="f_re_logo" src="{{ $flight_logo }}" class="img-fluid">
                                        </div>
                                        <div class="col-md-5 btm-flights-price">
                                            <p id="f_re_a_d_time">{{ date('H:m', strtotime($return->sI[0]->dt)) }}
                                                → {{ date('H:m', strtotime($return->sI[0]->at)) }}</p>
                                            {{-- <a href="#">Flight Details</a> --}}
                                        </div>
                                        <div class="col-md-5 p-0">
                                            <p class="price-round"> <i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                                <span
                                                    id="f_re_price">{{ number_format($return->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}</span>
                                            </p>


                                            <input type="hidden" name="retripPrice" id="retripPrice"
                                                value="{{ $return->totalPriceList[0]->fd->ADULT->fC->TF }}">

                                            <input type="hidden" name="downFarePrice" id="downFarePrice"
                                                value="{{ $return->sI[0]->id }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 btm-fligh-price">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-8">
                                    <p class="price-round"> <i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                        <span
                                            id="total_fare">{{ number_format(round($key->totalPriceList[0]->fd->ADULT->fC->TF) + round($return->totalPriceList[0]->fd->ADULT->fC->TF), 0) }}</span>
                                    </p>
                                    {{-- <a href="#">Flight Details</a> --}}
                                </div>
                                <div class="col-md-4">
                                    <a href="#" id="ViewPrice"
                                        onclick="getFareRules({{ $key->sI[0]->id }}); getDownFareRules({{ $return->sI[0]->id }})"
                                        data-return_id="{{ $return->sI[0]->id }}" data-bs-toggle="modal"
                                        data-bs-target="#ViewPrice{{ $key->sI[0]->id }}"><button
                                            class="btn btn-primary">Book</button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endif


        </div>
        </div>
        </div>
    </section>
@endsection

@section('script-content')
    <!-- slick js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.carousel').slick({
                slidesToShow: 7,
                dots: false,
                centerMode: true,
            });
        });

        var elementPosition = $('#footer').offset();

        $(window).scroll(function() {
            //   console.log(elementPosition.top);
            //   console.log($(window).scrollTop());
            if ($(window).scrollTop() < 200) {
                $('.pricedetails-btm-full').css('position', 'fixed').css('bottom', '0').css('right', '0').css(
                    'width', '70%');
            } else {
                $('.pricedetails-btm').css('position', 'static').css('width', '100%');
            }
        });
    </script>

    {{-- <script src="{{ asset('mobiscroll/js/mobiscroll.jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

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

        var fromDate = $('#flightBookingDepart').val();
        var returnDate = $('#flightBookingReturn').val();


        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();


        var todayDate = (day < 10 ? '0' : '') + day + '-' +
            (month < 10 ? '0' : '') + month + '-' + d.getFullYear();


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
                if ($('#trip_type').val() != 'oneway') {
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
        // alert(fromDate)

        $input_start_date.datepicker(options_start_date);
        $input_start_date.datepicker('setDate', fromDate);
        $input_end_date.datepicker(options_end_date);
        $input_end_date.datepicker('setDate', returnDate);

        function get_days_difference(start_date, end_date) {
            return Math.floor(end_date - start_date) / (1000 * 60 * 60 * 24);
        }
    </script>

    <script>
        $('#fromPlace').select2({
            placeholder: 'Select from',
        });
        $('#toPlace').select2({
            placeholder: 'Select to'
        });



        $('.from-to-inner').click(function() {
            var fromPlace = $('#fromPlace').val();
            var toPlace = $('#toPlace').val();

            $('#fromPlace').val(toPlace);
            $('#toPlace').val(fromPlace);
            $('#toPlace').trigger('change');
            $('#fromPlace').trigger('change');
            // console.log($('#fromPlace :selected').text());
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
            $('#travelClass').val(travelClassVal);
            $('#adultval').val(adultsVal);



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

        $('#travelClass').val(travelClassVal);
        $('#adultval').val(adultsVal);

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
        // $( document ).ready( getFareRules );

        function getFareRules(airportId) {
            var flight_count = $('.airportApiId1').attr('data-flight_count');
            // for (i = 1; i <= flight_count; i++) {

            // var airportApiId = $('.airportApiId' + i).attr('data-airportId');
            var airportApiId = airportId;
            // alert(airportApiId);

            var totalPriceList = $('#totalPriceList' + airportApiId).val();

            // alert(totalPriceList);

            for (j = 1; j <= totalPriceList; j++) {
                var uniqueTripPriceId = $('#uniqueTripPriceId' + airportApiId + j).val();
                // console.log(uniqueTripPriceId);
                var cancellationId = 'cancellation' + airportApiId + j;
                var dateChangeId = 'dateChangeText' + airportApiId + j;
                var seatChargeId = 'seatChargeId' + airportApiId + j;



                getFarePrices(uniqueTripPriceId, cancellationId, dateChangeId, seatChargeId);

            }

            // }

            function getFarePrices(uniqueTripPriceId, cancellationId, dateChangeId, seatChargeId) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('getFarePrices') }}',
                    data: {
                        'uniqueTripPriceId': uniqueTripPriceId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status.success == true && data.status.httpStatus == '200') {

                            $.each(data.fareRule, function(k) {
                                // console.log(data.fareRule[k].fr.CANCELLATION.DEFAULT.policyInfo);

                                if ((data.fareRule[k].fr).hasOwnProperty('CANCELLATION')) {
                                    if ((data.fareRule[k].fr.CANCELLATION.hasOwnProperty('DEFAULT'))) {
                                        let cancellationText = data.fareRule[k].fr.CANCELLATION.DEFAULT
                                            .policyInfo;
                                        let myArray = cancellationText.replace(/__nls__/g, "<br>");
                                        $('#' + cancellationId).html(myArray);
                                    } else {
                                        let cancellationText = data.fareRule[k].fr.CANCELLATION
                                            .BEFORE_DEPARTURE
                                            .policyInfo;
                                        let myArray = cancellationText.replace(/__nls__/g, "<br>");
                                        $('#' + cancellationId).html(myArray);
                                    }
                                }

                                if ((data.fareRule[k].fr).hasOwnProperty('DATECHANGE')) {
                                    if ((data.fareRule[k].fr.DATECHANGE.hasOwnProperty('DEFAULT'))) {
                                        let dateChangeText = data.fareRule[k].fr.DATECHANGE.DEFAULT
                                            .policyInfo;
                                        let dateDisplay = dateChangeText.replace(/__nls__/g, "<br>");
                                        $('#' + dateChangeId).html(dateDisplay);

                                    } else {
                                        let dateChangeText = data.fareRule[k].fr.DATECHANGE
                                            .BEFORE_DEPARTURE
                                            .policyInfo;
                                        let dateDisplay = dateChangeText.replace(/__nls__/g, "<br>");
                                        $('#' + dateChangeId).html(dateDisplay);
                                    }

                                }

                                if ((data.fareRule[k].fr).hasOwnProperty('SEAT_CHARGEABLE')) {
                                    let seatCharge = data.fareRule[k].fr.SEAT_CHARGEABLE.DEFAULT
                                        .policyInfo;
                                    $('#' + seatChargeId).html(seatCharge);
                                }


                            });
                        }



                    }
                })
            }

        }

        function getDownFareRules(airportId) {
            var flight_count = $('.airportApiId1').attr('data-flight_count');
            // for (i = 1; i <= flight_count; i++) {

            // var airportApiId = $('.airportApiId' + i).attr('data-airportId');
            var airportApiId = airportId;
            // alert(airportApiId);

            var totalPriceList = $('#totalPriceList' + airportApiId).val();

            // alert(totalPriceList);

            for (j = 1; j <= totalPriceList; j++) {
                var uniqueTripPriceId = $('#uniqueTripPriceId' + airportApiId + j).val();
                // console.log(uniqueTripPriceId);
                var cancellationId = 'cancellationRe' + airportApiId + j;
                var dateChangeId = 'dateChangeTextRe' + airportApiId + j;
                var seatChargeId = 'seatChargeId' + airportApiId + j;


                // alert(uniqueTripPriceId)
                getFarePrices(uniqueTripPriceId, cancellationId, dateChangeId, seatChargeId);

            }

            // }

            function getFarePrices(uniqueTripPriceId, cancellationId, dateChangeId, seatChargeId) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('getFarePrices') }}',
                    data: {
                        'uniqueTripPriceId': uniqueTripPriceId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status.success == true && data.status.httpStatus == '200') {

                            $.each(data.fareRule, function(k) {
                                // console.log(data.fareRule[k].fr.CANCELLATION.DEFAULT.policyInfo);

                                if ((data.fareRule[k].fr).hasOwnProperty('CANCELLATION')) {
                                    if ((data.fareRule[k].fr.CANCELLATION.hasOwnProperty('DEFAULT'))) {
                                        let cancellationText = data.fareRule[k].fr.CANCELLATION.DEFAULT
                                            .policyInfo;
                                        let myArray = cancellationText.replace(/__nls__/g, "<br>");
                                        $('#' + cancellationId).html(myArray);
                                    } else {
                                        let cancellationText = data.fareRule[k].fr.CANCELLATION
                                            .BEFORE_DEPARTURE
                                            .policyInfo;
                                        let myArray = cancellationText.replace(/__nls__/g, "<br>");
                                        $('#' + cancellationId).html(myArray);
                                    }
                                }

                                if ((data.fareRule[k].fr).hasOwnProperty('DATECHANGE')) {
                                    if ((data.fareRule[k].fr.DATECHANGE.hasOwnProperty('DEFAULT'))) {
                                        let dateChangeText = data.fareRule[k].fr.DATECHANGE.DEFAULT
                                            .policyInfo;
                                        let dateDisplay = dateChangeText.replace(/__nls__/g, "<br>");
                                        $('#' + dateChangeId).html(dateDisplay);

                                    } else {
                                        let dateChangeText = data.fareRule[k].fr.DATECHANGE
                                            .BEFORE_DEPARTURE
                                            .policyInfo;
                                        let dateDisplay = dateChangeText.replace(/__nls__/g, "<br>");
                                        $('#' + dateChangeId).html(dateDisplay);
                                    }

                                }

                                if ((data.fareRule[k].fr).hasOwnProperty('SEAT_CHARGEABLE')) {
                                    let seatCharge = data.fareRule[k].fr.SEAT_CHARGEABLE.DEFAULT
                                        .policyInfo;
                                    $('#' + seatChargeId).html(seatCharge);
                                }


                            });
                        }



                    }
                })
            }

        }

        $(document).ready(function() {
            $('.oneWayFromTo').click(function() {
                // alert($(this).val());
                $("#loader_div").show();
                setTimeout(function() {
                    $("#loader_div").hide();
                }, 5000);

            });


            // var radio_on_checked = $("input[name='roundFromTo']").val();
            // if(radio_on_checked == 'on'){
            //     alert(radio_on_checked);
            // }

            $('.roundFromTo').click(function() {
                // alert($(this).val());
                $("#loader_div").show();

                //onward
                var f_on_name = $(this).data('f_on_name');
                var f_on_code = $(this).data('f_on_code');
                var f_on_depat_time = $(this).data('f_on_depat_time');
                var f_on_arival_time = $(this).data('f_on_arival_time');
                var f_on_price = $(this).data('f_on_price');
                var f_on_logo = $(this).data('f_on_logo');
                var onward_price = $(this).data('onward_price');
                var flight_up_id = $(this).data('flight_up_id');

                $('#ontripPrice').val(onward_price);
                $('#upFarePrice').val(flight_up_id);

                var ontripPrice = $('#ontripPrice').val();
                var retripPrice = $('#retripPrice').val();

                var upFarePrice = $('#upFarePrice').val();
                var downFarePrice = $('#downFarePrice').val();
                // alert(parseInt(retripPrice)+'='+parseInt(ontripPrice));

                $('#f_on_name').html('Departure ・' + f_on_name);
                $('#f_on_a_d_time').html(f_on_depat_time + ' → ' + f_on_arival_time);
                $('#f_on_price').html(f_on_price);
                $('#f_on_logo').attr('src', f_on_logo);
                $('#ViewPrice').attr('data-bs-target', '#ViewPrice' + flight_up_id);
                $('#ViewPrice').attr('onclick', 'getFareRules(' + flight_up_id + '); getDownFareRules(' +
                    downFarePrice + ')');

                $('#total_fare').html(Math.round(retripPrice) + Math.round(ontripPrice))

                setTimeout(function() {
                    $("#loader_div").hide();
                }, 1000);

            })

            $('#ViewPrice').click(function() {

                var id = $(this).data('return_id');
                //   alert('asd');
                $('.showFare' + id).show();
            })


            $('.roundToFrom').click(function() {
                // alert($(this).val());
                $("#loader_div").show();

                //return
                var f_re_code = $(this).data('f_re_code');
                var f_re_name = $(this).data('f_re_name');
                var f_re_depat_time = $(this).data('f_re_depat_time');
                var f_re_arival_time = $(this).data('f_re_arival_time');
                var f_re_price = $(this).data('f_re_price');
                var f_re_logo = $(this).data('f_re_logo');
                var flight_down_id = $(this).data('flight_down_id');

                var return_price = $(this).data('return_price');

                $('#retripPrice').val(return_price);
                $('#downFarePrice').val(flight_down_id);

                var retripPrice = $('#retripPrice').val();
                var ontripPrice = $('#ontripPrice').val();

                var upFarePrice = $('#upFarePrice').val();
                var downFarePrice = $('#downFarePrice').val();

                $('#total_fare').html(Math.round(retripPrice) + Math.round(ontripPrice))

                $('#f_re_name').html('Return ・' + f_re_name);
                $('#f_re_a_d_time').html(f_re_depat_time + ' → ' + f_re_arival_time);
                $('#f_re_price').html(f_re_price);
                $('#f_re_logo').attr('src', f_re_logo);
                $('.showFare').hide();
                $('.showFare' + flight_down_id).show();

                $('#ViewPrice').attr('onclick', 'getFareRules(' + upFarePrice + '); getDownFareRules(' +
                    flight_down_id + ')');


                setTimeout(function() {
                    $("#loader_div").hide();
                }, 1000);

            })
        })


        //   alert($('#trip_type').val() );
        if ($('#trip_type').val() == 'oneway') {
            $('#flightBookingReturn').val('');
            $('#flightBookingReturn').prop('disabled', true);
        } else {
            $('#flightBookingReturn').prop('disabled', false);

        }

        $('#trip_type').on('change', function() {
            if ($('#trip_type').val() == 'oneway') {
                $('#flightBookingReturn').val('');
                $('#flightBookingReturn').prop('disabled', true);
            } else {
                $('#flightBookingReturn').prop('disabled', false);
            }
        })

        $("input[name='pKey']").click(function() {
            var onPrice = $("input[name='pKey']:checked").attr('data-onPrice');
            var downPrice = $("input[name='rKey']:checked").attr('data-downPrice');

            $('#priceOnUp').html((parseFloat(onPrice) + parseFloat(downPrice)));

            var pKey = $("input[name='pKey']:checked").val();
            var rKey = $("input[name='rKey']:checked").val();


        })

        $("input[name='rKey']").click(function() {
            var onPrice = $("input[name='pKey']:checked").attr('data-onPrice');
            var downPrice = $("input[name='rKey']:checked").attr('data-downPrice');
            $('#priceOnUp').html((parseFloat(onPrice) + parseFloat(downPrice)));

            var pKey = $("input[name='pKey']:checked").val();
            var rKey = $("input[name='rKey']:checked").val();

        });


        $("#viewPriceForm").submit(function() {
            var pKey = $("input[name='pKey']:checked").val();
            var rKey = $("input[name='rKey']:checked").val();
            window.location.replace("{{ route('reviewDetailsRoundTrip') }}?pKey="+pKey+"&rKey="+rKey+"");
            return false;
        })
    </script>
@endsection
