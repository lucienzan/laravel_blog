<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Testing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $num)
    {   
        // $acceptUser = [1,11];
        // if(! in_array(Auth::id(),$acceptUser)){
        //     return abort('404');
        // }
        // if(!(Auth::id()<=$num)){  // (1<=5)=>it turns out into true and then !(ture) => false
        //     return abort('404');
        // }
        // if(Auth::id() !== 11 && Auth::id() !==1){
        //     return abort('404');
        // }
        return $next($request);
    }
}
