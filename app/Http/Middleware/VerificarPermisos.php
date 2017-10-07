<?php

namespace GaneshaSIGE\Http\Middleware;

use Closure;
use Laracasts\Flash\Flash;


class VerificarPermisos
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
       #dd(\Request::route()->getName());
        foreach (\Auth::user()->roles as $rol) {
            if($rol->tieneModulo(\Request::route()->getName())){
                return $next($request);
            }
        else{
        Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>');

        return back();
        }
        }

    }
}
