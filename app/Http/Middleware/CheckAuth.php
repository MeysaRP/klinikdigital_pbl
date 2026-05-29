<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('login')) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        return $next($request);
    }
}
