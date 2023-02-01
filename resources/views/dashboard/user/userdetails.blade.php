<x-dashboard.layout>

    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Create Users</h4>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="row">
                                  <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                    <input type="text" class="form-control allowtext" value="{{$user->company_name}}" placeholder="Company name" name="company_name" readonly>
                                  </div>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>User Name</label>
                                    <input type="text" class="form-control allowtext" placeholder="User Name" value="{{$user->name}}" name="name"readonly>
                                  </div>
                                   </div>
                                   <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Phone Number allownumber" id="MobileNumber" value="{{$user->mobile_number}}" name="mobile_number" readonly>
                                    <span id="mobile_error" style="color:red"></span>
                                  </div>
                                 </div>

                                 <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>E-Mail Id</label>
                                    <input type="text" class="form-control" placeholder="E-Mail Id" name="email" value="{{$user->email}}" id="Email" readonly>
                                    <span id="email_error" style="color:red"></span>
                                  </div>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                       <label>User Type</label>
                                       <select class="form-select" name="userType" disabled>
                                           <option value="">Select Type</option>
                                           <option value="B2B" @if($user->user_type == 'B2B') selected @endif>B2B</option>
                                           <option value="B2E" @if($user->user_type == 'B2E') selected @endif>B2E</option>
                                           {{-- <option value="Admin">Admin</option> --}}
                                        </select>
                                       <span id="userTypeerr" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                           <label>Aadhar Card No.</label>
                                       <input type="text" class="form-control allownumber" value="{{$user->aadhar_no}}" placeholder="Ex:-789654123786" name="aadhar_no" id="aadhar_no" readonly>
                                       <span id="aadhar_error" style="color:red"></span>
                                    </div>
                               </div>
                               <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>Pan Card No.</label>
                                       <input type="text" class="form-control" value="{{$user->pan_no}}" placeholder="Ex:-EXMN12541D" name="pan_no" id="pan_no" readonly>
                                       
                                    </div>
                               </div>
                               <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>GST No.</label>
                                        <input type="text" class="form-control" value="{{$user->gst_no}}" placeholder="Ex:-334sawda" name="gst_no" id="gst_no" readonly>
                                       
                                    </div>
                               </div>
                                 <div class="col-md-12 mb-3">
                                     <div class="form-group">
                                         <label>Address</label>
                                         <textarea rowspan="3" class="form-control" name="address" placeholder="Address" readonly>{{$user->address}}</textarea>
                                     </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
        <script>
            //mobile validation
            $("#MobileNumber").change(function() {
                var mobNum =  $("#MobileNumber").val();
                var filter = /^\d*(?:\.\d{1,2})?$/;
                if (filter.test(mobNum)) {
                    if(mobNum.length == 10){
                        $("#mobile_error").text('');
                        $("#Submit").prop('disabled', false);
                    } else {
                        $("#mobile_error").text('Invalid Mobile Number...!');
                        $("#Submit").prop('disabled', true);
                        return false;
                    }
                    }
                    else {
                    $("#Submit").prop('disabled', true);
                    $("#mobile_error").text('Invalid Mobile Number...!');
                    return false;
                }
            });

            //email validation
            $("#Email").change(function(){
                var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                if (testEmail.test($("#Email").val()))
                {
                    $("#email_error").text('');
                    $("#Submit").prop('disabled', false);
                }
                else
                {
                    $("#email_error").text('Invalid email...!');
                    $("#Submit").prop('disabled', true);
                }

            });

                // form submission
                $('form[name=CreateUserForm]').submit(function(e){
                  e.preventDefault();
                  var formData = new FormData($(this)[0]);
                  console.log(formData);
                  $.ajax({
                    url : ' {{ route('create.user.store') }} ',
                    type : 'POST',
                    data : formData,
                    cache : false,
                    async : false,
                    processData : false,
                    contentType : false,
                    success : function(data, textStatus, xhr) {
                                        if (xhr.status == 201) {
                                            $.toast({
                                                heading: 'Success',
                                                text: data.msg,
                                                icon: 'success'
                                            });
                                            $('form[name=CreateUserForm]')[0].reset();

                                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    $('.input-error').remove();
                    $('input').removeClass('is-invalid');

                    if (jqXHR.status == 422) {
                        for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {

                            $.toast({
                                heading: 'error',
                                text: value,
                                icon: 'error'
                            });

                            $('form[name=CreateUserForm] input[name=' + key + ']').addClass(
                                'is-invalid');
                            $('form[name=CreateUserForm] input[name=' + key + ']').after(
                                '<span class="text-danger input-error" role="alert">' + value +
                                '</span>');

                                $('form[name=CreateUserForm] select[name=' + key + ']').after(
                                '<span class="text-danger input-error" role="alert">' + value +
                                '</span>');

                            $('form[name=CreateUserForm] textarea[name=' + key + ']').addClass(
                                'is-invalid');
                            $('form[name=CreateUserForm] textarea[name=' + key + ']').after(
                                '<span class="text-danger input-error" role="alert">' + value +
                                '</span>');

                            // $('#' + key).addClass('invalid');
                            // $('input#' + key).after('<span class="input-error" style="color:red">' +
                            //     value + '</span>');

                            // $('#err' + key).after('<span class="input-error" style="color:red">' +
                            //     value + '</span>');

                        }
                    } else {
                        // alert('something went wrong! please try again..');
                    }
                },
                  });
               });
            </script>
            @endsection
</x-dashboard.layout>