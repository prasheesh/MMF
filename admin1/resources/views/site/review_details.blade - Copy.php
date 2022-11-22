@extends('layouts.app')
@section('style-content')
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css')}}" >


<style>

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

.fare-P small {
  color: #ccc;
}
.fare-P h4 {
      margin-bottom: 0;
    font-size: 16px;
    font-weight: 600;
    color: #83bdd0;
}
.text-olld {
      text-decoration: line-through;
}


</style>
@endsection
@section('content')
<!--Review Details modal -->
<?php
 $priceIds = $_REQUEST['pkey'];
?>

<div class="modal" id="review-details">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="modal-header modal-headd">
            <h6>Review Details</h6>
          </div>
           <button type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>

            {{-- <div class="p-3 passengerreview">
             <table class="table table-bordered ">
               <tr>
                 <td>First & Middle Name</td>
                 <td>Raju</td>
               </tr>
               <tr>
                 <td>Last Name</td>
                 <td>Krishna</td>
               </tr>
                <tr>
                 <td>Gender</td>
                 <td>Male</td>
               </tr>
             </table>
           </div> --}}
           <div id="passenger_div"></div>


             <div class="modal-footer text-end">
              <button class="btn btn-edit" onclick="edit_field()">Edit</button>
                <a href="{{ route('booking-final')}}"><button class="btn btn-confirm" id="cnfBtn">Confirm</button></a>
             </div>

           <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>


  <!-- Review Details end -->

  <div class="bg-grey" style="height: 300px; margin-bottom: -270px;"></div>

  <?php  foreach($fair_rules->fareRule as $k => $fair_rules){ ?>
  <section class="" >



    <div class="container container-make">
     <div class="row">

     <div class="col-md-9 p-3">
        <h5><b>Complete your booking</b></h5>
       <div class="card">
        <?php
        $dep_time = strtotime($result_array->tripInfos[0]->sI[0]->dt);
        $arr_time = strtotime($result_array->tripInfos[0]->sI[0]->at);
        $total_time = $arr_time -  $dep_time;
        $hours = floor($total_time / 3600);
        $minutes = floor(($total_time / 60) % 60);
        $seconds = $total_time % 60;

        $date = date('N' ,strtotime($result_array->tripInfos[0]->sI[0]->dt));
        if($date == 1){
          $day = "Monday";
        }elseif($date == 2){
          $day = "Tuesday";
        }elseif($date == 3){
          $day = "Wednessday";
        }elseif($date == 4){
          $day = "Thursday";
        }elseif($date == 5){
          $day = "Friday";
        }elseif($date == 6){
          $day = "Saturday";
        }elseif($date == 7){
          $day = "Sunday";
        }


        ?>
         <div class="card-body card-shadow">
            <div class="d-flex align-items-center justify-content-between">
              <div>
               {{-- @dd($result_array); --}}
               <?php //echo "<pre>"; print_r($result_array->tripInfos[0]->sI[0]->da->name); exit;?>
                <h5>{{ $result_array->tripInfos[0]->sI[0]->da->city }} <i class="fa-solid fa-arrow-right" style="    margin: 0px 5px;"></i> {{ $result_array->tripInfos[0]->sI[0]->aa->city }}</h5>
                <p class="f-14-mb-10">{{$day}}, {{date('M d' ,strtotime($result_array->tripInfos[0]->sI[0]->dt))  }}  <?php if( $result_array->tripInfos[0]->sI[0]->stops == 0 ){ echo "Non stop";}else{ echo($result_array->tripInfos[0]->sI[0]->stops)."stop";  } ?> - {{$hours}}h {{ $minutes}}m</p>
              </div>

              <div>
                <button class="btn btn-refund">NON-REFUNDABLE</button>
                <p class="mt-3 f-14-mb-10">View Fare Rules</p>
              </div>

            </div>
            <?php
               $flight_code = $result_array->tripInfos[0]->sI[0]->fD->aI->code;
               $flight_logo = 'assets/img/AirlinesLogo/'.$flight_code.'.png';
             ?>
           <div class="d-flex align-items-center justify-content-between">
             <div>
               <img src="{{ $flight_logo }}" style="    width: 25%"> {{ $result_array->tripInfos[0]->sI[0]->fD->aI->name }}, {{ $result_array->tripInfos[0]->sI[0]->fD->aI->code }} {{ $result_array->tripInfos[0]->sI[0]->fD->fN }}
             </div>
              <div>
                <a href="#">{{ $result_array->tripInfos[0]->totalPriceList[0]->fd->ADULT->cc }}</a>
                <i class="fa-solid fa-angle-right"></i>
                <a href="#">{{ $result_array->tripInfos[0]->totalPriceList[0]->fd->ADULT->cc }} SAVER</a>
              </div>
           </div>

           <div class="row bg-rajiv ">
             <div class="col-md-2">
               <p>{{date('H:i' ,strtotime($result_array->tripInfos[0]->sI[0]->dt))  }}</p>
             </div>
               <div class="col-md-10">
                 <p><b>{{ $result_array->tripInfos[0]->sI[0]->da->city }}.</b> {{ $result_array->tripInfos[0]->sI[0]->da->name }}  </p>
                 <p > {{$hours}}h {{ $minutes}}m</p>
               </div>
                 <div class="col-md-2">
                   <p style="margin-bottom: 0px;">{{date('H:i' ,strtotime($result_array->tripInfos[0]->sI[0]->at))  }}</p>
                 </div>
                   <div class="col-md-10">
                      <p style="margin-bottom: 0px;"><b>{{ $result_array->tripInfos[0]->sI[0]->aa->city }}.</b> {{ $result_array->tripInfos[0]->sI[0]->aa->name }} </p>
                   </div>
           </div>
              <?php

              // foreach($fair_rules->fareRule as $k => $v){
              // print_r($v->fr);
              // }
              ?>

           <div class="row align-items-center cancel-ticket">
             <div class="col-md-1">
               <img src="assets/img/flight-fly.png" class="img-fluid">
             </div>
              <div class="col-md-11 ps-0">
                <h5><b>Cancellation Refund Policy</b></h5>
                <p><?php  if(isset($fair_rules->fr->NO_SHOW)){ echo $fair_rules->fr->NO_SHOW->DEFAULT->policyInfo; } ?></p>
              </div>
           </div>


           <div class="mt-3 mb-3 cancelation-tab">
               <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php if(isset($fair_rules->fr->CANCELLATION)){ ?>
                   <li class="nav-item" role="presentation">
                     <button class="nav-link   <?php if(isset($fair_rules->fr->CANCELLATION)){ echo 'active';} ?> " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Cancellation Charges</button>
                   </li>
                   <?php } ?>
                   <li class="nav-item " role="presentation">
                     <button class="nav-link <?php if(!isset($fair_rules->fr->CANCELLATION)){ echo 'active';} ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Date Changes Charges</button>
                   </li>
                 </ul>
                 <div class="tab-content ps-3" id="pills-tabContent">
                   <div class="tab-pane fade <?php if(isset($fair_rules->fr->CANCELLATION)){ echo 'show active';} ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                      <h6>{{ $result_array->tripInfos[0]->sI[0]->da->city }} - {{ $result_array->tripInfos[0]->sI[0]->aa->city }}</h6>

                      <table class="table table-bordered text-center ">
                       <tbody>
                         {{-- <tr>
                           <th colspan="2">Without Cancellation Protection</th>
                            <th colspan="2">With Cancellation Protection</th>
                         </tr> --}}
                         <tr>
                            <td> Airline Cancellation Fee
                            <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->CANCELLATION)){ echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->ACF; } ?></p></td>
                            <td> Airline Cancellation Fee Tax
                              <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->CANCELLATION)){ echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->ACFT; } ?></p></td>
                             <td>Tripjack Cancellation Fee<p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->CANCELLATION)){ echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->CCF; } ?></p></td>
                              <td> Tripjack Cancellation Fee Tax <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->CANCELLATION)){ echo $fair_rules->fr->CANCELLATION->DEFAULT->fcs->ACFT; } ?></p></td>
                         </tr>
                       </tbody>
                      </table>

                   </div>
                   <div class="tab-pane fade <?php if(!isset($fair_rules->fr->CANCELLATION)){ echo 'show active';} ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <h6>{{ $result_array->tripInfos[0]->sI[0]->da->city }} - {{ $result_array->tripInfos[0]->sI[0]->aa->city }}</h6>

                      <table class="table table-bordered text-center ">
                       <tbody>
                         {{-- <tr>
                           <th colspan="2">Without Cancellation Protection</th>
                            <th colspan="2">With Cancellation Protection</th>
                         </tr> --}}
                         <tr>
                          <td>Airline Reschedule Fee
                           <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->DATECHANGE)){ echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->ARF; } ?></p></td>
                           <td> Airline Reschedule Fee Tax
                             <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->DATECHANGE)){ echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->ARFT; } ?></p></td>
                            <td> Tripjack Reschedule Fee
                              <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->DATECHANGE)){ echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->CRF ; } ?></p></td>
                             <td>  Tripjack Reschedule Fee Tax <p><i class="fa-solid fa-indian-rupee-sign"></i> <?php if(isset($fair_rules->fr->DATECHANGE)){ echo $fair_rules->fr->DATECHANGE->DEFAULT->fcs->CRFT; } ?></p></td>
                        </tr>
                       </tbody>
                      </table>

                   </div>
                 </div>
           </div>


             <div class=" unsure-ticket align-items-center">
                <img src="assets/img/flight-fly.png" class="img-fluid">
                <span><h5><b>Unsure of your travel plans?</b></h5> </span>
             </div>

             <div class="row align-items-center check-ticket">
              <div class="col-md-12 form-check">
                   <input class="form-check-input amtClk" type="checkbox" name="free_change" value="100">
                <div class="add-type">
                 <p >Add Free Date Change</p>
                 <img src="assets/img/calender-addfree.png">
               </div>
                <div class="add-type1">
                 <p>Save up to ₹ 2,625 on date change charges up to 24 hours before departure. You just pay the fare difference. <a href="#"> View T&C </a></p>

                 <h6><i class="fa-solid fa-indian-rupee-sign"></i> 125</h6>
               </div>
              </div>
           </div>

           <div class="row align-items-center cancel-ticket">
             <div class="col-md-1">
               <img src="assets/img/travel-insurance.png" class="img-fluid">
             </div>
              <div class="col-md-11 ps-0">
                <h5><b>Travel Insurance</b></h5>
                <p>Zero cancellation fee for your tickets when you cancel. Pay additional Rs.399</p>
              </div>
           </div>

           <div class="row mt-3">

             <div class="col-md-4 ">
               <div class="delay-tabs">
                 <div class="row ">
                   <div class="col-md-2 img-pl-0">
                     <img src="assets/img/clock-expire-16.png">
                   </div>
                   <div class="col-md-10">
                     <p>Upto  <i class="fa-solid fa-indian-rupee-sign"></i> 1,000 </p>
                     <p>Trip Delay</p>

                   </div>
                 </div>
               </div>
             </div>

              <div class="col-md-4 ">
               <div class="delay-tabs">
                 <div class="row ">
                   <div class="col-md-2 img-pl-0">
                     <img src="assets/img/cancel-2.png">
                   </div>
                   <div class="col-md-10">
                     <p>Upto  <i class="fa-solid fa-indian-rupee-sign"></i> 2,000 </p>
                     <p>Missed flight Connection</p>

                   </div>
                 </div>
               </div>
             </div>

              <div class="col-md-4 ">
               <div class="delay-tabs">
                 <div class="row ">
                   <div class="col-md-2 img-pl-0">
                     <img src="assets/img/cancel-3.png">
                   </div>
                   <div class="col-md-10">
                     <p>Upto  <i class="fa-solid fa-indian-rupee-sign"></i> 2,000 </p>
                     <p>Trip cancellation</p>

                   </div>
                 </div>
               </div>
             </div>
           </div>



           <div class="row align-items-center check-ticket">
              <div class="col-md-12 form-check">
                   <input class="form-check-input amtClk" type="radio" name="secure_trip" id="secure_yes" value="250">
                <div class="">
                 <h6 class="add-free-chk" >Yes, Secure my trip.</h6>
               </div>
              </div>
              <div class="col-md-12 form-check">
                   <input class="form-check-input amtClk" type="radio"  name="secure_trip" id="secure_yes" value="0" checked>
                <div class="">
                 <h6 class="add-free-chk2">I do not wish to secure my trip</h6>
               </div>
              </div>

           </div>
           <div class="input-info">
             <p>By adding insurance you confirm all passengers are between 2 to 70 years of age, and agree to theTerms & Conditions andGood Health Terms</p>
           </div>


           <div class="row align-items-center cancel-ticket">
             <div class="col-md-1">
               <img src="assets/img/enter-travellar-img.png" class="img-fluid">
             </div>
              <div class="col-md-8 ps-0">
                <h5><b>Enter Traveller Details</b></h5>
                <p> Book faster and Easy</p>
              </div>
              <div class=" col-md-3 text-end">
                <button class="btn btn-blue-continue" onclick="clone_div()">Add New Adult</button>
              </div>
           </div>
           <form name="passenger_details" method="POST" action="" id="passenger_details">


             <div class="row first-inputname ">
           <p id="overflow" style="color: red"></p>

               <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="firstname[]" class="form-control" placeholder="First and middle name" required="true">
                </div>

             </div>
             <div class="col-md-4">
               <div class="form-group">
                 <input type="text" name="lastname[]" class="form-control" placeholder="Last name" required="true">
               </div>
             </div>
             <div class="col-md-2">
              <div class="form-group">
               <select name="gender[]" class="form-select" placeholder="Gender" required="true">
                <option value="">Select Gender</option>
                <option value="male">male</option>
                <option value="female">female</option>
               </select>
              </div>
            </div>
             {{-- <div class="col-md-2  ">
              <div class="form-check" role="group" aria-label="Basic outlined example">
                <input class="form-check-input " type="radio" id="Gender"  name="gender[0]"  value="Male" required="true">Male
              </div>
              <div class="form-check" role="group" aria-label="Basic outlined example">

                <input class="form-check-input " type="radio" id="Gender"  name="gender[0]"  value="Female" required="true">Female
              </div>
            </div> --}}
            </div>
            <div id="app_div"></div>
            {{-- </form> --}}
            <div class="row first-inputname ">
             <label>Booking Details will be sent to</label>
              <div class="col-md-2">
               <div class="form-group">
                 {{-- <input type="text" name="country_code" class="form-control" placeholder="Country Code" id="country_code"> --}}
                 <select name="country_code" class="form-control" placeholder="Gender" required="true">
                  <option value="">Select country</option>
                  @foreach ($countries as $countries)
                      <option value="{{$countries->phonecode}}">{{$countries->name}}</option>
                  @endforeach
                 </select>
               </div>
             </div>
              <div class="col-md-5">
               <div class="form-group">
                 <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" required="true" id="mobile" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" >
               </div>
             </div>
              <div class="col-md-5">
               <div class="form-group">
                 <input type="email" name="email" class="form-control" placeholder="Email ID" required="true" id="email_id">
               </div>
             </div>
           </div>
              <div class="row check-ticket-new">
              <div class=" form-check check-ticket">
                   <input class="form-check-input" type="checkbox" name="whatsapp" id="whatsapp">
                 <h6 class="" >Also send my booking details on WhatsApp</h6>

              </div>
            </div>
            <div class="row mt-5">
             <div class="col-md-3 ms-auto text-end">
             {{-- <a href="#"  data-bs-toggle="modal" data-bs-target="#review-details"><button class="btn btn-blue-continue"> Continue
             </button></a> --}}
             <input type="submit" class="btn btn-blue-continue" id="submit" value="submiit">
           </div>
            </div>
           </form>




         </div>
       </div>
     </div>

     <div class="col-md-3 p-3 mt30 ">

      <?php if(isset($result_array->alerts[0])){  ?>
      <div class="card mb-3">
        <div class=" card-body card-shadow">
          <h5><b>Fare Price</b></h5>
          <div class="row">
            <div class="col-md-6 fare-P">
              <h4><i class="fa-solid fa-indian-rupee-sign mr-2"></i> {{number_format($result_array->alerts[0]->newFare,2)}}</h4>
              <small >New price</small>
            </div>
            <div class="col-md-6 fare-P">
              <h4 class="text-olld"><i class="fa-solid fa-indian-rupee-sign mr-2"></i> {{number_format($result_array->alerts[0]->oldFare,2)}}</h4>
              <small >Old price</small>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
        <div class="card">
          <div class=" card-body card-shadow">
            <h5><b>Fare Summery</b></h5>
              <?php
              $basefare = $result_array->tripInfos[0]->totalPriceList[0]->fd->ADULT->fC->BF;
              $adults  =  $result_array->searchQuery->paxInfo->ADULT;
              $adult_base_fair = $basefare * $adults;
              $Taxes = $result_array->tripInfos[0]->totalPriceList[0]->fd->ADULT->fC->BF;
              $bookingId = $result_array->bookingId;
              $TotalAmount =  $adult_base_fair + $Taxes;

              ?>
              <div class="accordion" id="myAccordion">
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            <span class="ms-2">Base Fare </span> <span class="ms-auto"> <i class="fa-solid fa-indian-rupee-sign"></i> {{number_format($adult_base_fair,2)}}</span>
                          </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                           <small class="ms-3">
                            <span>Adult(s) ({{$adults}} X ₹ {{number_format($basefare,2)}})</span>
                             <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i> {{number_format($adult_base_fair,2)}}</span>
                           </small>
                      </div>
                  </div>
              </div>


              <div class="accordion mt-2" id="myAccordion">
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne2">
                            <span class="ms-2">Fee & Surcharges </span> <span class="ms-auto"> <i class="fa-solid fa-indian-rupee-sign"></i> {{number_format($Taxes,2)}}</span>
                          </button>
                      </h2>
                      <div id="collapseOne2" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                           <small class="ms-3">
                            <span>Total fee & surcharges: </span>
                             <span class="float-end"> <i class="fa-solid fa-indian-rupee-sign"></i>  {{number_format($Taxes,2)}}</span>
                           </small>
                      </div>
                  </div>
              </div>

              <div class="accordion mt-2 othercharges" id="myAccordion">
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne3">
                            <span class="ms-2 ">Other Charges </span> <span class="ms-auto OtherAmount"> <i class="fa-solid fa-indian-rupee-sign" ></i> 125</span>
                          </button>
                      </h2>
                      <div id="collapseOne3" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                        <small class="ms-3">
                         <span>Secure Amount: </span>
                          <span class="float-end scrAMT"> <i class="fa-solid fa-indian-rupee-sign"></i>  </span>
                        </small>
                      </div>
                      <div id="collapseOne3" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                        <small class="ms-3">
                         <span>Date Change: </span>
                          <span class="float-end dtcgAMT"> <i class="fa-solid fa-indian-rupee-sign"></i>  </span>
                        </small>
                      </div>

                  </div>

              </div>
              <div class="border-dassed"></div>
              <div class="row ">
                <div class="col-md-7">
                  <b>Total Amount</b>
                </div>
                <div class="col-md-5  text-end Total_Amount">
                  <i class="fa-solid fa-indian-rupee-sign"></i> {{ $TotalAmount}}
                </div>
              </div>


       </div>
      </div>


    </div>
    </div>
    </div>
  </section>
  <?php } ?>
  <script>
    $(document).ready(function(){
      $(".othercharges").hide();

      $(".amtClk").click(function(){

          var secureAMT= parseInt(0);
          var free_dateChange = parseInt(0);
          var secureAMT = $("input[name='secure_trip']:checked").val();
          var adultFare_Charges ='<?php echo $TotalAmount ?>' ;

          if ($("input[name='free_change']:checked").length > 0){
             var free_dateChange = $("input[name='free_change']:checked").val();

          }else{
             var free_dateChange = 0;
          }
          //alert(free_change);
          var other_totalAMT = parseInt(secureAMT) + parseInt(free_dateChange);
          var Total_Amount =   parseInt(adultFare_Charges) + parseInt(other_totalAMT);
          //  alert(other_totalAMT);
          //  alert(adultFare_Charges);
          if(other_totalAMT > 0) {
               $(".othercharges").show();

               $('.scrAMT').html(secureAMT);
               $('.dtcgAMT').html(free_dateChange);
               $('.OtherAmount').html(other_totalAMT);
               $('.Total_Amount').html(Total_Amount);

          } else {
               $(".othercharges").hide();
               $('.Total_Amount').html(Total_Amount);


          }
          $('.Total_Amount').html(Total_Amount);
      });

    });


    //////////////add new passenger cloning/////////
    function clone_div() {
      //alert("hi");
      var adults = '<?php echo $adults; ?>';
     /// alert(adults);
            var count = $('.newrow').length;

           var count_new = count+1;
         if(adults > count_new) {

            var html = `
                         <div class="row first-inputname newrow" id="newrow${count_new}">
                            <div class="col-md-4">
                              <div class="form-group">
                                <input type="text" name="firstname[]" class="form-control" placeholder="First and middle name" required="true">
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" name="lastname[]" class="form-control" placeholder="Last name" required="true">
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                            <select name="gender[]" class="form-select" placeholder="Gender" required="true">
                              <option value="">Select Gender</option>
                              <option value="male">male</option>
                              <option value="female">female</option>
                            </select>
                            </div>
                          </div>
                          <div class="col-md-2 text-end ">
                            <div class="btn-group btn-grp" role="group" aria-label="Basic outlined example">
                                <button type="button" class="plus-bg bg-danger" onclick="remove(${count_new})">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                              </div>
                          </div>
                          </div>
                          <div id="app_div"></div>
                        `;
            $('#app_div').append(html);
          }else{
            $('#overflow').html("You have already selected "+adults+" ADULT. Remove before adding a new one.");
            //$('#overflow').show();
          }


        }
        function remove(id) {
            $('#newrow' + id).remove();
            $('#overflow').html('');
           // $('#overflow').hide();

        }


