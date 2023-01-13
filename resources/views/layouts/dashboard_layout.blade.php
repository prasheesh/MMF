<!DOCTYPE html>
<html>

<head>
    
        

    

    

    

    


</head>

<body>

    <!-- book modal -->
    <div class="modal" id="book-table">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                            class="fa fa-times"></i></button>

                    <table class="table table-booking" style="">
                        <thead class="bg-grey" style="border-bottom: 2px solid #fff;">
                            <tr>
                                <th class="">FARES</th>
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
                            <tr>
                                <td class=""><b>Saver</b>
                                    <p>
                                        Fair offered by airline.
                                    </p>
                                </td>
                                <td>7kgs</td>
                                <td>15kgs</td>
                                <td>cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500
                                </td>
                                <td>Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250
                                </td>
                                <td>Middle Seat Free, <br> Window/Asile Chargeable</td>
                                <td>----</td>
                                <td align="right">
                                    <p class="final-price"><b><i class="fa-solid fa-indian-rupee-sign"></i> 5,834</b>
                                    </p>
                                    <a href="passenger-details.html"> <button class="btn btn-book-now">Book Now</button>
                                    </a>
                                </td>

                            </tr>


                            <tr>
                                <td class=""><b>Saver</b>
                                    <p>
                                        Fair offered by airline.
                                    </p>
                                </td>
                                <td>7kgs</td>
                                <td>15kgs</td>
                                <td>cancellation <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3,500
                                </td>
                                <td>Date change <br> fee starting <i class="fa-solid fa-indian-rupee-sign"></i> 3250
                                </td>
                                <td>Middle Seat Free, <br> Window/Asile Chargeable</td>
                                <td>----</td>
                                <td align="right">
                                    <p class="final-price"><b><i class="fa-solid fa-indian-rupee-sign"></i> 5,834</b>
                                    </p>
                                    <a href="passenger-details.html"> <button class="btn btn-book-now">Book
                                            Now</button></a>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- book modal end -->

    <!-- View flight Detials   -->
    <div class="modal" id="flightdetails">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                    <h4>Flight Detials</h4>
                    <hr>
                    <div class="clearfix mb-3"></div>

                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <span><img src="{{ asset('assets/img/flight-logo-2.png') }}" class="img-fluid" width="30%"></span>
                            <span><b>Indigo</b></span>
                        </div>
                        <div class="col-md-8">
                            <p>Abu Dhabi to Bengaluru , 27 Sep</p>
                        </div>
                        <div class="col-md-12 mt-3">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="33.3%">
                                        <div>
                                            <p class="flight-brand">05:30</p>
                                            <p class="flight-number">Hyderabad</p>
                                        </div>
                                    </td>
                                    <td width="33.3%">
                                        <div>
                                            <small><span class="brdr-btm-time">NON-STOP</span></small><br>
                                            <!--                                            <small>01 h 25 m </small>-->
                                        </div>
                                    </td>
                                    <td width="33.3%">
                                        <div>
                                            <p class="flight-brand">07:40</p>
                                            <p class="flight-number">Mumbai</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small>Terminal 1<br>Abu Dhabi,<br>United Arab Emirate</small>
                                    </td>
                                    <td></td>
                                    <td>
                                        <small>Terminal 2<br>Mumbai, India</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>BAGGAGE</b></p><small>ADULT</small>
                                    </td>
                                    <td>
                                        <p><b>CHECK IN</b></p><small>40 Kgs</small>
                                    </td>
                                    <td>
                                        <p><b>CABIN</b></p><small>8 Kgs</small>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- View flight detials end   -->


    <!-- View Price -->

    <div class="modal" id="ViewPrice">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>You have <b>more fares</b> to select from</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">

                    <div class="container card-bkdetail">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12 mb-3">
                                    <p class="deapt">DEPART</p>
                                </div>
                                <div class="clearfix mb-2"></div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-3 p-0">
                                                <img src="{{ asset('assets/img/flight-logo-2.png') }}" class="img-fluid">
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <span><b>IndiGo</b> | 6E-6106</span>
                                                <p class="ms-0">Airways | QF-1533</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 m-auto">
                                        <h4 class="citiname">Hyderabad</h4>
                                        <p>Date and Departure</p>
                                    </div>
                                    <div class="col-md-3 m-auto">
                                        <h4 class="citiname">Mumbai</h4>
                                        <p>Return</p>
                                    </div>
                                </div>

                                <table class="table table-borderless table-striped mt-3">
                                    <tr class="bg-grey">
                                        <td colspan="2"></td>
                                        <td class="bag-icon"><i class="fa-solid fa-briefcase"></i> <br>Cabin Bag</td>
                                        <td class="bag-icon"><i class="fa-solid fa-suitcase-rolling"></i><br> Check In
                                        </td>
                                        <td class="bag-icon"><i class="fa-solid fa-plane-slash"></i> <br>Cancellation
                                        </td>
                                        <td class="bag-icon"><i class="fa-solid fa-calendar-days"></i><br> Date Change
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span><input type="radio"></span>
                                            <span><b>Saver</b></span><br>
                                            <small>Fare offered by Airlines</small>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 4,353</td>
                                        <td>7 Kgs</td>
                                        <td>20 Kgs</td>
                                        <td>Cancellation Fee Apply</td>
                                        <td>Chargeable</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span><input type="radio"></span>
                                            <span><b> Flexi Plus</b></span><br>
                                            <small>Fare offered by Airlines</small>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 6,363</td>
                                        <td>7 Kgs</td>
                                        <td>20 Kgs</td>
                                        <td>Cancellation Fee Apply</td>
                                        <td>Chargeable</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span><input type="radio"></span>
                                            <span><b>Super 6E</b></span><br>
                                            <small>Fare offered by Airlines</small>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 5,373</td>
                                        <td>7 Kgs</td>
                                        <td>20 Kgs</td>
                                        <td>Cancellation Fee Apply</td>
                                        <td>Chargeable</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="card ">
                            <div class="card-body">
                                <div class="col-md-12 mb-3">
                                    <p class="deapt">RETURN</p>
                                </div>
                                <div class="clearfix mb-2"></div>
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-3 p-0">
                                                <img src="{{ asset('assets/img/flight-logo-2.png') }}" class="img-fluid">
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <span><b>IndiGo</b> | 6E-6106</span>
                                                <p class="ms-0">Airways | QF-1533</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 m-auto">
                                        <h4 class="citiname">Hyderabad</h4>
                                        <p>Date and Departure</p>
                                    </div>
                                    <div class="col-md-3 m-auto">
                                        <h4 class="citiname">Mumbai</h4>
                                        <p>Return</p>
                                    </div>
                                </div>

                                <table class="table table-borderless table-striped mt-3">
                                    <tr class="bg-grey">
                                        <td colspan="2"></td>
                                        <td class="bag-icon"><i class="fa-solid fa-briefcase"></i> <br>Cabin Bag</td>
                                        <td class="bag-icon"><i class="fa-solid fa-suitcase-rolling"></i><br> Check In
                                        </td>
                                        <td class="bag-icon"><i class="fa-solid fa-plane-slash"></i> <br>Cancellation
                                        </td>
                                        <td class="bag-icon"><i class="fa-solid fa-calendar-days"></i><br> Date Change
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span><input type="radio"></span>
                                            <span><b>Saver</b></span><br>
                                            <small>Fare offered by Airlines</small>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 4,353</td>
                                        <td>7 Kgs</td>
                                        <td>20 Kgs</td>
                                        <td>Cancellation Fee Apply</td>
                                        <td>Chargeable</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span><input type="radio"></span>
                                            <span><b> Flexi Plus</b></span><br>
                                            <small>Fare offered by Airlines</small>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 6,363</td>
                                        <td>7 Kgs</td>
                                        <td>20 Kgs</td>
                                        <td>Cancellation Fee Apply</td>
                                        <td>Chargeable</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span><input type="radio"></span>
                                            <span><b>Super 6E</b></span><br>
                                            <small>Fare offered by Airlines</small>
                                        </td>
                                        <td><i class="fa-solid fa-indian-rupee-sign"></i> 5,373</td>
                                        <td>7 Kgs</td>
                                        <td>20 Kgs</td>
                                        <td>Cancellation Fee Apply</td>
                                        <td>Chargeable</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer footer-btn">
                    <p><i class="fa-solid fa-indian-rupee-sign"></i> 8950 <br> <small> FOR 1 ADULT</small></p>
                    <button class="btn btn-book-now">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Price end -->
   

    <!-- ======= Footer ======= -->
    {{-- <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <img src="{{ asset('assets/img/MMF.png') }}" class="img-fluid" width="150">
                        <p class="mt-3">

                            <strong>Phone:</strong> +9140 66464466<br>
                            <strong>Email:</strong>support@makemyfly.com<br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4></h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.html">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="about.html">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="services.html">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="contact.html">Contact Us</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4></h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="privacy-polciy.html">Privacy Policy</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="terms-conditions.html">Terms of
                                    Service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="payment">Make Payment</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <!--<h4>Join Our Newsletter</h4>-->
                        <!--<p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>-->
                        <!--<form action="" method="post">-->
                        <!--  <input type="email" name="email"><input type="submit" value="Subscribe">-->
                        <!--</form>-->

                        <div style="text-align:left;">
                            <h4>Address</h4>

                            <p class="" style="color:#777;"> 21-7-760 , Ghansi bazaar,<br> Hyderabad - 500002
                            </p>

                        </div>

                        <div class="social-links text-left text-md-right pt-3 pt-md-0">

                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>

                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>


                        </div>




                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright" style="color: #fff;">
                    &copy; Copyright <strong><span>MakeMyFly</span></strong>. All Rights Reserved
                </div>

            </div>


            <div class="credits">

                Designed by <a href="https://vmaxindia.com" target="_blank">VMax</a>
            </div>




        </div>
    </footer> --}}
    <!-- End Footer -->

    

    






    <script type="text/javascript">
        $(document).ready(function() {
            $('.carousel').slick({
                slidesToShow: 7,
                dots: false,
                centerMode: true,
            });
        });
    </script>


</body>

</html>
