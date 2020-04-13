<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\City;

class DomainMiddleware
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

            /*
        $host = strtolower(request()->getHost());
        $shortHost = str_replace('flownow.loc', '', $host);
            */

        $host = strtolower(request()->getHost());
        $shortHost = str_replace(env('APP_DOMAIN'), '', $host);

        $subdomains = explode('.', $shortHost);
        if(count($subdomains) > 2) {
                abort(404);
        }

        $subdomain = current($subdomains);

        if(empty($subdomain) || $subdomain == 'www') {
                if($request->_city != false) {
                  $subdomain = $request->_city;
                } else {
                  $subdomain = 'moskva';
                }     
        }

        if($subdomain == 'spb') {
                $subdomain = 'sankt-peterburg';
        }

        $city = City::whereSlug($subdomain)->with(['region'])->firstOrFail();

        $request->_city = $city;



        return $next($request);
    }
}
