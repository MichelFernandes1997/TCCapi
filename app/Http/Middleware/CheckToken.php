<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Redis;

use Closure;

class CheckToken
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
        try {
            $bearerToken = $request->header('Authorization');

            if ($bearerToken !== null) {
                $token = str_replace('\\', '', Str::after($bearerToken, ' '));

                if (Redis::get($token) === null)
                    return response()->json(['error' => 'Unathenticated user!'], 401);

                $request->token = $token;
                
                Redis::expire($token, '3600');
            } else {
                return response()->json(['error' => 'Token not found'], 401);
            }

            return $next($request);
        } catch (Exception $e) {
            return response()->json(['Authorize' => $e->getMessage()], $e->getStatusCode());
        }
    }
}
