<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class GetDashboardPage
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
      // dd($request->path());
      // return new Response(view($request->path()));
      try {
        return new Response(view($request->path()));;
      } catch (\Exception $e) {
        try {
          return new Response(view($request->path() . '/index'));;
        } catch (\Exception $e) {
          return $next($request);
        }
      }

    }
}
