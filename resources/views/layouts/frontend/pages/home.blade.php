@extends('layouts.frontend.master')

@section('title')
मुख्य पान
@endsection

@section('keywords', 'मुख्य पान, उपक्रम, निवेदन, कार्यक्रम, फेसबुक, ट्विटर, home, upkram, nivedan, information, facebook, twitter')

@section('description')
@foreach ($upkramList as $item)
{{ $item->title }}
@endforeach
@foreach ($trusty as $item)
{{ $item->title }}
@endforeach
@endsection

@push('styles')
@if ($slider->isNotEmpty())
    {{-- fetch the first banner image early, before the CSS/JS finish --}}
    <link rel="preload" as="image" href="{{ asset('assets/backend/images/slider_images/'.$slider->first()->image_path) }}" fetchpriority="high" />
@endif
@endpush

@push('scripts')
@endpush

@section('page-content')
        <!-- Banner Start -->
        <div class="sigma_banner banner-3">
            <div class="sigma_banner-slider">
                @foreach ($slider as $item)
                <!-- Banner Item Start -->
                <div class="light-bg sigma_banner-slider-inner bg-cover bg-center bg-norepeat" style="background-image: url('{{ asset('assets/backend/images/slider_images/'.$item->image_path) }}')"></div>
                <!-- Banner Item End -->
                @endforeach
            </div>
        </div>
        <!-- Banner End -->

        <!-- About Start -->
        <section class="section">
            <div class="container">
                <div id="nivedan" class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="dv-collage">
                            <figure class="dv-collage-main">
                                <img src="{{ asset('assets/frontend/images/about-group1/10.jpg') }}" alt="श्री दत्त" loading="lazy" />
                            </figure>
                            <figure class="dv-collage-side">
                                <img src="{{ asset('assets/frontend/images/about-group1/30.jpg') }}" alt="श्री स्वामी समर्थ" loading="lazy" />
                            </figure>
                            <figure class="dv-collage-side">
                                <img src="{{ asset('assets/frontend/images/about-group1/20.jpg') }}" alt="श्री नृसिंह सरस्वती" loading="lazy" />
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dv-scroll" style="background-image: url('{{ asset('assets/frontend/images/QR/page1.png') }}')">
                            <h3 class="dv-scroll-title">निवेदन</h3>
                            <p>
                                नमस्कार, या संकेतस्थळावरील माहिती आणि छायाचित्रे ही पारंपारिक,
                                संगणकीय माहिती मायाजालात असलेल्या विविध संकेत स्थळे आणि
                                आधुनिक युगातील व्हाट्सअपच्या माध्यमातून एकत्रित करण्यात आली आहे.
                                बिनचूक माहिती देण्याचा आम्ही प्रयत्न करीत आहे. वेळोवेळी नवीन
                                माहिती यात समाविष्ट करण्याचा मानस आहे. या संकेतस्थळावरील कोणत्याही
                                माहितीबद्दल आपल्या सूचनांचे कायमच स्वागत राहील.
                                चूक भूल द्यावी घ्यावी ही विनंती.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr />
        <!-- vishwasta mandal start -->
        <section class="section">
            <div class="container">
                <div class="row align-items-top align-items-md-start">
                    <div id="vishwastal mandal" class="col-lg-6">
                        <div class="text-bg-primary card" style="max-width: 500px">
                            <div class="card-header fw-bold fs-5">विश्वस्त मंडळ</div>
                            <div class="card-body">
                                <ul class="card-body" style="list-style-type: disc">
                                @foreach ($trusty as $item)
                                    <li>{{ $item->name }}</li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-bg-primary card" style="max-width: 500px">
                            <div class="card-header fw-bold fs-5">संयुक्त व्यवस्थापक</div>
                            <div class="card-body">
                                <ul class="card-body" style="list-style-type: disc">
                                @foreach ($manager as $item)
                                    <li>{{ $item->name }}</li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <p>श्री स्वामी समर्थ संप्रदायाच्या प्रासादिक भक्तीचा प्रसार करण्यासाठी आणि संतसज्जनांच्या परंपरेला अनुसरून 'जनसेवा हीच ईश्वरसेवा' ह्या प्रेरणेने भक्तिमार्गातून सुविचार आणि शिकवण ह्याचा प्रचार करण्यासाठी ‘ब्रह्मांडनायक श्री स्वामी समर्थ प्रतिष्ठान’ विश्वस्त मंडळ कटिबद्ध आहे. ह्या विश्वस्त मंडळाचे सर्व सभासद सर्वतोपरी स्वामींच्या निस्सिम सेवेत आहेत.</p>
            </div>
        </section>
        <!-- vishwasta mandal end -->

         <!-- Form Start -->
        <div class="section dark-overlay bg-cover bg-center bg-norepeat" style="background-image: url('{{ asset('assets/frontend/images/bg2visit.jpg') }}')">
            <div class="container text-center">
                <h1 class="title">Visit Our Gallery</h1>
                <br />
                <a class="sigma_btn-custom" href="{{ route('gallery') }}">GALLERY</a>
            </div>
        </div>
        <!-- Form End -->
        <!-- About End -->


        {{-- <div id="image-carousel" class="carousel image-carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($slider as $item)
                <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                    <img src="{{ asset("assets/backend/images/slider_images/".$item->image_path) }}" class="slider-image d-block w-100" alt="image-2" />
                </div>
                @endforeach
            </div>
             <a class="carousel-control-prev" href="#image-carousel" role="button" data-slide="prev" aria-label="Previous Slider">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#image-carousel" role="button" data-slide="next" aria-label="Next Slider">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> 
        </div> --}}

        {{-- <div class="mdc-bg-grey-100 pt-5 pb-5">
            <div class="container special-survey-other-news">
                <div class="row">
                    <div class="col-12 col-sm-8 special-survey">
                        <div class="row">
                            <div class="col d-flex flex-column align-items-center">
                                <h1>उपक्रम</h1>
                                <div class="bottom-bar mt-4"></div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($upkramList as $item)
                            <div class="col-12 col-sm-6 col-md-4 mt-5">
                                <a href={{ route('upkram-detail', $item->id) }} class="survey-link-card-link" aria-label="{{ $item->title }}">
                                    <div class="survey-link-card mdc-text-white-darker mdc-bg-{{ $item->bg_color }} p-4">
                                        <div class="icon text-center">
                                            <i class="las la-{{ $item->icon }}"></i>
                                        </div>
                                        <div class="text text-center">{{ $item->title }}</div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdc-bg-grey-100 pt-3 pb-3">
            <div class="container py-5 department-information">
            <div class="row">
                <div class="col d-flex flex-column align-items-center">
                    <h1>विभाग</h1>
                    <div class="bottom-bar mt-4"></div>
                </div>
            </div>
            </div>
        </div>
        <div class="container py-5 media-information">
                <div class="row">
                    <div class="col-12 col-sm-4 mt-3">
                        <div class="header col d-flex flex-column align-items-center">
                            <h1 class="text-center"><img src="{{ asset('assets/frontend/images/social/facebook.png') }}" height="35" width="35">  फेसबुक</h1>
                            <div class="bottom-bar mt-3"></div>
                        </div>
                        <div class="facebook-content mt-5">
                            <div
                                class="fb-page"
                                data-href="https://www.facebook.com/maharevenue"
                                data-tabs="timeline"
                                data-width=""
                                data-height=""
                                data-small-header="false"
                                data-adapt-container-width="true"
                                data-hide-cover="false"
                                data-show-facepile="true"
                            >
                                <blockquote cite="https://www.facebook.com/maharevenue" class="fb-xfbml-parse-ignore">
                                    <a href="https://www.facebook.com/maharevenue" aria-label="Facebook Page">Zilla Parishad Palghar</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 mt-3">
                        
                    </div>
                    <div class="col-12 col-sm-4 mt-3">
                        <div class="header col d-flex flex-column align-items-center">
                            <h1 class="text-center"><img src="{{ asset('assets/frontend/images/social/tweeter.png') }}" height="35" width="35">  ट्विटर</h1>
                            <div class="bottom-bar mt-3"></div>
                        </div>
                        <div class="twitter-content mt-5">
                            <a class="twitter-timeline" href="https://twitter.com/maharevenue?lang=en" aria-label="Tweeter Page">Tweets by DGPMaharashtra</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>
        </div>
        <div style="display: none">
        </div> --}}
 @endsection
