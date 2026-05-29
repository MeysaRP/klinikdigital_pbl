<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!session('login')) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }
        if (!in_array(session('role'), $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        return $next($request);
    }
}