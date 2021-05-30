<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = is_array($role)
            ? $role
            : explode('|', $role);
        abort_if(!in_array($request->user()->role->slug, $roles), '403', 'Access denied');
        return $next($request);
    }
}
