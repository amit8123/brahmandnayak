@extends('layouts.frontend.master')

@section('title')
देणगी
@endsection
@section('keywords', 'मुख्य पान, उपक्रम, कार्यक्रम, फेसबुक, ट्विटर, home, upkram, information, facebook, twitter, conatct us, donation')
@section('description')
@endsection

@push('styles')
<style type="text/css">
    .tg {
      border-collapse: collapse;
      border-spacing: 0;
      border-color: black;
      font-size: 15px;
    }

    .tg td {
      border-color: black;
      border-style: solid;
      border-width: 1px;
      font-family: Arial, sans-serif;
      overflow: hidden;
      padding: 10px 5px;
      word-break: normal;
    }

    .tg th {
      border-color: black;
      border-style: solid;
      border-width: 1px;
      font-family: Arial, sans-serif;
      font-weight: bold;
      overflow: hidden;
      padding: 10px 5px;
      word-break: normal;
      background-color: rgba(125, 126, 128, 0.473);
    }

    .tg .tg-0pky {
      text-align: center;
      vertical-align: middle;
      border-color: black;
      color: black;
    }

    
    @media screen and (max-width: 767px) {
      .tg {
        width: auto !important;
      }

      .tg col {
        width: auto !important;
      }

      .tg-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
    }
  </style>
@endpush

