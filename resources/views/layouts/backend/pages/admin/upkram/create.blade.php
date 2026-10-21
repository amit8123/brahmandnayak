@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')

@section('sub-title')
    Upkram - Create
@endsection

@section('sub-custom-styles')
@endsection

@section('sub-custom-scripts')
<script type="text/javascript" src="{{ asset('assets/backend/CKEditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
            CKEDITOR.replace( 'mohim-body', {
                language: 'en',
            });
        })
</script>
@endsection

@section('page-content')
    <div class="main-container container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                @include('layouts.backend.messages')
                <form class="form-horizontal" method="POST" action="{{ route('admin.upkram.store') }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Create New Upkram</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <!-- icon -->
                            <div class="form-group">
                                <label class="col-form-label" for="icon">Select Icon</label>
                                <select class="form-control" id="icon" name="icon" required>
                                    <option value="">Select an Icon</option>
                                    <option value="user" @if (old('icon')=="user" ) {{ 'selected' }} @endif>User</option>
                                    <option value="pen" @if (old('icon')=="pen" ) {{ 'selected' }} @endif>Pen</option>
                                    <option value="mobile" @if (old('icon')=="mobile" ) {{ 'selected' }} @endif>Mobile</option>
                                    <option value="plus" @if (old('icon')=="plus" ) {{ 'selected' }} @endif>Plus</option>
                                    <option value="laptop" @if (old('icon')=="laptop" ) {{ 'selected' }} @endif>Laptop</option>
                                    <option value="bell" @if (old('icon')=="bell" ) {{ 'selected' }} @endif>Bell</option>
                                </select>
                            </div>
                            <!-- /icon -->
                            <!-- Back gorund colour -->
                            <div class="form-group">
                                <label class="col-form-label" for="bg-color">Select Back-Ground Colour</label>
                                <select class="form-control" id="bg-color" name="bg-color" required>
                                    <option>Select a Background Colour</option>
                                    <option value="green" @if (old('bg-color')=="green" ) {{ 'selected' }} @endif>Green</option>
                                    <option value="teal" @if (old('bg-color')=="teal" ) {{ 'selected' }} @endif>Teal</option>
                                    <option value="brown-900" @if (old('bg-color')=="brown-900" ) {{ 'selected' }} @endif>Brown</option>
                                    <option value="blue" @if (old('bg-color')=="blue" ) {{ 'selected' }} @endif>Blue</option>
                                    <option value="deep-orange" @if (old('bg-color')=="deep-orange" ) {{ 'selected' }} @endif>Orange</option>
                                    <option value="purple" @if (old('bg-color')=="purple" ) {{ 'selected' }} @endif>Purple</option>
                                </select>
                            </div>
                            <!-- /Back gorund colour -->
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="title">Upkram Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ old('title') }}" required autofocus>
                            </div>
                            <!-- /title -->
                            <!-- mohim body-->
                            <div class="form-group">
                                <label class="col-form-label" for="mohim-body">Upkram Detail</label>
                                <textarea name="mohim-body" class="form-control"
                                    id="mohim-body"></textarea>
                            </div>
                            <!-- /mohim body-->
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <!-- submit -->
                                    <button type="submit" class="btn btn-block btn-success">Create</button>
                                    <!-- /submit -->
                                </div>
                                <div class="col">
                                    <!-- submit -->
                                    <a href="{{ route('admin.upkram.index') }}" class="btn btn-block btn-danger">Cancel</a>
                                    <!-- /submit -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
