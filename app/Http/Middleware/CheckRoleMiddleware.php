<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        if(in_array($request->user()->role, $roles)){
            return $next($request);
        }

        if($roles[0] == "admin"){
            return redirect(url('/').'/admin_login');
        }
        else{
            return redirect(url('/').'/user_login');
        }
        return back();
    }
}
