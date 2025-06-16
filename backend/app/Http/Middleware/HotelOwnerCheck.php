<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HotelOwnerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $hotel_id = $request->route('hotel_id');

        if ($user->id != $hotel_id) {
            abort(403, 'Unauthorized access to this hotel.');
        }

        return $next($request);
    }
}
