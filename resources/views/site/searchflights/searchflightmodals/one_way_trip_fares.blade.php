{{-- one way trip view more fares --}}
@if ($tripType == 'oneway')
    @if ($result_array->status->success == true && $result_array->status->httpStatus == 200)
        @if (isset($result_array->searchResult->tripInfos))
            @foreach ($result_array->searchResult->tripInfos->ONWARD as $key => $value)
                <div class="modal" id="book-table{{ $value->sI[0]->id }}">
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

                                        <?php
                                        $i = 1;
                                        $id = 1;
                                        $c = 1;
                                        $d = 1;
                                        $s = 1;
                                        $totalPriceList = count($value->totalPriceList);
                                        
                                        ?>
                                        <input type="hidden" name="totalPriceList{{ $value->sI[0]->id }}"
                                            id="totalPriceList{{ $value->sI[0]->id }}" value="{{ $totalPriceList }}">

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
                                            <tr>
                                                <td class=""><b>{{ $values->fareIdentifier }}</b>
                                                    <input type="hidden"
                                                        name="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $i++ }}"
                                                        id="uniqueTripPriceId{{ $value->sI[0]->id }}{{ $id++ }}"
                                                        value="{{ $values->id }}">

                                                    <p>
                                                        Fare offered by airline.
                                                    </p>
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
                                                <td id="cancellation{{ $value->sI[0]->id }}{{ $c++ }}">--
                                                    {{-- cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500 --}}
                                                </td>
                                                <td id="dateChangeText{{ $value->sI[0]->id }}{{ $d++ }}">--
                                                    {{-- Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250 --}}
                                                </td>
                                                <td id="seatChargeId{{ $value->sI[0]->id }}{{ $s++ }}">--
                                                    {{-- Middle Seat Free, <br> Window/Asile Chargeable --}}
                                                </td>
                                                <td>
                                                    @if (isset($values->fd->ADULT->mI))
                                                        @if ($values->fd->ADULT->mI == true)
                                                            Free Meal
                                                        @else
                                                            Paid Meal
                                                        @endif
                                                    @else
                                                        --
                                                    @endif


                                                </td>
                                                @php
                                                    if (isset($values->fd->CHILD->fC->TF)) {
                                                        $child_amt = $values->fd->CHILD->fC->TF;
                                                    } else {
                                                        $child_amt = 0;
                                                    }
                                                    if (isset($values->fd->INFANT->fC->TF)) {
                                                        $infant_amt = $values->fd->INFANT->fC->TF;
                                                    } else {
                                                        $infant_amt = 0;
                                                    }
                                                    $total_fare = $values->fd->ADULT->fC->TF + $child_amt + $infant_amt;
                                                @endphp
                                                <td align="right">
                                                    <p class="final-price"><b><i
                                                                class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($total_fare) }}</b>
                                                    </p>
                                                    <a href="{{ route('reviewDetails') }}?pKey0={{ $values->id }}">
                                                        <button class="btn btn-book-now">Book Now</button> </a>
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
        @endif
    @endif
@endif
