<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocolMiddleware {

    public function handle($request, Closure $next)
    {
            // if (!$request->secure() && App::environment() === 'production' && ($request->getHttpHost() === 'floristum.com' || $request->getHttpHost() === 'floristum.ru')) {
            //     // return redirect()->secure($request->getRequestUri());
            // }

            return $next($request); 
    }
}