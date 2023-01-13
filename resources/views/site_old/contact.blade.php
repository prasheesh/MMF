@extends('layouts.app')
@section('content')
<div class="breadcrumbs aos-init aos-animate" data-aos="fade-in">
      <div class="container">
        <h2>Contact Us</h2>
        <p> </p>
      </div>
    </div>

  <section id="contact" class="contact">


      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>21-7-760 , Ghansi bazaar,<br> Hyderabad - 500002</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>support[At]makemyfly[dot]com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                &nbsp; <a style="color:#000;" href="https://wa.me/+9140 66464466" target="_blank">+9140 66464466</a>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="" method="post" name="contactForm" id="contactForm"role="form" class="php-email-form">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required=""></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section>

    @endsection

    @section('script-content')

    <script>

    //form submit
    $('form[name=contactForm]').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('contact-form-submit') }}",
                type: "POST",
                dataType: "json",
                data: formData,
                asyns: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function(data, textStatus, xhr) {

                    if (xhr.status == 201) {
                        $('form[name=contactForm]')[0].reset();

                        $('.input-error').remove();
                        $.toast({
                            heading: 'Success',
                            text: data.message,
                            icon: 'success',
                            position:'top-right'
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.input-error').remove();
                    $('input').removeClass('is-invalid');
                    $('select').removeClass('is-invalid');
                    if (jqXHR.status == 422) {
                        for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {

                            $.toast({
                                heading: 'Error',
                                text: value,
                                icon: 'error',
                                position:'top-right'
                            });

                            $('form[name=contactForm] textarea[name=' + key + ']').addClass(
                                'is-invalid');
                            $('form[name=contactForm] textarea[name=' + key + ']').after(
                                '<p class="text-danger input-error" role="alert">' + value +
                                '</p>');


                            $('form[name=contactForm] input[name=' + key + ']').addClass('is-invalid');
                            $('form[name=contactForm] input[name=' + key + ']').after(
                                '<p class="text-danger input-error" role="alert">' + value +
                                '</p>');

                            $('.file-error' + key).html('<br>' + value);

                        }

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'something went wrong! please try again..',
                            icon: 'error',
                            position:'top-right'
                        });
                    }



                }
            });
        });

    </script>
@endsection