<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('admin*')) {
            // Hozzáadjuk az admin jogokat az összes kérést küldő felhasználónak
            $user = Config::get('admins.admin_data');
    
            // Kiírjuk a $user változó tartalmát a log-ba
            \Log::debug('User data in middleware:', ['user' => $user]);
    
            // Ellenőrizzük, hogy a $user egyáltalán tartalmaz-e értékeket
            if ($user) {
                // Hozzáadjuk az admin jogokat a felhasználóhoz
                $request->merge(['user' => $user]);
            }
        }
    
        return $next($request);
    }
}
