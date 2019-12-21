<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTAuthenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Token not provided'
            ]);
        }
        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Token expired'
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Token invalid'
            ]);
        }
        if (! $user) {
            return response()->json([
                'is_success' => false,
                'message'    => 'User not found'
            ]);
        }

        return $next($request);
    }
}
