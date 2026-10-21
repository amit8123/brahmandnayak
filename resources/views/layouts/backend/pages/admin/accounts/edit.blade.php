@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')
@section('sub-title')
    Accounts - Edit
@endsection

@section('sub-custom-styles')
@endsection

@section('sub-custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/crypto-js.min.js"></script>
<script>
    $( document ).ready(function() {
        let encKey = '{{ $base64Key }}';

        function encrypt(encryptionKey, data){
            let iv = CryptoJS.lib.WordArray.random(16);
            let key = CryptoJS.enc.Base64.parse(encryptionKey);
            let options = {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7,
            };

            let encrypted = CryptoJS.AES.encrypt(data, key, options);
            encrypted = encrypted.toString();
            iv = CryptoJS.enc.Base64.stringify(iv);
            
            let result = {
                iv: iv,
                value: encrypted,
                mac: CryptoJS.HmacSHA256(iv + encrypted, key).toString(),
            };

            result = JSON.stringify(result);
            result = CryptoJS.enc.Utf8.parse(result);
            return CryptoJS.enc.Base64.stringify(result);
        }


        $("#submit-botton").click(async function(){
            let toEncrypt = {
                'name' : $("#name").val(),
                'email' : $("#email").val(),
                'mobile' : $("#mobile").val(),
                'role' : $("#role").val(),
                'password' : $("#password").val(),
                'confirm-password' : $("#confirm-password").val()
            };
            let encryptedData = encrypt(encKey, JSON.stringify(toEncrypt))

            var el = `<form method="POST" action="{{ route('admin.accounts.update',$account->id) }}" enctype="multipart/form-data" style="display: none;" hidden>
            @csrf
            @method('PATCH')
            <input name="encryptedData" value="${encryptedData}" hidden>
            <button type="submit" id="encrypted-submit">Login</button>
            </form>`

            $('body').append(el);
            setTimeout(() => {
                $("#encrypted-submit").click()
                $("#password").val("")
                $("#confirm-password").val("")
                $(this).attr('disabled',true)
            }, 500);

        });
    });
</script>
    <script>
        $(document).ready(function(){
            $("#mobile").keydown(function (e) {
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
                <form class="form-horizontal">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header">
                            <h2 class="m-0">Edit Accounts</h2>
                        </div>
                        <div class="card-body">
                        {{-- {{ csrf_field() }}
                        {{ method_field('patch') }} --}}
                        @csrf
                        @method('PATCH')
                        <!-- name -->
                            <div class="form-group">
                                <label class="col-form-label" for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name',$account->name) }}" required autofocus>
                            </div>
                            <!-- /name -->
                            <!-- email -->
                            <div class="form-group">
                                <label class="col-form-label" for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email',$account->email) }}" required>
                            </div>
                            <!-- /email -->
                            <!-- mobile -->
                            <div class="form-group">
                                <label class="col-form-label" for="mobile">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control" id="mobile" minlength="10" maxlength="13" value="{{ old('mobile',$account->mobile) }}" required>
                            </div>
                            <!-- /mobile -->
                            <!-- role -->
                            <div class="form-group">
                                <label class="col-form-label" for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Select a role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{ ((old('role') == $role->id) || $account->role == $role->id)? 'selected': '' }}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /role -->
                            <!-- password -->
                            <div class="form-group">
                                <label class="col-form-label" for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" minlength="6">
                            </div>
                            <!-- /password -->
                            <!-- confirm password -->
                            <div class="form-group mb-0">
                                <label class="col-form-label" for="confirm-password">Confirm Password</label>
                                <input type="password" name="confirm-password" class="form-control" id="confirm-password" minlength="6">
                            </div>
                            <!-- /confirm password -->
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <!-- submit -->
                                    <button type="button" class="btn btn-block btn-success submit-botton" id="submit-botton">Update</button>
                                    <!-- /submit -->
                                </div>
                                <div class="col">
                                    <!-- submit -->
                                    <a href="{{ route('admin.accounts.index') }}" class="btn btn-block btn-danger">Cancel</a>
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
