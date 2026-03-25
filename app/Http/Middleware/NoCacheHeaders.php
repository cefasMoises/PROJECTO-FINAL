<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoCacheHeaders
{
	public function handle(Request $request, Closure $next): Response
	{
		$response = $next($request);

		return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
			->header('Pragma', 'no-cache')
			->header('Expires', 'Sat, 01 Jan 1999 00:00:00 GMT');
	}
}
