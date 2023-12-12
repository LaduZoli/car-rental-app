<?php
// app/Http/Middleware/DebugMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DebugMiddleware
{
    public function handle($request, Closure $next)
    {
        info('Current user email: ' . optional(Auth::user())->email);

        return $next($request);
    }
}
