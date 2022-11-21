<?php

namespace App\Http\Middleware;

use App\Models\UserDriver;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DriverJwtAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        // Config::set('guard.user.provider', 'drivers');
        return $next($request);
    }
}
