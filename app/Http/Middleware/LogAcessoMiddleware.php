<?php

namespace App\Http\Middleware;

use Closure;
use App\LogAcesso;
class LogAcessoMiddleware
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
        $ip = $request->server->get('REMOTE_ADDR');
        $route = $request->getRequestUri();
        // return Response("passei aki");
        LogAcesso::create(['log' => $ip. ' requisitou a rota '. $route]);
        return $next($request);
        // $resposta = $next($request);
        // $resposta->setStatusCode(201, 'resposta modificada'); 
        // return dd($resposta);
    }
}

