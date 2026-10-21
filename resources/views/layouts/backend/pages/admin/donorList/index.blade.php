@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')

@section('sub-title')
Donor
@endsection

@section('sub-custom-styles')
<style>
    .import-card { border: 0; border-radius: 14px; box-shadow: 0 8px 30px rgba(0, 0, 0, .08); margin: 18px 0 26px; }
    .dropzone-box {
        border: 3px dashed #c9a24a; border-radius: 14px; background: #fffaf0;
        padding: 34px 20px; text-align: center; cursor: pointer;
        transition: background .25s, border-color .25s, transform .25s;
    }
    .dropzone-box:hover, .dropzone-box.is-over { background: #fff1cc; border-color: #e8731a; transform: scale(1.01); }
    .dropzone-box .dz-icon { font-size: 46px; line-height: 1; }
    .dropzone-box .dz-title { font-weight: 700; font-size: 18px; margin-top: 8px; }
    .dropzone-box .dz-file { margin-top: 10px; font-weight: 600; color: #702f1e; word-break: break-all; }
    .import-busy {
        position: fixed; inset: 0; z-index: 2000; display: none; align-items: center; justify-content: center;
        background: rgba(255, 255, 255, .85); font-size: 20px; font-weight: 700; flex-direction: column;
    }
    .import-busy.show { display: flex; }
</style>
@endsection

@section('sub-custom-scripts')
<script>
    $(document).ready(function() {
        $(".data-table").dataTable({ pageLength: 50, lengthMenu: [[25, 50, 100, 500, -1], [25, 50, 100, 500, 'All']] })

        // ---- excel / csv drag & drop import ----
        var $zone = $('#dropzone'), $input = $('#import-file');
        function showFile(file) {
            $('#dz-file').text(file ? file.name + ' (' + Math.round(file.size / 1024) + ' KB)' : '');
            $('#import-submit').prop('disabled', !file);
        }
        $zone.on('click', function(e) { if (e.target.id !== 'import-file') $input.trigger('click'); });
        $input.on('click', function(e) { e.stopPropagation(); });
        $input.on('change', function() { showFile(this.files[0]); });
        $zone.on('dragover dragenter', function(e) { e.preventDefault(); e.stopPropagation(); $zone.addClass('is-over'); });
        $zone.on('dragleave dragend drop', function(e) { e.preventDefault(); e.stopPropagation(); $zone.removeClass('is-over'); });
        $zone.on('drop', function(e) {
            var files = e.originalEvent.dataTransfer.files;
            if (files && files.length) {
                $input[0].files = files;
                showFile(files[0]);
            }
        });
        $('#import-form').on('submit', function() { $('#import-busy').addClass('show'); });
        /**
         * for showing delete item popup
         */

        $(document).on('click', "#delete-item", function() {
            $(this).addClass('delete-item-trigger-clicked');

            var options = {
                'backdrop': 'static'
            };
            $('#delete-modal').modal(options)
            $("#delete-modal-label").text('Delete item?')
        })

        // on click of confirmation
        $(document).on('click', "#delete-action-confirm", function() {
            $('.delete-item-trigger-clicked').siblings(".delete-data-form").submit();
        })

        //  on modal hide
        $('#delete-modal').on('hide.bs.modal', function() {
            $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
        })
    })

</script>
@endsection

@section('page-content')
<div class="main-container container">
    @include('layouts.backend.messages')
    <!-- heading -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-primary mr-auto">Donor List</h1>
            </div>
            <div class="col d-flex justify-content-end align-self-center">
                <a href="{{ route('admin.donorList.create') }}" class="btn btn-outline-primary pull-right">Create New</a>
            </div>
        </div>
    </div>
    <!-- /heading -->

    @if (session()->has('import_errors'))
    <div class="alert alert-warning">
        <strong>Some rows were skipped:</strong>
        <ul class="mb-0">
            @foreach (session('import_errors') as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- import from excel -->
    <div class="card import-card">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-wrap align-items-center mb-3">
                <h4 class="mb-0">Import donors from Excel</h4>
                <a href="{{ route('admin.donorList.import.template') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-download"></i> Download sample sheet
                </a>
            </div>
            <form id="import-form" method="POST" action="{{ route('admin.donorList.import') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div id="dropzone" class="dropzone-box">
                    <div class="dz-icon">&#128196;</div>
                    <div class="dz-title">Drop your Excel file here, or click to choose</div>
                    <div class="text-muted">.xlsx or .csv &middot; columns: date, name, email, amount, transaction_id, remark</div>
                    <div class="dz-file" id="dz-file"></div>
                    <input type="file" id="import-file" name="file" accept=".xlsx,.csv,.txt" hidden>
                </div>
                <div class="d-flex justify-content-between flex-wrap align-items-center mt-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="skip_duplicates" name="skip_duplicates" value="1" checked>
                        <label class="custom-control-label" for="skip_duplicates">Skip rows whose Transaction ID already exists</label>
                    </div>
                    <button type="submit" id="import-submit" class="btn btn-primary" disabled>
                        <i class="fa fa-upload"></i> Import now
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="import-busy" id="import-busy">
        <div>&#9203; Importing, please wait&hellip;</div>
        <small class="text-muted mt-2">Large files can take a minute. Do not close this page.</small>
    </div>
    <!-- /import from excel -->

    <!-- table -->
    <table class="table table-striped table-bordered data-table" cellspacing="0" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Transaction ID</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($donorList->isNotEmpty())
            @foreach($donorList as $item)
            <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $item->date }}</td>
                    <td class="align-middle">{{ $item->name }}</td>
                    <td class="align-middle">{{ $item->email }}</td>
                    <td class="align-middle">{{ $item->amount }}</td>
                    <td class="align-middle">{{ $item->transaction_id }}</td>
                    <td class="align-middle">{{ $item->remark }}</td>
                <td class="align-middle">
                    <a href="{{ route('admin.donorList.edit', $item->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <form method="POST" class="delete-data-form" action="{{ route('admin.donorList.delete', $item->id) }}" hidden>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                    <button type="button" class="btn btn-danger" id="delete-item"><i class="fa fa-trash-o"></i> Delete</button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <!-- /table -->
</div>
<!-- Delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-modal-label">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-content">
                <h4 class="text-center">Are you sure you want to delete this item?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete-action-confirm" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
@endsection
