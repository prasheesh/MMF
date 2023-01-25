<div class="col-md-3 p-3">
    <div class="card">
        <div class=" card-body card-shadow">
            <h5>One Way Price2</h5>

            <div class="mt-4">
                <form>
                    <input type="range" name="" class="form-range">
                </form>
                <span class=" left-range"><i class="fa-solid fa-indian-rupee-sign"></i> 6,363</span>
                <span class=" right-range"><i class="fa-solid fa-indian-rupee-sign"></i> 20,636</span>

            </div>

            <div class="mt-4">
                <h5>Stops From {{ @$result_array->searchResult->tripInfos->ONWARD[0]->sI[0]->da->city }}</h5>
                <div class="d-flex justify-content-between mt-3">
                    <div> <input type="radio" name="stops" value="0"> <span>Non-stop</span></div>
                    <!--onclick="filterfunction()"-->
                        <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div> <input type="radio" name="stops" value="1"> <span>1Stop</span> </div>
                    <!--onclick="filterfunction()"-->
                        <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                </div>
                <!--<div class="d-flex justify-content-between mt-2">-->
                <!--    <div> <input type="radio" name=""> 1 Stop (2)</div>-->
                <!--    <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>-->
                <!--</div>-->
            </div>


            <div class="mt-4">
                <h5>Departure From Hyderabad</h5>

                <div class="row mt-3 invisible-checkboxes">

                    <div class="col-md-3 align-items-center main-departure depaturemain" id="depart1">
                        <a href="javascript:;" class="anchor depaturemaina" id="anchor1"></a>
                        <input type="hidden" name="rGroup" value="00:00" />
                        <input type="hidden" name="rGroup" value="06:00" />
                        <div class="departure-1">
                            <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                            <p>Before 6 AM <br></p>
                        </div>
                    </div>
                    <div class="col-md-3 main-departure depaturemain" id="depart2">
                        <a href="javascript:;" class="anchor depaturemaina" id="anchor2"></a>
                        <input type="hidden" name="rGroup" value="06:01" />
                        <input type="hidden" name="rGroup" value="12:00" />
                        <div class="departure-1">
                            <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                            <p>6 AM to 12 PM<br></p>
                        </div>
                    </div>
                    <div class="col-md-3 main-departure depaturemain" id="depart3">
                        <a href="javascript:;" class="anchor depaturemaina" id="anchor3"></a>
                        <input type="hidden" name="rGroup" value="12:01" />
                        <input type="hidden" name="rGroup" value="17:00" />
                        <div class="departure-1">
                            <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />

                            <p>12 PM to 5 PM <br> </p>
                        </div>
                    </div>
                    <div class="col-md-3 main-departure depaturemain" id="depart4">
                        <a href="javascript:;" class="anchor depaturemaina" id="anchor4"></a>
                        <input type="hidden" name="rGroup" value="17:01" />
                        <input type="hidden" name="rGroup" value="23:59" />
                        <div class="departure-1">
                            <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                            <p>After 5 AM <br></p>
                        </div>
                    </div>
                </div>




                <div class="mt-4">
                    <h5>Arrival at Mumbai</h5>

                    <div class="row mt-3 invisible-checkboxes">
                        <div class="col-md-3 align-items-center main-departure">
                            <input type="checkbox" name="rGroup" value="5" id="r5" />
                            <label class="checkbox-alias" for="r5">
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                    <p>Before 6 AM <br> 9418</p>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-3 main-departure">
                            <input type="checkbox" name="rGroup" value="6" id="r6" />
                            <label class="checkbox-alias" for="r6">
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />
                                    <p>6 AM to 12 PM<br> 9586</p>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-3 main-departure">
                            <input type="checkbox" name="rGroup" value="7" id="r7" />
                            <label class="checkbox-alias" for="r7">
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />

                                    <p>12 PM to 5 PM <br> 1158</p>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-3 main-departure">
                            <input type="checkbox" name="rGroup" value="8" id="r8" />
                            <label class="checkbox-alias" for="r8">
                                <div class="departure-1">
                                    <img src="{{ 'assets/img/sun.png' }}" class="img-fluid" />

                                    <p>After 5 AM <br> 2569</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>




                <div class="mt-4">
                    <h5>Airlines</h5>
                    <div class="d-flex justify-content-between mt-3">
                        <div> <input type="radio" name=""> 1 Stop (2)</div>
                        <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div> <input type="radio" name=""> 1 Stop (2)</div>
                        <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div> <input type="radio" name=""> 1 Stop (2)</div>
                        <div> <i class="fa-solid fa-indian-rupee-sign"></i> 6,363</div>
                    </div>
                    <div class="text-end mt-2"><a href="#">View more</a></div>
                </div>

            </div>
        </div>
    </div>
</div>
