<?php

namespace App\Http\Middleware;

use Closure;

class ClientSupervisor
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
        if(auth()->user()->role_id != 2){
            abort('404');
        }
        return $next($request);
    }
}
