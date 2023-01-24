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
                                <span><a href="#"class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
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
