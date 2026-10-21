@extends('layouts.frontend.master')

@section('title')
संपर्क
@endsection
@section('keywords', 'मुख्य पान, उपक्रम, कार्यक्रम, फेसबुक, ट्विटर, home, upkram, information, facebook, twitter, conatct us')
@section('description')
@endsection

@push('styles')
@endpush

@push('scripts')
<!-- for mobile field only digits use -->
<script>
    $(document).ready(function(){
            $("#mobile").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        })
</script>
<!-- modal for successfully feedback form submitted -->
<script>
$(document).ready(function() {
  $('.sigma_box').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally
    
    // Make an AJAX request to submit the form data
    $.ajax({
      type: $(this).attr('method'),
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: function(response) {
        // Show the success modal
        $('#successModal').modal('show');
        
        // Optionally, reset the form fields
        $('.sigma_box')[0].reset();
      },
      error: function(xhr, status, error) {
        // Handle errors if needed
        console.log(xhr.responseText);
      }
    });
  });
  // Enable modal dismissal on close button click
    $('#successModal .close, #successModal .btn-secondary').click(function() {
      $('#successModal').modal('hide');
    });
});
</script>
@endpush

@section('page-content')
  <!-- partial:partia/__subheader.html -->
  @php($subheaderStyle = "background-image: url('" . asset('assets/frontend/images/banner/subheader.jpg') . "')")
  <div class="sigma_subheader dark-overlay dark-overlay-2" @include('layouts.frontend.partials.attr-style', ['css' => $subheaderStyle])>
    <div class="container">
      <div class="sigma_subheader-inner">
        <div class="sigma_subheader-text">
          <h1>संपर्क</h1>
        </div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a class="btn-link" href="{{ route('home') }}">मुख्य पान</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">संपर्क</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- partial -->

  <!-- Map Start -->
  <div class="sigma_map">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15036.630686159964!2d72.72815958715819!3d19.577744600000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be701c41da228ab%3A0xb531630d5f437966!2sBrahmandnayak%20Shree%20Swami%20Samarth%20Pratistan%20(Swami%20Math)!5e0!3m2!1sen!2sin!4v1792081645234!5m2!1sen!2sin"
      title="ब्रह्मांडनायक श्री स्वामी समर्थ प्रतिष्ठान (स्वामी मठ)"
      style="border:0;" width="100%" height="450" allowfullscreen="" loading="lazy"
      referrerpolicy="strict-origin-when-cross-origin" tabindex="0"></iframe>
  </div>
  <!-- Map End -->

  <!-- Contact form Start -->
  <div class="section mt-negative pt-0">
    <div class="container">
      <form class="sigma_box box-lg m-0 mf_form_validate ajax_submit"
        action="{{ route('contactStore') }}" method="POST"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <i class="far fa-user"></i>
              <input type="text" placeholder="Full Name" class="form-control dark" name="name" id="name" value="{{ old('name') }}" required autocomplete="off"/>
                <div class="row d-flex flex-column align-items-center">
                <div class="color-main" style="color: #f00;">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
                </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <i class="far fa-envelope"></i>
              <input type="email" placeholder="Email Address" class="form-control dark" name="email" id="email" value="{{ old('email') }}" required autocomplete="off" />
              <div class="row d-flex flex-column align-items-center">
                <div class="color-main" style="color: #f00;">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <i class="far fa-pencil"></i>
              <input type="text" maxlength="10" minlength="10" placeholder="Mobile" class="form-control dark"
                name="mobile" id="mobile" value="{{ old('mobile') }}" required autocomplete="off" />
                <div class="row d-flex flex-column align-items-center">
                <div class="color-main" style="color: #f00;">
                    @error('mobile')
                        {{ $message }}
                    @enderror
                </div>
                </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="comment" placeholder="Enter Message" cols="45" rows="5" class="form-control dark" id="comment"
            required autocomplete="off"></textarea>
            <div class="row d-flex flex-column align-items-center">
                <div class="color-main" style="color: #f00;">
                    @error('comment')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="text-center">
          <button type="submit" class="sigma_btn-custom" name="button">
            Submit Now
          </button>
          <div class="server_response w-100"></div>
        </div>
      </form>
    </div>
  </div>
  <!-- Contact form End -->

  <!-- Icons Start -->
  <div class="section section-padding pt-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="sigma_icon-block text-center light icon-block-7">
            <i class="flaticon-email"></i>
            <div class="sigma_icon-block-content">
              <span>Send Email <i class="far fa-arrow-right"></i> </span>
              <h5>Email Address</h5>
              <p>bsssp.org@gmail.com</p>
              <p>info@support.com</p>
            </div>
            <div class="icon-wrapper">
              <i class="flaticon-email"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="sigma_icon-block text-center light icon-block-7">
            <i class="flaticon-call"></i>
            <div class="sigma_icon-block-content">
              <span>Call Us Now <i class="far fa-arrow-right"></i> </span>
              <h5>Phone Number</h5>
              <p><a href="tel:+917775037999">7775037999</a></p>
            </div>
            <div class="icon-wrapper">
              <i class="flaticon-call"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="sigma_icon-block text-center light icon-block-7">
            <i class="flaticon-location"></i>
            <div class="sigma_icon-block-content">
              <span>Find Us Here <i class="far fa-arrow-right"></i> </span>
              <h5>Location</h5>
              <p>Brahmandnayak Shree Swami Samarth Pratistan (Swami Math),</p>
              <p>HPHW+3VW, Madhukar Nagar, Chatale,</p>
              <p>Dahisar T. Mahim, Maharashtra 401102</p>
              <p class="mt-3 fw-bold">Trust Address</p>
              <p>A/601 Ashwant Star YK/NX,</p>
              <p>Virar West</p>
            </div>
            <div class="icon-wrapper">
              <i class="flaticon-location"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Icons End -->
  <!-- WhatsApp Group Start -->
  <div class="section section-padding pt-0">
    <div class="container text-center">
      <h2 class="title text-center">आमच्या WhatsApp ग्रुपमध्ये सामील व्हा</h2>
      <p class="mt-4">ग्रुपमध्ये सामील होण्यासाठी WhatsApp कॅमेऱ्याने हा QR कोड स्कॅन करा.</p>
      <div class="dv-wa">
        <img src="{{ asset('assets/frontend/images/QR/whatsapp-group.jpg') }}" alt="WhatsApp group QR code" loading="lazy" />
      </div>
    </div>
  </div>
  <!-- WhatsApp Group End -->
  <!-- Modal Start -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Your form has been submitted successfully.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal End -->
@endsection