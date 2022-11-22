@include('header');

<div class="container mt-3">

    <div class="d-flex justify-content-between align-item-center mm_flx mb-3">

        <h4>Application For Change of Ownership Water</h4>

        <div class="d-flex align-items-center">

            <div class="mr_15"><small> Change Language </small> </div>

            <div class="switcher">
                <input type="radio" name="balance" value="1" id="yin"
                    class="switcher__input switcher__input--yin" checked="">
                <label for="yin" class="switcher__label">English</label>

                <input type="radio" name="balance" value="2" id="yang"
                    class="switcher__input switcher__input--yang">
                <label for="yang" class="switcher__label">Marathi</label>

                <span class="switcher__toggle"></span>
            </div>

        </div>

    </div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <strong>{{ $error }}</strong>
            </div>
        @endforeach
    @endif

    <form name="ValidateForm" method="POST" action="{{ route('insertWaterChange') }}" id="ValidateForm"
        enctype="multipart/form-data">
        @csrf
        
        
        <h6 style="background-color:#FFEFD6; padding:10px;" class="  rounded-2"><strong> Applicant Details </strong></h6>

        
        <div class="row">

            <div class="col-md-2">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Title of Applicant <span class="mand_error">*</span>
                    </label>
                    <label for="" class="form-label lblmrt">अर्जदाराचे शीर्षक <span class="mand_error">*</span>
                    </label>
                    <select class="form-select" name="app_title" required>
                        <option value="">-Select-</option>
                        @foreach ($ApplicatTitle as $val)
                            <option value="{{ $val->id }}" @if($val->id == old('app_title')) selected @endif>{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--<div class="col-md-12">-->
            <!--	<div class="mb-3 mt-0">-->
            <!--		<label for="" class="form-label">Address / पत्ता </label>				 -->
            <!--		<textarea class="form-control" rows="3"></textarea>-->
            <!--	  </div>-->
            <!--</div>-->

            <div class="col-md-5">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">First Name<span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">पहिले नाव<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="first_name" value="{{old('first_name')}}" required>
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Middle Name</label>
                    <label for="" class="form-label lblmrt">मधले नाव</label>
                    <input type="text" class="form-control" id="" placeholder="" name="middle_name" value="{{old('middle_name')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Last Name<span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">आडनाव<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="last_name" value="{{old('last_name')}}" required>
                </div>
            </div>



            <!--<div class="col-md-12">-->
            <!--	<div class="mb-3 mt-0">-->
            <!--		<label for="" class="form-label">Address / पत्ता </label>				 -->
            <!--		<textarea class="form-control" rows="3"></textarea>-->
            <!--	  </div>-->
            <!--</div>-->



            <div class="col-md-2">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Plot/ Flat No <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">प्लॉट/फ्लॅट क्र<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="plot_no" value="{{old('plot_no')}}" required>
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Name of the Building <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">इमारतीचे नाव<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="building_name" value="{{old('building_name')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Name of the street<span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">रस्त्याचे नाव<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="street_name" value="{{old('street_name')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Name of the area<span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">क्षेत्राचे नाव<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="area_name" value="{{old('area_name')}}"
                        required>
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Pin Code <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">पिन कोड<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="pincode" value="{{old('pincode')}}"
                        required>
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3 mt-0">
                    <label for="" class="form-label lbleng">Nearby landmark</label>
                    <label for="" class="form-label lblmrt">घरा जवळची खूण           </label>
                    <input type="text" class="form-control" id="" placeholder="" name="landmark" value="{{old('landmark')}}">
                </div>
            </div>

            <!--<div class="col-md-2">-->
            <!--    <div class="mb-3 mt-0">-->
            <!--        <label for="" class="form-label lbleng">Google location </label>-->
            <!--        <label for="" class="form-label lblmrt">गुगल लोकेशन   <span class="mand_error">*</span></label>-->
            <!--        <input type="text" class="form-control" id="" placeholder="" name="location">-->
            <!--    </div>-->
            <!--</div>-->

            <div class="col-md-3">
                <div class="mb-3 mt-0">
                    <label for="" class="form-label lbleng">City Survey/ Gut Number <span class="mand_error">*</span> </label>
                    <label for="" class="form-label lblmrt">सिटी सर्व्हे/गट नंबर   <span class="mand_error">*</span>  </label>
                    <input type="text" class="form-control" id="" placeholder="" name="survey_no" value="{{old('survey_no')}}">
                </div>
            </div>


        </div>

        <h6 style="background-color:#FFEFD6; padding:10px;" class=" mt-3 rounded-2"><strong> Application form details</strong></h6>

        <div class="row">
            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Contact Number <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">संपर्क क्रमांक    <span class="mand_error">*</span> </label>
                    <input type="text" class="form-control" id="" placeholder="" name="contact_number" value="{{old('contact_number')}}"
                        required minlength="10" maxlength="10"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Property Number<span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">मालमत्ता क्रमांक       <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_number" value="{{old('prop_number')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Water Connection Account <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">नळ खाते क्रमांक<span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="tap_acc_number" value="{{old('tap_acc_number')}}"
                        required
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Water Usage<span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">वापर <span class="mand_error">*</span></label>
                    <select class="form-select" name="usage" required>
                        <option value="">-Select-</option>
                        @foreach ($usage as $val)
                            <option value="{{ $val->water_usage_id }}" @if(old('usage') == $val->water_usage_id) selected @endif>{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-0">
                    <label for="" class="form-label lbleng">Name of Previous Owner <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> पूर्वीच्या मालकाचे नाव <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="pre_owner_name" value="{{old('pre_owner_name')}}"
                        required>
                </div>
            </div>




            <div class="col-md-12">
                <div class="mb-3 mt-0">
                    <label for="" class="form-label lbleng"> Property Address <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> मालमत्तेचा पत्ता <span class="mand_error">*</span></label>
                    <textarea class="form-control" rows="3" name="prop_address" required>{{old('prop_address)}}</textarea>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> Zonal Office <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> झोन कार्यालय <span class="mand_error">*</span></label>
                    <select class="form-select" name="zonal_office" required>
                        <option value="">-Select-</option>
                        @foreach ($wards as $val)
                            <option value="{{ $val->ward_id }}" @if(old('zonal_office') == $val->ward_id) selected @endif>{{ $val->ward_desc }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-5">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> Full name of the person in whose name the  
                        property is to be renamed  <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">ज्याचे नावे नळ खाते नामांतर करायचे आहे त्याचे पूर्ण नाव     <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_renamed" value="{{old('prop_renamed')}}"
                        required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> Full Address <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> पूर्ण पत्ता <span class="mand_error">*</span></label>
                    <textarea class="form-control" rows="3" name="prop_full_address" required>{{old('prop_full_address')}}</textarea>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Mobile <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> मोबाइल <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_mobile" value="{{old('prop_mobile')}}"
                        required minlength="10"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="10">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> Email Address <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> ई-मेल आडी <span class="mand_error">*</span></label>
                    <input type="email" class="form-control" id="" placeholder="" name="prop_email" value="{{old('prop_email')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng">Property boundaries <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> मालमत्तेची चतु:सीमा <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_boundries" value="{{old('prop_boundries')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> East <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> पूर्वेस <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_east" value="{{old('prop_east')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> West <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> पश्चिमेस <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_west" value="{{old('prop_west')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> North <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt">उत्तरेस <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_north" value="{{old('prop_north')}}"
                        required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label lbleng"> South <span class="mand_error">*</span></label>
                    <label for="" class="form-label lblmrt"> दक्षिणेस <span class="mand_error">*</span></label>
                    <input type="text" class="form-control" id="" placeholder="" name="prop_south" value="{{old('prop_south')}}"
                        required>
                </div>
            </div>

        </div>

        <div class="row">

            <h6 class="mt-3"><strong> List of Documents (Attachment) </strong></h6>
            
            <div class="alert alert-info mb-0 p-2 mb-3">
             <small><strong>Note: </strong> Upload below files only pdf, .jpg, .jpeg, .bmp  Max upto 5 MB</small>
            </div>

            
            
            <div class="col-md-3">
                <div class="mb-3 mt-4">
                    <label for="" class="form-label">Existing Property tax paid receipt <span class="mand_error">*</span></label>
                    <input type="file" class="form-control" id="" placeholder=""
                        name="exist_prop_tax_paid_file" required
                        accept="application/pdf,application/image , image/jpeg, image/png">
                </div>

                {{-- <div class="mb-3 mt-0 d-flex d-flex align-items-center">

                    <div class="att_file">
                        <i class="fa-solid fa-file"></i> pt_paidreceipt-0001.jpg <br>
                        <small>&nbsp; &nbsp; <a href="#"> Preview </a></small>
                    </div>
                    <div class="mm_l">

                    </div>
                </div> --}}

            </div>

            <div class="col-md-3">
                <div class="mb-3 mt-4">
                    <label for="" class="form-label">Existing water tax paid Receipt <span class="mand_error">*</span></label>
                    <input type="file" class="form-control" id="" placeholder="" name="water_tax_file"
                        required accept="application/pdf,application/image , image/jpeg, image/png">
                </div>

                {{-- <div class="mb-3 mt-0 d-flex d-flex align-items-center">

                    <div class="att_file">
                        <i class="fa-solid fa-file"></i> wt_paidreceipt001.jpg <br>
                        <small>&nbsp; &nbsp; <a href="#"> Preview </a></small>
                    </div>
                    <div class="mm_l">

                    </div>
                </div> --}}

            </div>


            <div class="col-md-3">
                <div class="mb-3" style="margin-top: 24px;">
                    <label for="" class="form-label">Aadhaar Card <span class="mand_error">*</span></label>
                    <input type="file" class="form-control" id="" placeholder="" name="aadhar_file"
                        required accept="application/pdf,application/image , image/jpeg, image/png">
                </div>

                {{-- <div class="mb-3 mt-0 d-flex d-flex align-items-center">

                    <div class="att_file">
                        <i class="fa-solid fa-file"></i> aadhaarcard0001.jpg <br>
                        <small>&nbsp; &nbsp; <a href="#"> Preview </a></small>
                    </div>
                    <div class="mm_l">

                    </div>
                </div> --}}

            </div>



        </div>


        <div class="col-md-12">
            <div class="mb-5 mt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="check1" name="declaration"
                        value="something" required>

                    <label class="form-check-label ms-3 lbleng" style="margin-top: -15px;">

                        <span class="mand_error">*</span> Affidavit: Completeness of the above information: True and correct and uploaded along with
                        (I am sure that the documents are their original counter orders. I am ready to pay the
                        prescribed fee for
                        name transfer. I am aware that the Municipal Corporation shall have full right to take legal
                        action
                        against me besides canceling the order of name transfer issued hereby if any information or
                        mistake is
                        found in the application.)

                    </label>
                    <label class="form-check-label ms-3 lblmrt" style="margin-top: -15px;">
                        <span class="mand_error">*</span>
                        शपथपत्र : उपरोक्त माहिती पूर्णता: सत्य व बरोबर असून सोबत अपलोड केलेली
                        कागदपत्रे त्यांच्या मूळ प्रतिबरहुकूम आहेत याची मला खात्री आहे .नामांतरसाठी निर्धारित शुल्क
                        भरण्यास मी तयार आहे .अर्जातील
                        माहिती किंवा चूक आढळून आल्यास याद्वारे निर्गमित करण्यात आलेली नामांतर आदेश रद्द करण्यासोबतच
                        माझयावर कायदेशीर
                        कार्यवाही करण्याचा महानगरपालिकेस पूर्ण अधिकार असेल याची मला जाणीव आहे .)



                    </label>

                </div>
            </div>
        </div>



        <div class="col-md-12 text-start mb-5 mt-5">
            <div>
                <button class="btn btn-primary btn_sm printMe"> <i class="fa-solid fa-print"></i> View and Print
                </button>
                <button type="submit" id="submitBtn" class="btn btn-success btn_sm"><i
                        class="fa-solid fa-check"></i> Submit </button>
            </div>
        </div>



    </form>

</div>


</div>

@include('footer');

<script>
    // add validation
    $(function() {
        $("form[name='ValidateForm']").validate({
            rules: {
                app_title: "required",
                first_name: "required",
                // middle_name: "required",
                last_name: "required",
                plot_no: "required",
                building_name: "required",
                street_name: "required",
                area_name: "required",
                pincode: "required",
                prop_number: "required",
                tap_acc_number: "required",
                usage: "required",
                prop_address: "required",
                zonal_office: "required",
                prop_renamed: "required",
                prop_full_address: "required",
                prop_mobile: "required",
                prop_email: "required",
                prop_boundries: "required",
                prop_east: "required",
                prop_west: "required",
                prop_north: "required",
                prop_south: "required",
                exist_prop_tax_paid_file: "required",
                water_tax_file: "required",
                aadhar_file: "required",
                declaration: "required",

                prop_email: {
                    required: true,
                    email: true
                },
                prop_mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                contact_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                }
            },
            messages: {
                app_title: "Enter Title of Applicant",
                first_name: "Enter First Name",
                // middle_name: "Enter Middle Name",
                last_name: "Enter Last Name",
                plot_no: "Enter Plot/ Flat No",
                buliding_name: "Enter Name of the Building",
                street_name: "Enter Name of the street",
                area_name: "Enter Name of the area",
                pincode: "Enter Pin Code",
                prop_number: "Please Select Property Number",
                tap_acc_number: "Please Enter Tap Account Number",
                usage: "Please Select Usage",
                pre_owner_name: "Please Enter Name",
                prop_address: "Please Enter Name",
                zonal_office: "Please Select Name",
                prop_renamed: "Please Enter Full name ",
                prop_full_address: "Please Enter Full Address ",
                prop_mobile: "Please Enter Mobile ",
                prop_email: "Please Enter Email Address",
                prop_boundries: "Please Enter Property boundaries",
                prop_east: "Please Enter East ",
                prop_west: "Please Enter West",
                prop_north: "Please Enter North",
                prop_south: "Please Enter South",
                exist_prop_tax_paid_file: "Please Select File",
                water_tax_file: "Please Select File",
                aadhar_file: "Please Select File",

                declaration: "Please Agree the Declaration",

                prop_mobile: {
                    required: "Please Enter Mobile Number",
                    minlength: "Please Enter 10 digit valid Mobile Number",
                    maxlength: "Please Enter 10 digit valid Mobile Number",
                },
                contact_number: {
                    required: "Please Enter Mobile Number",
                    minlength: "Please Enter 10 digit valid Mobile Number",
                    maxlength: "Please Enter 10 digit valid Mobile Number",
                },
                prop_email: "Please Enter a valid email address"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    // add validation

</script>

</body>

</html>
