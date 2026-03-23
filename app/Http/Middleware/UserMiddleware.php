<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 'user' || Auth::user()->role === 'member')) {
            return $next($request);
        }

        return redirect('/admin/dashboard')->with('error', 'Unauthorized access.');
    }
}