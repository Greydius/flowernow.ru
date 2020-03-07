<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocol
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

        if (
          !$request->secure() 
            && 
          App::environment() === 'production' 
            &&
          ($request->getHttpHost() === 'floristum.ru' || $request->getHttpHost() === 'floristum.com')
        ) {
          return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
