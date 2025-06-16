<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;

class CheckJWT
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
        $token = $request->cookie('access_token');
        if (!$token) {
            return response()->json(['error' => 'Vui lòng đăng nhập để tiếp tục!'], 401);
        }
        try {

            $decode = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            if(!isset($decode->sub)){
                return response()->json([
                    'error' => 'Token không hợp lệ.'
                ],401);
            }
            
            $request->merge(['user_id' => $decode->sub]);
        } catch (\Firebase\JWT\ExpiredException $err) {
            return response()->json(['error' => 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.'], 401);
        } catch (\Exception $err) {
            return response()->json(['error' => 'Token không hợp lệ.'], 401);
        }
        return $next($request);
    }
}
