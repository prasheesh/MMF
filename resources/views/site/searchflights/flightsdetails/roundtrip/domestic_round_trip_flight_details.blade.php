{{-- domestic round trip search flights --}}
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body round-trip1">
                @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                    @if (isset($result_array->searchResult->tripInfos->ONWARD))
                        <p>{{ $city_name_from->city }}
                            →
                            {{ $city_name_to->city }}
                            <span>{{ date('D, d M', strtotime($flightBookingDepart)) }}</span>
                        </p>
                    @endif
                @endif
                <div class="bg-tablle">
                    <p>Departure</p>
                    <p>Duration</p>
                    <p>Arrival</p>
                    <p>Price</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body round-trip1">
                @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
                    @if (isset($result_array->searchResult->tripInfos->RETURN))
                        <p>{{ $city_name_to->city }}
                            →
                            {{ $city_name_from->city }}
                            <span>{{ date('D, d M', strtotime($flightBookingReturn)) }}</span>
                        </p>
                    @endif
                @endif
                <div class="bg-tablle">
                    <p>Departure</p>
                    <p>Duration</p>
                    <p>Arrival</p>
                    <p>Price</p>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
        @if (isset($result_array->searchResult->tripInfos->ONWARD))
            <div class="col-md-6">
                @php $radio_on_cnt = 1; @endphp

                {{-- show flights low to high  onwards --}}
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
                {{-- end flights low to high onwards --}}

                @foreach ($flight_list_by_price as $key => $value)
                    @php $cnt_up = count($value->sI); @endphp
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body round-trip1 shadow">
                                    <?php
                                    $flight_code = $value->sI[0]->fD->aI->code;
                                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                    ?>

                                    <img src="{{ $flight_logo }}">
                                    <span>FI.No.{{ $value->sI[0]->fD->aI->code }}
                                        {{ $value->sI[0]->fD->fN }},
                                        <b>{{ $value->sI[0]->fD->aI->name }}</b></span>
                                    <div class="row pt-3">
                                        <div class="col-md-3 departture">
                                            <span>{{ date('H:m', strtotime($value->sI[0]->dt)) }}</span>
                                            <span>{{ $value->sI[0]->da->city }}</span>
                                        </div>
                                        <div class="col-md-3 departture time-gap">
                                            <?php
                                            if ($cnt_up != 1) {
                                                $connect_time = 0;
                                                for ($i = 0; $i < $cnt_up - 1; $i++) {
                                                    $connect_time += $value->sI[$i]->cT;
                                                }
                                                $minutes = $value->sI[0]->duration + $value->sI[$cnt_up - 1]->duration + $connect_time;
                                            } else {
                                                $minutes = $value->sI[0]->duration;
                                            }
                                            $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                            ?>

                                            <span class="">{{ $hours }}
                                            </span><br>
                                            <div class="clearfix"> </div>
                                            <span>
                                                @if ($cnt_up == '1')
                                                    NON-STOP
                                                @else
                                                    {{ $cnt_up - 1 }} Stop
                                                @endif
                                            </span><br>
                                            @if ($cnt_up != '1')
                                                <?php
                                for($i =0; $i < $cnt_up-1; $i++ ){
                                        $connecting_time = $value->sI[$i]->cT;
                                        $connect_hours = intdiv($connecting_time, 60) . ' h ' . $connecting_time % 60 . ' m';
                                ?>
                                                <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Plane change  {{ $value->sI[$i]->aa->city }} | {{ $connect_hours }} Layover">


                                                    via {{ $value->sI[$i]->aa->city }}
                                                </span><br>
                                                <?php } ?>
                                            @endif
                                        </div>
                                        <div class="col-md-3 departture">
                                            <span>{{ date('H:m', strtotime($value->sI[$cnt_up - 1]->at)) }}</span>
                                            <span>{{ $value->sI[$cnt_up - 1]->aa->city }}</span>
                                        </div>
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
                                        <div class="col-md-3 departture text-center">
                                            <input <?php echo $radio_on_cnt == 1 ? 'Checked' : ''; ?> type="radio" name="roundFromTo"
                                                class="form-check-input roundFromTo"
                                                data-flight_up_id="{{ $value->sI[0]->id }}"
                                                data-fare_on_id="{{ $value->totalPriceList[0]->id }}"
                                                data-f_on_code="{{ $value->sI[0]->fD->fN }}"
                                                data-f_on_name="{{ $value->sI[0]->fD->aI->name }}"
                                                data-f_on_depat_time="{{ date('H:m', strtotime($value->sI[0]->dt)) }}"
                                                data-f_on_arival_time="{{ date('H:m', strtotime($value->sI[$cnt_up - 1]->at)) }}"
                                                data-f_on_price="{{ number_format($getminafareval, 0) }}"
                                                data-f_on_logo="{{ $flight_logo }}"
                                                data-onward_price="{{ $getminafareval }}">
                                            <p class="price-round"> <i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                                {{ number_format($getminafareval, 0) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $radio_on_cnt++; ?>
                @endforeach
            </div>

            <div class="col-md-6">
                @php
                    $radio_re_cnt = 1;
                @endphp

                {{-- show flights low to high return --}}
                @php
                    $getminafareval_return = [];
                    foreach ($result_array->searchResult->tripInfos->RETURN as $key => $all_flights_return) {
                        $farevalues_return = [];
                        foreach ($all_flights_return->totalPriceList as $fare_price_return) {
                            $farevalues_return[$fare_price_return->id] = $fare_price_return->fd->ADULT->fC->TF;
                            $all_fare_values_return[$fare_price_return->id] = $fare_price_return->fd->ADULT->fC->TF;
                        }
                        $getminafareval_return[] = array_keys($farevalues_return, min($farevalues_return));
                    }
                    $merge_min_fare_val_array_return = call_user_func_array('array_merge', $getminafareval_return);
                    
                    $min_fares_array_return = array_intersect_key($all_fare_values_return, array_flip($merge_min_fare_val_array_return));
                    
                    asort($min_fares_array_return);
                    $flight_list_by_price_return = [];
                    foreach ($min_fares_array_return as $min_key_return => $min_val) {
                        foreach ($result_array->searchResult->tripInfos->RETURN as $k => $sI_return) {
                            foreach ($sI_return->totalPriceList as $fares_return) {
                                if ($min_key_return == $fares_return->id) {
                                    array_push($flight_list_by_price_return, $sI_return);
                                }
                            }
                        }
                    }
                @endphp
                {{-- end flights low to high  return --}}

                @foreach ($flight_list_by_price_return as $key => $value)
                    {{-- @foreach ($result_array->searchResult->tripInfos->RETURN as $key => $value) --}}
                    @php $cnt_dwn = count($value->sI); @endphp
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body round-trip1 shadow">
                                    <?php
                                    $flight_code = $value->sI[0]->fD->aI->code;
                                    $flight_logo = 'assets/img/AirlinesLogo/' . $flight_code . '.png';
                                    ?>
                                    <img src="{{ $flight_logo }}">
                                    <span>FI.No.{{ $value->sI[0]->fD->aI->code }}
                                        {{ $value->sI[0]->fD->fN }},
                                        <b>{{ $value->sI[0]->fD->aI->name }}</b></span>
                                    <div class="row pt-3">
                                        <div class="col-md-3 departture">
                                            <span>{{ date('H:m', strtotime($value->sI[0]->dt)) }}</span>
                                            <span>{{ $value->sI[0]->da->city }}</span>
                                        </div>
                                        <div class="col-md-3 departture time-gap">
                                            <?php
                                            if ($cnt_dwn != 1) {
                                                $connect_time = 0;
                                                for ($i = 0; $i < $cnt_dwn - 1; $i++) {
                                                    $connect_time += $value->sI[0]->cT;
                                                }
                                                $minutes = $value->sI[0]->duration + $value->sI[$cnt_dwn - 1]->duration + $connect_time;
                                            } else {
                                                $minutes = $value->sI[0]->duration;
                                            }
                                            $hours = intdiv($minutes, 60) . ' h ' . $minutes % 60 . ' m';
                                            ?>

                                            <span class="">{{ $hours }}
                                            </span><br>
                                            <div class="clearfix"> </div>
                                            <span>
                                                @if ($cnt_dwn == '1')
                                                    NON-STOP
                                                @else
                                                    {{ $cnt_dwn - 1 }} Stop
                                                @endif
                                            </span><br>
                                            @if ($cnt_dwn != 1)
                                                <?php
                                for($i =0; $i < $cnt_dwn-1; $i++ ){
                                        $connecting_time = $value->sI[$i]->cT;
                                        $connect_hours = intdiv($connecting_time, 60) . ' h ' . $connecting_time % 60 . ' m';
                                ?>
                                                <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Plane change  {{ $value->sI[$i]->aa->city }} | {{ $connect_hours }} Layover">

                                                    via {{ $value->sI[$i]->aa->city }}
                                                </span><br>
                                                <?php } ?>
                                            @endif
                                        </div>
                                        <div class="col-md-3 departture">
                                            <span>{{ date('H:m', strtotime($value->sI[$cnt_dwn - 1]->at)) }}</span>
                                            <span>{{ $value->sI[$cnt_dwn - 1]->aa->city }}</span>
                                        </div>
                                        <div class="col-md-3 departture text-center">
                                            <input <?php echo $radio_re_cnt == 1 ? 'Checked' : ''; ?> type="radio" name="roundToFrom"
                                                class="form-check-input roundToFrom" value=""
                                                data-flight_down_id="{{ $value->sI[0]->id }}"
                                                data-fare_re_id="{{ $value->totalPriceList[0]->id }}"
                                                data-f_re_code="{{ $value->sI[0]->fD->fN }}"
                                                data-f_re_name="{{ $value->sI[0]->fD->aI->name }}"
                                                data-f_re_depat_time="{{ date('H:m', strtotime($value->sI[0]->dt)) }}"
                                                data-f_re_arival_time="{{ date('H:m', strtotime($value->sI[$cnt_dwn - 1]->at)) }}"
                                                data-f_re_price="{{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}"
                                                data-f_re_logo={{ $flight_logo }}
                                                data-return_price="{{ $value->totalPriceList[0]->fd->ADULT->fC->TF }}">
                                            <p class="price-round"> <i class="fa-solid fa-indian-rupee-sign mr-2"></i>
                                                {{ number_format($value->totalPriceList[0]->fd->ADULT->fC->TF, 0) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $radio_re_cnt++; ?>
                @endforeach
            </div>
        @endif
    @endif
</div>
