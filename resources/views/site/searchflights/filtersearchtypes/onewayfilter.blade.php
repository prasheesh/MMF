
    @if (!empty($result_array->searchResult->tripInfos))


    <div class="col-md-3 p-3">
        <div class="card">
            <div class=" card-body card-shadow">
                <h5>One Way Trip</h5>

                <div class="mt-4">
                    <div id="slider-range"></div>

                    <p>
                        {{-- <label for="amount">Price range:</label> --}}
                        <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                    </p>

                    {{-- <div id="slider-range" class="form-range" name="rangeInput"></div>
                    <input type="number" min=0 max="9900" oninput="validity.valid||(value='{{$minpricevalue}}');" id="min_price" class="left-range"  readonly/>
                    <input type="number" min=0 max="10000" oninput="validity.valid||(value='{{$maxpricevalue}}');" id="max_price" class="right-range"  readonly/> --}}
                    {{-- <form>
                        <input type="range" name="" class="form-range pricerangefilter" min="{{number_format($minpricevalue, 0)}}" max="{{number_format($maxpricevalue, 0)}}">
                    </form> --}}
                    {{-- <span class=" left-range" id="min_price"><i class="fa-solid fa-indian-rupee-sign"></i> {{number_format($minpricevalue, 0)}}</span>
                    <span class=" right-range" id="max_price"><i class="fa-solid fa-indian-rupee-sign"></i> {{number_format($maxpricevalue, 0)}}</span> --}}
                    {{-- <input type="text" id="example" name="example_name" value="" /> --}}
                </div>


                <!-- Number Of Stops --->
                <div class="mt-4">

                    <h5>Stops From {{$result_array->searchResult->tripInfos->ONWARD[0]->sI[0]->da->city}}</h5>

                    {{-- @php $i=0 @endphp --}}

                    @foreach($all_stops as $key=>$stop)

                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <input type="radio" class="stopsclick" name="stops" value="{{$stop+1}}">
                                <span>
                                    @if ($stop == '0')
                                        NON-STOP <small>({{ $flights_cnt[$stop]}})</small>
                                    @else
                                        {{ $stop }} Stop <small>({{ $flights_cnt[$stop]}})</small>

                                    @endif
                                </span>
                            </div>
                        </div>

                    @endforeach

                </div>

                <!-- End Number Of Stops --->


                <!-- Deptaure flights -->
                <div class="mt-4">
                    <h5>Departure From {{$result_array->searchResult->tripInfos->ONWARD[0]->sI[0]->da->city}}</h5>

                    <div class="row mt-3 invisible-checkboxes">

                        <div class="col-md-3 align-items-center main-departure depaturemain"  id="depart1">
                            <a href="javascript:;" class="anchor depaturemaina " id="anchor1"></a>
                            <input type="hidden" name="rGroup" value="00:00" />
                            <input type="hidden" name="rGroup" value="06:00" />
                            <input type="hidden" name="rGroup" value="dept" />
                            <input type="hidden" name="rGroup" value="before6" />
                            <div class="departure-1">
                                <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                <p>Before 6 AM </p>
                            </div>
                        </div>
                        <div class="col-md-3 main-departure depaturemain" id="depart2">
                            <a href="javascript:;" class="anchor depaturemaina " id="anchor2"></a>
                            <input type="hidden" name="rGroup" value="06:01" />
                            <input type="hidden" name="rGroup" value="12:00" />
                            <input type="hidden" name="rGroup" value="dept" />
                            <input type="hidden" name="rGroup" value="btw612" />
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                    <p>6 AM to 12 PM</p>
                                </div>
                        </div>
                        <div class="col-md-3 main-departure depaturemain" id="depart3">
                            <a href="javascript:;" class="anchor depaturemaina" id="anchor3"></a>
                            <input type="hidden" name="rGroup" value="12:01" />
                            <input type="hidden" name="rGroup" value="17:00" />
                            <input type="hidden" name="rGroup" value="dept" />
                            <input type="hidden" name="rGroup" value="btw1217" />
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                    <p>12 PM to 5 PM</p>
                                </div>
                        </div>
                        <div class="col-md-3 main-departure depaturemain" id="depart4">
                            <a href="javascript:;" class="anchor depaturemaina" id="anchor4"></a>
                            <input type="hidden" name="rGroup" value="17:01" />
                            <input type="hidden" name="rGroup" value="23:59" />
                            <input type="hidden" name="rGroup" value="dept" />
                            <input type="hidden" name="rGroup" value="btw1723" />
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                    <p>After 5 AM</p>
                                </div>
                        </div>
                    </div>
                </div>

                <!-- End Deptaure flights -->



                <!-- Arrival flights -->
                <div class="mt-4">

                    <h5>Arrival at {{$arrival_cityname[0]}}</h5>

                    <div class="row mt-3 invisible-checkboxes">
                        <div class="col-md-3 align-items-center main-departure depaturemain">
                            <a href="javascript:;" class="anchor depaturemaina" ></a>
                            <input type="hidden" name="rGroup" value="00:00" />
                            <input type="hidden" name="rGroup" value="06:00" />
                            <input type="hidden" name="rGroup" value="arriv" />
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                    <p>Before 6 AM </p>
                                </div>
                        </div>
                        <div class="col-md-3 main-departure depaturemain">
                            <a href="javascript:;" class="anchor depaturemaina" ></a>
                            <input type="hidden" name="rGroup" value="06:01" />
                            <input type="hidden" name="rGroup" value="12:00" />
                            <input type="hidden" name="rGroup" value="arriv" />
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                    <p>6 AM to 12 PM </p>
                                </div>
                        </div>
                        <div class="col-md-3 main-departure depaturemain">
                            <a href="javascript:;" class="anchor depaturemaina" ></a>
                            <input type="hidden" name="rGroup" value="12:01" />
                            <input type="hidden" name="rGroup" value="17:00" />
                            <input type="hidden" name="rGroup" value="arriv" />
                            <div class="departure-1">
                                <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />

                                <p>12 PM to 5 PM </p>
                            </div>
                        </div>
                        <div class="col-md-3 main-departure depaturemain">
                            <a href="javascript:;" class="anchor depaturemaina" id="anchor2"></a>
                            <input type="hidden" name="rGroup" value="17:01" />
                            <input type="hidden" name="rGroup" value="23:59" />
                            <input type="hidden" name="rGroup" value="arriv" />
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />

                                    <p>After 5 AM </p>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- End Arrival flights -->



                <!-- Airlines Details -->
                    <div class="mt-4">
                        <h5>Airlines</h5>
                        @php $a = 0 @endphp
                        @foreach ($airlinesnames as $key => $airlinesname)
                        <div class="d-flex justify-content-between mt-3">
                            <div>

                                <input type="radio" name="airlines" class="airlinesclickstops" value="{{$airlinesname}}">
                                {{$airlinesname}} ({{$airlinesnames_count[$a]}})

                            </div>
                        </div>
                        @php $a++ @endphp
                        @endforeach


                        {{-- <div class="text-end mt-2"><a href="#">View more</a></div> --}}
                    </div>
                <!-- End Airlines Details -->



            </div>
        </div>

    </div>


    @endif
