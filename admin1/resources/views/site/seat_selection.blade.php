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

    </style>
@endsection

@section('content')

    <section class="">
        <div id="loader_div" class="loader_div"></div>
        <div class="bg-grey" style="height: 300px; margin-bottom: -270px;"></div>
        <div class="container container-make">
            <div class="row">
                <div class="col-md-9 p-3">
                    <h5><b>Complete your booking</b></h5>
                   <div class="card">
                     <div class="card-body">

                          <div class="mt-3 mb-3 cancelation-tab">
                           <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                  <i class="fa-solid fa-seat-airline"></i> Seats</button>
                               </li>
                               @foreach ($review->tripInfos as $k=>$v )
                                                                @foreach ($v->sI as $k1=>$v1 )
                                                                @if(isset($v1->ssrInfo->MEAL))
                               <li class="nav-item" role="presentation">
                                 <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Meals</button>
                               </li>
                               @endif
                               @endforeach
                               @endforeach
                             </ul>
                             <div class="tab-content ps-3" id="pills-tabContent">
                               @if($result_array->status->success == true && $result_array->status->httpStatus == 200 )
                               @if(isset($review->tripInfos))
                               @if(isset($result_array->tripSeatMap))

                               <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                  <div class="hyderabad-booking">
                                    @foreach ($review->tripInfos as $k=>$v )
                                    @foreach ($v->sI as $k1=>$v1 )
                                    {{-- {{ print_r($v1); }} --}}

                                    <h6>{{ $v1->da->city }} - {{ $v1->aa->city }}</h6>
                                  {{-- <p>0 of 1 selected</p> --}}

                                    @endforeach



                                  @endforeach($review->tripInfos)
                                </div>
                                  <div class="row align-items-end">
                                     <div class="col-md-4">
                                      {{-- <div class="row bussiness-p">
                                        <div class="col-md-3 ">
                                          <img src="assets/img/portfolio64.png" class="img-fluid">
                                        </div>
                                        <div class="col-md-9 ps-0" >
                                           <p>Bussiness Class</p>
                                           <p>18 Seats <span >(79- in pitch)</span></p>
                                        </div>
                                      </div> --}}


                                      {{-- <div class="row bussiness-p mt-3">
                                        <div class="col-md-3 ">
                                          <img src="assets/img/sofa64.png" class="img-fluid">
                                        </div>
                                        <div class="col-md-9 ps-0" >
                                           <p>Economy Class</p>
                                           <p>236 Seats <span >(33- in pitch)</span></p>
                                        </div>
                                      </div> --}}

                                      <!-- <ul class="bussiness-ul">
                                        <li><span><img src="assets/img/preferred-seats.png" class="img-fluid"> </span> <p>39 Preffered Seats <span >(34- in pitch)</span></p></li>

                                        <li><span><img src="assets/img/preferred-seats1.png" class="img-fluid"> </span> <p>5 Bassinet Seats</p></li>
                                        <li><span><img src="assets/img/preferred-seats2.png" class="img-fluid"> </span> <p>14 Extra Leg Space Seats</p></li>

                                        <li><span><img src="assets/img/preferred-seats3.png" class="img-fluid"> </span> <p>2 Windowless Seats</p></li>

                                        <li><span><img src="assets/img/preferred-seats4.png" class="img-fluid"> </span> <p>Emergency Exit Seats <span >fixed armered seats</span></p></li>

                                        <li><span><img src="assets/img/preferred-seats5.png" class="img-fluid"> </span> <p>Emergency Seats</p></li>
                                      </ul> -->
                                      <ul class="bussiness-ul">
                                        <li><span class="new-li"><i class="fa-regular fa-square"></i> </span> <p>{{ $isBookedfalse }} Seats Available</p></li>
                                        {{-- <li><span class="select-li"><i class="fa-solid fa-square"></i> </span> <p> Select </p></li> --}}
                                        <li><span class="booked-li"><i class="fa-solid fa-rectangle-xmark"></i> </span> <p>{{ $isBookedtrue }} Seats Booked</p></li>
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">Tooltip on top</button> -->
                                      </ul>

                                     </div>
                                      <div class="col-md-8  meals-seats">
                                       <div class="seats-bg">
                                        <!-- <img src="assets/img/flight-booking-img.png" class="img-fluid"> -->
                                        <img src="{{ 'assets/img/booking-front-crop.png' }}" class="img-fluid">
                                        <div class="flight-seats">
                                            @foreach($result_array->tripSeatMap->tripSeat as $key=>$value)
                                            <?php
                                                $row = $value->sData->row;
                                                $column = $value->sData->column;
                                            ?>

