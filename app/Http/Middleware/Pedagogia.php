<?php

namespace App\Http\Middleware;

use App\rules\UserAccess;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Pedagogia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $acess = session()->get('acesso');

        if ($acess == UserAccess::getPDG() || $acess == UserAccess::getAdm()) {

            return $next($request);
        }
        return redirect('/panel');
    }
}
