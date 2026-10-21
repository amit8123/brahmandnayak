@extends('layouts.frontend.master')

@section('title')
चित्रदालन
@endsection
@section('keywords', 'पालघर, गॅलरी, फोटो, इमेज, image, gallry, photo, district, palghar')
@section('description')
@foreach ($category as $item)
{{ $item->category }}
@endforeach
@endsection

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/plugins/baguetteBox.min.css') }}">
    <style>
    .select-container {
      position: relative;
      /* margin: 0 auto; */
      margin-left: 2rem;
      width: 20rem;
      border-radius: 5px;
    }

    ::placeholder {
      /* Most modern browsers support this now. */
      color: #ccc7c7;
    }

    .select-container .select {
      position: relative;
      background: #670E10;
      height: 3rem;
      border-radius: 5px;
    }

    .select-container .select::after {
      position: absolute;
      content: "";
      width: 10px;
      height: 10px;
      top: 50%;
      right: 15px;
      transform: translateY(-50%) rotate(45deg);
      border-bottom: 2px solid white;
      border-right: 2px solid white;
      cursor: pointer;
      transition: border-color 0.4s;
    }

    .select-container.active .select::after {
      border: none;
      border-left: 2px solid white;
      border-top: 2px solid white;
    }

    .select-container .select input {
      position: relative;
      /* width: 100%;
      height: 100%; */
      padding: 0 10px;
      background: none;
      outline: none;
      border: none;
      font-size: 1.4rem;
      color: white;
      cursor: pointer;
    }

    .select-container .option-container {
      position: relative;
      /* background: #a02527d2; */
      height: 0;
      overflow-y: scroll;
      transition: 0.4s;
      background-color: #fff;
      z-index: 1;
      border-radius: 5px;
    }

    .select-container.active .option-container {
      height: 10rem;
      background-color: #fff;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    .select-container .option-container::-webkit-scrollbar {
      border-left: 1px solid rgba(0, 0, 0, 0.2);
      width: 5px;
    }

    .select-container .option-container::-webkit-scrollbar-thumb {
      background: #0f0e11;
    }

    .select-container .option-container .option {
      position: relative;
      padding: 10px;
      height: 40px;
      border-top: 1px solid rgba(0, 0, 0, 0.3);
      cursor: pointer;
      display: flex;
      align-items: center;
      transition: 0.2s;
    }

    .select-container .option-container .option.selected {
      background: rgba(0, 0, 0, 0.5);
      pointer-events: none;
    }

    .select-container .option-container .option:hover {
      background: rgba(0, 0, 0, 0.2);
      padding-left: 20px;
    }

    .select-container .option-container .option label {
      font-size: 18px;
      color: black;
      border: none;
      cursor: pointer;
      vertical-align: middle;
    }

    @media (max-width: 992px) {

      .select-container {
        width: 15rem;
      }

      .select {
        height: 2rem;
      }

      ::placeholder {
        font-size: 15px;
      }

      label {
        font-size: 20px;
      }
    }
  </style>

@endpush

@push('scripts')
<script src="{{ asset('assets/frontend/js/plugins/baguetteBox.min.js') }}"></script>
  <script>
    baguetteBox.run('.tz-gallery');
  </script>
  <script>
  let selectContainer = document.querySelector(".select-container");
    let select = document.querySelector(".select");
    let input = document.getElementById("input");
    let options = document.querySelectorAll(".select-container .option");

    select.onclick = () => {
      selectContainer.classList.toggle("active");
    };

    options.forEach((e) => {
      e.addEventListener("click", () => {
        input.value = e.innerText;
        selectContainer.classList.remove("active");
        options.forEach((e) => {
          e.classList.remove("selected");
        });
        e.classList.add("selected");
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
          <h1>चित्रदालन</h1>
        </div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a class="btn-link" href="{{ route('home') }}">मुख्य पान</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              चित्रदालन
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- partial -->

  <!-- Categories Start -->
  <div class="section section-padding">
    <div class="container gallery-container">

      {{-- <div class="text-center filter-items">
        <h5 class="active portfolio-trigger" data-filter="*">All</h5>
        @foreach ($category as $item)
        <h5 class="portfolio-trigger" data-filter=".{{ $item->id }}">{{ $item->category }}</h5>
        @endforeach
      </div> --}}

      <div class="row">
        <div class="col-3 select-container">
          <div class="select">
            <input type="text" id="input" placeholder="select" onfocus="this.blur();">
          </div>
          <div class="option-container">
            <div class="portfolio-trigger option" data-filter="*">
              <label> All </label>
            </div>
            @foreach ($category as $item)
            <div class="portfolio-trigger option" data-filter=".{{ $item->id }}">
              <label>{{ $item->category }}</label>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="tz-gallery">
        <div class="portfolio-filter row">
        @if ($gallery->isNotEmpty())
        @foreach ($gallery as $item)
          <div class="col-lg-4 col-md-6 p-2 blog-list-img {{ $item->category_id }}">
            <a class="lightbox" href="{{ $item->file_path }}">
              <img class="transition" src="{{ $item->file_path }}" alt="portfolio">
            </a>
          </div>
        @endforeach
        @endif
        </div>
      </div>
    </div>
  </div>
  <!-- Categories End -->
@endsection