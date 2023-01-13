@extends('layouts.app')
@section('style-content')
    <link href="assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        /*::-webkit-scrollbar-track {
              box-shadow: inset 0 0 5px grey;
              border-radius: 10px;
            }*/

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #c1c1c1;
        }

        .table-booking {
            font-size: 14px;
            margin-bottom: 0;
        }

        .table-booking th {
            padding: 15px;
        }

        .table-booking td {
            padding: 15px;
        }

        .final-price {
            font-size: 18px;
            margin-bottom: 0;
        }

        .form-control {
            padding: 15px 0px 15px 15px;
        }

        .modal-headd {
            background: #257483;
            color: white;
            border-radius: 0;
            border: 0px solid #257483;
        }
    </style>




    <!-- Meals carousel -->

    <style>
        .mycard {
            height: 450px;
            overflow: scroll;
            width: 100%;
        }

        .cardtitle {
            font-weight: bold;
            --tw-text-opacity: 1;
            color: rgba(31, 41, 55, var(--tw-text-opacity));
            text-align: center;
        }

        .cardimg {
            margin-left: auto;
            margin-right: auto;
            margin-top: 2.75rem;
            margin-bottom: 2.75rem;
            max-height: 6rem;
            border-radius: 9999px;
        }

        .carddescription {
            --tw-text-opacity: 1;
            color: rgba(107, 114, 128, var(--tw-text-opacity));
            text-align: center;
        }

        .slider {
            width: 100%;

            min-height: 385px;
        }

        .slider input {
            visibility: hidden;
        }

        .testimonials {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 375px;
            perspective: 500px;
            overflow: hidden;
        }

        .testimonials .item {
            width: 85% !important;
            border-radius: 0px;
            border-width: 2px;
            --tw-border-opacity: 1;
            border-color: rgba(30, 58, 138, var(--tw-border-opacity));
            top: 5px;
            left: 3px;
            position: absolute;
            box-sizing: border-box;
            background-color: #fff;
            padding: 10px;
            width: 450px;
            text-align: center;
            transition: transform 0.4s;
            -webkit-transform-style: preserve-3d;
            box-shadow: 0 0 10px rgb(0 0 0 / 30%);
            user-select: none;
            cursor: pointer;
        }

        .testimonials .item h2 {
            font-size: 14px;
        }

        .dots {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dots label {
            display: block;
            height: 5px;
            width: 5px;
            border-radius: 50%;
            cursor: pointer;
            background-color: #413b52;
            margin: 7px;
            transition: transform 0.2s, color 0.2s;
        }

        /* First */
        #t-1:checked~.dots label[for="t-1"] {
            transform: scale(2);
            background-color: #fff;
        }

        #t-1:checked~.dots label[for="t-2"] {
            transform: scale(1.5);
        }

        #t-1:checked~.testimonials label[for="t-1"] {
            z-index: 4;
        }

        #t-1:checked~.testimonials label[for="t-2"] {
            transform: translateX(300px) translateZ(-90px) translateY(-15px);

            z-index: 3;
        }

        #t-1:checked~.testimonials label[for="t-3"] {
            transform: translateX(600px) translateZ(-180px) translateY(-30px);
            z-index: 2;
        }

        #t-1:checked~.testimonials label[for="t-4"] {
            transform: translateX(900px) translateZ(-270px) translateY(-45px);
            z-index: 1;
        }

        #t-1:checked~.testimonials label[for="t-5"] {
            transform: translateX(1200px) translateZ(-360px) translateY(-60px);
        }

        /* Second */
        #t-2:checked~.dots label[for="t-1"] {
            transform: scale(1.5);
        }

        #t-2:checked~.dots label[for="t-2"] {
            transform: scale(2);
            background-color: #fff;
        }

        #t-2:checked~.dots label[for="t-3"] {
            transform: scale(1.5);
        }

        #t-2:checked~.testimonials label[for="t-1"] {
            transform: translateX(-300px) translateZ(-90px) translateY(-15px);
        }

        #t-2:checked~.testimonials label[for="t-2"] {
            z-index: 3;
            left: 300px;
        }

        #t-2:checked~.testimonials label[for="t-3"] {
            transform: translateX(300px) translateZ(-90px) translateY(-15px);
            z-index: 2;
        }

        #t-2:checked~.testimonials label[for="t-4"] {
            transform: translateX(600px) translateZ(-180px) translateY(-30px);
            z-index: 1;
        }

        #t-2:checked~.testimonials label[for="t-5"] {
            transform: translateX(900px) translateZ(-270px) translateY(-45px);
        }
    </style>
@endsection

