<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyConnection {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if ( ! Auth::getSession()->get('id_conn2') ) {

             if ( $request->ajax() ) {
                 return response('sin conexion a fuente de datos','412');
             }

            return  abort('412','sin conexion a fuente de datos');
        }
        return $next($request);
    }

}
