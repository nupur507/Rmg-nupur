<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotFranchise
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'franchise')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('franchise.login');
        }

        return $next($request);
    }
}
