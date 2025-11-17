<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Exception;

class JwtWebMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->cookie('jwt_token');
            if (! $token) {
                return redirect()->route('login')->with('error', 'Faça login primeiro.');
            }

            $user = JWTAuth::setToken($token)->authenticate();
            Auth::guard('jwt_web')->setUser($user);
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            // Token expirou → tentar renovar
            try {
                $newToken = JWTAuth::setToken($request->cookie('jwt_token'))->refresh();

                // Salva novo cookie e autentica
                $cookie = cookie('jwt_token', $newToken, 10, null, null, false, true);
                $user = JWTAuth::setToken($newToken)->authenticate();
                Auth::guard('jwt_web')->setUser($user);

                // Continua a requisição com novo token
                $response = $next($request);
                return $response->withCookie($cookie);

            } catch (Exception $e) {
                // Se não conseguir renovar, redireciona pro login
                return redirect()->route('login')->with('error', 'Sessão expirada. Faça login novamente.');
            }
        }
        catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Sessão inválida. Faça login novamente.');
        }

        return $next($request);
    }
}