@section('content')
    <section class="">
        <div class="bg-grey" style="height: 300px; margin-bottom: -270px;"></div>
        <div class="container container-make">
            <div class="row">
                <div class="col-md-9 p-3">
                    <h5><b>Complete your booking</b></h5>
                    <div class="card">
                        <div class="card-body">

                            <div class="mt-3 mb-3 cancelation-tab">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">
                                            <i class="fa-solid fa-seat-airline"></i> Seats</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">Meals</button>
                                    </li>
                                </ul>

                                <div class="tab-content ps-3" id="pills-tabContent">

                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div class="hyderabad-booking">
                                            <h6>Hyderabad - Mumbai</h6>
                                            <p>0 of 1 selected</p>
                                        </div>
                                        <div class="row align-items-end">
                                            <div class="col-md-4">
                                                <div class="row bussiness-p">
                                                    <div class="col-md-3 ">
                                                        <img src="assets/img/portfolio64.png" class="img-fluid">
                                                    </div>
                                                    <div class="col-md-9 ps-0">
                                                        <p>Bussiness Class</p>
                                                        <p>18 Seats <span>(79- in pitch)</span></p>
                                                    </div>
                                                </div>


                                                <div class="row bussiness-p mt-3">
                                                    <div class="col-md-3 ">
                                                        <img src="assets/img/sofa64.png" class="img-fluid">
                                                    </div>
                                                    <div class="col-md-9 ps-0">
                                                        <p>Economy Class</p>
                                                        <p>236 Seats <span>(33- in pitch)</span></p>
                                                    </div>
                                                </div>

                                                <ul class="bussiness-ul">
                                                    <li><span><img src="assets/img/preferred-seats.png" class="img-fluid">
                                                        </span>
                                                        <p>{{ $isBookedtrue }} Booked Seats <span>(34- in pitch)</span></p>
                                                    </li>

                                                    <li><span><img src="assets/img/preferred-seats1.png" class="img-fluid">
                                                        </span>
                                                        <p>5 Bussiness Seats</p>
                                                    </li>
                                                    <li><span><img src="assets/img/preferred-seats2.png" class="img-fluid">
                                                        </span>
                                                        <p>{{ $isLegroom }} Leg Space Seats</p>
                                                    </li>

                                                    <li><span><img src="assets/img/preferred-seats3.png" class="img-fluid">
                                                        </span>
                                                        <p>2 Windowless Seats</p>
                                                    </li>

                                                    <li><span><img src="assets/img/preferred-seats4.png" class="img-fluid">
                                                        </span>
                                                        <p>Emergency Exit Seats <span>fixed armered seats</span></p>
                                                    </li>

                                                    <li><span><img src="assets/img/preferred-seats5.png" class="img-fluid">
                                                        </span>
                                                        <p>Emergency Seats</p>
                                                    </li>
                                                </ul>

                                            </div>

                                            <div class="col-md-8 meals-seats">
                                                <img src="assets/img/flight-booking-img.png" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Meals tab -->

                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">

                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#demo" data-bs-slide-to="0"
                                                class="active"></button>
                                            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                                            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                                        </div>




                                        <div class="slider" id="demo">
                                            <input type="radio" name="testimonial" id="t-1" />
                                            <input type="radio" name="testimonial" id="t-2" />
                                            <input type="radio" name="testimonial" id="t-3" checked />
                                            <input type="radio" name="testimonial" id="t-4" />
                                            <input type="radio" name="testimonial" id="t-5" />
                                            <div class="testimonials mb-8">
                                                <label class="item" for="t-1">
                                                    <div class="mycard">

                                                        <div class="row align-items-center border-bottom">
                                                            <div class="col-md-6 meals-border-left">
                                                                <h6>Hyderabad to Mumbai</h6>
                                                                <p>0 of 1 Meals Selected</p>
                                                            </div>
                                                            <div class="col-md-6 meals-input">
                                                                <input type="checkbox" name="">
                                                                <span>Veg</span>
                                                                <input type="checkbox" name="">
                                                                <span>Non-Veg</span>
                                                            </div>
                                                        </div>


                                                        <div class="row align-items-center meals-parent">
                                                            <div class="col-md-2 ">
                                                                <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-8 meals-headtxt">
                                                                <h6>UNIBIC CHOCOLATE CHIPS COOKIES 50 GMS</h6>
                                                                <p><b><i class="fa-solid fa-indian-rupee-sign"></i> 200</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <button class="btn btn-add">ADD</button>
                                                            </div>
                                                        </div>

                                                        <div class="row align-items-center meals-parent">
                                                            <div class="col-md-2 ">
                                                                <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-8 meals-headtxt">
                                                                <h6>UNIBIC CHOCOLATE CHIPS COOKIES 50 GMS</h6>
                                                                <p><b><i class="fa-solid fa-indian-rupee-sign"></i> 200</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <button class="btn btn-add">ADD</button>
                                                            </div>
                                                        </div>

                                                        <div class="row align-items-center meals-parent">
                                                            <div class="col-md-2 ">
                                                                <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-8 meals-headtxt">
                                                                <h6>UNIBIC CHOCOLATE CHIPS COOKIES 50 GMS</h6>
                                                                <p><b><i class="fa-solid fa-indian-rupee-sign"></i> 200</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <button class="btn btn-add">ADD</button>
                                                            </div>
                                                        </div>


                                                        <div class="row align-items-center meals-parent">
                                                            <div class="col-md-2 ">
                                                                <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-8 meals-headtxt">
                                                                <h6>UNIBIC CHOCOLATE CHIPS COOKIES 50 GMS</h6>
                                                                <p><b><i class="fa-solid fa-indian-rupee-sign"></i> 200</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <button class="btn btn-add">ADD</button>
                                                            </div>
                                                        </div>


                                                        <div class="row align-items-center meals-parent">
                                                            <div class="col-md-2 ">
                                                                <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-8 meals-headtxt">
                                                                <h6>UNIBIC CHOCOLATE CHIPS COOKIES 50 GMS</h6>
                                                                <p><b><i class="fa-solid fa-indian-rupee-sign"></i> 200</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <button class="btn btn-add">ADD</button>
                                                            </div>
                                                        </div>


                                                        <div class="row align-items-center meals-parent">
                                                            <div class="col-md-2 ">
                                                                <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-8 meals-headtxt">
                                                                <h6>UNIBIC CHOCOLATE CHIPS COOKIES 50 GMS</h6>
                                                                <p><b><i class="fa-solid fa-indian-rupee-sign"></i> 200</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <button class="btn btn-add">ADD</button>
                                                            </div>
                                                        </div>

                                                        <div class="row align-items-center meals-parent">
                                                            <div class="col-md-2 ">
                                                                <img src="assets/img/veg-curry1.png" class="img-fluid">
                                                            </div>
                                                            <div class="col-md-8 meals-headtxt">
                                                                <h6>UNIBIC CHOCOLATE CHIPS COOKIES 50 GMS</h6>
                                                                <p><b><i class="fa-solid fa-indian-rupee-sign"></i> 200</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2 ">

                                                                <button class="btn btn-add">ADD</button>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <p class="carddescription">Poner en práctica los conocimientos
                                                                adquiridos.</p>
                                                        </div>

                                                    </div>
                                                </label>


                                            </div>

                                        </div>

                                    </div>

                                    <!-- End of Meals tab -->
                                </div>
                            </div>

                        </div>

                        <div class="row mt-5">
                            <div class="col-md-3 ms-auto">
                                <button class="btn btn-blue-continue"> Procced to Pay</button>
                            </div>
                        </div>
                    </div>






            </div>

            <div class="col-md-3 p-3 mt30 ">
                <div class="card">
                    <div class=" card-body card-shadow">
                        <h5><b>Fare Summery</b></h5>

                        <div class="accordion" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne">
                                        <span class="ms-2">Base Fare </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> 4,600</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    <small class="ms-3">
                                        <span>Base Fare </span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i>
                                            4,600</span>
                                    </small>
                                </div>
                            </div>
                        </div>


                        <div class="accordion mt-2" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne2">
                                        <span class="ms-2">Fee & Surcharges </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> 500</span>
                                    </button>
                                </h2>
                                <div id="collapseOne2" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    <small class="ms-3">
                                        <span>Other Charges </span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> 125</span>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mt-2" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne3">
                                        <span class="ms-2">Other Charges </span> <span class="ms-auto"> <i
                                                class="fa-solid fa-indian-rupee-sign"></i> 125</span>
                                    </button>
                                </h2>
                                <div id="collapseOne3" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                    <small class="ms-3">
                                        <span>Other Charges </span>
                                        <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> 125</span>
                                    </small>
                                </div>
                            </div>
                            <div class="border-dassed"></div>
                        </div>

                        <div class="row ">
                            <div class="col-md-7">
                                <b>Total Amount</b>
                            </div>
                            <div class="col-md-5  text-end">
                                <i class="fa-solid fa-indian-rupee-sign"></i> 5,225
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection

