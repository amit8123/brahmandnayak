<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // get the user role
        $userRole = Auth::user()->role;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }
        return abort(401, 'Unauthorized');
    }
}
