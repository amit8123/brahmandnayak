<?php

use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/handshake', function (Request $request) {

//     $encryptKey = Crypt::generateKey('AES-128-CBC');

//     $base64Key = base64_encode($encryptKey);
//     $request->session()->put('key', $base64Key);

//     return response()->json(['encryptionKey' => $base64Key]);
// })->name('handshake');

// Route::post('/normal', function (Request $request) {
//     return response()->json(['request' => $request->all()]);
// })->name('normal');