@push('scripts')
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
  $('.form-horizontal').submit(function(e) {
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
        $('.form-horizontal')[0].reset();
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
  <div class="sigma_subheader dark-overlay dark-overlay-2"
    style="background-image: url('{{ asset('assets/frontend/images/banner/subheader.jpg') }}')">
    <div class="container">
      <div class="sigma_subheader-inner">
        <div class="sigma_subheader-text">
          <h1>देणगी</h1>
        </div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a class="btn-link" href="{{ route('home') }}">मुख्य पान</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">देणगी</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- partial -->

  <!-- Form Start -->

  <div class="section">
    <div class="container font-monospace">
      <h4 class="title text-center">Make a donation to help us</h4>
      <div class="details">
        <p class="fw-bolder fs-5 text-dark text-decoration-underline">Do not hand over cash to any person.</p>
        <p class="lh-sm fw-bold text-dark">
          Cheques, Demand Drafts and Pay Orders in ANY CURRENCY have to be made in favour of Brahmandnayak Shree Swami Samarth Pratishthan Trust and handed over at the Pooja Booking Counter inside the temple premises or at the
          Accounts Office (Donation Dept). The Office will issue a donation receipt.
        </p><br>
        <div class="row mb-3">
          <div class="col-lg-6 sequence-content">
            <div class="tg-wrap">
              <h3 class="fw-bold text-uppercase font-monospace">TRUST ACCOUNT NAME AND DETAILS</h3>
              <table class="tg table-striped-columns">
                <tbody>
                  <tr>
                    <th class="tg-0pky">Bank Name</th>
                    <td class="tg-0pky">Brahmandnayak Shree Swami Samarth Pratisthan</td>
                  </tr>
                  <tr>
                    <th class="tg-0pky">Bank Name</th>
                    <td class="tg-0pky">Bank Of India</td>
                  </tr>
                  <tr>
                    <th class="tg-0pky">Branch</th>
                    <td class="tg-0pky">Virar (W)</td>
                  </tr>
                  <tr>
                    <th class="tg-0pky">Account Number</th>
                    <td class="tg-0pky">013410110009891</td>
                  </tr>
                  <tr>
                    <th class="tg-0pky">IFSC Code</th>
                    <td class="tg-0pky">BKID0000134</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-lg-6 mb-lg-30">
            <div class="img-group pt-0">
            <h3 class="fw-bold text-uppercase font-monospace">SCAN AND PAY</h3>
              <div class="img-group-inner">
                <img id="about_img1" class="dv-upi" src="{{ asset('assets/frontend/images/QR/donation-upi.jpg') }}" alt="Bank of India UPI QR - BRAHMANDNAYAK" />
              </div>
              <p class="mt-3 fw-bold">UPI ID: boism-7775037999@boi</p>
            </div>
          </div>
        </div>

    <!-- donation for start  -->
        <h3 class="panel-title">Donation Details</h3>
        <div class="row" style="border:3px solid black; font-family: Arial, Helvetica, sans-serif !important;">
          <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
              </div>
              <div class="panel-body">
                <div class="bodyTest">
                  <form class="form-horizontal" method="POST" action="{{ route('storeFrontForm') }}" enctype="multipart/form-data">
                   {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="date" class="control-label">Date</label>
                          <div class="">
                            <input id="date" name="date" type="date" class="form-control" value="{{ old('date') }}" required>
                            <p class="help-block"></p>
                            <div class="row d-flex flex-column align-items-center">
                            <div class="color-main" style="color: #f00;">
                                @error('date')
                                    {{ $message }}
                                @enderror
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Full name input-->
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="name" class="control-label">Name</label>
                          <div class="">
                            <input id="name" name="name" type="text"
                              placeholder="Enter name" class="form-control" value="{{ old('name') }}" required>
                            <p class="help-block"></p>
                            <div class="row d-flex flex-column align-items-center">
                            <div class="color-main" style="color: #f00;">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="control-group">
                          <label for="email" class="control-label ">Email ID</label>
                          <div class="">
                            <input id="email" name="email" type="email"
                              placeholder="Enter your email" class="form-control" value="{{ old('email') }}" required>
                            <p class="help-block"></p>
                            <div class="row d-flex flex-column align-items-center">
                            <div class="color-main" style="color: #f00;">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="control-group">
                          <label for="transaction_id" class="control-label ">Transaction ID</label>
                          <div class="">
                            <input id="transaction_id" name="transaction_id" type="text"  value="{{ old('transaction_id') }}" required placeholder="Enter Transaction ID"
                              class="form-control">
                            <p class="help-block"></p>
                            <div class="row d-flex flex-column align-items-center">
                            <div class="color-main" style="color: #f00;">
                                @error('transaction_id')
                                    {{ $message }}
                                @enderror
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="cardNumber">Amount</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="₹" value="{{ old('amount') }}" required />
                            <p class="help-block"></p>
                            <div class="row d-flex flex-column align-items-center">
                            <div class="color-main" style="color: #f00;">
                                @error('amount')
                                    {{ $message }}
                                @enderror
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 btn-group-vertical fs-3">
                        <button class="badge bg-secondary" type="submit" value="submit">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- donation form End  -->



      </div>
    </div>
  </div>
  <!-- Form End -->

  <!-- Donor list Start -->
  <div class="section pt-0" id="donor-list">
    <div class="container">
      <h2 class="title text-center">देणगीदारांची यादी</h2>

      <div class="dv-donor-stats">
        <div class="dv-stat">
          <strong>{{ number_format($totals->donors) }}</strong>
          <span>एकूण देणगीदार</span>
        </div>
        <div class="dv-stat">
          <strong>&#8377; {{ number_format($totals->total, 0) }}</strong>
          <span>एकूण देणगी</span>
        </div>
      </div>

      <form method="GET" action="{{ route('donation') }}#donor-list" class="dv-search" role="search">
        <input type="search" name="q" value="{{ $search }}" placeholder="नाव, रक्कम किंवा शेरा शोधा… (Search name, amount or remark)" aria-label="Search donors" autocomplete="off" />
        <button type="submit" aria-label="Search"><i class="far fa-search"></i> शोधा</button>
        @if ($search !== '')
          <a href="{{ route('donation') }}#donor-list" class="dv-search-clear">&#10005; Clear</a>
        @endif
      </form>

      @if ($search !== '')
        <p class="text-center dv-result-note">"{{ $search }}" साठी {{ number_format($donors->total()) }} निकाल</p>
      @endif

      <div class="dv-table-wrap">
        <table class="dv-table">
          <thead>
            <tr>
              <th>#</th>
              <th>दिनांक</th>
              <th>नाव</th>
              <th>रक्कम</th>
              <th>शेरा</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($donors as $donor)
              <tr>
                <td data-label="#">{{ $donors->firstItem() + $loop->index }}</td>
                <td data-label="दिनांक">{{ \Carbon\Carbon::parse($donor->date)->format('d-m-Y') }}</td>
                <td data-label="नाव">{{ $donor->name }}</td>
                <td data-label="रक्कम" class="dv-amount">&#8377; {{ $donor->amount }}</td>
                <td data-label="शेरा">{{ $donor->remark ?: '—' }}</td>
              </tr>
            @empty
              <tr class="dv-empty">
                <td colspan="5">कोणतीही नोंद सापडली नाही.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="dv-table-foot">
        @if ($donors->total() > 0)
          <span>{{ $donors->firstItem() }}–{{ $donors->lastItem() }} / {{ number_format($donors->total()) }}</span>
        @endif
        {{ $donors->onEachSide(1)->links('layouts.frontend.partials.pagination') }}
      </div>
    </div>
  </div>
  <!-- Donor list End -->

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
          <p>Your form has been submitted successfully. Thank You!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal End -->
@endsection