{{-- {{ print_r($value->sData->row) }} --}}
@for($i=1;$i<=$row;$i++)

                                          <ul class="select-seat-ul">


                                            <?php $sc =1;  ?>
                                            @foreach ($value->sInfo as $k=>$seat)
{{-- {{ print_r($seat->seatPosition->row) }} --}}
<?php $cnt = $column/2; ?>

@for($j=1;$j<=$column;$j++)

                                    @if($seat->seatPosition->row == $i && $seat->seatPosition->column == $j)
                                    <?php  $sc++; ?>
                                        @php if($seat->isBooked == true){
                                            echo '<li class="seat-booked" data-bs-toggle="tooltip" data-bs-placement="top" title="Sorry! This seat is taken"> <i class="fa-solid fa-rectangle-xmark"></i> </li>';

                                        }else{
                                            if(isset($seat->isLegroom)){
                                                if(isset($seat->isAisle)){
                                                echo '<li id="seat'.$seat->code.'" onclick="seatSelection('."'$seat->code','$seat->amount'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' Aisle Seat | Extra Legroom Seat | '.$seat->amount.'">XL</li>';
                                            }else{
                                                echo '<li id="seat'.$seat->code.'" onclick="seatSelection('."'$seat->code','$seat->amount'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' Extra Legroom seat | '.$seat->amount.'">XL</li>';
                                            }
                                            }
                                            else{
                                                if(isset($seat->isAisle)){
                                                echo '<li id="seat'.$seat->code.'" onclick="seatSelection('."'$seat->code','$seat->amount'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' Aisle Seat | '.$seat->amount.'">'. $seat->seatNo.'</li>';
                                                }else{
                                                    echo '<li id="seat'.$seat->code.'" onclick="seatSelection('."'$seat->code','$seat->amount'".')" class="seat-open" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$seat->seatNo.' | '.$seat->amount.'">'. $seat->seatNo.'</li>';
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
                                          @endforeach


                                        </div>
                                        <img src="assets/img/booking-black.png" class="img-fluid">
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                  @endif
                                  @else
                                  <h4>{{ $review->errors[0]->errCode.' - '.$review->errors[0]->message }}</h4>

                                  @endif
                                  @else

                                        <h4>{{ $result_array->errors[0]->errCode.' - '.$result_array->errors[0]->message }}</h4>
                                  @endif



                             <!-- Meals tab -->

                               <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">



                                 <div class="carousel-indicators">
                                   <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                                   <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                                   <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                                 </div>




                                        <div class="slider" id="demo">
                                                         <div class="testimonials mb-8">
                                                           <label class="item" for="t-1">
                                                            @if(isset($review->tripInfos))
                                                             <div class="mycard">

                                                               <div class="row align-items-center border-bottom">
                                                                 <div class="col-md-6 meals-border-left">
                                                                    @foreach ($review->tripInfos as $k=>$v )
                                    @foreach ($v->sI as $k1=>$v1 )
                                                                   <h6>{{ $v1->da->city }} to {{  $v1->aa->city  }}</h6>
                                                                    {{-- <p>0 of 1 Meals Selected</p> --}}
                                                                    @endforeach
                                                                    @endforeach
                                                                 </div>

                                                                 {{-- <div class="col-md-6 meals-input">
                                                                   <input type="checkbox" name="">
                                                                   <span>Veg</span>
                                                                   <input type="checkbox" name="">
                                                                   <span>Non-Veg</span>
                                                                 </div> --}}
                                                               </div>
                                                               @foreach ($review->tripInfos as $k=>$v )
                                                                @foreach ($v->sI as $k1=>$v1 )
                                                                @if(isset($v1->ssrInfo->MEAL))
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

                                                                  <button class="btn btn-add">ADD</button>
                                                                 </div>
                                                               </div>

                                                               @endforeach
                                                               @endif
                                                                    @endforeach
                                                                    @endforeach



                                                             </div>
                                                             @else
                                  <h4>{{ $review->errors[0]->errCode.' - '.$review->errors[0]->message }}</h4>

                                  @endif
                                                           </label>

                                                         </div>


                                                       </div>

                                           </div>

                               <!-- End of Meals tab -->




                             </div>

                       </div>

                           <div class="row mt-5">
                              <div class="col-md-3 ms-auto">
                                <button class="btn btn-blue-continue"> Procced to Pay</button>
                              </div>
                             </div>
                             </div>





                     </div>
                   </div>



            <div class="col-md-3 p-3 mt30 ">
                @if($review->status->success == true && $review->status->httpStatus == 200 )
                               @if(isset($review->tripInfos))
                               <?php
                               $adult = $review->searchQuery->paxInfo->ADULT

                               ?>

                <div class="card">
                    <div class=" card-body card-shadow">
                        <h5><b>Fare Summary</b></h5>

                        <div class="accordion" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne">
                                        <span class="ms-2">Base Fare </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> {{ $adult *$review->totalPriceInfo->totalFareDetail->fC->BF }}</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    <small class="ms-0">
                                        <span>Base Fare </span>
                                        <span class="float-end"> Adult(s) ({{ $adult }} X ₹ {{ $review->totalPriceInfo->totalFareDetail->fC->BF }})</span>
                                    </small>
                                </div>
                            </div>
                        </div>


                        <div class="accordion mt-2" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne2">
                                        <span class="ms-2">Fee & Surcharges </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> {{ $adult * $review->totalPriceInfo->totalFareDetail->fC->TAF }}</span>
                                    </button>
                                </h2>
                                <div id="collapseOne2" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    {{-- <small class="ms-3">
                                        <span>Other Charges </span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> 125</span>
                                    </small> --}}
                                </div>
                            </div>
                        </div>

                        <div class="accordion mt-2 d-none othercharges" id="myAccordion"  >
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne3">
                                        <span class="ms-2">Other Charges </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> <span id="othercharges"> </span></span>
                                    </button>
                                </h2>
                                <div id="collapseOne3" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    <small class="ms-3">
                                        <span>Seats</span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> <span id="seat_amt"></span></span>
                                    </small>
                                </div>
                            </div>
                            <div class="border-dassed"></div>
                        </div>

                        <div class="row ">
                            <div class="col-md-7">
                                <b>Total Amount</b>
                            </div>
                            <?php $ttl_price = $adult * ($review->totalPriceInfo->totalFareDetail->fC->BF+$review->totalPriceInfo->totalFareDetail->fC->TAF) ?>
                            <div class="col-md-5  text-end">
                                <i class="fa-solid fa-indian-rupee-sign"></i> <span data-ttl_price="{{ $ttl_price }}" id="ttl_price">{{ $ttl_price }}</span>
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

@section('script-content')
    <!-- Meals Carousel -->

    <script type="text/javascript">
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
      </script>

      <script>
            function seatSelection(code,seat_amt){
                // alert(code+' - '+amount)
                $("#loader_div").show();
                setTimeout(function() {
                    $("#loader_div").hide();
                }, 3000);
                var ttl_price = $('#ttl_price').attr('data-ttl_price');
                var price = parseFloat(ttl_price)+parseFloat(seat_amt);
                $('.othercharges').removeClass('d-none');
                $('#othercharges').html(seat_amt);
                $('#seat_amt').html(seat_amt);
                $('#ttl_price').html(price);
                $("#seat"+code).removeClass('seat-open');
                $("#seat"+code).addClass('seat-select');
                var count = $('.seat-select').length;
                alert(count)
                // $("#seat"+code).html('<i class="fa-solid fa-square"></i>');
            }
        </script>
@endsection
