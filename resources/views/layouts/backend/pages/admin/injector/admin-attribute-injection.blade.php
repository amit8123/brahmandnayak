@extends('layouts.backend.master')

@section('title')
    BSSSP - Admin | @yield('sub-title')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/datatables.min.css')}}">
    <style type="text/css">
        .main-container {
            padding-top: 0;
        }

        .word-break {
            word-break: break-all;
            word-break: break-word;
        }

        .word-overflow{
            white-space: nowrap;
            max-width: 150px;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    </style>
    @yield('sub-custom-styles')
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset("assets/backend/js/datatables.min.js") }}"></script>
    <script>
        $(document).ready(function () {
            $('.alert').delay(1000).fadeOut(2000);
        })
    </script>
    @yield('sub-custom-scripts')
@endpush
