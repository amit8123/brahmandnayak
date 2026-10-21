@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')

@section('sub-title')
    Upkram - Edit
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
                <form class="form-horizontal" method="POST" action="{{ route('admin.upkram.update',$upkram->id) }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Edit Upkram</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <!-- icon -->
                            <div class="form-group">
                                <label class="col-form-label" for="icon">Select Icon</label>
                                <select class="form-control" id="icon" name="icon" required>
                                    <option value="">Select an Icon</option>
                                    <option value="user" {{ ($upkram->icon == 'user'? 'selected': '') }}>User</option>
                                    <option value="pen" {{ ($upkram->icon == 'pen'? 'selected': '') }}>Pen</option>
                                    <option value="mobile" {{ ($upkram->icon == 'mobile'? 'selected': '') }}>Mobile</option>
                                    <option value="plus" {{ ($upkram->icon == 'plus'? 'selected': '') }}>Plus</option>
                                    <option value="laptop" {{ ($upkram->icon == 'laptop'? 'selected': '') }}>Laptop</option>
                                    <option value="bell" {{ ($upkram->icon == 'bell'? 'selected': '') }}>Bell</option>
                                </select>
                            </div>
                            <!-- /icon -->
                            <!-- Back gorund colour -->
                            <div class="form-group">
                                <label class="col-form-label" for="bg-color">Select Back-Ground Colour</label>
                                <select class="form-control" id="bg-color" name="bg-color" required>
                                    <option>Select a Background Colour</option>
                                    <option value="green" {{ ($upkram->bg_color == 'green'? 'selected': '') }}>Green</option>
                                    <option value="teal" {{ ($upkram->bg_color == 'teal'? 'selected': '') }}>Teal</option>
                                    <option value="brown-900" {{ ($upkram->bg_color == 'brown-900'? 'selected': '') }}>Brown</option>
                                    <option value="blue" {{ ($upkram->bg_color == 'blue'? 'selected': '') }}>Blue</option>
                                    <option value="deep-orange" {{ ($upkram->bg_color == 'deep-orange'? 'selected': '') }}>Orange</option>
                                    <option value="purple" {{ ($upkram->bg_color == 'purple'? 'selected': '') }}>Purple</option>
                                </select>
                            </div>
                            <!-- /Back gorund colour -->
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="title">Upkram Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title',$upkram->title) }}" required autofocus>
                            </div>
                            <!-- /title -->
                            <!-- mohim body-->
                            <div class="form-group">
                                <label class="col-form-label" for="mohim-body">Upkram Detail</label>
                                <textarea name="mohim-body" class="form-control" id="mohim-body">{!! $upkram->mohim_body!!}</textarea>
                            </div>
                            <!-- /mohim body-->
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <!-- submit -->
                                    <button type="submit" class="btn btn-block btn-success">Update</button>
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
