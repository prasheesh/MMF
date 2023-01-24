<table class="table mt-3 mb-3" id="for_filter">
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
        @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
            @if (isset($result_array->searchResult->tripInfos))
                @php
                    $sno = 1;
                    $flight_count = count($result_array->searchResult->tripInfos->ONWARD);
                    // echo $flight_count;
                @endphp
                {{-- show fares low to high  --}}
                @php
                    $getminafareval = [];
                    foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $all_flights) {
                        $farevalues = [];
                        foreach ($all_flights->totalPriceList as $fare_price) {
                            $farevalues[$fare_price->id] = $fare_price->fd->ADULT->fC->TF;
                            $all_fare_values[$fare_price->id] = $fare_price->fd->ADULT->fC->TF;
                        }
                        $getminafareval[] = array_keys($farevalues, min($farevalues));
                    }
                    $merge_min_fare_val_array = call_user_func_array('array_merge', $getminafareval);
                    
                    $min_fares_array = array_intersect_key($all_fare_values, array_flip($merge_min_fare_val_array));
                    
                    asort($min_fares_array);
                    $flight_list_by_price = [];
                    foreach ($min_fares_array as $min_key => $min_val) {
                        foreach ($result_array->searchResult->tripInfos->ONWARD as $k => $sI) {
                            foreach ($sI->totalPriceList as $fares) {
                                if ($min_key == $fares->id) {
                                    array_push($flight_list_by_price, $sI);
                                }
                            }
                        }
                    }
                @endphp
                {{-- end fares low to high  --}}
                @foreach ($flight_list_by_price as $key => $value)
                    {{-- @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value) --}}
                    @php $count = count($value->sI); @endphp
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
                                        @if (count($value->sI) == '1')
                                            NON-STOP
                                        @else
                                            {{ count($value->sI) - 1 }} Stop
                                        @endif

                                    </span></p>
                                <?php
                                if (count($value->sI) != '1') {
                                    $connect_time = 0;
                                    for ($i = 0; $i < $count - 1; $i++) {
                                        $connect_time += $value->sI[$i]->cT;
                                    }
                                    $minutes = $value->sI[0]->duration + $value->sI[$count - 1]->duration + $connect_time;
                                } else {
                                    $minutes = $value->sI[0]->duration;
                                }
                                $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                ?>

                                <p class="flight-brand">{{ $hours }} </p>
                                @if (count($value->sI) != '1')
                                    <?php
                                                                for($i=0;$i<$count-1;$i++){
                                                                        $connecting_time = $value->sI[$i]->cT;
                                                                        $connect_hours = intdiv($connecting_time, 60) . ' h ' . $connecting_time % 60 . ' m';
                                                                ?>
                                    <small data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Plane change  {{ $value->sI[$i]->aa->city }} | {{ $connect_hours }} Layover">


                                        via {{ $value->sI[$i]->aa->city }}
                                    </small>
                                    <?php } ?>
                                @endif
                            </div>
                        </td>
                        <td style="width:15%">
                            <div>
                                <p class="flight-number">{{ $value->sI[$count - 1]->aa->city }}
                                </p>
                                <p class="flight-brand">
                                    {{ date('H:m', strtotime($value->sI[$count - 1]->at)) }}
                                </p>
                            </div>
                        </td>
                        <td style="width:20%">
                            <div>
                                <p class=" flight-brand"><i class="fa-solid fa-indian-rupee-sign"></i>

                                    @php
                                        $minfarevalue = [];
                                        foreach ($value->totalPriceList as $minvalue) {
                                            if (isset($minvalue->fd->CHILD->fC->TF)) {
                                                $child_amt = $minvalue->fd->CHILD->fC->TF;
                                            } else {
                                                $child_amt = 0;
                                            }
                                            if (isset($minvalue->fd->INFANT->fC->TF)) {
                                                $infant_amt = $minvalue->fd->INFANT->fC->TF;
                                            } else {
                                                $infant_amt = 0;
                                            }
                                        
                                            $minfarevalue[] = $minvalue->fd->ADULT->fC->TF + $child_amt + $infant_amt;
                                        }
                                        
                                        $getminafareval = min($minfarevalue);
                                        
                                    @endphp

                                    {{ number_format($getminafareval, 0) }}
                                </p>
                                <p class="flight-brand oneWayFromTo"><a href="#" data-bs-toggle="modal"
                                        id="" class="airportApiId{{ $sno++ }}"
                                        data-bs-target="#book-table{{ $value->sI[0]->id }}"
                                        data-airportId={{ $value->sI[0]->id }} data-flight_count={{ $flight_count }}
                                        onclick="getFareRules({{ $value->sI[0]->id }})">View More Fares</a></p>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" align="center">
                        <div>{{ 'No Flights Found' }}</div>
                    </td>
                </tr>

            @endif
        @else
            <tr>
                <td colspan="5" align="center">
                    <div>{{ $errors[0]->message }}</div>
                </td>
            </tr>
        @endif

    </tbody>
</table>
