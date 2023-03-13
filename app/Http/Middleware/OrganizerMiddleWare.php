<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OrganizerMiddleWare
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
        if (auth()->guard('organizer')->user()) {
            auth('web')->logout();
            auth('admin')->logout();

            /*  auth('buyer')->logout();
              auth('seller')->logout();
              auth('employee')->logout();*/
            return $next($request);
        }else{
            return redirect()->route('organizer.login');
        }
    }
}
