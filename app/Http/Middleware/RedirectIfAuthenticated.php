<?php

    namespace App\Http\Middleware;

    use Closure;

    class RedirectIfAuthenticated
    {
        /**
         * Handle an incoming request.
         *
         * @param               $request
         * @param  \Closure     $next
         * @param  string|null  $guard
         *
         * @return \Illuminate\Http\RedirectResponse|mixed
         */
        public function handle($request, Closure $next, ?string $guard = null)
        {
            if (auth($guard)->check()) {
                if ($guard === 'admin') {
                    return redirect()->route('backend.dashboard');
                }

                return redirect()->route('frontend.page', ['alias' => 'account']);
            }

            return $next($request);
        }
    }
