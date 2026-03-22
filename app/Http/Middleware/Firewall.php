<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Firewall
{
    public function handle(Request $request, Closure $next)
    {
        // Block specific IP
        $blockedIps = ['192.168.1.1', '10.0.0.1'];

        if (in_array($request->ip(), $blockedIps)) {
            abort(403, 'Access Denied');
        }

        // Block suspicious user agents
        if (str_contains($request->userAgent(), 'curl')) {
            abort(403, 'Bot Access Denied');
        }

        return $next($request);
    }
}
