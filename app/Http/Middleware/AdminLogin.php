<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        //判断是否登陆
        if(!session('userName')){
            if($cookie = \Cookie::get('autoBlog'))
            {
                session(['userName'=>$cookie['name']]);
                session(['userUid'=>$cookie['uid']]);
            }
            else
            {
                return redirect(route('viewLogin'));
            }
        }
        return $next($request);
    }
}
