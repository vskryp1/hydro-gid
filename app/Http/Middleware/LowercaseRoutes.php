<?php

	namespace App\Http\Middleware;

	use Closure;
	use Redirect;

	class LowercaseRoutes
	{
		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \Closure                 $next
		 * @return mixed
		 */
		public function handle ($request, Closure $next)
		{
			if (!ctype_lower(preg_replace('/[^A-Za-z]/', '', $request->path())) && $request->path() !== "/") {
				$old_route = $request->fullUrl();
				$new_route = str_replace($request->path(), strtolower($request->path()), $old_route);
				if($new_route != $old_route) {
					return Redirect::to($new_route, 301);
				}
			}
			return $next($request);
		}
	}
