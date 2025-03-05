<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Session;

class AuthCheckClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            //Session::put('intended_url', $request->getRequestUri());
            Session::put('intended_url', $request->fullUrl());
            return redirect(route('client.login'))->withErrors('You are not allowed to access');
        }

        return $next($request);
    }
}
