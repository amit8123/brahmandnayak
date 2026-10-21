@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')

@section('sub-title')
    Gallery - Create
@endsection

@section('sub-custom-styles')
<link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone-custom.css') }}">
@endsection

@section('sub-custom-scripts')
<script src="{{ asset('assets/backend/js/dropzone.min.js') }}"></script>
<script>
    $(document).ready(function(){
            $(".submit-form").click(function(){
                $("#upload-zone").submit()
            });

            $(window).on('load', function(){
                Dropzone.autoDiscover = false;
            })
            var uploadedDocumentMap = {};

            var dropzoneOptions = {
                dictDefaultMessage: 'Drag & drop here or click to select',
                paramName: "document",
                url: '{{ route('admin.gallery.upload') }}',
                maxFilesize: 2, // MB
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    if(response.success){
                        $('form').append('<input type="hidden" name="document[' + file.name + ']" value="' + response.image_path + '">')
                        uploadedDocumentMap[file.name] = response.image_path
                    } else {
                        $('form').find('input[name="document[' + file.name + ']"][value="' + name + '"]').remove()
                        file.previewElement.remove()
                        alert(response.message);
                    }
                },
                removedfile: function (file) {
                    console.log(file)
                    file.previewElement.remove()

                    if(uploadedDocumentMap[file.name] != null){
                        let path = uploadedDocumentMap[file.name];
                        $('form').find('input[name="document[' + file.name + ']"][value="' + path + '"]').remove()
                    }
                },
                
            };
            var uploader = document.querySelector('#upload-zone');
            var myDropzone = new Dropzone(uploader, dropzoneOptions);
        })
</script>
@endsection

@section('page-content')
    <div class="main-container container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                @include('layouts.backend.messages')
    
                <label for="document">Gallery</label>
    
                <form id="upload-zone" class="upload-zone form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.gallery.store') }}">
                    @csrf
    
                    <!--category-->
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="category">Category</label>
                        <div class="col-md-4">
                            <select class="form-control" name="category" id="category" required="required">
                                <option value="">Select Category</option>
                                @foreach ($categoryList as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--/category-->
    
                    <div class="fallback">
                        <input name="document" id="document-dropzone" type="file" multiple />
                    </div>
                </form>
                <div class="form-group d-flex justify-content-end mt-3">
                    <input class="btn btn-danger submit-form" type="submit">
                </div>
    
            </div>
        </div>
    </div>
@endsection
