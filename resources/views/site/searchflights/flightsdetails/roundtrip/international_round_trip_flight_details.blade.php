{{-- show flights low to high  combo --}}
@php
    $getminafareval = [];
    foreach ($result_array->searchResult->tripInfos->COMBO as $key => $all_flights) {
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
        foreach ($result_array->searchResult->tripInfos->COMBO as $k => $sI) {
            foreach ($sI->totalPriceList as $fares) {
                if ($min_key == $fares->id) {
                    array_push($flight_list_by_price, $sI);
                }
            }
        }
    }
@endphp
{{-- end flights low to high combo --}}
@foreach ($flight_list_by_price as $key => $value)
    {{-- @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $value) --}}
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <?php
                    $flight_code = $value->sI[0]->fD->aI->code;
                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                    ?>
                    <span><img src="{{ $flight_logo }}" class="img-fluid" width="10%"></span>
                    <span><b>{{ $value->sI[0]->fD->aI->name }}</b></span>
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <span><i class="fas fa-indian-rupee-sign"></i>
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
                        <b>{{ number_format($getminafareval) }}</b></span>&nbsp;&nbsp;
                    <span><a href="" data-bs-toggle="modal"
                            data-bs-target="#ViewPriceInternational{{ $value->sI[0]->id }}"
                            class="btn btn-outline-primary btn-sm"
                            onclick="getDownFareRules({{ $value->sI[0]->id }})">View
                            Prices</a></span>
                </div>

                <?php
                $depart = [];
                $return = [];
                foreach ($value->sI as $key => $va) {
                    if ($va->isRs == false) {
                        array_push($depart, $va);
                    } elseif ($va->isRs == true) {
                        array_push($return, $va);
                    }
                }
                
                $cnt_depart = count($depart);
                $cnt_return = count($return);
                ?>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Depart</b>
                                {{ date('D, d M', strtotime($depart[0]->dt)) }}
                                • {{ $depart[0]->fD->aI->name }}</p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <ul class="tab-view-data clearfix">
                                <li class="col-md-4">
                                    <div>
                                        <p class="flight-brand">
                                            {{ date('H:m', strtotime($depart[0]->dt)) }}
                                        </p>
                                        <p class="flight-number">
                                            {{ $depart[0]->da->city }}
                                        </p>
                                    </div>
                                </li>
                                <li class="col-md-4 text-center">
                                    <div>
                                        <small><span class="brdr-btm-time">
                                                @if ($cnt_depart == '1')
                                                    NON-STOP
                                                @else
                                                    {{ $cnt_depart - 1 }} Stop
                                                @endif
                                            </span></small><br>
                                        <?php
                                        if ($cnt_depart != '1') {
                                            $connect_time = 0;
                                            for ($i = 0; $i < $cnt_depart - 1; $i++) {
                                                $connect_time += $depart[$i]->cT;
                                            }
                                        
                                            $minutes = $depart[0]->duration + $depart[$cnt_depart - 1]->duration + $connect_time;
                                        } else {
                                            $minutes = $depart[0]->duration;
                                        }
                                        
                                        $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                        ?>
                                        <small>{{ $hours }}</small><br>

                                        @if ($cnt_depart != '1')
                                            <?php
                                                        for($i =0; $i < $cnt_depart-1; $i++ ){

                                                            $connecting_time = $depart[$i]->cT;
                                                            $connect_hours = intdiv($connecting_time, 60) . ' h ' . $connecting_time % 60 . ' m';
                                                    ?>
                                            <small data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Plane change  {{ $depart[$i]->aa->city }} | {{ $connect_hours }} Layover">

                                                via {{ $depart[$i]->aa->city }}
                                            </small><br>
                                            <?php } ?>
                                        @endif

                                    </div>
                                </li>
                                <li class="col-md-4 text-end">
                                    <div>
                                        <p class="flight-brand">
                                            {{ date('H:m', strtotime($depart[$cnt_depart - 1]->at)) }}
                                        </p>
                                        <p class="flight-number">
                                            {{ $depart[$cnt_depart - 1]->aa->city }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        {{-- <small>Partially Refundable</small> --}}
                    </div>
                </div>

                {{-- return flight in international round trip --}}
                {{-- @elseif($v->isRs == true) --}}
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Return</b>
                                {{ date('D, d M', strtotime($return[0]->dt)) }}
                                • {{ $return[0]->fD->aI->name }}</p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <ul class="tab-view-data clearfix">
                                <li class="col-md-4">
                                    <div>
                                        <p class="flight-brand">
                                            {{ date('H:m', strtotime($return[0]->dt)) }}
                                        </p>
                                        <p class="flight-number">
                                            {{ $return[0]->da->city }}
                                        </p>
                                    </div>
                                </li>
                                <li class="col-md-4 text-center">
                                    <div>
                                        <small>
                                            <span class="brdr-btm-time">
                                                @if ($cnt_return == '1')
                                                    NON-STOP
                                                @else
                                                    {{ $cnt_return - 1 }} Stop
                                                @endif
                                            </span>
                                        </small><br>
                                        <?php
                                        if ($cnt_return != '1') {
                                            $connect_time = 0;
                                            for ($i = 0; $i < $cnt_return - 1; $i++) {
                                                $connect_time += $return[$i]->cT;
                                            }
                                            $minutes = $return[0]->duration + $return[$cnt_return - 1]->duration + $connect_time;
                                        } else {
                                            $minutes = $depart[0]->duration;
                                        }
                                        $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                        ?>
                                        <small>{{ $hours }} </small><br>
                                        @if ($cnt_return != '1')
                                            <?php
                                                        for($i =0; $i < $cnt_return-1; $i++ ){
                                                                $connecting_time = $return[$i]->cT;
                                                                $connect_hours = intdiv($connecting_time, 60) . ' h ' . $connecting_time % 60 . ' m';
                                                        ?>
                                            <small data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Plane change  {{ $return[$i]->aa->city }} | {{ $connect_hours }} Layover">
                                                via {{ $return[$i]->aa->city }}
                                            </small><br>
                                            <?php } ?>
                                        @endif
                                    </div>
                                </li>
                                <li class="col-md-4 text-end">
                                    <div>
                                        <p class="flight-brand">
                                            {{ date('H:m', strtotime($return[$cnt_return - 1]->at)) }}
                                        </p>
                                        <p class="flight-number">
                                            {{ $return[$cnt_return - 1]->aa->city }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                {{-- @endif --}}
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
@endforeach
