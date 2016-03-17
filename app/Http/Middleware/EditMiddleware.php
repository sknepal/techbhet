<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Log;
use App\Event;
use Illuminate\Http\Request;
class EditMiddleware
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
//       Log::error(session()->get('owner'));
//        Log::error(Auth::user()->id);
//
//      if (session()->get('owner')!=Auth::user()->id){
//            return redirect('/');
//        }
        return $next($request);
    }
}