@section('script-content')
    <!-- Meals Carousel -->

    <script type="text/javascript">
        const $ = str => document.querySelector(str);
        const $$ = str => document.querySelectorAll(str);

        (function() {
            if (!window.app) {
                window.app = {};
            }
            app.carousel = {
                removeClass: function(el, classname = '') {
                    if (el) {
                        if (classname === '') {
                            el.className = '';
                        } else {
                            el.classList.remove(classname);
                        }
                        return el;
                    }
                    return;
                },
                reorder: function() {
                    let childcnt = $("#carousel").children.length;
                    let childs = $("#carousel").children;

                    for (let j = 0; j < childcnt; j++) {
                        childs[j].dataset.pos = j;
                    }
                },
                move: function(el) {
                    let selected = el;

                    if (typeof el === "string") {
                        console.log(`got string: ${el}`);
                        selected = (el == "next") ? $(".selected").nextElementSibling : $(".selected")
                            .previousElementSibling;
                        console.dir(selected);
                    }

                    let curpos = parseInt(app.selected.dataset.pos);
                    let tgtpos = parseInt(selected.dataset.pos);

                    let cnt = curpos - tgtpos;
                    let dir = (cnt < 0) ? -1 : 1;
                    let shift = Math.abs(cnt);

                    for (let i = 0; i < shift; i++) {
                        let el = (dir == -1) ? $("#carousel").firstElementChild : $("#carousel")
                            .lastElementChild;

                        if (dir == -1) {
                            el.dataset.pos = $("#carousel").children.length;
                            $('#carousel').append(el);
                        } else {
                            el.dataset.pos = 0;
                            $('#carousel').prepend(el);
                        }

                        app.carousel.reorder();
                    }


                    app.selected = selected;
                    let next = selected
                        .nextElementSibling; // ? selected.nextElementSibling : selected.parentElement.firstElementChild;
                    var prev = selected
                        .previousElementSibling; // ? selected.previousElementSibling : selected.parentElement.lastElementChild;
                    var prevSecond = prev ? prev.previousElementSibling : selected.parentElement
                        .lastElementChild;
                    var nextSecond = next ? next.nextElementSibling : selected.parentElement.firstElementChild;

                    selected.className = '';
                    selected.classList.add("selected");

                    app.carousel.removeClass(prev).classList.add('prev');
                    app.carousel.removeClass(next).classList.add('next');

                    app.carousel.removeClass(nextSecond).classList.add("nextRightSecond");
                    app.carousel.removeClass(prevSecond).classList.add("prevLeftSecond");

                    app.carousel.nextAll(nextSecond).forEach(item => {
                        item.className = '';
                        item.classList.add('hideRight')
                    });
                    app.carousel.prevAll(prevSecond).forEach(item => {
                        item.className = '';
                        item.classList.add('hideLeft')
                    });

                },
                nextAll: function(el) {
                    let els = [];

                    if (el) {
                        while (el = el.nextElementSibling) {
                            els.push(el);
                        }
                    }

                    return els;

                },
                prevAll: function(el) {
                    let els = [];

                    if (el) {
                        while (el = el.previousElementSibling) {
                            els.push(el);
                        }
                    }


                    return els;
                },
                keypress: function(e) {
                    switch (e.which) {
                        case 37: // left
                            app.carousel.move('prev');
                            break;

                        case 39: // right
                            app.carousel.move('next');
                            break;

                        default:
                            return;
                    }
                    e.preventDefault();
                    return false;
                },
                select: function(e) {
                    console.log(`select: ${e}`);
                    let tgt = e.target;
                    while (!tgt.parentElement.classList.contains('carousel')) {
                        tgt = tgt.parentElement;
                    }

                    app.carousel.move(tgt);

                },
                previous: function(e) {
                    app.carousel.move('prev');
                },
                next: function(e) {
                    app.carousel.move('next');
                },
                doDown: function(e) {
                    console.log(`down: ${e.x}`);
                    app.carousel.state.downX = e.x;
                },
                doUp: function(e) {
                    console.log(`up: ${e.x}`);
                    let direction = 0,
                        velocity = 0;

                    if (app.carousel.state.downX) {
                        direction = (app.carousel.state.downX > e.x) ? -1 : 1;
                        velocity = app.carousel.state.downX - e.x;

                        if (Math.abs(app.carousel.state.downX - e.x) < 10) {
                            app.carousel.select(e);
                            return false;
                        }
                        if (direction === -1) {
                            app.carousel.move('next');
                        } else {
                            app.carousel.move('prev');
                        }
                        app.carousel.state.downX = 0;
                    }
                },
                init: function() {
                    document.addEventListener("keydown", app.carousel.keypress);
                    // $('#carousel').addEventListener("click", app.carousel.select, true);
                    $("#carousel").addEventListener("mousedown", app.carousel.doDown);
                    $("#carousel").addEventListener("touchstart", app.carousel.doDown);
                    $("#carousel").addEventListener("mouseup", app.carousel.doUp);
                    $("#carousel").addEventListener("touchend", app.carousel.doup);

                    app.carousel.reorder();
                    $('#prev').addEventListener("click", app.carousel.previous);
                    $('#next').addEventListener("click", app.carousel.next);
                    app.selected = $(".selected");

                },
                state: {}

            }
            app.carousel.init();
        })();
    </script>
@endsection
