@extends('layouts.backend.master')

@section('title')
    Temple Trust - Login
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/crypto-js.min.js"></script>
<script>
    var onloadCallback = function() {};
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


        $("#login-button").click(async function(){
            let toEncrypt = {
                'email' : $("#email").val(),
                'password' : $("#password").val(),
                'g-recaptcha-response' : $("#g-recaptcha-response").val()
            };
            let encryptedData = encrypt(encKey, JSON.stringify(toEncrypt))

            var el = `<form method="POST" action="{{ route('login') }}" style="display: none;" hidden>
            @csrf
            <input name="encryptedData" value="${encryptedData}" hidden>
            <button type="submit" id="encrypted-submit">Login</button>
            </form>`

            $('body').append(el);
            setTimeout(() => {
                $("#encrypted-submit").click()
                $("#email").val("")
                $("#password").val("")
                $(this).attr('disabled',true)
            }, 500);

        });
    });
</script>
@endpush

@section('page-content')
<div class="login-card" style="margin-top: 40px;">
    <div class="login-logo"><i class="fas fa-om"></i></div>
    <h1>BSSSP Mandir</h1>
    <p class="sub">Admin Panel - please sign in to continue</p>

    <form id="login-form" onsubmit="return false;">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required autocomplete="off">
        </div>

        <div class="form-group mt-3">
            {!! NoCaptcha::renderJs('en', false, 'onloadCallback') !!}
            {!! NoCaptcha::display() !!}
        </div>

        <button type="button" class="btn btn-block btn-primary login-button" id="login-button">Login</button>

        @if ($errors->has('email') || $errors->has('password'))
            <div class="p-2 mt-3 bg-danger text-white text-center rounded">The email or password is not correct.</div>
        @endif
        @if ($errors->has('g-recaptcha-response'))
            <div class="p-2 mt-3 bg-danger text-white text-center rounded">Please tick the captcha box.</div>
        @endif
    </form>

    <div class="back-link"><a href="{{ route('home') }}">&larr; Back to website</a></div>
</div>
@endsection
