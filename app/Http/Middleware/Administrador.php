<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class Administrador
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
        $UserAdmin = Auth::user()->level;
       if ($UserAdmin < 355){
          return redirect('/');
       }
        return $next($request);
    }
}
