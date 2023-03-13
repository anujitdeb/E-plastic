<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckAdmin
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
        if (!auth()->guard('admin')->check()) {
            return $next($request);
        }
        elseif (!auth()->guard('customer')->check()) {
            return $next($request);
        }
        elseif (!auth()->guard('employee')->check()) {
            return $next($request);
        }
        elseif (!auth()->guard('buyer')->check()) {
            return $next($request);
        }
        else{
            return redirect()->route('dashboard.index');
        }

    }
}
