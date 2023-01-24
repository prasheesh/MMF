@if (!empty($result_array->searchResult->tripInfos->COMBO))
    @foreach ($result_array->searchResult->tripInfos->COMBO as $key => $tis)
        @foreach ($tis->sI as $k => $value1)
            <div class="modal" id="getInterntionalFlightPrices{{ $key }}">
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
                                    $totalPriceList = count($tis->totalPriceList);
                                    ?>
                                    <input type="hidden" name="totalPriceList{{ $value1->id }}"
                                        id="totalPriceList{{ $value1->id }}" value="{{ $totalPriceList }}">

                                    {{-- show price low to high one way --}}
                                    @php
                                        $farevalues = [];
                                        foreach ($tis->totalPriceList as $fares_p) {
                                            $farevalues[$fares_p->id] = $fares_p->fd->ADULT->fC->TF;
                                        }
                                        asort($farevalues);
                                        $fare_list = [];
                                        foreach ($farevalues as $k => $v) {
                                            foreach ($tis->totalPriceList as $fares) {
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
                                                <b>Saver</b>
                                                <input type="hidden"
                                                    name="uniqueTripPriceId{{ $value1->id }}{{ $i++ }}"
                                                    id="uniqueTripPriceId{{ $value1->id }}{{ $id++ }}"
                                                    value="{{ $values->id }}">
                                                <p>
                                                    Fare offered by airline.
                                                </p>
                                            </td>
                                            <td>{{ $values->fd->ADULT->bI->cB }}
                                            </td>
                                            <td><?php if (isset($values->fd->ADULT->bI->iB)) {
                                                echo $values->fd->ADULT->bI->iB;
                                            } else {
                                                echo '--';
                                            } ?></td>
                                            <td id="cancellation{{ $value1->id }}{{ $c++ }}">
                                                --
                                                {{-- cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500 --}}
                                            </td>
                                            <td id="dateChangeText{{ $value1->id }}{{ $d++ }}">
                                                --
                                                {{-- Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250 --}}
                                            </td>
                                            <td id="seatChargeId{{ $value1->id }}{{ $s++ }}">
                                                --
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
                                                <p class="final-price">
                                                    <b><i
                                                            class="fa-solid fa-indian-rupee-sign"></i>{{ number_format($values->fd->ADULT->fC->NF) }}</b>
                                                </p>
                                                <a href="{{ route('reviewDetails') }}?pKey0={{ $values->id }}">
                                                    <button class="btn btn-book-now">Book
                                                        Now</button> </a>
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
@endif
