<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class CheckLocale
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
        $locale = $request->cookie('locale');
        if($locale) App::setLocale($locale);
        return $next($request);
    }
}
