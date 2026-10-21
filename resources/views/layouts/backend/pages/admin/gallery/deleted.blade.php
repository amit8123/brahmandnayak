@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')
@section('sub-title')
    Gallery - Deleted
@endsection

@section('sub-custom-styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables.min.css') }}">
@endsection

@section('sub-custom-scripts')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/backend/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
                $('#myTable').DataTable();
    
                // for showing restore item popup
                $(document).on('click', "#restore-item", function() {
                    $(this).addClass('restore-item-trigger-clicked');
    
                    var options = {
                        'backdrop': 'static'
                    };
                    $('#restore-modal').modal(options)
                    $("#restore-modal-label").text('Restore item?')
                })
    
                // on click of confirmation
                $(document).on('click', "#restore-action-confirm", function() {
                    $('.restore-item-trigger-clicked').siblings("#restore-data-form").submit();
                })
    
                //  on modal hide
                $('#restore-modal').on('hide.bs.modal', function() {
                    $('.restore-item-trigger-clicked').removeClass('restore-item-trigger-clicked')
                })
            })
    
    </script>   
@endsection

@section('page-content')
    <div class="main-container container-fluid">
        @include('layouts.backend.messages')
        <!-- heading -->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="text-primary mr-auto">Deleted Gallery</h1>
                </div>
            </div>
        </div>
        <!-- /heading -->
        <!-- table -->
        <table class="table table-striped table-bordered" id="myTable" cellspacing="0" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Image name</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($galleryList->isNotEmpty())
                @foreach ($galleryList as $item)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $item->file_name }}</td>
                    <td class="align-middle">
                        <img src="{{  $item->file_path }}" alt="" width="120px" height="120px">
                    </td>
                    <td class="align-middle">
                        <form method="POST" id="restore-data-form"
                            action="{{ route('admin.gallery.deleted.restore', $item->id) }}" hidden>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                        </form>
                        <button type="button" class="btn btn-primary" id="restore-item"><i
                                class="fa fa-refresh"></i> Restore</button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <!-- /table -->
    </div>
    <!-- Restore Modal -->
    <div class="modal fade" id="restore-modal" tabindex="-1" role="dialog" aria-labelledby="restore-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restore-modal-label">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <h4 class="text-center">Are you sure you want to active this item?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" id="restore-action-confirm" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Restore Modal -->
@endsection
