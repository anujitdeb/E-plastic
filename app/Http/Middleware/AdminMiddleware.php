<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('admin')->user()) {
            auth('web')->logout();
            auth('organizer')->logout();
            auth('customer')->logout();
            auth('buyer')->logout();
            auth('employee')->logout();

          /*  auth('buyer')->logout();
            auth('seller')->logout();
            auth('employee')->logout();*/
            return $next($request);
        }
        elseif (auth()->guard('customer')->user()) {
            auth('web')->logout();
            auth('admin')->logout();
            auth('customer')->logout();
            auth('buyer')->logout();
            auth('employee')->logout();

            /*  auth('buyer')->logout();
              auth('seller')->logout();
              auth('employee')->logout();*/
            return $next($request);
        }
        elseif (auth()->guard('buyer')->user()) {
            auth('web')->logout();
            auth('organizer')->logout();
            auth('customer')->logout();
            auth('admin')->logout();
            auth('employee')->logout();

            /*  auth('buyer')->logout();
              auth('seller')->logout();
              auth('employee')->logout();*/
            return $next($request);
        }
        elseif (auth()->guard('employee')->user()) {
            auth('web')->logout();
            auth('organizer')->logout();
            auth('customer')->logout();
            auth('buyer')->logout();
            auth('admin')->logout();

            /*  auth('buyer')->logout();
              auth('seller')->logout();
              auth('employee')->logout();*/
            return $next($request);
        }
        else{
            return redirect()->route('dashboard.login');
        }
    }
}
