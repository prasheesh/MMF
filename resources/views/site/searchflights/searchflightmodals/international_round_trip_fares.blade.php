{{-- start round trip international fares --}}
@if ($tripType == 'round')

    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
        @if (isset($result_array->searchResult->tripInfos))
            @if (isset($result_array->searchResult->tripInfos->COMBO))
                @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $value)
                    <?php
                    
                    $city_name_from = DB::table('airport_details')
                        ->where('code', $fromPlace)
                        ->first('city');
                    $city_name_to = DB::table('airport_details')
                        ->where('code', $toPlace)
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
                                                            <br>Cabin Bag
                                                        </td>
                                                        <td class="bag-icon"><i
                                                                class="fa-solid fa-suitcase-rolling"></i><br> Check In
                                                        </td>
                                                        <td class="bag-icon"><i class="fa-solid fa-plane-slash"></i>
                                                            <br>Cancellation
                                                        </td>
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

                                                    <input type="hidden" name="totalPriceList{{ $value->sI[0]->id }}"
                                                        id="totalPriceList{{ $value->sI[0]->id }}"
                                                        value="{{ $totalPriceList }}">

                                                    {{-- show price low to high one way --}}
                                                    @php
                                                        $farevalues = [];
                                                        foreach ($value->totalPriceList as $fares_p) {
                                                            $farevalues[$fares_p->id] = $fares_p->fd->ADULT->fC->TF;
                                                        }
                                                        asort($farevalues);
                                                        $fare_list = [];
                                                        foreach ($farevalues as $k => $v) {
                                                            foreach ($value->totalPriceList as $fares) {
                                                                if ($k == $fares->id) {
                                                                    array_push($fare_list, $fares);
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    {{-- end price low to high one way --}}


                                                    @foreach ($fare_list as $key => $values)
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
                                                                    href="{{ route('reviewDetails') }}?pKey0={{ $values->id }}">
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
                                        <small> FOR 1 ADULT</small>
                                    </p>
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
{{-- end round trip international fares --}}
