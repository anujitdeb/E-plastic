<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StallMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('stall')->check()) {
            auth('admin')->logout();
            auth('organizer')->logout();
            return $next($request);
        }else{
            return redirect()->route('stall.login');
        }
    }
}
