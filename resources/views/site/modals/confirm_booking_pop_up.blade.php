 <!-- Modal -->
            <div class="modal fade" id="confirmBookingModal" tabindex="-1" aria-labelledby="confirmBookingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmBookingModalLabel">Balance</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                        </div>
                        <div class="modal-body">

                            <div>
                                <h5>Available Balance</h5>
                                <p>{{ number_format($available_balance,2) }}</p>
                            </div>
                            <div>
                                <h5>Required Balance</h5>
                                <p>{{ number_format($ttl_price,2) }}</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-one" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-blue-continue confirmBooking" ><a> Procced to Pay</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->
