<?php

namespace App\Http\Middleware;

use Closure;
use GPBMetadata\Google\Api\Auth;
use Illuminate\Http\Request;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        $role = empty($role) ? [null] : $role;

        if (Auth()->check() && in_array(Auth()->user()->role->name, $role)){
            return $next($request);
        }
        
        return back()->with('error', 'Bạn không có quyền truy cập!');
    }
}
