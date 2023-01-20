@extends('layouts.app')
@section('style-content')
    <link href="assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <style>
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
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        /*::-webkit-scrollbar-track {
              box-shadow: inset 0 0 5px grey;
              border-radius: 10px;
            }*/

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #c1c1c1;
        }

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
    </style>




    <!-- Meals carousel -->

    <style>
        .mycard {
            height: 450px;
            overflow: scroll;
            width: 100%;
        }

        .cardtitle {
            font-weight: bold;
            --tw-text-opacity: 1;
            color: rgba(31, 41, 55, var(--tw-text-opacity));
            text-align: center;
        }

        .cardimg {
            margin-left: auto;
            margin-right: auto;
            margin-top: 2.75rem;
            margin-bottom: 2.75rem;
            max-height: 6rem;
            border-radius: 9999px;
        }

        .carddescription {
            --tw-text-opacity: 1;
            color: rgba(107, 114, 128, var(--tw-text-opacity));
            text-align: center;
        }

        .slider {
            width: 100%;

            min-height: 385px;
        }

        .slider input {
            visibility: hidden;
        }

        .testimonials {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 375px;
            perspective: 500px;
            overflow: hidden;
        }

        .testimonials .item {
            width: 85% !important;
            border-radius: 0px;
            border-width: 2px;
            --tw-border-opacity: 1;
            border-color: rgba(30, 58, 138, var(--tw-border-opacity));
            top: 5px;
            left: 3px;
            position: absolute;
            box-sizing: border-box;
            background-color: #fff;
            padding: 10px;
            width: 450px;
            text-align: center;
            transition: transform 0.4s;
            -webkit-transform-style: preserve-3d;
            box-shadow: 0 0 10px rgb(0 0 0 / 30%);
            user-select: none;
            cursor: pointer;
        }

        .testimonials .item h2 {
            font-size: 14px;
        }

        .dots {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dots label {
            display: block;
            height: 5px;
            width: 5px;
            border-radius: 50%;
            cursor: pointer;
            background-color: #413b52;
            margin: 7px;
            transition: transform 0.2s, color 0.2s;
        }

        /* First */
        #t-1:checked~.dots label[for="t-1"] {
            transform: scale(2);
            background-color: #fff;
        }

        #t-1:checked~.dots label[for="t-2"] {
            transform: scale(1.5);
        }

        #t-1:checked~.testimonials label[for="t-1"] {
            z-index: 4;
        }

        #t-1:checked~.testimonials label[for="t-2"] {
            transform: translateX(300px) translateZ(-90px) translateY(-15px);

            z-index: 3;
        }

        #t-1:checked~.testimonials label[for="t-3"] {
            transform: translateX(600px) translateZ(-180px) translateY(-30px);
            z-index: 2;
        }

        #t-1:checked~.testimonials label[for="t-4"] {
            transform: translateX(900px) translateZ(-270px) translateY(-45px);
            z-index: 1;
        }

        #t-1:checked~.testimonials label[for="t-5"] {
            transform: translateX(1200px) translateZ(-360px) translateY(-60px);
        }

        /* Second */
        #t-2:checked~.dots label[for="t-1"] {
            transform: scale(1.5);
        }

        #t-2:checked~.dots label[for="t-2"] {
            transform: scale(2);
            background-color: #fff;
        }

        #t-2:checked~.dots label[for="t-3"] {
            transform: scale(1.5);
        }

        #t-2:checked~.testimonials label[for="t-1"] {
            transform: translateX(-300px) translateZ(-90px) translateY(-15px);
        }

        #t-2:checked~.testimonials label[for="t-2"] {
            z-index: 3;
            left: 300px;
        }

        #t-2:checked~.testimonials label[for="t-3"] {
            transform: translateX(300px) translateZ(-90px) translateY(-15px);
            z-index: 2;
        }

        #t-2:checked~.testimonials label[for="t-4"] {
            transform: translateX(600px) translateZ(-180px) translateY(-30px);
            z-index: 1;
        }

        #t-2:checked~.testimonials label[for="t-5"] {
            transform: translateX(900px) translateZ(-270px) translateY(-45px);
        }
        .seat-selected {
            background: #7dd3e5;
                color: white;
                border: 1px solid #7dd3e5;
                height: 35px;
        }
        .meal-selected{
            background: green;
        color: white;
        }

    </style>
@endsection

@section('content')

