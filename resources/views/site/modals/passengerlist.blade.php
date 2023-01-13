            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Travellers & Class</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-7 mb-4">
                                    <p>ADULTS (12y +)</p>
                                    <ul class="count" id="passengerCount">
                                        <li class="active" id="adult1" data-val="1">1</li>
                                        <li data-val="2" id="adult2">2</li>
                                        <li data-val="3" id="adult3">3</li>
                                        <li data-val="4" id="adult4">4</li>
                                        <li data-val="5" id="adult5">5</li>
                                        <li data-val="6" id="adult6">6</li>
                                        <li data-val="7" id="adult7">7</li>
                                        <li data-val="8" id="adult8">8</li>
                                        <li data-val="9" id="adult9">9</li>
                                    </ul>
                                </div>

                                <div class="col-md-5 mb-4">
                                    <p>CHILDREN (2y - 12y )</p>
                                    <ul class="count passengerCountchild">
                                        <li id="child0" data-val="0" class="active">0</li>
                                        <li data-val="1" id="child1">1</li>
                                        <li data-val="2" id="child2">2</li>
                                        <li data-val="3" id="child3">3</li>
                                        <li data-val="4" id="child4">4</li>
                                        <li data-val="5" id="child5">5</li>
                                        <li data-val="6" id="child6">6</li>
                                    </ul>
                                </div>

                                <div class="col-md-12 mb-4 errorinfant">
                                    <p>INFANTS (below 2y)</p>
                                    <ul class="count passengerCountinfant">
                                        <li id="infant0" data-val="0" class="active">0</li>
                                        <li data-val="1" id="infant1">1</li>
                                        <li data-val="2" id="infant2">2</li>
                                        <li data-val="3" id="infant3">3</li>
                                        <li data-val="4" id="infant4">4</li>
                                        <li data-val="5" id="infant5">5</li>
                                        <li data-val="6" id="infant6">6</li>
                                    </ul>
                                </div>

                                <div class="col-md-5 mb-4">
                                    <p>CHOOSE TRAVEL CLASS</p>
                                    <ul class="count" id="chooseTravel">
                                        {{-- <li class="active" id="travel1" data-val="PREMIUM_ECONOMY">Premium Economy</li> --}}
                                        <li class="active" id="travel2" data-val="ECONOMY">Economy</li>
                                        <li id="travel3" data-val="BUSINESS">Business</li>
                                        <li id="travel4" data-val="FIRST">First Class</li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-one" data-bs-dismiss="modal">Close</button>
                            <button id="saveTravelDetail" type="button" class="btn btn-theme" data-bs-dismiss="modal">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->
