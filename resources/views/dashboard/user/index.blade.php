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
                              <form name="CreateUserForm" method="POST" enctype="multipart/form-data">
                              @csrf
                                <div class="row">
                                  <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                    <input type="text" class="form-control" placeholder="Company name" name="company_name">
                                  </div>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>User Name</label>
                                    <input type="text" class="form-control" placeholder="User Name" name="name">
                                  </div>
                                   </div>
                                   <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>Phone Number</label>
                                    <input type="text" class="form-control allownumber" placeholder="Phone Number" id="MobileNumber" name="mobile_number" >
                                    <span id="mobile_error" style="color:red"></span>
                                  </div>
                                 </div>

                                 <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                            <label>E-Mail Id</label>
                                        <input type="email" class="form-control" placeholder="E-Mail Id" name="email" id="Email">
                                        <span id="email_error" style="color:red"></span>
                                      </div>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>Create Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                  </div>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                                  </div>
                                 </div>

                                 {{-- <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-select" name="role">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->role_name}}</option>
                                            @endforeach
                                        </select>
                                        <span id="roleerr" style="color:red"></span>
                                    </div>
                                 </div> --}}
                                 <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                       <label>User Type</label>
                                       <select class="form-select" name="user_type">
                                           <option value="">Select Type</option>
                                           <option value="B2B">B2B</option>
                                           <option value="B2E">B2E</option>
                                           <option value="Admin">Admin</option>
                                        </select>
                                       <span id="userTypeerr" style="color:red"></span>
                                 </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                            <label>Aadhar Card No.</label>
                                        <input type="text" class="form-control" placeholder="Ex:-789654123786" name="aadhar_no" id="aadhar_no">
                                        <span id="aadhar_error" style="color:red"></span>
                                      </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                            <label>Pan Card No.</label>
                                        <input type="text" class="form-control" placeholder="Ex:-EXMN12541D" name="pan_no" id="pan_no">
                                        
                                      </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                            <label>GST No.</label>
                                        <input type="text" class="form-control" placeholder="Ex:-334sawda" name="gst_no" id="gst_no">
                                        
                                      </div>
                                </div>
                                
                                 <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>Upload Aadhar Card</label>
                                    <input type="file" class="form-control" placeholder="" name="aadhar_card" multiple>
                                  </div>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>Upload Pan Card</label>
                                    <input type="file" class="form-control" placeholder="" name="pan_card" multiple>
                                  </div>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                     <div class="form-group">
                                        <label>Upload GST Certificate</label>
                                    <input type="file" class="form-control" placeholder="" name="gst_certificate" multiple>
                                  </div>
                                 </div>

                                 <div class="col-md-12 mb-3">
                                     <div class="form-group">
                                         <label>Address</label>
                                         <textarea rowspan="3" class="form-control" name="address" placeholder="Address"></textarea>
                                     </div>
                                 </div>
                                 <div class="col-md-12 text-end ">
                                     <button type="submit" id="Submit" class="btn btn-info">Submit</button>
                                 </div>

                                </div>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
<script src="{{ asset('assets/js/custom.js') }}"></script>
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
                //   console.log(formData);
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

                                $('form[name=CreateUserForm] Select[name=' + key + ']').after(
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