<?php
$priceIds = $_REQUEST;
// print_r(($priceIds)); exit();
$priceIds=http_build_query($priceIds);
$keyIds = explode('&',$priceIds);
foreach ($keyIds as $key => $val){
            $priceIdss[] = substr($val,6);  //pkey1= by default removing 6 str
        }
        array_pop($priceIdss);
        $segment_key = $priceIdss;

        // dd(count($segment_key));
    //   dd($segment_key);

?>

<input type="hidden" name="no_of_passenger" id="no_of_passenger" value="{{ count($request->session()->get('first_name')) }}">

    <section class="">
        <div id="loader_div" class="loader_div"></div>
        <div class="bg-grey" style="height: 300px; margin-bottom: -270px;"></div>
        <div class="container container-make">
            <div class="row">
                <div class="col-md-9 p-3">
                    <h5><b>Complete your booking</b></h5>
                   <div class="card">
                     <div class="card-body">
                        <input type="hidden" name="bookingId" id="bookingId" class="form-control" placeholder="" value="<?php echo $_GET['bookingId']; ?>">

                          <div class="mt-3 mb-3 cancelation-tab">
                           <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            @if($review->status->success == true && $review->status->httpStatus==200)
                            @if($result_array->status->success == true && $result_array->status->httpStatus == 200 )
                            @if(isset($review->tripInfos))
                            @if(isset($result_array->tripSeatMap))



@foreach ($result_array->tripSeatMap->tripSeat as $k =>$v )

<li class="nav-item" role="presentation">
    <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home{{ $k }}" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
     <i class="fa-solid fa-seat-airline"></i> Seats{{ $k }}</button>
  </li>

@endforeach

                               @endif
                               @endif
                               @endif
                               @endif

                               @if(isset($review->tripInfos))
                               @foreach ($review->tripInfos as $k=>$v )
                                                                @foreach ($v->sI as $k1=>$v1 )
                                                                @if(isset($v1->ssrInfo->MEAL))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile{{ $v1->id }}" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Meals{{ $v1->id }}</button>
                                </li>

                               @endif
                               @endforeach
                               @endforeach
                               @endif
                               {{-- @else
                               {{ $review->errors[0]->message }} --}}

                             </ul>
                             <div class="tab-content ps-3" id="pills-tabContent">
                               @if($result_array->status->success == true && $result_array->status->httpStatus == 200 )
                               @if(isset($review->tripInfos))
                               @if(isset($result_array->tripSeatMap))

                               <?php $flight_array = array(); $segment_array=array(); ?>
                               <?php   $segment_id = 0; ?>
                               @foreach ($review->tripInfos as $k=>$v )

                                    @foreach ($v->sI as $k1=>$v1 )

                                   <?php
                                   array_push($flight_array,$v1);
                                   array_push($segment_array,$segment_id);
                                   ?>

                                    <!--<h6>{{ $v1->da->city }} - {{ $v1->aa->city }}</h6>-->

                                @endforeach
                            @php   $segment_id++; @endphp
                          @endforeach
@php  $seg_id=0; @endphp
                               @foreach($result_array->tripSeatMap->tripSeat as $key=>$value)

                               @if(isset($value->sData))
                               {{-- {{ print_r($result_array->tripSeatMap->tripSeat) }} --}}
                                            <?php
                                                $row = $value->sData->row;
                                                $column = $value->sData->column;
                                            ?>

                        <div class="tab-pane fade show " id="pills-home{{ $key }}" role="tabpanel" aria-labelledby="pills-home-tab">
                                  <div class="hyderabad-booking">


                                    <h6>{{ $flight_array[$seg_id]->da->city }} - {{ $flight_array[$seg_id]->aa->city }}</h6>
                                  {{-- <p>0 of 1 selected</p> --}}

                                </div>

                                <div class="row align-items-end">
                                     <div class="col-md-4">

                                      <ul class="bussiness-ul">
                                        <!--<li><span class="new-li"><i class="fa-regular fa-square"></i> </span> <p>{{ $isBookedfalse }} Seats Available</p></li>-->

                                        <!--<li><span class="booked-li"><i class="fa-solid fa-rectangle-xmark"></i> </span> <p>{{ $isBookedtrue }} Seats Booked</p></li>-->

                                      </ul>

                                </div>
                                      <div class="col-md-8  meals-seats">
                                       <div class="seats-bg">
                                        <!-- <img src="assets/img/flight-booking-img.png" class="img-fluid"> -->
                                        <img src="{{ 'assets/img/booking-front-crop.png' }}" class="img-fluid">
                                        <div class="flight-seats">


