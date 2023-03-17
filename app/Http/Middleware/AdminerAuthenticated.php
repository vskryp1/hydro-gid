<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\URL;

class AdminerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guard('admin')->check()) {
            if (auth()->user()->hasRole([UserType::ROLE_SUPER_ADMIN])) {
                return $next($request);
            }
        }
        abort(404);
    }

}
