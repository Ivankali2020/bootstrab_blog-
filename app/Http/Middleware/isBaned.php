<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isBaned
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
        if(Auth::user()->isBaned == '1'){
            Auth::logout();
            return redirect()->route('login')->with('message',['icon'=>'error','title'=> "You Are Banned From This Website"]);
        }
        return $next($request);
    }
}