{{-- {{ print_r($value->sData->row) }} --}}
@for($i=1;$i<=$row;$i++)

                                          <ul class="select-seat-ul">
                                            <input type="hidden" name="seat_chrge" id="seat_chrge" value="0">

                                            <?php $sc =1;  ?>
                                            @foreach ($value->sInfo as $k=>$seat)
{{-- {{ print_r($seat->seatPosition->row) }} --}}
<?php $cnt = $column/2; ?>

@for($j=1;$j<=$column;$j++)

                                    @if($seat->seatPosition->row == $i && $seat->seatPosition->column == $j)
                                    <?php  $sc++; ?>
                                        @php if($seat->isBooked == true){
                                            echo '<li class="seat-booked" data-bs-toggle="tooltip" data-bs-placement="top" title="Sorry! This seat is taken"> <i class="fa-solid fa-times"></i> </li>';

                                        }else{
                                            if(isset($seat->isLegroom)){
                                                if(isset($seat->isAisle)){
                                                echo '<li  data-segment_key="'.$segment_key[$segment_array[$seg_id]].'" data-seat_code="'.$seat->code.'" id="seat'.$seat->code.$key.'" onclick="seatSelection('."'$seat->code','$seat->amount','$key'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' Aisle Seat | Extra Legroom Seat | '.$seat->amount.'">XL</li>';
                                            }else{
                                                echo '<li data-segment_key="'.$segment_key[$segment_array[$seg_id]].'" data-seat_code="'.$seat->code.'" id="seat'.$seat->code.$key.'" onclick="seatSelection('."'$seat->code','$seat->amount','$key'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' Extra Legroom seat | '.$seat->amount.'">XL</li>';
                                            }
                                            }
                                            else{
                                                if(isset($seat->isAisle)){
                                                echo '<li  data-segment_key="'.$segment_key[$segment_array[$seg_id]].'" data-seat_code="'.$seat->code.'" id="seat'.$seat->code.$key.'" onclick="seatSelection('."'$seat->code','$seat->amount','$key'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' Aisle Seat | '.$seat->amount.'">'. $seat->seatNo.'</li>';
                                                }else{
                                                    echo '<li data-segment_key="'.$segment_key[$segment_array[$seg_id]].'" data-seat_code="'.$seat->code.'" id="seat'.$seat->code.$key.'" onclick="seatSelection('."'$seat->code','$seat->amount','$key'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' | '.$seat->amount.'">'. $seat->seatNo.'</li>';
                                                }
                                            }


                                         }

                                        @endphp
                                    @elseif($seat->seatPosition->row == $i && round($cnt) == $sc)
                                    <li class="select-seat-space"></li>
