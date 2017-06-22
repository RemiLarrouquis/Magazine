<?php

namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Exception;
class authJWT
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::toUser($request->input('token'));
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['error'=>true, 'result'=>'Erreur de connexion']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['error'=>true, 'result'=>'Connexion perdue']);
            }else{
                return response()->json(['error'=>true, 'result'=>"Erreur d'authentification"]);
            }
        }
        return $next($request);
    }
}
