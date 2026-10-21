<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;

class DecryptEncryptedPayload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('encryptedData')) {
            try {

                $encryptKey = base64_decode($request->session()->get('key'));

                $encryptedData = $request->input('encryptedData');


                $encryptInstance = new Encrypter($encryptKey);

                $decryptedData = $encryptInstance->decrypt($encryptedData, false);


                $request->request->remove('encryptedData');

                $decryptedData = json_decode($decryptedData, true);
                $request->request->add($decryptedData);

                return $next($request);
            } catch (\Throwable $th) {
                return abort(401);
            }
        }

        return $next($request);
    }
}