<?php  $sc++; ?>
                                        @endif
                                        @endfor
                                            @endforeach

                                          </ul>

                                          @endfor



                                        </div>
                                        <img src="{{ 'assets/img/booking-black.png' }}" class="img-fluid">
                                      </div>
                                      </div>
                                    </div>
                                  </div>

                                @else

                                <h4>{{  $value->nt }}</h4>
                                @endif
                                <?php $seg_id++; ?>
                                  @endforeach
                                  @endif
                                  @else
                                  <h4>{{ $review->errors[0]->errCode.' - '.$review->errors[0]->message }}</h4>

                                  @endif
                                  @else

                                        <h4>{{ $result_array->errors[0]->errCode.' - '.$result_array->errors[0]->message }}</h4>
                                  @endif



                             <!-- Meals tab -->
                             @if(isset($review->tripInfos))

                             @php
                             $seg_m_id = 0;
                             @endphp
                             @foreach ($review->tripInfos as $k=>$v )

                                            @foreach ($v->sI as $k1=>$v1 )
                                            @if(isset($v1->ssrInfo->MEAL))
                               <div class="tab-pane fade" id="pills-profile{{ $v1->id }}" role="tabpanel" aria-labelledby="pills-profile-tab">
                                 {{-- <div class="carousel-indicators">
                                   <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                                   <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                                   <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                                 </div> --}}
                                <div class="slider" id="demo">
                                                         <div class="testimonials mb-8">
                                                           <label class="item" for="t-1">

                                                             <div class="mycard">

                                                               <div class="row align-items-center border-bottom">
                                                                 <div class="col-md-6 meals-border-left">
                                                                    {{-- @foreach ($review->tripInfos as $k=>$v )
                                    @foreach ($v->sI as $k1=>$v1 ) --}}
                                                                   <h6>{{ $v1->id }}{{ $v1->da->city }} to {{  $v1->aa->city  }}</h6>
                                                                    {{-- <p>0 of 1 Meals Selected</p> --}}
                                                                    {{-- @endforeach
                                                                    @endforeach --}}
                                                                 </div>

                                                                 {{-- <div class="col-md-6 meals-input">
                                                                   <input type="checkbox" name="">
                                                                   <span>Veg</span>
                                                                   <input type="checkbox" name="">
                                                                   <span>Non-Veg</span>
                                                                 </div> --}}
                                                               </div>

                                                                {{-- @if(isset($v1->ssrInfo->MEAL)) --}}
                                                                @foreach ($v1->ssrInfo->MEAL as $k2=>$v2 )
                                                               <div class="row align-items-center meals-parent">
                                                                 <div class="col-md-2 ">
                                                                   <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                                 </div>
                                                                 <div class="col-md-8 meals-headtxt">
                                                                  <h6>{{ $v2->desc }}</h6>
                                                                  @if(isset($v2->amount))
                                                                  <p><b><i class="fa-solid fa-indian-rupee-sign"></i> {{ $v2->amount }}</b></p>
                                                                  @endif
                                                                 </div>
                                                                 <div class="col-md-2 ">
                                                                    <?php
                                                                        if(isset($v2->amount)){
                                                                            $meal_amt = $v2->amount;
                                                                        }else{
                                                                            $meal_amt = 0;
                                                                        }
                                                                    ?>
                                                                    <input type="hidden" name="meal_amount" id="meal_amount" value="0">
{{-- {{ dd($segment_key, $k) }} --}}
                                                                  <button data-segment_key="{{ $segment_key[$segment_array[$seg_m_id]] }}" data-meal_code="{{ $v2->code }}"  class="btn btn-add" id="meal_code{{ $v2->code }}{{ $v1->id }}" onclick="addMeals('{{ $v2->code }}','{{ $meal_amt }}','{{ $v1->id }}')">ADD</button>
                                                                 </div>
                                                               </div>
                                                               @endforeach
                                                             </div>

                                                           </label>

                                                         </div>


                                                       </div>

                                           </div>
                                           @endif
                                          @php $seg_m_id++ ; @endphp
                                           @endforeach
                                           @endforeach

                                           @else
                                           <h4>{{ $review->errors[0]->errCode.' - '.$review->errors[0]->message }}</h4>

                                           @endif
                               <!-- End of Meals tab -->


                             </div>

                       </div>

                       <div class="mt-5 float-end d-flex">
                        {{-- <div class="" data-bs-toggle="modal" data-bs-target="#confirmBookingModal">
                          <button class="btn btn-blue-continue confirmBooking1"><a> Skip & Procced</a></button>
                        </div> --}}
                        <div class="ms-1" data-bs-toggle="modal" data-bs-target="#confirmBookingModal">
                          <button class="btn btn-blue-continue confirmBooking1" ><a> Procced to Pay</a></button>
                        </div>
                       </div>
                            </div>
                     </div>
                   </div>




            <div class="col-md-3 p-3 mt30 ">
                @if($review->status->success == true && $review->status->httpStatus == 200 )
                    @if(isset($review->tripInfos))
                    @php

                        $adults = $review->searchQuery->paxInfo->ADULT; ////get total adult list
                        $childs = $review->searchQuery->paxInfo->CHILD; //get total childs
                        $infants = $review->searchQuery->paxInfo->INFANT; //get total infants

                    foreach($review->tripInfos as $key => $priceList){
                        foreach($priceList->totalPriceList as $k=>$pList){
                            /* adults base fare */
                            // dd($pList);
                        if(isset($pList->fd->ADULT->fC->BF)){
                                    $adult_bf =  $pList->fd->ADULT->fC->BF;
                                    $adult_tax = $adults * $pList->fd->ADULT->fC->TAF;
                                    // start adult tax
                                $adult_OT = $adults * $pList->fd->ADULT->afC->TAF->OT;
                                $adult_MF = $adults * $pList->fd->ADULT->afC->TAF->MF;
                                $adult_MFT = $adults * $pList->fd->ADULT->afC->TAF->MFT;
                                $adult_AGST = $adults * $pList->fd->ADULT->afC->TAF->AGST;
                                $adult_YQ = $adults * $pList->fd->ADULT->afC->TAF->YQ;
                                //end adult tax
                                }else{
                                    $adult_bf = 0;
                                    $adult_tax=0;
                                    $adult_OT=0;
                                    $adult_MFT=0;
                                    $adult_AGST=0;
                                    $adult_YQ =0;
                            }

                             /* childrens base fare */
                        if(isset($pList->fd->CHILD->fC->BF)){
                                    $child_bf =  $pList->fd->CHILD->fC->BF;
                                    $child_tax = $pList->fd->CHILD->fC->TAF;
                                    // start child tax
                                $child_OT = $childs * $pList->fd->CHILD->afC->TAF->OT;
                                $child_MF = $childs * $pList->fd->CHILD->afC->TAF->MF;
                                $child_MFT = $childs * $pList->fd->CHILD->afC->TAF->MFT;
                                $child_AGST = $childs * $pList->fd->CHILD->afC->TAF->AGST;
                                $child_YQ = $childs * $pList->fd->CHILD->afC->TAF->YQ;
                                }else{
                                    $child_bf = 0;
                                    $child_tax = 0;
                                    $child_OT = 0;
                                    $child_MF = 0;
                                    $child_MFT = 0;
                                    $child_AGST = 0;
                                    $child_YQ = 0;
                            }
                            /* infants base fare */
                        if(isset($pList->fd->INFANT->fC->BF)){
                                    $infant_bf =  $pList->fd->INFANT->fC->BF;
                                    $infant_tax= $infants * $pList->fd->INFANT->fC->TAF;
                                    //start infant tax
                                    $infants_OT = $infants * $pList->fd->INFANT->afC->TAF->OT;
                                $infants_MF = $infants * $pList->fd->INFANT->afC->TAF->MF;
                                $infants_MFT = $infants * $pList->fd->INFANT->afC->TAF->MFT;
                                $infants_AGST = $infants * $pList->fd->INFANT->afC->TAF->AGST;
                                $infants_YQ = $infants * $pList->fd->INFANT->afC->TAF->YQ;

                                    //end infant tax
                                }else{
                                    $infant_bf = 0;
                                    $infant_tax = 0;
                                    $infants_OT = 0;
                                    $infants_MF = 0;
                                    $infants_MFT = 0;
                                    $infants_AGST = 0;
                                    $infants_YQ = 0;
                            }

                        }

                    }




                        $is_domestic = $review->searchQuery->isDomestic;

                        $ttl_adlut_bf = $adults*$adult_bf;
                        $ttl_child_bf = $childs*$child_bf;
                        $ttl_infant_bf = $infants*$infant_bf;

                        $basefare = $ttl_adlut_bf+$ttl_child_bf+$ttl_infant_bf;  //getting base fare for total trips

                        $Taxes_trip = $adult_tax + $child_tax + $infant_tax; //getting taxes for total trips

                        $TotalAmount = $basefare + $Taxes_trip;  ///calculating total amount with base fare and taxes


                       // total taxes break up
                                $OT = $adult_OT + $child_OT + $infants_OT;
                                $MF = $adult_MF + $child_MF + $infants_MF;
                                $MFT = $adult_MFT + $child_MFT + $infants_MFT;
                                $AGST = $adult_AGST + $child_AGST + $infants_AGST;
                                $YQ = $adult_YQ + $child_YQ + $infants_YQ;
                    @endphp
{{-- alert fare if changed --}}
@if(isset($review->alerts[0]))
    <div class="card mb-3">
        <div class=" card-body card-shadow">
            <h5><b>Fare Price</b></h5>
            <div class="row">
                <div class="col-md-6 fare-P">
                    <h4><i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                        {{ number_format($review->alerts[0]->newFare, 2) }}</h4>
                    <small>New price</small>
                </div>
                <div class="col-md-6 fare-P">
                    <h4 class="text-olld"><i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                        {{ number_format($review->alerts[0]->oldFare, 2) }}</h4>
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
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne">
                                        <table width="100%">
                                            <tr>
                                                <td width="">
                                                    <span class="ps-1">Base Fare</span>
                                                </td>
                                                <td width="60%">
                                                    <span class="d-flex justify-content-end icon_style">
                                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ number_format($review->totalPriceInfo->totalFareDetail->fC->BF, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
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

                                    {{-- <small class="ms-0">
                                        <span>Base Fare </span>
                                        <span class="float-end"> Adult(s) ({{ $adult }} X ₹ {{ $review->totalPriceInfo->totalFareDetail->fC->BF/$adult }})</span>
                                    </small> --}}
                                </div>
                            </div>
                        </div>


                        <div class="accordion mt-2" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne2">
                                        <table>
                                            <tr>
                                                <td>
                                                    <span class="ps-1">Fee & Surcharges</span>
                                                </td>
                                                <td>
                                                    <span class="d-flex icon_style">
                                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ number_format($Taxes_trip, 2) }}
                                                    </span>
                                                </td>
                                            </tr>

                                        </table>
                                        {{-- <span class="ms-2">Fee & Surcharges </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> {{ $review->totalPriceInfo->totalFareDetail->fC->TAF }}</span> --}}
                                    </button>
                                </h2>
                                {{-- <div id="collapseOne2" class="accordion-collapse collapse" data-bs-parent="#myAccordion"> --}}
                                    {{-- <small class="ms-3">
                                        <span>Other Charges </span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> 125</span>
                                    </small> --}}
                                {{-- </div> --}}

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

                        <div class="accordion mt-2 d-none othercharges" id="myAccordion"  >
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne3">
                                        <span class="ms-2">Other Charges </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> <span id="othercharges"> </span></span>
                                    </button>
                                </h2>
                                <div id="collapseOne3" class="accordion-collapse collapse seat_amt d-none" data-bs-parent="#myAccordion">
                                    <small class="ms-3">
                                        <span>Seats</span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> <span id="seat_amt"></span></span>
                                    </small>
                                </div>
                                <div id="collapseOne3" class="accordion-collapse collapse meal_amt d-none" data-bs-parent="#myAccordion">
                                    <small class="ms-3">
                                        <span>Meals</span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> <span id="meal_amt"></span></span>
                                    </small>
                                </div>
                            </div>
                            <div class="border-dassed"></div>
                        </div>

                        <div class="row ">
                            <div class="col-md-7">
                                <b>Total Amount</b>
                            </div>
                            @php $ttl_price = $TotalAmount @endphp
                            <div class="col-md-5  text-end">
                                <i class="fa-solid fa-indian-rupee-sign"></i> <span data-ttl_price="{{ $ttl_price }}" id="ttl_price">{{ $ttl_price }}</span>
                                <input type="hidden" name="other_charges" id="other_charges" value=0>
                            </div>
                        </div>


                    </div>
                </div>
                @else
                <h4>{{ $review->errors[0]->errCode.' - '.$review->errors[0]->message }}</h4>

                @endif
                @endif
            </div>

        </div>
        </div>
    </section>
