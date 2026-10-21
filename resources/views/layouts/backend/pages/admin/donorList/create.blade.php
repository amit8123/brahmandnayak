@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')

@section('sub-title')
    Donor - Create
@endsection

@section('sub-custom-styles')
@endsection

@section('sub-custom-scripts')
    <script>
        $(document).ready(function(){
            $("#amount").keydown(function (e) {
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
@endsection

@section('page-content')
    <div class="main-container container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                @include('layouts.backend.messages')
                <form class="form-horizontal" method="POST" action="{{ route('admin.donorList.store') }}">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Create New Donor</h2>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <!-- date -->
                            <div class="form-group">
                                <label class="col-form-label" for="date">Date</label>
                                <input type="date" name="date" class="form-control" id="date" value="{{ old('date') }}" required autofocus>
                            </div>
                            <!-- /date -->
                            <!-- name -->
                            <div class="form-group">
                                <label class="col-form-label" for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            <!-- /name -->
                            <!-- email -->
                            <div class="form-group">
                                <label class="col-form-label" for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <!-- /email -->
                            <!-- amount -->
                            <div class="form-group">
                                <label class="col-form-label" for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control" id="amount" value="{{ old('amount') }}" required autofocus>
                            </div>
                            <!-- /amount -->
                            <!-- transaction_id -->
                            <div class="form-group">
                                <label class="col-form-label" for="transaction_id">Transaction ID</label>
                                <input type="text" name="transaction_id" class="form-control" id="transaction_id" value="{{ old('transaction_id') }}" required autofocus>
                            </div>
                            <!-- /transaction_id -->
                            <!-- remark -->
                            <div class="form-group">
                            <label class="col-form-label" for="remark">Remark</label><br>
                            <textarea id="remark" name="remark" rows="4" cols="50" value="{{ old('remark') }}"></textarea>
                            </div>
                            <!-- remark -->
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
                                    <a href="{{ route('admin.donorList.index') }}" class="btn btn-block btn-danger">Cancel</a>
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
