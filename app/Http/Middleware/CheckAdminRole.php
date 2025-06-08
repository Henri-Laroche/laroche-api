<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // Suponha que o papel de administrador esteja armazenado em $user→role e que 'admin' seja o valor necessário.
        if (!$request->user() || $request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
