<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
       public function handle($request, Closure $next)
    {
        if (Auth::check() && session('locked', false)) {
            // Allow access only to the unlock route or lock screen
            if (!$request->routeIs('admin.unlock') && !$request->routeIs('admin.lock-screen')) {
                return redirect()->route('admin.lock-screen');
            }
        }

        return $next($request);
    }

}
