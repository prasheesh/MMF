@extends('layouts.app')
@section('style-content')
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

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

        .form-control {
            padding: 15px 0px 15px 15px;
        }

        .modal-headd {
            background: #257483;
            color: white;
            border-radius: 0;
            border: 0px solid #257483;
        }
        .fare-P small {
        color: #ccc;
        }
        .fare-P h4 {
            margin-bottom: 0;
            font-size: 16px;
            font-weight: 600;
            color: #83bdd0;
        }
        .text-olld {
            text-decoration: line-through;
        }
    </style>
@endsection
@section('content')
    <!--Review Details modal -->
    <?php
    $priceIds = $_REQUEST;
    // print_r(($priceIds)); exit();
    $priceIds=http_build_query($priceIds);
   // print_r($priceIds); exit;
   //$priceIds = "000";
    ?>

    <div class="modal" id="review-details">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="modal-header modal-headd">
                        <h6>Review Details</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>

                    <div id="passenger_div"></div>

                    <div class="modal-footer text-end">
                        <button class="btn btn-edit" onclick="edit_field()">Edit</button>
                        <a href="{{ route('booking-final') }}"><button class="btn btn-confirm"
                                id="cnfBtn">Confirm</button></a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Review Details end -->

    <div class="bg-grey" style="height: 300px; margin-bottom: -270px;"></div>
{{-- print_r($fair_rules); exit(); --}}

    <section class="">



        <div class="container container-make">
            <div class="row">

                <div class="col-md-9 p-3">
                    <h5><b>Complete your booking</b></h5>
                    <div class="card">

                        <div class="card-body card-shadow">
                            <?php $i=0; $basefare = 0;   $Taxes_trip = 0;
                             foreach($result_array->tripInfos as $k => $tripInfos){ ?>
                            <!-- card details one -->
                            <div class="p-3" style="box-shadow:0px 0px 3px rgba(0,0,0,0.2)">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>

                                        <?php $hours = 0; $minutes = 0; $total_time =0; $j=0;
                                        foreach ($tripInfos->sI as $k => $flightDetails) {
                                            //echo "<pre>"; print_r(count($result_array->tripInfos)); exit();
                                            $dep_time = strtotime($flightDetails->dt);
                                            $arr_time = strtotime($flightDetails->at);
                                            $total_time =  $total_time +( $arr_time - $dep_time);
                                            $hours =  floor($total_time / 3600);
                                            $minutes = floor(($total_time / 60) % 60);

                                            $date = date('N', strtotime($flightDetails->dt));
                                            if ($date == 1) {
                                                $day = 'Monday';
                                            } elseif ($date == 2) {
                                                $day = 'Tuesday';
                                            } elseif ($date == 3) {
                                                $day = 'Wednessday';
                                            } elseif ($date == 4) {
                                                $day = 'Thursday';
                                            } elseif ($date == 5) {
                                                $day = 'Friday';
                                            } elseif ($date == 6) {
                                                $day = 'Saturday';
                                            } elseif ($date == 7) {
                                                $day = 'Sunday';
                                            }
                                       $j++; }

                                        $stops = count($tripInfos->sI) - 1;
                                        ?>
                                        <h5>{{ $tripInfos->sI[0]->da->city }} <i class="fa-solid fa-arrow-right"
                                                style="    margin: 0px 5px;"></i>
                                            {{ $tripInfos->sI[$stops]->aa->city }}</h5>
                                        <p class="f-14-mb-10">{{ $day }},
                                            {{ date('M d', strtotime($tripInfos->sI[0]->dt)) }} -
                                            <?php if ($stops == 0) {
                                                echo 'Non stop';
                                            } else {
                                                echo $stops . ' stop';
                                            } ?> - {{ $hours }}h {{ $minutes }}m</p>
                                    </div>

                                    <div>
                                        <?php if($tripInfos->totalPriceList[0]->fd->ADULT->rT == 0){ ?>
                                        <button class="btn btn-refund">NON-REFUNDABLE</button>
                                        <?php  }elseif($tripInfos->totalPriceList[0]->fd->ADULT->rT == 1){ ?>
                                        <button class="btn btn-refund">REFUNDABLE</button>
                                        <?php  }else{  ?>
                                        <button class="btn btn-refund">PARTIAL-REFUNDABLE</button>
                                        <?php } ?>

                                        {{-- <p class="mt-3 f-14-mb-10">View Fare Rules</p> --}}
                                    </div>

                                </div>
                                <?php $j=0; foreach($tripInfos->sI as $k => $flightDetails){ ?>
                                <?php
                                //echo "<pre>"; print_r(count($result_array->tripInfos)); exit();
                                $dep_time = strtotime($flightDetails->dt);
                                $arr_time = strtotime($flightDetails->at);
                                $total_time = $arr_time - $dep_time;
                                $hours = floor($total_time / 3600);
                                $minutes = floor(($total_time / 60) % 60);
                                $seconds = $total_time % 60;


                                ?>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <img src="assets/img/AirlinesLogo/{{ $flightDetails->fD->aI->code }}.png"
                                            style="    width: 25%">
                                        {{ $flightDetails->fD->aI->name }},
                                        {{ $flightDetails->fD->aI->code }}
                                        {{ $flightDetails->fD->fN }}
                                    </div>
                                    <div>
                                        <a href="#">{{ $tripInfos->totalPriceList[0]->fd->ADULT->cc }}</a>
                                        <i class="fa-solid fa-angle-right"></i>
                                        <a href="#">{{ $tripInfos->totalPriceList[0]->fd->ADULT->cc }}
                                            SAVER</a>
                                    </div>
                                </div>

                                <div class="row bg-rajiv mb-5">
                                    <div class="col-md-2">
                                        <p>{{ date('H:i', strtotime($flightDetails->dt)) }}</p>
                                    </div>
                                    <div class="col-md-10">
                                        <p><b>{{ $flightDetails->da->city }}.</b>
                                            {{ $flightDetails->da->name }} , {{ $flightDetails->da->terminal}}
                                        </p>
                                        <p> {{ $hours }}h {{ $minutes }}m</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-bottom: 0px;">
                                            {{ date('H:i', strtotime($flightDetails->at)) }}</p>
                                    </div>
                                    <div class="col-md-10">
                                        <p style="margin-bottom: 0px;">
                                            <b>{{ $flightDetails->aa->city }}.</b>
                                            {{ $flightDetails->aa->name }} , {{ $flightDetails->aa->terminal}}
                                        </p>
                                    </div>
                                </div>
                                <?php $j++; } ?>
                            </div>

                            <div class="clearfix mb-3"></div>
                            @php
                            /* adults base fare */
                                if(isset($tripInfos->totalPriceList[0]->fd->ADULT->fC->BF)){
                                    $adult_bf =  $tripInfos->totalPriceList[0]->fd->ADULT->fC->BF;
                                }else{
                                    $adult_bf = 0;
                                }

                                /* children base fare */
                                if(isset($tripInfos->totalPriceList[0]->fd->CHILD->fC->BF)){
                                    $child_bf =  $tripInfos->totalPriceList[0]->fd->CHILD->fC->BF;
                                }else{
                                    $child_bf = 0;
                                }

                                /* infants base fare*/
                                if(isset($tripInfos->totalPriceList[0]->fd->INFANT->fC->BF)){
                                    $infant_bf =  $tripInfos->totalPriceList[0]->fd->INFANT->fC->BF;
                                }else{
                                    $infant_bf = 0;
                                }


                                $adults = $result_array->searchQuery->paxInfo->ADULT; ////get total adult list

                                if(isset($result_array->searchQuery->paxInfo->CHILD)){
                                    $childs = $result_array->searchQuery->paxInfo->CHILD; //get total childs
                                }else{
                                    $childs = 0;
                                }

                                if(isset($result_array->searchQuery->paxInfo->INFANT)){
                                    $infants = $result_array->searchQuery->paxInfo->INFANT; //get total infants
                                }else{
                                    $infants = 0;
                                }


                                $is_domestic = $result_array->searchQuery->isDomestic; //domestic or international

                                $ttl_adlut_bf = $adults*$adult_bf;
                                $ttl_child_bf = $childs*$child_bf;
                                $ttl_infant_bf = $infants*$infant_bf;

                                //total taxes break up
                                $adult_tax = $adults * $tripInfos->totalPriceList[0]->fd->ADULT->fC->TAF;
                                // start adult tax
                                $adult_OT = $adults * $tripInfos->totalPriceList[0]->fd->ADULT->afC->TAF->OT;
                                $adult_MF = $adults * $tripInfos->totalPriceList[0]->fd->ADULT->afC->TAF->MF;
                                $adult_MFT = $adults * $tripInfos->totalPriceList[0]->fd->ADULT->afC->TAF->MFT;
                                $adult_AGST = $adults * $tripInfos->totalPriceList[0]->fd->ADULT->afC->TAF->AGST;
                                $adult_YQ = $adults * $tripInfos->totalPriceList[0]->fd->ADULT->afC->TAF->YQ;
                                //end adult tax


                                if($childs){
                                    $child_tax = $childs * $tripInfos->totalPriceList[0]->fd->CHILD->fC->TAF;
                                     // start child tax
                                $child_OT = $childs * $tripInfos->totalPriceList[0]->fd->CHILD->afC->TAF->OT;
                                $child_MF = $childs * $tripInfos->totalPriceList[0]->fd->CHILD->afC->TAF->MF;
                                $child_MFT = $childs * $tripInfos->totalPriceList[0]->fd->CHILD->afC->TAF->MFT;
                                $child_AGST = $childs * $tripInfos->totalPriceList[0]->fd->CHILD->afC->TAF->AGST;
                                $child_YQ = $childs * $tripInfos->totalPriceList[0]->fd->CHILD->afC->TAF->YQ;
                                //end child tax
                                }else{
                                    $child_tax = 0;
                                    $child_OT = 0;
                                    $child_MF = 0;
                                    $child_MFT = 0;
                                    $child_AGST = 0;
                                    $child_YQ = 0;
                                }

                                if($infants){
                                    $infant_tax= $infants * $tripInfos->totalPriceList[0]->fd->INFANT->fC->TAF;

                                    //start infant tax
                                    $infants_OT = $infants * $tripInfos->totalPriceList[0]->fd->INFANT->afC->TAF->OT;
                                $infants_MF = $infants * $tripInfos->totalPriceList[0]->fd->INFANT->afC->TAF->MF;
                                $infants_MFT = $infants * $tripInfos->totalPriceList[0]->fd->INFANT->afC->TAF->MFT;
                                $infants_AGST = $infants * $tripInfos->totalPriceList[0]->fd->INFANT->afC->TAF->AGST;
                                $infants_YQ = $infants * $tripInfos->totalPriceList[0]->fd->INFANT->afC->TAF->YQ;

                                    //end infant tax
                                }else{
                                    $infant_tax = 0;
                                    $infants_OT = 0;
                                    $infants_MF = 0;
                                    $infants_MFT = 0;
                                    $infants_AGST = 0;
                                    $infants_YQ = 0;
                                }


                                $basefare = $ttl_adlut_bf+$ttl_child_bf+$ttl_infant_bf;  //getting base fare for total trips
                                $Taxes_trip = $adult_tax + $child_tax + $infant_tax; //getting taxes for total trips

                                $Taxes = $Taxes_trip ;   ///calculating taxes for
                                $bookingId = $result_array->bookingId; ///booking send to form to store in session
                                $TotalAmount = $basefare + $Taxes;  ///calculating total amount with base fare and taxes

                                // total taxes break up
                                $OT = $adult_OT + $child_OT + $infants_OT;
                                $MF = $adult_MF + $child_MF + $infants_MF;
                                $MFT = $adult_MFT + $child_MFT + $infants_MFT;
                                $AGST = $adult_AGST + $child_AGST + $infants_AGST;
                                $YQ = $adult_YQ + $child_YQ + $infants_YQ;

                            @endphp

                            <!-- card details one end -->
                            <?php $i++; } ?>
                          {{-- //////////////////////////////////// --}}

                            <?php $a=1; foreach($fair_rules as $row){
                               // echo "hi";
                                 foreach($row->fareRule as $key => $fair_rules){ ?>

                                      <div class="row align-items-center cancel-ticket">
                                        <div class="col-md-1">
                                            <img src="assets/img/flight-fly.png" class="img-fluid">
                                        </div>
                                        <div class="col-md-11 ps-0">
                                            <h5><b>Cancellation Refund Policy</b></h5>
                                            <p>
                                                @php
                                                 if (isset($fair_rules->fr->NO_SHOW)) {
                                                if (isset($fair_rules->fr->NO_SHOW->DEFAULT)) {
                                                echo $fair_rules->fr->NO_SHOW->DEFAULT->policyInfo;
                                                }else{
                                                echo $fair_rules->fr->NO_SHOW->BEFORE_DEPARTURE->policyInfo;
                                                }
                                            }
                                               @endphp
                                            </p>
                                        </div>
                                    </div>


                                    <div class="mt-3 mb-3 cancelation-tab">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <?php if(isset($fair_rules->fr->CANCELLATION)){ ?>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link   <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                    echo 'active';
                                                } ?> " id="pills-home-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-home{{$a}}" type="button" role="tab"
                                                    aria-controls="pills-home" aria-selected="true">Cancellation Charges</button>
                                            </li>
                                            <?php } ?>
                                            <li class="nav-item " role="presentation">
                                                <button class="nav-link <?php if (!isset($fair_rules->fr->CANCELLATION)) {
                                                    echo 'active';
                                                } ?>" id="pills-profile-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-profile{{$a}}" type="button"
                                                    role="tab" aria-controls="pills-profile" aria-selected="false">Date Changes
                                                    Charges</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content ps-3" id="pills-tabContent">
                                            <div class="tab-pane fade <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                echo 'show active';
                                            } ?>" id="pills-home{{$a}}" role="tabpanel"
                                                aria-labelledby="pills-home-tab">

                                                {{-- <h6>{{$key}}</h6> --}}

                                                <table class="table table-bordered text-center ">
                                                    <tbody>
                                                        {{-- <tr>
                                            <th colspan="2">Without Cancellation Protection</th>
                                                <th colspan="2">With Cancellation Protection</th>
                                            </tr> --}}
                                                    <?php if(isset($fair_rules->fr->CANCELLATION->DEFAULT)){ ?>
                                                        <tr>
                                                            <td> Airline Cancellation Fee
                                                                <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->CANCELLATION->DEFAULT->fcs->ACF)) {
                                                                        echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->ACF;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?></p>
                                                            </td>
                                                            <td> Airline Cancellation Fee Tax
                                                                <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->CANCELLATION->DEFAULT->fcs->ACFT)) {
                                                                        echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->ACFT;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?></p>
                                                            </td>
                                                            {{-- MakeMyFly --}}
                                                            <td> Cancellation Fee<p><i
                                                                        class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                                        echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->CCF;
                                                                    } ?></p>
                                                            </td>
                                                            {{-- MakeMyFly --}}
                                                            <td>  Cancellation Fee Tax <p><i
                                                                        class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                                        echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->CCFT;
                                                                    } ?></p>
                                                            </td>
                                                        </tr>
                                                        <?php }else{ ?>
                                                            <tr>
                                                                <td> Airline Cancellation Fee
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION->BEFORE_DEPARTURE->fcs->ACF)) {
                                                                            echo $fair_rules->fr->CANCELLATION->BEFORE_DEPARTURE->fcs->ACF;
                                                                        } else {
                                                                            echo "0";
                                                                        } ?></p>
                                                                </td>
                                                                <td> Airline Cancellation Fee Tax
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION->BEFORE_DEPARTURE->fcs->ACFT)) {
                                                                            echo $fair_rules->fr->CANCELLATION->BEFORE_DEPARTURE->fcs->ACFT;
                                                                        } else {
                                                                            echo 0;
                                                                        } ?></p>
                                                                </td>
                                                                <td>MakeMyFly Cancellation Fee<p><i
                                                                            class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                                            echo $fair_rules->fr->CANCELLATION->BEFORE_DEPARTURE->fcs->CCF;
                                                                        } ?></p>
                                                                </td>
                                                                <td> MakeMyFly Cancellation Fee Tax <p><i
                                                                            class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                                            echo $fair_rules->fr->CANCELLATION->BEFORE_DEPARTURE->fcs->CCFT;
                                                                        } ?></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td> Airline Cancellation Fee
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION->AFTER_DEPARTURE->fcs->ACF)) {
                                                                            echo $fair_rules->fr->CANCELLATION->AFTER_DEPARTURE->fcs->ACF;
                                                                        } else {
                                                                            echo "0";
                                                                        } ?></p>
                                                                </td>
                                                                <td> Airline Cancellation Fee Tax
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION->AFTER_DEPARTURE->fcs->ACFT)) {
                                                                            echo $fair_rules->fr->CANCELLATION->AFTER_DEPARTURE->fcs->ACFT;
                                                                        } else {
                                                                            echo 0;
                                                                        } ?></p>
                                                                </td>
                                                                {{-- MakeMyFly --}}
                                                                <td> Cancellation Fee<p><i
                                                                            class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                                            echo $fair_rules->fr->CANCELLATION->AFTER_DEPARTURE->fcs->CCF;
                                                                        } ?></p>
                                                                </td>
                                                                {{-- MakeMyFly --}}
                                                                <td>  Cancellation Fee Tax <p><i
                                                                            class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->CANCELLATION)) {
                                                                            echo $fair_rules->fr->CANCELLATION->AFTER_DEPARTURE->fcs->CCFT;
                                                                        } ?></p>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="tab-pane fade <?php if (empty($fair_rules->fr->CANCELLATION)) {
                                                echo 'show active';
                                            } ?>" id="pills-profile{{$a}}" role="tabpanel"
                                                aria-labelledby="pills-profile-tab">

                                                {{-- <h6>{{ $key }}</h6> --}}

                                                <table class="table table-bordered text-center ">
                                                    <tbody>
                                                        {{-- <tr>
                                                <th colspan="2">Without Cancellation Protection</th>
                                                    <th colspan="2">With Cancellation Protection</th>
                                                </tr> --}}
                                                <?php if(isset($fair_rules->fr->DATECHANGE->DEFAULT)){ ?>
                                                        <tr>
                                                            <td>Airline Reschedule Fee
                                                                <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->DATECHANGE->DEFAULT->fcs->ARF)) {
                                                                        echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->ARF;
                                                                    } else {
                                                                        0;
                                                                    } ?></p>
                                                            </td>
                                                            <td> Airline Reschedule Fee Tax
                                                                <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->DATECHANGE->DEFAULT->fcs->ARFT)) {
                                                                        echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->ARFT;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?></p>
                                                            </td>
                                                            {{-- MakeMyFly --}}
                                                            <td>  Reschedule Fee
                                                                <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->DATECHANGE)) {
                                                                        echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->CRF;
                                                                    } ?></p>
                                                            </td>
                                                            {{-- MakeMyFly --}}
                                                            <td>  Reschedule Fee Tax <p><i
                                                                        class="fa-solid fa-indian-rupee-sign"></i>
                                                                    <?php if (isset($fair_rules->fr->DATECHANGE)) {
                                                                        echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->CRFT;
                                                                    } ?></p>
                                                            </td>
                                                        </tr>
                                                        <?php }else{ ?>
                                                            <tr>
                                                                <td>Airline Reschedule Fee
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE->fcs->ARF)) {
                                                                            echo $fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE->fcs->ARF;
                                                                        } else {
                                                                            0;
                                                                        } ?></p>
                                                                </td>
                                                                <td> Airline Reschedule Fee Tax
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE->fcs->ARFT)) {
                                                                            echo $fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE->fcs->ARFT;
                                                                        } else {
                                                                            echo 0;
                                                                        } ?></p>
                                                                </td>
                                                                {{-- MakeMyFly --}}
                                                                <td>  Reschedule Fee
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE)) {
                                                                            echo $fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE->fcs->CRF;
                                                                        } ?></p>
                                                                </td>
                                                                {{-- MakeMyFly --}}
                                                                <td>  Reschedule Fee Tax <p><i
                                                                            class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE)) {
                                                                            echo $fair_rules->fr->DATECHANGE->BEFORE_DEPARTURE->fcs->CRFT;
                                                                        } ?></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Airline Reschedule Fee
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE->AFTER_DEPARTURE->fcs->ARF)) {
                                                                            echo $fair_rules->fr->DATECHANGE->AFTER_DEPARTURE->fcs->ARF;
                                                                        } else {
                                                                            0;
                                                                        } ?></p>
                                                                </td>
                                                                <td> Airline Reschedule Fee Tax
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE->AFTER_DEPARTURE->fcs->ARFT)) {
                                                                            echo $fair_rules->fr->DATECHANGE->AFTER_DEPARTURE->fcs->ARFT;
                                                                        } else {
                                                                            echo 0;
                                                                        } ?></p>
                                                                </td>
                                                                {{-- MakeMyFly --}}
                                                                <td>  Reschedule Fee
                                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE)) {
                                                                            echo $fair_rules->fr->DATECHANGE->AFTER_DEPARTURE->fcs->CRF;
                                                                        } ?></p>
                                                                </td>
                                                                {{-- MakeMyFly --}}
                                                                <td>  Reschedule Fee Tax <p><i
                                                                            class="fa-solid fa-indian-rupee-sign"></i>
                                                                        <?php if (isset($fair_rules->fr->DATECHANGE)) {
                                                                            echo $fair_rules->fr->DATECHANGE->AFTER_DEPARTURE->fcs->CRFT;
                                                                        } ?></p>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                              <?php  $a++; }}?>
                                {{-- /////////////////////////////// --}}


 {{--
                            <div class=" unsure-ticket align-items-center">
                                <img src="assets/img/flight-fly.png" class="img-fluid">
                                <span>
                                    <h5><b>Unsure of your travel plans?</b></h5>
                                </span>
                            </div>

                            <div class="row align-items-center check-ticket">
                                <div class="col-md-12 form-check">
                                    <input class="form-check-input amtClk" type="checkbox" name="free_change"
                                        value="125">
                                    <div class="add-type">
                                        <p>Add Free Date Change</p>
                                        <img src="assets/img/calender-addfree.png">
                                    </div>
                                    <div class="add-type1">
                                        <p>Save up to ₹ 2,625 on date change charges up to 24 hours before departure. You
                                            just pay the fare difference. <a href="#"> View T&C </a></p>

                                        <h6><i class="fa-solid fa-indian-rupee-sign"></i> 125</h6>
                                    </div>
                                </div>
                            </div>

                           <div class="row align-items-center cancel-ticket">
                                <div class="col-md-1">
                                    <img src="assets/img/travel-insurance.png" class="img-fluid">
                                </div>
                                <div class="col-md-11 ps-0">
                                    <h5><b>Travel Insurance</b></h5>
                                    <!--<p>Zero cancellation fee for your tickets when you cancel. Pay additional Rs.399</p>-->
                                </div>
                            </div>

                            <div class="row mt-3">

                                <div class="col-md-4 ">
                                    <div class="delay-tabs">
                                        <div class="row ">
                                            <div class="col-md-2 img-pl-0">
                                                <img src="assets/img/clock-expire-16.png">
                                            </div>
                                            <div class="col-md-10">
                                                <p>Upto <i class="fa-solid fa-indian-rupee-sign"></i> 1,000 </p>
                                                <p>Trip Delay</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="delay-tabs">
                                        <div class="row ">
                                            <div class="col-md-2 img-pl-0">
                                                <img src="assets/img/cancel-2.png">
                                            </div>
                                            <div class="col-md-10">
                                                <p>Upto <i class="fa-solid fa-indian-rupee-sign"></i> 2,000 </p>
                                                <p>Missed flight Connection</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="delay-tabs">
                                        <div class="row ">
                                            <div class="col-md-2 img-pl-0">
                                                <img src="assets/img/cancel-3.png">
                                            </div>
                                            <div class="col-md-10">
                                                <p>Upto <i class="fa-solid fa-indian-rupee-sign"></i> 2,000 </p>
                                                <p>Trip cancellation</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row align-items-center check-ticket">
                                <div class="col-md-12 form-check">
                                    <input class="form-check-input amtClk" type="radio" name="secure_trip"
                                        id="secure_yes" value="250.50">
                                    <div class="">
                                        <h6 class="add-free-chk">Yes, Secure my trip.</h6>
                                    </div>
                                </div>
                                <div class="col-md-12 form-check">
                                    <input class="form-check-input amtClk" type="radio" name="secure_trip"
                                        id="secure_yes" value="0" checked>
                                    <div class="">
                                        <h6 class="add-free-chk2">I do not wish to secure my trip</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="input-info">
                                <p>By adding insurance you confirm all passengers are between 2 to 70 years of age, and
                                    agree to theTerms & Conditions andGood Health Terms</p>
                            </div>

--}}
                            <div class="row align-items-center cancel-ticket">
                                <div class="col-md-1">
                                    <img src="assets/img/enter-travellar-img.png" class="img-fluid">
                                </div>
                                <div class="col-md-8 ps-0">
                                    <h5><b>Enter Traveller Details</b></h5>
                                    <p> Book faster and Easy</p>
                                    <h6>ADULT (12 yrs+)</h6>
                                </div>
                                <div class=" col-md-3 text-end">
                                    <button class="btn btn-blue-continue" onclick="clone_div()">Add New Adult</button>
                                </div>
                            </div>
                            <form name="passenger_details" method="POST" action="" id="passenger_details">
                                <div class="row first-inputname ">
                                    <p id="overflow" style="color: red"></p>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <select name="gender[]" class="form-select" placeholder="Gender"
                                                required="true">
                                                <option value=""> Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="hidden" name="adult" value="1"/>
                                            <input type="text" name="firstname[]" class="form-control allowtext"
                                                placeholder="First and middle name" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="lastname[]" class="form-control allowtext"
                                                placeholder="Last name" required="true">
                                        </div>
                                    </div>

                                    @if(!$is_domestic)

                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <input type="text" minlength="8" maxlength="14" name="passport_no[]" class="form-control allow-alpa-numeric"
                                                placeholder="Passport No" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <select name="passport_country_code[]" class="form-control" placeholder="Passport Issuing Country"
                                                required="true">
                                                <option value="">Select Passport Issuing Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->iso }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input id="datePicker" type="text" name="passport_expiry_date[]" class="form-control date-picker-hide"
                                                placeholder="Passport Expiry Date" required="true">
                                        </div>
                                    </div>
                                    @endif
                                  </div>
                                <div id="app_div"></div>

@if($childs)
                                <div class="row align-items-center cancel-ticket">
                                    <div class="col-md-1">
                                        {{-- <img src="assets/img/enter-travellar-img.png" class="img-fluid"> --}}
                                    </div>
                                    <div class="col-md-8 ps-0">
                                        <h6>CHILD (2-12 Yrs)</h6>
                                    </div>
                                    <div class=" col-md-3 text-end">
                                        <button class="btn btn-blue-continue" onclick="clone_child_div()">Add New Child</button>
                                    </div>
                                </div>
                                <div class="row first-inputname ">
                                    <p id="overflowchild" style="color: red"></p>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <select name="gender_child[]" class="form-select" placeholder="Gender"
                                                required="true">
                                                <option value=""> Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="hidden" name="children" value="2"/>
                                            <input type="text" name="firstname_child[]" class="form-control allowtext"
                                                placeholder="First and middle name" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="lastname_child[]" class="form-control allowtext"
                                                placeholder="Last name" required="true">
                                        </div>
                                    </div>

                                    @if(!$is_domestic)

                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <input type="text" minlength="8" maxlength="14" name="passport_no_child[]" class="form-control allow-alpa-numeric"
                                                placeholder="Passport No" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <select name="passport_country_code_child[]" class="form-control" placeholder="Passport Issuing Country"
                                                required="true">
                                                <option value="">Select Passport Issuing Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->iso }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input id="datePicker" type="text" name="passport_expiry_date_child[]" class="form-control date-picker-hide"
                                                placeholder="Passport Expiry Date" required="true">
                                        </div>
                                    </div>
                                    @endif
                                  </div>
                                  <div id="app_child_div"></div>
                                  @endif

                                  @if($infants)
                                <div class="row align-items-center cancel-ticket">
                                    <div class="col-md-1">
                                        {{-- <img src="assets/img/enter-travellar-img.png" class="img-fluid"> --}}
                                    </div>
                                    <div class="col-md-8 ps-0">
                                        <h6>Infant (15 days - 2 Yrs)</h6>
                                    </div>
                                    <div class=" col-md-3 text-end">
                                        <button class="btn btn-blue-continue" onclick="clone_infants_div()">Add New Infants</button>
                                    </div>
                                </div>
                                <div class="row first-inputname ">
                                    <p id="overflowinfant" style="color: red"></p>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <select name="gender_infant[]" class="form-select" placeholder="Gender"
                                                required="true">
                                                <option value=""> Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="hidden" name="infant" value="3"/>
                                            <input type="text" name="firstname_infant[]" class="form-control allowtext"
                                                placeholder="First and middle name" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="lastname_infant[]" class="form-control allowtext"
                                                placeholder="Last name" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input id="datePicker_infant" type="text" name="dob_infant[]" class="form-control date-picker-hide"
                                                placeholder="DOB" required="true">
                                        </div>
                                    </div>

                                    @if(!$is_domestic)

                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <input type="text" minlength="8" maxlength="14" name="passport_no_infant[]" class="form-control allow-alpa-numeric"
                                                placeholder="Passport No" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <select name="passport_country_code_infant[]" class="form-control" placeholder="Passport Issuing Country"
                                                required="true">
                                                <option value="">Select Passport Issuing Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->iso }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input id="datePicker" type="text" name="passport_expiry_date_infant[]" class="form-control date-picker-hide"
                                                placeholder="Passport Expiry Date" required="true">
                                        </div>
                                    </div>
                                    @endif
                                  </div>
                                  <div id="app_infant_div"></div>
                                  @endif



                                <div class="row first-inputname ">
                                    <label>Booking Details will be sent to</label>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select id="country_code" name="country_code" class="form-control" placeholder="Gender"
                                                required="true">
                                                <option value="">Select country</option>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->phonecode }}" @if( $country->phonecode == '91') selected @endif>{{ $country->name }}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control allownumber" id="isocode" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="mobile_number" class="form-control allownumber"
                                                placeholder="Mobile Number" required="true" id="mobile">
                                                <span id="check_valid_mobile" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email ID" required="true" id="email_id">
                                        </div>
                                    </div>
                                </div>
                                {{--
                                <div class="row check-ticket-new">
                                    <div class=" form-check check-ticket">
                                        <input class="form-check-input" type="checkbox" name="whatsapp" id="whatsapp">
                                        <h6 class="">Also send my booking details on WhatsApp</h6>

                                    </div>
                                </div>
                                --}}
                                <div class="row mt-5">
                                    <div class="col-md-3 ms-auto text-end">
                                        {{-- <a href="#"  data-bs-toggle="modal" data-bs-target="#review-details"><button class="btn btn-blue-continue"> Continue
             </button></a> --}}
                                        <input type="submit" class="btn btn-blue-continue" id="submit"
                                            value="submiit">
                                    </div>
                                </div>
                            </form>




                        </div>
                    </div>
                </div>

                <div class="col-md-3 p-3 mt30 ">
{{-- alert fare if changed --}}
                    @if(isset($result_array->alerts[0]))
                    <div class="card mb-3">
                        <div class=" card-body card-shadow">
                            <h5><b>Fare Price</b></h5>
                            <div class="row">
                                <div class="col-md-6 fare-P">
                                    <h4><i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                        {{ number_format($result_array->alerts[0]->newFare, 2) }}</h4>
                                    <small>New price</small>
                                </div>
                                <div class="col-md-6 fare-P">
                                    <h4 class="text-olld"><i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                        {{ number_format($result_array->alerts[0]->oldFare, 2) }}</h4>
                                    <small>Old price</small>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endif
                    <div class="card">
                        <div class=" card-body card-shadow">
                            <h5><b>Fare Summary</b></h5>
                        <!--- Base Fare only -->
                            <div class="accordion" id="myAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne">

                                            <table width="100%">
                                                <tr>
                                                    <td width="">
                                                        <span class="ps-1">Base Fare</span>
                                                    </td>
                                                    <td width="60%">
                                                        <span class="d-flex justify-content-end icon_style">
                                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                                            {{ number_format($basefare, 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>

                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#myAccordion">

                                        <table>
                                            <!--- Adult Calculation table row -->
                                            <tr>
                                                <td>
                                                    <span class="">
                                                        Adult(s) <br><small style="font-size: 12px;">({{ $adults }} X ₹ {{ number_format($adult_bf, 2) }})</small>
                                                    </span>
                                                </td>
                                                <td>:</td>
                                                <td width="45%">
                                                    <span class="icon_style justify-content-end">
                                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ number_format($adults*$adult_bf, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <!--- End Adult Calculation table row -->

                                            @if($childs > 0)
                                                <!-- Child Calculation table row -->
                                                <tr>
                                                    <td>
                                                        <span class="">
                                                            Child(s) <br><small style="font-size: 12px;">({{ $childs }} X ₹ {{ number_format($child_bf, 2) }})</small>
                                                        </span>
                                                    </td>
                                                    <td>:</td>
                                                    <td width="45%">
                                                        <span class="icon_style justify-content-end">
                                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                                            {{ number_format($childs * $child_bf, 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <!-- End Child Calculation table row -->
                                            @endif
                                            @if($infants > 0)
                                                <!-- Infants Calculation table row -->
                                                <tr>
                                                    <td>
                                                        <span class="">
                                                            Infant(s) <br><small style="font-size: 12px;">({{ $infants }} X ₹ {{ number_format($infant_bf, 2) }})</small>
                                                        </span>
                                                    </td>
                                                    <td>:</td>
                                                    <td width="45%">
                                                        <span class="icon_style justify-content-end">
                                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                                            {{ number_format($infants * $infant_bf, 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <!-- End Infants Calculation table row -->
                                            @endif

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--- End Base Fare only -->

                             <!--- Taxes and Fees --->
                            <div class="accordion mt-2" id="myAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne2">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <span class="ps-1">Fee & Surcharges</span>
                                                    </td>
                                                    <td>
                                                        <span class="d-flex icon_style">
                                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                                            {{ number_format($Taxes, 2) }}
                                                        </span>
                                                    </td>
                                                </tr>

                                            </table>


                                        </button>
                                    </h2>
                                    <div id="collapseOne2" class="accordion-collapse collapse"
                                        data-bs-parent="#myAccordion">
                                        <table>
                                            <tr>
                                                <td><span>Other Charges </span> </td>
                                                <td> : </td>
                                                <td>
                                                    <span class="d-flex icon_style">

                                                        <i class="fa-solid fa-indian-rupee-sign"></i> {{ $OT }}

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <span>Management Fee </span> </td>
                                                <td> : </td>
                                                <td>
                                                    <span class="d-flex icon_style">

                                                        <i class="fa-solid fa-indian-rupee-sign"></i> {{ $MF }}

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <span>Management Fee Tax</span> </td>
                                                <td> : </td>
                                                <td>
                                                    <span class="d-flex icon_style">

                                                        <i class="fa-solid fa-indian-rupee-sign"></i> {{ $MFT }}

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <span>Airline GST</span> </td>
                                                <td> : </td>
                                                <td>
                                                    <span class="d-flex icon_style">

                                                        <i class="fa-solid fa-indian-rupee-sign"></i> {{ $AGST }}

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <span>Fuel Surcharge</span> </td>
                                                <td> : </td>
                                                <td>
                                                    <span class="d-flex icon_style">

                                                        <i class="fa-solid fa-indian-rupee-sign"></i> {{ $YQ }}

                                                    </span>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td> <span>Carrier Misc Fee</span> </td>
                                                <td> : </td>
                                                <td>
                                                    <span class="d-flex icon_style">

                                                        <i class="fa-solid fa-indian-rupee-sign"></i> {{ $YR }}

                                                    </span>
                                                </td>
                                            </tr> --}}
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <!--- End Taxes and Fees --->
                            <div class="accordion mt-2 othercharges" id="myAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne3">
                                            <span class="ms-2 ">Other Charges </span> <span class="ms-auto OtherAmount">
                                                <i class="fa-solid fa-indian-rupee-sign"></i> 125</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne3" class="accordion-collapse collapse"
                                        data-bs-parent="#myAccordion">
                                        <small class="ms-3">
                                            <span>Secure Amount: </span>
                                            <span class="float-end scrAMT"> <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </span>
                                        </small>
                                    </div>
                                    <div id="collapseOne3" class="accordion-collapse collapse"
                                        data-bs-parent="#myAccordion">
                                        <small class="ms-3">
                                            <span>Date Change: </span>
                                            <span class="float-end dtcgAMT"> <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </span>
                                        </small>
                                    </div>

                                </div>

                            </div>
                            <div class="border-dassed"></div>
                            <div class="row ">
                                <div class="col-md-7">
                                    <b>Total Amount</b>
                                </div>
                                <div class="col-md-5  text-end Total_Amount">
                                    <i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($TotalAmount, 2) }}
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>


    <script>
        $(document).ready(function() {

            let country_code = $('#country_code').val();
            let isocode = $('#isocode').val(country_code);
            /** On Key Up check the validation **/
            $('body').on('keyup', '#mobile', function(){
                let countrys_code = $('#country_code').val();

                if(countrys_code == 91)
                {
                    var patt_m= /^[6789]\d{9}$/;
                    if(!patt_m.test($('#mobile').val()))
                    {
                        ($('#mobile')).css({"background-color": "pink"});
                        $('#check_valid_mobile').html('Please enter Valid mobile number')

                    }
                    else
                    {
                        //err_msg_mobile="";
                        ($('#mobile')).css({"background-color": "white"});
                        $('#check_valid_mobile').html('')
                    }
                }

            });
            /** End On Key Up check the validation **/

            /** Country change get value **/
            $('#country_code').on('change', function(e){
                let countryvalue = e.target.value;
                $('#isocode').val(countryvalue)

            })
            /** Country change get value **/

            var d = new Date();

            var todayDate = new Date(d.setMonth(d.getMonth() + 6));
            $('#datePicker').datepicker({dateFormat: "dd-mm-yy", minDate:todayDate});

            var minDate = new Date(d.setMonth(d.getMonth() - 29));
            var maxDate = new Date();
            $('#datePicker_infant').datepicker({dateFormat: "dd-mm-yy", minDate:minDate, maxDate:maxDate});

            $(".othercharges").hide();

            $(".amtClk").click(function() {

                var secureAMT = parseFloat(0).toFixed(2);
                var free_dateChange = parseFloat(0).toFixed(2);
                var secureAMT = $("input[name='secure_trip']:checked").val();
                var adultFare_Charges = '<?php echo $TotalAmount; ?>';

                if ($("input[name='free_change']:checked").length > 0) {
                    var free_dateChange = $("input[name='free_change']:checked").val();
                } else {
                    var free_dateChange = 0;
                }
                // alert(secureAMT);
                var other_totalAMT = parseFloat(secureAMT) + parseFloat(free_dateChange);
                var Total_Amount = parseFloat(adultFare_Charges) + parseFloat(other_totalAMT);
                //  alert(other_totalAMT);
                //  alert(adultFare_Charges);
                if (other_totalAMT > 0) {
                    $(".othercharges").show();

                    $('.scrAMT').html(secureAMT);
                    $('.dtcgAMT').html(free_dateChange);
                    $('.OtherAmount').html(other_totalAMT);
                    $('.Total_Amount').html(Total_Amount);

                } else {
                    $(".othercharges").hide();
                    $('.Total_Amount').html(Total_Amount);
                }
                //$('.Total_Amount').html(Total_Amount);
                $('.Total_Amount').html(Number(Total_Amount).toLocaleString());
            });

        });


        //////////////add new passenger cloning/////////
        function clone_div() {
            var adults = '<?php echo $adults; ?>';
            var is_domestic = '<?php echo $is_domestic; ?>';
            var count = $('.newrow').length;
            var count_new = count + 1;
            if (adults > count_new) {

                var html = `
                         <div class="row first-inputname newrow" id="newrow${count_new}">

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <select name="gender[]" class="form-select" placeholder="Gender" required="true">
                              <option value=""> Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                            </div>
                          </div>
                            <div class="col-md-4">
                              <div class="form-group mb-3">
                                <input type="text" name="firstname[]" class="form-control allowtext" placeholder="First and middle name" required="true">
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group mb-3">
                              <input type="text" name="lastname[]" class="form-control allowtext" placeholder="Last name" required="true">
                            </div>
                          </div>
                          @if(!$is_domestic)
                          <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <input type="text" minlength="8" maxlength="14" name="passport_no[]" class="form-control allow-alpa-numeric"
                                                placeholder="Passport No" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <select name="passport_country_code[]" class="form-control" placeholder="Passport Issuing Country"
                                                required="true">
                                                <option value="">Select Passport Issuing Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->iso }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="passport_expiry_date[]" class="form-control date-picker-hide"
                                                placeholder="Passport Expiry Date" required="true">
                                        </div>
                                    </div>

@endif

                          <div class="col-md-2 text-end ">
                            <div class="btn-group btn-grp" role="group" aria-label="Basic outlined example">
                                <button type="button" class="plus-bg bg-danger" onclick="remove(${count_new})">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                              </div>
                          </div>
                          </div>
                          <div id="app_div"></div>
                        `;
                $('#app_div').append(html);
            } else {
                $('#overflow').html("You have already selected " + adults + " ADULT. Remove before adding a new one.");
                //$('#overflow').show();
            }


        }

        function remove(id) {
            $('#newrow' + id).remove();
            $('#overflow').html('');
            // $('#overflow').hide();

        }


        /* add new children cloning */
        function clone_child_div() {
            var childs = '<?php echo $childs; ?>';
            var is_domestic = '<?php echo $is_domestic; ?>';
            var count = $('.newrowchild').length;
            var count_new = count + 1;
            if (childs > count_new) {

                var html = `
                         <div class="row first-inputname newrowchild" id="newrowchild${count_new}">

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <select name="gender_child[]" class="form-select" placeholder="Gender" required="true">
                              <option value=""> Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                            </div>
                          </div>
                            <div class="col-md-4">
                              <div class="form-group mb-3">
                                <input type="text" name="firstname_child[]" class="form-control allowtext" placeholder="First and middle name" required="true">
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group mb-3">
                              <input type="text" name="lastname_child[]" class="form-control allowtext" placeholder="Last name" required="true">
                            </div>
                          </div>
                          @if(!$is_domestic)
                          <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <input type="text" minlength="8" maxlength="14" name="passport_no_child[]" class="form-control allow-alpa-numeric"
                                                placeholder="Passport No" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <select name="passport_country_code_child[]" class="form-control" placeholder="Passport Issuing Country"
                                                required="true">
                                                <option value="">Select Passport Issuing Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->iso }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="passport_expiry_date_child[]" class="form-control date-picker-hide"
                                                placeholder="Passport Expiry Date" required="true">
                                        </div>
                                    </div>

@endif

                          <div class="col-md-2 text-end ">
                            <div class="btn-group btn-grp" role="group" aria-label="Basic outlined example">
                                <button type="button" class="plus-bg bg-danger" onclick="remove_child(${count_new})">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                              </div>
                          </div>
                          </div>
                          <div id="app_child_div"></div>
                        `;
                $('#app_child_div').append(html);
            } else {
                $('#overflowchild').html("You have already selected " + childs + " CHILD. Remove before adding a new one.");
                //$('#overflow').show();
            }


        }

        function remove_child(id) {
            $('#newrowchild' + id).remove();
            $('#overflowchild').html('');
            // $('#overflow').hide();

        }

        /* add new children cloning */
        function clone_infants_div() {
            var infants = '<?php echo $infants; ?>';
            var is_domestic = '<?php echo $is_domestic; ?>';
            var count = $('.newrowinfant').length;
            var count_new = count + 1;
            if (infants > count_new) {

                var html = `
                         <div class="row first-inputname newrowinfant" id="newrowinfant${count_new}">

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <select name="gender_infant[]" class="form-select" placeholder="Gender" required="true">
                              <option value=""> Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                            </div>
                          </div>
                            <div class="col-md-4">
                              <div class="form-group mb-3">
                                <input type="text" name="firstname_infant[]" class="form-control allowtext" placeholder="First and middle name" required="true">
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group mb-3">
                              <input type="text" name="lastname_infant[]" class="form-control allowtext" placeholder="Last name" required="true">
                            </div>
                          </div>
                          <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input id="datePicker_infant" type="text" name="dob_infant[]" class="form-control date-picker-hide"
                                                placeholder="DOB" required="true">
                                        </div>
                                    </div>
                          @if(!$is_domestic)
                          <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <input type="text" minlength="8" maxlength="14" name="passport_no_infant[]" class="form-control allow-alpa-numeric"
                                                placeholder="Passport No" required="true">
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group mb-3">
                                            <select name="passport_country_code_infant[]" class="form-control" placeholder="Passport Issuing Country"
                                                required="true">
                                                <option value="">Select Passport Issuing Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->iso }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="passport_expiry_date_infant[]" class="form-control date-picker-hide"
                                                placeholder="Passport Expiry Date" required="true">
                                        </div>
                                    </div>

@endif

                          <div class="col-md-2 text-end ">
                            <div class="btn-group btn-grp" role="group" aria-label="Basic outlined example">
                                <button type="button" class="plus-bg bg-danger" onclick="remove_infant(${count_new})">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                              </div>
                          </div>
                          </div>
                          <div id="app_infant_div"></div>
                        `;
                $('#app_infant_div').append(html);
            } else {
                $('#overflowinfant').html("You have already selected " + infants + " INFANT. Remove before adding a new one.");
                //$('#overflow').show();
            }


        }

        function remove_infant(id) {
            $('#newrowinfant' + id).remove();
            $('#overflowinfant').html('');
            // $('#overflow').hide();

        }

        var values = {};

        $(function() {
            $("#submit").click(function() {
                var adult_count = '<?php echo $adults; ?>';
                var child_count = '<?php echo $childs; ?>';
                var infant_count = '<?php echo $infants; ?>';
                var is_domestic = '<?php echo $is_domestic; ?>';
                var clone_count = $('.newrow').length;
                var total_rows = clone_count + 1;

                if(child_count > 0 ){
                    var clone_count_child = $('.newrowchild').length;
                    var total_child_rows = clone_count_child + 1;
                }else{
                    var total_child_rows = 0;
                }

                if(infant_count > 0){
                    var clone_count_infant = $('.newrowinfant').length;
                    var total_infant_rows = clone_count_infant + 1;
                }else{
                    var total_infant_rows = 0;
                }


                var proceed = true;
                $("#passenger_details input,select[required=true]").each(function() {
                    $(this).parent().after("");
                    $('.validation').remove();
                });
                $("#passenger_details input,select[required=true]").each(function() {
                    $(this).css('border-color', '');
                    if (!$.trim($(this).val())) { //if this field is empty
                        $(this).css('border-color', 'red'); //change border color to red
                        $(this).parent().after(
                            "<div class='validation' style='color:red;margin-bottom: 20px;'>This Field is Required</div>"
                        );
                        proceed = false; //set do not proceed flag

                    }

                });


                if (adult_count == total_rows ) { //////////////checking
                    if(child_count == total_child_rows){
                        if(infant_count == total_infant_rows){
                            if (proceed) {
                            //$('.passengerreview').modal('show');
                            $('.passengerreview').hide();
                            $('#overflow').html("");
                            var first_name = $("input[name='firstname[]']").map(function() {
                                return $(this).val();
                            }).get();
                            var last_name = $("input[name='lastname[]']").map(function() {
                                return $(this).val();
                            }).get();
                            var gender = $("select[name='gender[]']").map(function() {
                                return $(this).val();
                            }).get();

                            /*child details*/
                            if(child_count > 0){
                                var first_name_child = $("input[name='firstname_child[]']").map(function() {
                                return $(this).val();
                            }).get();
                                var last_name_child = $("input[name='lastname_child[]']").map(function() {
                                    return $(this).val();
                                }).get();
                                var gender_child = $("select[name='gender_child[]']").map(function() {
                                    return $(this).val();
                                }).get();
                            }

                            /*Infant details*/
                            if(infant_count > 0){
                                var first_name_infant = $("input[name='firstname_infant[]']").map(function() {
                                return $(this).val();
                            }).get();
                                var last_name_infant = $("input[name='lastname_infant[]']").map(function() {
                                    return $(this).val();
                                }).get();
                                var gender_infant = $("select[name='gender_infant[]']").map(function() {
                                    return $(this).val();
                                }).get();
                            }

                            var _token = '<?php echo csrf_token(); ?>';
                            var mobile = $('#mobile').val();
                            var email = $('#email_id').val();
                            var country_code = $('#country_code').val();

                            for (i = 0; i < adult_count; i++) {
                                var html = `
                                <div class="p-3 passengerreview">
                                <table class="table table-bordered ">
                                    <tr>
                                    <td>First & Middle Name</td>
                                    <td>${first_name[i]}</td>
                                    </tr>
                                    <tr>
                                    <td>Last Name</td>
                                    <td>${last_name[i]}</td>
                                    </tr>
                                    <tr>
                                    <td>Gender</td>
                                    <td>${gender[i]}</td>
                                    </tr>
                                </table>
                                </div>
                                `;
                                $('#passenger_div').append(html);
                            }
                                if(child_count>0){
                                    for (i = 0; i < child_count; i++) {
                                        html += ` @if($childs)
                                <div class="p-3 passengerreview">
                                <table class="table table-bordered ">
                                    <tr>
                                    <td>First & Middle Name</td>
                                    <td>${first_name_child[i]}</td>
                                    </tr>
                                    <tr>
                                    <td>Last Name</td>
                                    <td>${last_name_child[i]}</td>
                                    </tr>
                                    <tr>
                                    <td>Gender</td>
                                    <td>${gender_child[i]}</td>
                                    </tr>
                                </table>
                                </div>
                                @endif`;
                                $('#passenger_div').append(html);
                                    }

                                }

                                if(infant_count > 0){
                                    for (i = 0; i < infant_count; i++) {
                                        html += `@if($infants)
                                        <div class="p-3 passengerreview">
                                        <table class="table table-bordered ">
                                            <tr>
                                            <td>First & Middle Name</td>
                                            <td>${first_name_infant[i]}</td>
                                            </tr>
                                            <tr>
                                            <td>Last Name</td>
                                            <td>${last_name_infant[i]}</td>
                                            </tr>
                                            <tr>
                                            <td>Gender</td>
                                            <td>${gender_infant[i]}</td>
                                            </tr>
                                        </table>
                                        </div>
                                        @endif`;
                                    $('#passenger_div').append(html);
                                    }
                                }

                                // html += `<div id="passenger_div"></div>`;
                                // $('#passenger_div').append(html);


                            $('#review-details').modal('show');
                        }
                        }else{
                            $('#overflowinfant').html("Kindly add all travellers before proceeding");
                        }
                    }else{
                        $('#overflowchild').html("Kindly add all travellers before proceeding");
                    }
                } else {
                    $('#overflow').html("Kindly add all travellers before proceeding");
                }
                //  alert(proceed);
                return false;
            });
        });

        function edit_field() {
            $('#review-details').modal('hide');

        }

        $(function() {
            $("#cnfBtn").click(function() {
                //alert("hoii");
                $("#loader_div").removeClass('d-none');
                $("#loader_div").show();
                var adult_count = '<?php echo $adults; ?>';
                var child_count = '<?php echo $childs; ?>';
                var infant_count = '<?php echo $infants; ?>';
                var is_domestic = '<?php echo $is_domestic; ?>';

                var priceIds = '<?php  print_r($priceIds); ?>';

                var clone_count = $('.newrow').length;
                var total_rows = clone_count + 1;

                /*Adult details*/
                var first_name = $("input[name='firstname[]']").map(function() {
                    return $(this).val();
                }).get();
                var last_name = $("input[name='lastname[]']").map(function() {
                    return $(this).val();
                }).get();
                var gender = $("select[name='gender[]']").map(function() {
                    return $(this).val();
                }).get();

                if(is_domestic == 'true'){
                    var passport_no = $("input[name='passport_no[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var passport_country_code = $("select[name='passport_country_code[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var passport_expiry_date = $("input[name='passport_expiry_date[]']").map(function() {
                        return $(this).val();
                    }).get();
                }else{
                    passport_no='';
                    passport_country_code='';
                    passport_expiry_date='';
                }


                 /*child details*/
                 if(child_count > 0){
                    var first_name_child = $("input[name='firstname_child[]']").map(function() {
                    return $(this).val();
                }).get();
                    var last_name_child = $("input[name='lastname_child[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var gender_child = $("select[name='gender_child[]']").map(function() {
                        return $(this).val();
                    }).get();

                if(is_domestic == 'true'){
                    var passport_no_child = $("input[name='passport_no_child[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var passport_country_code_child = $("select[name='passport_country_code_child[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var passport_expiry_date_child = $("input[name='passport_expiry_date_child[]']").map(function() {
                        return $(this).val();
                    }).get();
                }else{
                    passport_no_child='';
                    passport_country_code_child='';
                    passport_expiry_date_child='';
                }

                }

                    /*Infant details*/
                if(infant_count > 0){
                    var first_name_infant = $("input[name='firstname_infant[]']").map(function() {
                    return $(this).val();
                }).get();
                    var last_name_infant = $("input[name='lastname_infant[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var gender_infant = $("select[name='gender_infant[]']").map(function() {
                        return $(this).val();
                    }).get();

                    var dob_infant = $("input[name='dob_infant[]']").map(function() {
                        return $(this).val();
                    }).get();

                    if(is_domestic == 'true'){
                    var passport_no_infant = $("input[name='passport_no_infant[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var passport_country_code_infant = $("select[name='passport_country_code_infant[]']").map(function() {
                        return $(this).val();
                    }).get();
                    var passport_expiry_date_infant = $("input[name='passport_expiry_date_infant[]']").map(function() {
                        return $(this).val();
                    }).get();
                }else{
                    passport_no_infant ='';
                    passport_country_code_infant ='';
                    passport_expiry_date_infant='';
                }

                }

                var _token = '<?php echo csrf_token(); ?>';

                var mobile = $('#mobile').val();
                var email = $('#email_id').val();
                var country_code = $('#country_code').val();
                //var whatsapp = $('#whatsapp').val();
                var whatsapp = $('input[name="whatsapp"]:checked').length > 0;
                //alert(whatsapp);

                $.ajax({
                    url: "{{ route('passengerDetails') }}",
                    type: "POST",
                    data: {
                        adult_count:adult_count,
                        child_count:child_count,
                        infant_count:infant_count,
                        first_name: first_name,
                        last_name: last_name,
                        gender: gender,
                        passport_no:passport_no,
                        passport_country_code:passport_country_code,
                        passport_expiry_date:passport_expiry_date,

                        first_name_child: first_name_child,
                        last_name_child: last_name_child,
                        gender_child: gender_child,
                        passport_no_child:passport_no_child,
                        passport_country_code_child :passport_country_code_child,
                        passport_expiry_date_child :passport_expiry_date_child,

                        first_name_infant : first_name_infant,
                        last_name_infant : last_name_infant,
                        gender_infant: gender_infant,
                        dob_infant: dob_infant,
                        passport_no_infant:passport_no_infant,
                        passport_country_code_infant : passport_country_code_infant,
                        passport_expiry_date_infant :passport_expiry_date_infant,

                        is_domestic:is_domestic,
                        email: email,
                        mobile: mobile,
                        country_code: country_code,
                        priceIds: priceIds,
                        whatsapp: whatsapp,
                        _token: _token,
                    },
                    beforeSend: function() {
                        $('#overlay').fadeIn();
                    },
                    success: function(result) {
                        //  alert(result);
                        // console.log(result);
                        window.location.href =
                            "{{ route('seatSelection') }}?<?php echo $priceIds; ?>&bookingId=<?php echo $bookingId; ?> ";
                    },
                    complete: function() {
                        $('#overlay').fadeOut();
                    }
                });


                return false;
            });
        });
    </script>
@endsection