//////////////////////////form validation////////////
// $(function() {
//   // Initialize form validation on the registration form.
//   // It has the name attribute "registration"
//   $("form[name='passenger_details']").validate({
//     // Specify validation rules


//       $('input[id^="DODate"]').each(function() {
//           $(this).rules('add', {
//               required: true,  // example rule
//               // another rule, etc.
//           });
//       });

//     rules: {
//       // The key name on the left side is the name attribute
//       // of an input field. Validation rules are defined
//       // on the right side
//       'firstname[]' : {
//                 required: true
//             },
//       lastname: "required",
//       mobile_number: "required",

//       email: {
//         required: true,
//         // Specify that email should be validated
//         // by the built-in "email" rule
//         email: true
//       }

//     },
//     // Specify validation error messages
//     messages: {
//       'firstname[]': {
//       required: "Please enter your lastname"

//      },
//       lastname: "Please enter your lastname",

//       email: "Please enter a valid email address",
//       mobile_number: "Please enter a valid mobile number"
//     },
//     // Make sure the form is submitted to the destination defined
//     // in the "action" attribute of the form when valid
//     submitHandler: function(form) {
//       form.submit();
//     }
//   });
// });
var values=  {};

$(function() {
    $("#submit").click(function() {

     var adult_count ='<?php echo $adults ?>' ;
     var priceIds ='<?php echo $priceIds ?>' ;
     var clone_count = $('.newrow').length;
     var total_rows  = clone_count+1;
     var proceed = true;
        $("#passenger_details input,select[required=true]").each(function(){
          $(this).parent().after("");
          $('.validation').remove();
        });
        $("#passenger_details input,select[required=true]").each(function(){
           	$(this).css('border-color','');
            if(!$.trim($(this).val())){ //if this field is empty
                $(this).css('border-color','red'); //change border color to red
                $(this).parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This Field is Required</div>");
								proceed = false; //set do not proceed flag

						}

				});


        if (adult_count==total_rows){  //////////////checking
            if(proceed){
              //$('.passengerreview').modal('show');
              $('.passengerreview').hide();
              $('#overflow').html("");
              var first_name = $("input[name='firstname[]']").map(function(){return $(this).val();}).get();
              var last_name = $("input[name='lastname[]']").map(function(){return $(this).val();}).get();
              var gender = $("select[name='gender[]']").map(function(){return $(this).val();}).get();
              var _token = '<?php echo csrf_token(); ?>';

              var mobile = $('#mobile').val();
              var email = $('#email_id').val();
              var country_code = $('#country_code').val();


                $.ajax({
                    url: "{{route("passengerDetails")}}",
                    type: "POST",
                    data: {
                         first_name  : first_name,
                         last_name   : last_name,
                         gender      : gender,
                         email       : email,
                         mobile      : mobile,
                         country_code: country_code,
                         priceIds    : priceIds,
                        _token: _token,
                    },
                    beforeSend: function() {
                        $('#overlay').fadeIn();
                    },
                    success: function(result) {
                        // alert(result);
                        console.log(result);

                    },
                    complete: function() {
                        $('#overlay').fadeOut();
                    }
                });
                    for (i = 0; i < adult_count; i++) {
                    var html = `
                            <div class="p-3 passengerreview">
                              <table class="table table-bordered ">
                                <tr>
                                  <td>First & Middle Name</td>
                                  <td>${first_name[i]}</td>
                                </tr>
                                <tr>
                                  <td>Last Name</td>
                                  <td>${last_name[i]}</td>
                                </tr>
                                  <tr>
                                  <td>Gender</td>
                                  <td>${gender[i]}</td>
                                </tr>
                              </table>
                            </div>
                            <div id="passenger_div"></div>
                              `;
                        $('#passenger_div').append(html);
                      }

              $('#review-details').modal('show');
            }
        }else{
          $('#overflow').html("Kindly add all travellers before proceeding");
        }
          //  alert(proceed);
            return false;
        });
    });

        function edit_field() {
            $('#review-details').modal('hide');

        }

        $(function() {
          $("#cnfBtn").click(function() {
         //alert("hoii");
          var adult_count ='<?php echo $adults ?>' ;
          var priceIds ='<?php echo $priceIds ?>' ;

          var clone_count = $('.newrow').length;
          var total_rows  = clone_count+1;

            var first_name = $("input[name='firstname[]']").map(function(){return $(this).val();}).get();
            var last_name = $("input[name='lastname[]']").map(function(){return $(this).val();}).get();
            var gender = $("select[name='gender[]']").map(function(){return $(this).val();}).get();
            var _token = '<?php echo csrf_token(); ?>';

            var mobile = $('#mobile').val();
            var email = $('#email_id').val();
            var country_code = $('#country_code').val();
            //var whatsapp = $('#whatsapp').val();
            var whatsapp = $('input[name="whatsapp"]:checked').length > 0;
            //alert(whatsapp);

              $.ajax({
                    url: "{{route("passengerDetails")}}",
                    type: "POST",
                    data: {
                          first_name  : first_name,
                          last_name   : last_name,
                          gender      : gender,
                          email       : email,
                          mobile      : mobile,
                          country_code: country_code,
                          priceIds    : priceIds,
                          whatsapp    : whatsapp,
                          _token: _token,
                    },
                    beforeSend: function() {
                        $('#overlay').fadeIn();
                    },
                    success: function(result) {
                        //  alert(result);
                        // console.log(result);
                        window.location.href="{{route('booking-final')}}?pkey=<?php echo $priceIds ?>&bookingId=<?php echo $bookingId ?> ";
                    },
                    complete: function() {
                        $('#overlay').fadeOut();
                    }
                });


                return false;
            });
        });

  </script>
@endsection