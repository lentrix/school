<?php

namespace App\Http\Middleware;

use Closure;

class HasRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if(!auth()->guest() && (auth()->user()->hasRole($role) || auth()->user()->hasRole('admin'))) {
            return $next($request);
        }else {
            return redirect()->back()->with('Error','You are not allowed to the perform this action.');
        }
    }
}
