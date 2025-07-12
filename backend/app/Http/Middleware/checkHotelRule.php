<?php

namespace App\Http\Middleware;

use App\Models\Hotel;
use Closure;
use Illuminate\Http\Request;

class checkHotelRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $hotel_id = $request->route('hotel_id');
        $hotel = Hotel::with('hotelRule')->find($hotel_id);

        if (!$hotel || !$hotel->hotelRule) {
            return redirect()->route('hotel.hotel_rules.index', ['hotel_id' => $hotel_id])
                ->with('warning', 'Vui lòng thiết lập quy tắc khách sạn trước khi tiếp tục.');
        }
        return $next($request);
    }
}
