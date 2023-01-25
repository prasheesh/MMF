@if (!empty($result_array->searchResult->tripInfos))
    @foreach ($result_array->searchResult->tripInfos as $trip_key => $value)
        @foreach ($value as $ke => $val)
            <?php $count_multi = count($val->sI); ?>
            @foreach ($val->sI as $key1 => $value1)
                @php
                    $flight_code = $value1->fD->aI->code;
                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                @endphp
                <div class="modal" id="book-table{{ $value1->id }}">
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
                                        @php
                                            $i = 1;
                                            $id = 1;
                                            $c = 1;
                                            $d = 1;
                                            $s = 1;
                                            $totalPriceList = count($val->totalPriceList);
                                            
                                        @endphp
                                        <input type="hidden" name="totalPriceList{{ $value1->id }}"
                                            id="totalPriceList{{ $value1->id }}" value="{{ $totalPriceList }}">

                                        {{-- show price low to high one way --}}
                                        @php
                                            $farevalues = [];
                                            foreach ($val->totalPriceList as $fares_p) {
                                                $farevalues[$fares_p->id] = $fares_p->fd->ADULT->fC->TF;
                                            }
                                            asort($farevalues);
                                            $fare_list = [];
                                            foreach ($farevalues as $k => $v) {
                                                foreach ($val->totalPriceList as $fares) {
                                                    if ($k == $fares->id) {
                                                        array_push($fare_list, $fares);
                                                    }
                                                }
                                            }
                                        @endphp
                                        {{-- end price low to high one way --}}

                                        @foreach ($fare_list as $key => $values)
                                            <tr>
                                                <td class="">
                                                    <b>{{ $values->fareIdentifier }}</b>
                                                    <input type="hidden"
                                                        name="uniqueTripPriceId{{ $value1->id }}{{ $i++ }}"
                                                        id="uniqueTripPriceId{{ $value1->id }}{{ $id++ }}"
                                                        value="{{ $values->id }}">
                                                    <p>
                                                        Fare offered by airline.
                                                    </p>
                                                </td>
                                                <td>{{ $values->fd->ADULT->bI->cB }}</td>
                                                <input type="hidden" name="price_id" id="PriceId{{ $trip_key }}"
                                                    value="{{ $values->id }}">
                                                <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                    echo $values->fd->ADULT->bI->iB;
                                                } else {
                                                    echo '--';
                                                } ?></td>
                                                <td id="cancellation{{ $value1->id }}{{ $c++ }}">--
                                                    {{-- cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500 --}}
                                                </td>
                                                <td id="dateChangeText{{ $value1->id }}{{ $d++ }}">--
                                                    {{-- Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250 --}}
                                                </td>
                                                <td id="seatChargeId{{ $value1->id }}{{ $s++ }}">--
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
                                                    {{-- <a href="{{ route('reviewDetails') }}?pkey0={{ $values->id }}">
                                                                <button class="btn btn-book-now">Book Now</button> </a> --}}
                                                    {{-- <button class="btn btn-book-now" onclick="bookNow('{{ $values->id }}')" >
                                                                Book Now</button> --}}
                                                    <input type="hidden" name="flight_code"
                                                        id="flightCode{{ $value1->id }}"
                                                        value="{{ $value1->fD->aI->code }}">
                                                    <input type="radio" class="roundtrip-card multitrip"
                                                        name="book_now" id="BookNowRadio{{ $value1->id }}"
                                                        onclick="bookNow('{{ $value1->id }}','{{ $trip_key }}','{{ $values->id }}')"
                                                        value="{{ $value1->id }}"
                                                        data-f_on_code="{{ $value1->fD->fN }}"
                                                        data-f_on_name="{{ $value1->fD->aI->name }}"
                                                        data-f_on_depat_time="{{ date('H:m', strtotime($value1->dt)) }}"
                                                        data-f_on_arival_time="{{ date('H:m', strtotime($val->sI[$count_multi - 1]->at)) }}"
                                                        data-f_on_price="{{ $values->fd->ADULT->fC->TF }}"
                                                        data-f_on_logo="{{ $flight_logo }}"
                                                        data-f_si_id="{{ $value1->id }}"
                                                        data-onward_price="{{ $values->fd->ADULT->fC->TF }}"
                                                        data-f_arr_code={{ $value1->da->code }}
                                                        data-f_dep_code={{ $val->sI[$count_multi - 1]->aa->code }}
                                                        data-f_logo={{ $value1->fD->aI->code }}
                                                        data-f_trip_id={{ $trip_key }}>
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