@endsection

@section('modals')

@include('site.modals.confirm_booking_pop_up')

@endsection

@section('script-content')
    <!-- Meals Carousel -->

    <script type="text/javascript">

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

      </script>

      <script>
            function seatSelection(code,seat_amt,flight_id){
                // alert(code+' - '+amount)
                var seat_selection = $('.seat-selected'+flight_id).length;
                var seat_charge=0;
                var selected_seat = $('.'+code+flight_id).length;
                var other_charge = $('#other_charges').val();
                var seat_chrge = $('#seat_chrge').val();
                var ttl_price = $('#ttl_price').attr('data-ttl_price');
                var no_of_passenger = $('#no_of_passenger').val();
                var all_seat_selected = $('.seat-selected').length;
                $("#loader_div").show();

                if(seat_selection < no_of_passenger){

            if(selected_seat == 0){
                setTimeout(function() {
                    $("#loader_div").hide();
                }, 3000);

                if(other_charge>0){
                        seat_charge = parseFloat(other_charge)+parseFloat(seat_amt);
                        var ttl_seat_charge = parseFloat(seat_chrge)+parseFloat(seat_amt);
                }else{
                    seat_charge = parseFloat(other_charge)+parseFloat(seat_amt);
                    var ttl_seat_charge = parseFloat(seat_chrge)+parseFloat(seat_amt);
                }


                $('#seat_chrge').val(ttl_seat_charge);
                $('#other_charges').val(seat_charge);
                var price = parseFloat(ttl_price)+parseFloat(seat_charge);
                if(seat_charge >0){
                    $('.othercharges').removeClass('d-none');
                    $('.seat_amt').removeClass('d-none');
                }else{
                    $('.othercharges').addClass('d-none');
                    $('.seat_amt').addClass('d-none');
                }

                $('#othercharges').html(seat_charge);
                $('#seat_amt').html(ttl_seat_charge);
                $('#ttl_price').html(price);
                $("#seat"+code+flight_id).addClass('seat-selected seat-selected'+flight_id+' '+ code+flight_id+' selected'+all_seat_selected);
                $("#seat"+code+flight_id).attr("data-seat_select_id",all_seat_selected);
               var segment_key=  $("#seat"+code+flight_id).attr("data-segment_key");
                $("#seat"+code+flight_id).append('<input type="hidden" name="seat_selected[]" data-flight_id="'+flight_id+'" value="'+code+'" data-segment_key = "'+segment_key+'" />');
                // alert(count)
            }else{
                setTimeout(function() {
                    $("#loader_div").hide();
                }, 3000);


                if(other_charge>0){
                        seat_charge = parseFloat(other_charge)-parseFloat(seat_amt);
                        var ttl_seat_charge = parseFloat(seat_chrge)-parseFloat(seat_amt);
                }else{
                    seat_charge = parseFloat(other_charge)+parseFloat(seat_amt);
                    var ttl_seat_charge = parseFloat(seat_chrge)+parseFloat(seat_amt);
                }

                $('#other_charges').val(seat_charge);
                var price = parseFloat(ttl_price)+parseFloat(seat_charge);

                if(seat_charge >0){
                    $('.othercharges').removeClass('d-none');
                    $('.seat_amt').removeClass('d-none');
                }else{
                    $('.othercharges').addClass('d-none');
                    $('.seat_amt').addClass('d-none');
                }
                var selected_seat_id  = $('.'+code+flight_id).data('seat_select_id');

                // alert(selected_seat_id)

                $('#seat_chrge').val(ttl_seat_charge);
                $('#othercharges').html(seat_charge);
                $('#seat_amt').html(ttl_seat_charge);
                $('#ttl_price').html(price);
                $("#seat"+code+flight_id).removeClass('seat-selected seat-selected'+flight_id+' '+ code+flight_id+' selected'+selected_seat_id);
                $("#seat"+code+flight_id+" input").remove();

            }
        }else{
            setTimeout(function() {
                    $("#loader_div").hide();
                }, 3000);

                if(selected_seat > 0){
                    if(other_charge>0){
                        seat_charge = parseFloat(other_charge)-parseFloat(seat_amt);
                        var ttl_seat_charge = parseFloat(seat_chrge)-parseFloat(seat_amt);
                }else{
                    seat_charge = parseFloat(other_charge)+parseFloat(seat_amt);
                    var ttl_seat_charge = parseFloat(seat_chrge)+parseFloat(seat_amt);
                }

                $('#seat_chrge').val(ttl_seat_charge);
                $('#other_charges').val(seat_charge);
                var price = parseFloat(ttl_price)+parseFloat(seat_charge);

                if(seat_charge >0){
                    $('.othercharges').removeClass('d-none');
                    $('.seat_amt').removeClass('d-none');
                }else{
                    $('.othercharges').addClass('d-none');
                    $('.seat_amt').addClass('d-none');
                }
                var selected_seat_id  = $('.'+code+flight_id).attr('data-seat_select_id');
                // alert(selected_seat_id)
                $('#othercharges').html(seat_charge);
                $('#seat_amt').html(ttl_seat_charge);
                $('#ttl_price').html(price);
                $("#seat"+code+flight_id).removeClass('seat-selected seat-selected'+flight_id+' '+ code+flight_id+' selected'+selected_seat_id);
                $("#seat"+code+flight_id+" input").remove();

            }else{
                alert('Seats are selected, remove to select another.');
            }

        }

            }

        function addMeals(code,meal_amt,flight_id){

                var selected_meals = $('.'+code+flight_id).length;
                var meal_selected_cnt = $('.meal-selected'+flight_id).length;
                var no_of_passenger = $('#no_of_passenger').val();

                var ttl_price = $('#ttl_price').attr('data-ttl_price');
                var other_charge = $('#other_charges').val();
                var meal_amount = $('#meal_amount').val();


                if(meal_selected_cnt <  no_of_passenger){
                    if(selected_meals == 0){

                        var ttl_meal_charge = parseFloat(meal_amount)+parseFloat(meal_amt);
                        var price = parseFloat(ttl_price)+parseFloat(other_charge)+parseFloat(meal_amt);
                        var seat_meal_charge = parseFloat(other_charge)+parseFloat(meal_amt);


                    $('#meal_code'+code+flight_id).addClass('meal-selected meal-selected'+flight_id+' '+code+flight_id+' selected_meals'+meal_selected_cnt);

                    var segment_key=  $("#meal_code"+code+flight_id).attr("data-segment_key");

                    $("#meal_code"+code+flight_id).append('<input type="hidden" name="meal_selected[]"  value="'+code+'" data-segment_key = "'+segment_key+'" data-flight_id="'+flight_id+'" />');

                    if(meal_amt > 0){
                        $('.othercharges').removeClass('d-none');
                        $('.meal_amt').removeClass('d-none');

                    }else{
                        $('.othercharges').addClass('d-none');
                        $('.meal_amt').addClass('d-none');
                    }

                    $('#other_charges').val(seat_meal_charge);
                    $('#meal_amount').val(ttl_meal_charge);
                    $('#othercharges').html(seat_meal_charge);
                    $('#meal_amt').html(ttl_meal_charge);
                    $('#ttl_price').html(price);

                }else{
                        var ttl_meal_charge = parseFloat(meal_amount)-parseFloat(meal_amt);
                        var price = parseFloat(ttl_price)+parseFloat(other_charge)-parseFloat(meal_amt);
                        var seat_meal_charge = parseFloat(other_charge)-parseFloat(meal_amt);

                    $('#other_charges').val(seat_meal_charge);
                    $('#meal_amount').val(ttl_meal_charge);

                    $('#othercharges').html(seat_meal_charge);
                    $('#meal_amt').html(ttl_meal_charge);
                    $('#ttl_price').html(price);


                    // $('#meal_code'+code+flight_id).removeClass(' meal-selected '+code+' selected_meals'+meal_selected_cnt);
                    $('#meal_code'+code+flight_id).removeClass('meal-selected meal-selected'+flight_id+' '+code+flight_id+' selected_meals'+meal_selected_cnt);

                    $("#meal_code"+code+flight_id+" input").remove();

                    if(seat_meal_charge > 0){
                        $('.othercharges').removeClass('d-none');
                        $('.meal_amt').removeClass('d-none');

                    }else{
                        $('.othercharges').addClass('d-none');
                        $('.meal_amt').addClass('d-none');
                    }
                }

                }else{

                    if(selected_meals > 0){
                        var ttl_meal_charge = parseFloat(meal_amount)-parseFloat(meal_amt);
                        var price = parseFloat(ttl_price)+parseFloat(other_charge)-parseFloat(meal_amt);
                        var seat_meal_charge = parseFloat(other_charge)-parseFloat(meal_amt);

                        $('#other_charges').val(seat_meal_charge);
                        $('#meal_amount').val(ttl_meal_charge);
                        $('#othercharges').html(seat_meal_charge);
                        $('#meal_amt').html(ttl_meal_charge);
                        $('#ttl_price').html(price);


                        $('#meal_code'+code+flight_id).removeClass('meal-selected meal-selected'+flight_id+' '+code+flight_id+' selected_meals'+meal_selected_cnt);
                        $("#meal_code"+code+flight_id+" input").remove();

                    if(seat_meal_charge > 0){
                        $('.othercharges').removeClass('d-none');
                        $('.meal_amt').removeClass('d-none');

                    }else{
                        $('.othercharges').addClass('d-none');
                        $('.meal_amt').addClass('d-none');
                    }

                    }else{
                        alert('Meals are selected');
                    }


                }

            }

            $(document).ready(function(){
                $(".confirmBooking").click(function(){

                    var no_of_passenger = parseInt($('#no_of_passenger').val());
                    // var seat_selected = $(".seat-selected");
                    // var meal_selected = $('.meal-selected');

                var seats=[];
                    $('input[name="seat_selected[]"]').each(function() {
                        seats.push({ name: 'seat_code', value: $(this).val(),flight_id:$(this).attr('data-flight_id'),segment_key:$(this).attr('data-segment_key') });
                });

                var meals=[];
                    $('input[name="meal_selected[]"]').each(function() {
                        meals.push({ name: 'meal_code', value: $(this).val(),flight_id:$(this).attr('data-flight_id'),segment_key:$(this).attr('data-segment_key') });
                });

                console.log(meals.length, seats.length);

                    var bookingId = $('#bookingId').val();
                    var ttl_price = $('#ttl_price').data('ttl_price');
                    var _token = '<?php echo csrf_token(); ?>';
console.log(ttl_price);
    // if(pasreInt(meals.length) == no_of_passenger || pasreInt(seats.length) == no_of_passenger ){
        // alert('ddd=');
                    $.ajax({
                        'type' : 'post',
                        'url' : '{{ route('proceed-to-pay') }}',
                        'dataType' :'json',
                        'data': {'seats':seats,'meals':meals,'bookingId':bookingId,'ttl_price':ttl_price,'_token':_token},
                        success: function (data){
                            console.log(data);
                            if(data.status.httpStatus == 200){
                                alert('booking confirmed');
                            }else{
                                alert(data.errors[0].message);
                            }

                        },
                        error:function(data){
                            console.log(data)
                            alert('booking not completed');
                        }
                    })

                // }else{
                //     alert('select all seats and meals')
                // }

                })
            })
        </script>
@endsection
