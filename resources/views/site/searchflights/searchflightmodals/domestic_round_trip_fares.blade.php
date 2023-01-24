{{-- round trip fares domestic start --}}
@if ($tripType == 'round')

    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
        @if (isset($result_array->searchResult->tripInfos))
            @if (isset($result_array->searchResult->tripInfos->ONWARD))
                @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value)
                    <div class="modal" id="ViewPrice{{ $value->sI[0]->id }}">
                        <div class="modal-dialog modal-lg">
                            <form action="" method="get" name="viewPriceForm" id="viewPriceForm"
                                class="viewPriceForm">
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
                                                            <h4 class="citiname">{{ $fromPlace }}</h4>
                                                            <p>Date and Departure</p>
                                                        </div>
                                                        <div class="col-md-3 m-auto">
                                                            <h4 class="citiname">{{ $toPlace }}</h4>
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
                                                                    class="fa-solid fa-suitcase-rolling"></i><br> Check
                                                                In</td>
                                                            <td class="bag-icon"><i class="fa-solid fa-plane-slash"></i>
                                                                <br>Cancellation
                                                            </td>
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
                                                        {{-- show price low to high onwards --}}
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
                                                        {{-- end price low to high onward --}}
                                                        @foreach ($fare_list as $key => $values)
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
                                                                <td>
                                                                    @if (isset($values->fd->ADULT->bI->cB))
                                                                        {{ $values->fd->ADULT->bI->cB }}
                                                                    @else
                                                                        --
                                                                    @endif
                                                                </td>
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
                                                            <h4 class="citiname">{{ $toPlace }}</h4>
                                                            <p>Date and Departure</p>
                                                        </div>
                                                        <div class="col-md-3 m-auto">
                                                            <h4 class="citiname">{{ $fromPlace }}</h4>
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
                                                                    class="fa-solid fa-suitcase-rolling"></i><br> Check
                                                                In</td>
                                                            <td class="bag-icon"><i class="fa-solid fa-plane-slash"></i>
                                                                <br>Cancellation
                                                            </td>
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

                                                            {{-- show price low to high return --}}
                                                            @php
                                                                $farevalues_return = [];
                                                                foreach ($value->totalPriceList as $fare_price) {
                                                                    $farevalues_return[$fare_price->id] = $fare_price->fd->ADULT->fC->TF;
                                                                }
                                                                asort($farevalues_return);
                                                                $fare_list_return = [];
                                                                foreach ($farevalues_return as $k => $v) {
                                                                    foreach ($value->totalPriceList as $fares_return) {
                                                                        if ($k == $fares_return->id) {
                                                                            array_push($fare_list_return, $fares_return);
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            {{-- end price low to high return --}}
                                                            @foreach ($fare_list_return as $key => $values)
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
                                                                    <td>
                                                                        @if (isset($values->fd->ADULT->bI->cB))
                                                                            {{ $values->fd->ADULT->bI->cB }}
                                                                        @else
                                                                            --
                                                                        @endif
                                                                    </td>
                                                                    <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                                        echo $values->fd->ADULT->bI->iB;
                                                                    } else {
                                                                        echo '--';
                                                                    } ?></td>
                                                                    <td
                                                                        class="cancellationRe{{ $value->sI[0]->id }}{{ $c++ }}">
                                                                        --
                                                                    </td>
                                                                    <td
                                                                        class="dateChangeTextRe{{ $value->sI[0]->id }}{{ $d++ }}">
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
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> <span class="priceOnUp"
                                                id="priceOnUp"></span>
                                            <br> <small> FOR 1 ADULT</small>
                                        </p>
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
{{-- round trip fares domestic End --}}
