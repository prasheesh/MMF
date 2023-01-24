{{-- tab starts  --}}
<div class="data">
    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
        @if (isset($result_array->searchResult->tripInfos->COMBO))

            {{-- start international mutli city flights --}}
            @include('site.searchflights.flightsdetails.multitrip.multicity_international_flights')
            {{-- end international mutli city flights --}}

            <!-- View flight Detials   -->
            @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $tis)
                @foreach ($tis->sI as $k => $v)
                    <div class="modal" id="flightdetails{{ $v->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                                            class="fa fa-times"></i></button>
                                    <h4>Flight Details</h4>
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
                                                                    <span class="brdr-btm-time">NON-STOPss</span>
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

            {{-- start modal international view prices  --}}
            <div>
                @include('site.searchflights.searchflightmodals.international_multi_trip_fares')
            </div>
            {{-- end modal International view prices --}}

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

                </div>
            </div>
        @endif
    @endif
</div>
{{-- tab ends --}}
