@extends('layouts.frontend.master')

@section('title')
Upkram
@endsection
@section('keywords', 'कार्यक्रम, उपक्रम, विशेष कार्यक्रम, माहिती, karykram, upkram, vishesh karykram, vibhag, department, palghar zilla parishad, zilla parishad, palghar')
@section('description')
{{ $upkram->title }} -> {{ $upkram->mohim_body }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/district-info.css') }}">
@endpush

@push('scripts')
<!-- Go to www.addthis.com/dashboard to customize your tools for share social button -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-603389c0034e29b7"></script>
@endpush

@section('page-content')
<div class="parallax-image-container">
    <div class="parallax-image" style="background-image: url('{{ asset('assets/frontend/images/parallax/background.jpeg') }}')"></div>
    <div class="container text-content py-5">
        <h1 class="mdc-text-cyan-400" style="text-shadow: 2px 2px #000000;">कार्यक्रम</h1>
        <div class="mt-3 links mdc-text-cyan-400" style="text-shadow: 1px 1px #000000;">
            <a href="{{ route('home') }}">मुख्य पान </a>
            <a href="#">कार्यक्रम</a>
        </div>
    </div>
</div>
<div class="container py-2 palghar-information">
    <!-- Go to www.addthis.com/dashboard to customize your tools for share social button -->
    <div class="addthis_inline_share_toolbox" style="display: table; margin: 0 auto; padding:10px;"></div>
    @if (isset($upkram))
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
                <h1>{{ $upkram->title }}</h1>
                <div class="bottom-bar mt-4"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 mt-5">
                <div class="row">
                    {!! $upkram->mohim_body !!}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection