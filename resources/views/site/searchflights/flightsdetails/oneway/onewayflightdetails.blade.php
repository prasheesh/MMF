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
                    echo $flight_count;
                @endphp
                {{-- show fares low to high  --}}
                @php
                    $farevalues = [];
                    
                    $getminafareval = [];
                    // dd($result_array->searchResult->tripInfos->ONWARD);
                    foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $all_flights) {
                        $farevalues = [];
                        foreach ($all_flights->totalPriceList as $fares) {
                            $farevalues[] = $fares->fd->ADULT->fC->TF;
                            // $getminafareval = min($farevalues);
                        }
                        // sort($getminafareval);
                        $getminafareval[] = min($farevalues);
                        // dd($farevalues);
                    }
                    
                    sort($getminafareval);
                    // dd($getminafareval, $farevalues);
                    $arrlength = count($getminafareval);
                    $fare_list = [];
                    for ($x = 0; $x < $arrlength; $x++) {
                        foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $all_flights) {
                            foreach ($all_flights->totalPriceList as $fares) {
                                // dd($all_flights->sI[0]->id);
                                if ($getminafareval[$x] == $fares->fd->ADULT->fC->TF) {
                                    array_push($fare_list, $all_flights);
                                }
                            }
                        }
                    }
                    
                    // dd($farevalues, $getminafareval, $fare_list);
                @endphp
                {{-- @foreach ($fare_list as $key => $value) --}}
                    @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value)
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
