{{-- tab starts  --}}
<div class="data">
    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
        @if (isset($result_array->searchResult->tripInfos->COMBO))
            @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $tis)
                <div class="" id="nav-tab Content">
                    <div class="tab-pane fade show active" id="Cheapest" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                                    onclick="getFareRules({{ $tis->sI[0]->id }})">View More
                                                    Fares</a></span>
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
                                                    <p class="flight-number"><span class="brdr-btm-time">NON-STOP</span>
                                                    </p>
                                                @else
                                                    <p class="flight-number"><span class="brdr-btm-time">
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i
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
                                                                    <span class="brdr-btm-time">NON-STOP</span>
                                                                </p>
                                                            @else
                                                                <p class="flight-number">
                                                                    <span class="brdr-btm-time">
                                                                        {{ $v->stops }}
                                                                        Stops</span>
                                                                </p>
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
                            <div class="modal" id="getInterntionalFlightPrices{{ $key }}">
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
                                                    $totalPriceList = count($tis->totalPriceList);
                                                    ?>
                                                    <input type="hidden" name="totalPriceList{{ $value1->id }}"
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
                                                                    Fare offered by airline.
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
                                                                    href="{{ route('reviewDetails') }}?pKey0={{ $values->id }}">
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
                @endif
            </div>
            {{-- International prices --}}
            {{-- INTERNATION FLIGHTS CODE ENDS  --}}
            {{-- DOMESTIC FLIGHTS CODE STARTS --}}
        @elseif (isset($result_array->searchResult->tripInfos))
            <div class="multi-city d-flex justify-content-start">
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    @foreach ($result_array->searchResult->tripInfos as $key => $tis)
                        <button class="nav-link mb-0  p-tb15 d-flex align-items-center  <?php echo $key == 0 ? 'active' : ''; ?>"
                            id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#ShowFlightDetails{{ $key }}" type="button" role="tab"
                            aria-controls="nav-home{{ $key }}" aria-selected="true">
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
