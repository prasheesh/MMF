@foreach ($result_array->searchResult->tripInfos as $key => $tis)
    <div class="tab-pane fade show <?php echo $key == 0 ? 'active' : ''; ?>" id="ShowFlightDetails{{ $key }}" role="tabpanel"
        aria-labelledby="nav-home-tab{{ $key }}">
        <div class="card mt-3 mb-3">
            <div class="card-body">
                <div class="row">
                    <table class="table mt-3 mb-3">
                        <thead class="bg-thead">
                            <tr>
                                <th>Sorted By: </th>
                                <th>Departure</th>
                                <th>Duration</th>
                                <th>Arrival</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        {{-- show fares low to high  --}}
                        @php
                            $getminafareval = [];
                            foreach ($tis as $key => $all_flights) {
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
                                foreach ($tis as $k => $sI) {
                                    foreach ($sI->totalPriceList as $fares) {
                                        if ($min_key == $fares->id) {
                                            array_push($flight_list_by_price, $sI);
                                        }
                                    }
                                }
                            }
                            // dd($flight_list_by_price);
                        @endphp
                        {{-- end fares low to high  --}}
                        @foreach ($flight_list_by_price as $tisKey => $tisI)
                            @php $cnt_stops = count($tisI->sI); @endphp


                            @foreach ($tisI->sI as $k => $v)
                                <tbody class="bg-tbody">
                                    <tr>
                                        <td style="width:25%">
                                            <div>
                                                <div class="row">
                                                    @php
                                                        
                                                        $flight_code = $v->fD->aI->code;
                                                        $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                                        
                                                    @endphp
                                                    <div class="col-md-4">
                                                        <img src="{{ $flight_logo }}">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p class="flight-number">
                                                            FI.No.{{ $v->fD->fN }}</p>
                                                        <p class="flight-brand">
                                                            {{ $v->fD->aI->name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width:15%">
                                            <div>
                                                <p class="flight-number">
                                                    {{ $v->da->city }}</p>
                                                <p class="flight-brand">
                                                    {{ date('H:i', strtotime($v->dt)) }}
                                                </p>
                                            </div>
                                        </td>
                                        <td style="width:25%">
                                            <div>
                                                <?php
                                                if ($cnt_stops != 1) {
                                                    $connect_time = 0;
                                                    for ($i = 0; $i < $cnt_stops - 1; $i++) {
                                                        // if(isset($tisI->sI[$i]->cT)){
                                                        //     $connect_time += $tisI->sI[$i]->cT;
                                                        // }else{
                                                        //     $connect_time +=0;
                                                        // }
                                                    }
                                                    $minutes = $tisI->sI[0]->duration + $tisI->sI[$cnt_stops - 1]->duration + $connect_time;
                                                } else {
                                                    $minutes = $v->duration;
                                                }
                                                $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                                ?>
                                                @if ($cnt_stops == '1')
                                                    <p class="flight-number"><span class="brdr-btm-time">NON-STOP</span>
                                                    </p>
                                                @else
                                                    <p class="flight-number"><span class="brdr-btm-time">
                                                            {{ $cnt_stops - 1 }}
                                                            Stop</span></p>
                                                @endif
                                                <span>
                                                    <p class="flight-brand">
                                                        {{ $hours }} </p>
                                                </span>
                                                @if ($cnt_stops != '1')
                                                    <?php
                        for($i=0;$i<$cnt_stops-1;$i++){
                            if(isset($tisI->sI[$i]->cT)){
                                $connecting_time = $tisI->sI[$i]->cT;
                            }else{
                                $connecting_time = 0;
                            }
                                $connect_hours = intdiv($connecting_time, 60) . ' h ' . $connecting_time % 60 . ' m';
                        ?>
                                                    <small data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Plane change  {{ $tisI->sI[$i]->aa->city }} | {{ $connect_hours }} Layover">


                                                        via {{ $tisI->sI[$i]->aa->city }}
                                                    </small><br>
                                                    <?php } ?>
                                                @endif
                                            </div>
                                        </td>
                                        <td style="width:15%">
                                            <div>
                                                <p class="flight-number">
                                                    {{ $tisI->sI[$cnt_stops - 1]->aa->city }}</p>
                                                <p class="flight-brand">
                                                    {{ date('H:i', strtotime($tisI->sI[$cnt_stops - 1]->at)) }}
                                                </p>
                                            </div>
                                        </td>
                                        <td style="width:20%">
                                            <div>
                                                @php
                                                    $minfarevalue = [];
                                                    foreach ($tisI->totalPriceList as $minvalue) {
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
                                                <p class=" flight-brand"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                    {{ number_format($getminafareval, 0) }}
                                                </p>
                                                <p class="flight-brand"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#book-table{{ $v->id }}"
                                                        onclick="getFareRules({{ $v->id }})">View More Fares</a>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
