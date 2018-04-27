<?php

namespace App\Http\Middleware;

use Closure;
use App\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RedirectIfClient
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'client')
	{
	    if (Auth::guard($guard)->check()) {
			$client=Auth::guard('client')->user();
			$client->last_login =Carbon::now();
			$client->save();
	        return redirect('client/home');
	    }

	    return $next($request);
	}
}