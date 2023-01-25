<x-dashboard.layout>

    <div class="rightpart">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h4 style="font-weight: 700">Passenger Details</h4>
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
                                            <label>Booking ID</label>
                                            <input type="text" class="form-control" placeholder="User Name"
                                                name="name" value={{ $bookings->booking_id }} disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input type="text" class="form-control" placeholder="User Name"
                                                name="name" value={{ $user->name }} disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control allownumber"
                                                placeholder="Phone Number" id="MobileNumber" name="mobile_number"
                                                value={{ $user->mobile_number }} disabled>
                                            <span id="mobile_error" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Traveller Name</label>
                                            @foreach ($booking_details as $booking_detail)
                                                <input type="text" class="form-control allownumber" id="MobileNumber"
                                                    disabled value={{ $booking_detail->first_name }}>
                                                <span id="mobile_error" style="color:red"></span>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            @foreach ($booking_details as $booking_detail)
                                                <input type="text" class="form-control allownumber" id="MobileNumber"
                                                    disabled
                                                    value={{ $booking_detail->gender_name == 'Mr' ? 'Male' : 'Female' }}>
                                                <span id="mobile_error" style="color:red"></span>
                                            @endforeach
                                        </div>
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
                var mobNum = $("#MobileNumber").val();
                var filter = /^\d*(?:\.\d{1,2})?$/;
                if (filter.test(mobNum)) {
                    if (mobNum.length == 10) {
                        $("#mobile_error").text('');
                        $("#Submit").prop('disabled', false);
                    } else {
                        $("#mobile_error").text('Invalid Mobile Number...!');
                        $("#Submit").prop('disabled', true);
                        return false;
                    }
                } else {
                    $("#Submit").prop('disabled', true);
                    $("#mobile_error").text('Invalid Mobile Number...!');
                    return false;
                }
            });

            //email validation
            $("#Email").change(function() {
                var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                if (testEmail.test($("#Email").val())) {
                    $("#email_error").text('');
                    $("#Submit").prop('disabled', false);
                } else {
                    $("#email_error").text('Invalid email...!');
                    $("#Submit").prop('disabled', true);
                }

            });

            // form submission
            $('form[name=CreateUserForm]').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                //   console.log(formData);
                $.ajax({
                    url: ' {{ route('create.user.store') }} ',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function(data, textStatus, xhr) {
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
