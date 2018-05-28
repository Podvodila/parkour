<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Spot;

use Closure;

class CheckUser
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
        if(Spot::find($request->id)->user_id != Auth::id()) {
            return redirect()->route('site.spotAdd');
        }
        return $next($request);
    }
}
