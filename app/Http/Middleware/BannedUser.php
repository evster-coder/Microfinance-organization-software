<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BannedUser
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->blocked) {
            return redirect()->route('user.banned');
        }

        return $next($request);
    }
}
