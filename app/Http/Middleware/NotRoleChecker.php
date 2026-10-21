<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Methods\Methods;
use Closure;
use Illuminate\Support\Facades\Auth;

class NotRoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $allowedRoles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$allowedRoles)
    {
        // get the user role
        $userRole = Auth::user()->role;
        if (!in_array($userRole, $allowedRoles)) {
            return $next($request);
        }
        return abort(401, 'Unauthorized');
    }
}
